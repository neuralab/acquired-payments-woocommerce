<?php
/**
 * PaymentGatewayTest.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Unit\WooCommerce;

use AcquiredComForWooCommerce\Tests\Framework\TestCase;
use AcquiredComForWooCommerce\Tests\Framework\Traits\AdminServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\Reflection;
use AcquiredComForWooCommerce\Tests\Framework\Traits\IncomingDataHandlerMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\LoggerServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\OrderServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\PaymentMethodServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\SettingsServiceMock;
use AcquiredComForWooCommerce\WooCommerce\PaymentGateway;
use Brain\Monkey\Functions;
use Mockery;

/**
 * PaymentGatewayTest class.
 *
 * @covers \AcquiredComForWooCommerce\WooCommerce\PaymentGateway
 */
class PaymentGatewayTest extends TestCase {
	/**
	 * Traits.
	 */
	use Reflection;
	use IncomingDataHandlerMock;
	use AdminServiceMock;
	use LoggerServiceMock;
	use OrderServiceMock;
	use PaymentMethodServiceMock;
	use SettingsServiceMock;

	/**
	 * Test class instance.
	 *
	 * @var object
	 */
	protected object $test_class;

	/**
	 * Mock settings for constructor.
	 *
	 * @return void
	 */
	private function mock_settings_for_constructor() : void {
		$this->get_settings_service()->shouldReceive( 'get_option' )->andReturn( 'test_value' );
		$this->get_settings_service()->shouldReceive( 'get_fields' )->andReturn( [] );
		$this->get_settings_service()->shouldReceive( 'get_wc_api_endpoint' )->with( 'webhook' )->andReturn( 'acquired-com-for-woocommerce-webhook' );
		$this->get_settings_service()->shouldReceive( 'get_wc_api_endpoint' )->with( 'redirect-new-order' )->andReturn( 'acquired-com-for-woocommerce-redirect-new-order' );
		$this->get_settings_service()->shouldReceive( 'get_wc_api_endpoint' )->with( 'redirect-new-payment-method' )->andReturn( 'redirect-new-payment-method' );
	}

	/**
	 * Mock init_hooks method.
	 *
	 * @return void
	 */
	private function mock_init_hooks() : void {
		Functions\expect( 'add_action' )
			->with(
				'woocommerce_update_options_payment_gateways_' . $this->config['plugin_id'],
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'process_admin_options' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'admin_notices',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'display_errors' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'admin_enqueue_scripts',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'add_order_assets' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'admin_enqueue_scripts',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'add_settings_assets' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'woocommerce_api_webhook-endpoint',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'process_webhook' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'woocommerce_api_redirect-order-endpoint',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'redirect_new_order' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'woocommerce_api_redirect-payment-endpoint',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'redirect_new_payment_method' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'woocommerce_order_action_' . $this->config['plugin_id'] . '_capture_payment',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'process_capture' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_action' )
			->with(
				'woocommerce_order_action_' . $this->config['plugin_id'] . '_cancel_order',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'process_cancellation' === $callback[1];
					}
				)
			)
			->once();

		Functions\expect( 'add_filter' )
			->with(
				'woocommerce_order_actions',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'add_order_actions' === $callback[1];
					}
				),
				10,
				2
			)
		->once();

		Functions\expect( 'add_filter' )
			->with(
				'woocommerce_gateway_description',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'show_staging_message' === $callback[1];
					}
				),
				10,
				2
			)
			->once();

		Functions\expect( 'add_filter' )
			->with(
				'woocommerce_order_fully_refunded_status',
				Mockery::on(
					function( $callback ) {
						return is_array( $callback ) && count( $callback ) === 2 && 'set_order_fully_refunded_status' === $callback[1];
					}
				),
				10,
				2
			)
			->once();
	}

	/**
	 * Set up the test case.
	 *
	 * @return void
	 */
	protected function setUp() : void {
		parent::setUp();

		$this->mock_incoming_data_handler();
		$this->mock_admin_service();
		$this->mock_logger_service();
		$this->mock_order_service();
		$this->mock_payment_method_service();
		$this->mock_settings_service();

		// Mock requirements for the constructor.
		$this->mock_settings_for_constructor();
		$this->get_settings_service()->shouldReceive( 'is_enabled' )->with( 'tokenization' )->andReturn( false );
		$this->mock_init_hooks();

		// Create the test class instance - this will trigger all the hook expectations
		$this->test_class = new PaymentGateway(
			$this->get_incoming_data_handler(),
			$this->get_admin_service(),
			$this->get_logger_service(),
			$this->get_order_service(),
			$this->get_payment_method_service(),
			$this->get_settings_service()
		);

		$this->initialize_reflection( $this->test_class );
	}

	/**
	 * Test constructor.
	 *
	 * @covers \AcquiredComForWooCommerce\WooCommerce\PaymentGateway::__construct
	 * @return void
	 */
	public function test_constructor() : void {
		$this->assertSame( $this->get_incoming_data_handler(), $this->get_private_property_value( 'incoming_data_handler' ) );
		$this->assertSame( $this->get_admin_service(), $this->get_private_property_value( 'admin_service' ) );
		$this->assertSame( $this->get_logger_service(), $this->get_private_property_value( 'logger_service' ) );
		$this->assertSame( $this->get_order_service(), $this->get_private_property_value( 'order_service' ) );
		$this->assertSame( $this->get_payment_method_service(), $this->get_private_property_value( 'payment_method_service' ) );
		$this->assertSame( $this->get_settings_service(), $this->get_private_property_value( 'settings_service' ) );
		$this->assertEquals( $this->config['plugin_id'], $this->test_class->id );
		$this->assertEquals( 'Acquired.com', $this->test_class->method_title );
		$this->assertEquals(
			'Securely accept Cards, Apple Pay & Google Pay on your store using Acquired.com.',
			$this->test_class->method_description
		);
		$this->assertFalse( $this->test_class->has_fields );
		$this->assertEquals( [ 'products', 'refunds' ], $this->test_class->supports );
	}

	/**
	 * Test constructor adds tokenization support when enabled.
	 *
	 * @covers \AcquiredComForWooCommerce\WooCommerce\PaymentGateway::__construct
	 * @return void
	 */
	public function test_constructor_adds_tokenization_support_when_enabled() : void {
		// Create a completely new mock for settings service
		$this->mock_settings_service();

		// Mock requirements for the constructor.
		$this->mock_settings_for_constructor();
		$this->get_settings_service()->shouldReceive( 'is_enabled' )->with( 'tokenization' )->andReturn( true );
		$this->mock_init_hooks();

		// Create test instance with tokenization enabled
		$test_class_instance = new PaymentGateway(
			$this->get_incoming_data_handler(),
			$this->get_admin_service(),
			$this->get_logger_service(),
			$this->get_order_service(),
			$this->get_payment_method_service(),
			$this->get_settings_service()
		);

		$this->assertEquals( [ 'products', 'refunds', 'tokenization' ], $test_class_instance->supports );
	}
}
