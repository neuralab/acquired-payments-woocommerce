<?php
/**
 * PaymentMethodTest.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Unit\WooCommerce;

use AcquiredComForWooCommerce\Tests\Framework\TestCase;
use AcquiredComForWooCommerce\Tests\Framework\Traits\Reflection;
use AcquiredComForWooCommerce\Tests\Framework\Traits\AssetsServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\SettingsServiceMock;
use AcquiredComForWooCommerce\WooCommerce\PaymentGateway;
use AcquiredComForWooCommerce\WooCommerce\PaymentMethod;
use Mockery;
use Mockery\MockInterface;

/**
 * PaymentMethodTest class.
 *
 * @covers \AcquiredComForWooCommerce\WooCommerce\PaymentMethod
 */
class PaymentMethodTest extends TestCase {
	/**
	 * Traits.
	 */
	use Reflection;
	use AssetsServiceMock;
	use SettingsServiceMock;

	/**
	 * Test class instance.
	 *
	 * @var object
	 */
	protected object $test_class;

	/**
	 * PaymentGateway mock.
	 *
	 * @var MockInterface&PaymentGateway
	 */
	protected MockInterface $payment_gateway;

	/**
	 * Create and configure PaymentGateway mock.
	 *
	 * @return void
	 */
	protected function mock_payment_gateway() : void {
		$this->payment_gateway = Mockery::mock( PaymentGateway::class );

		// Set up basic properties that PaymentMethod needs
		$this->payment_gateway->id          = $this->config['plugin_id'];
		$this->payment_gateway->title       = 'Acquired.com';
		$this->payment_gateway->description = 'Securely accept Cards, Apple Pay & Google Pay on your store using Acquired.com.';
		$this->payment_gateway->supports    = [ 'products', 'refunds' ];

		// Set up method expectations
		$this->payment_gateway->shouldReceive( 'is_available' )->andReturn( true );
	}

	/**
	 * Get PaymentGateway.
	 *
	 * @return MockInterface&PaymentGateway
	 */
	public function get_payment_gateway() : MockInterface {
		return $this->payment_gateway;
	}

	/**
	 * Set up the test case.
	 *
	 * @return void
	 */
	protected function setUp() : void {
		parent::setUp();

		$this->mock_payment_gateway();
		$this->mock_assets_service();
		$this->mock_settings_service();

		$this->test_class = new PaymentMethod(
			$this->get_payment_gateway(),
			$this->get_assets_service(),
			$this->get_settings_service()
		);

		$this->initialize_reflection( $this->test_class );
	}

	/**
	 * Test constructor.
	 *
	 * @covers \AcquiredComForWooCommerce\WooCommerce\PaymentMethod::__construct
	 * @return void
	 */
	public function test_constructor() : void {
		$this->assertSame( $this->get_payment_gateway(), $this->get_private_property_value( 'gateway' ) );
		$this->assertSame( $this->get_assets_service(), $this->get_private_property_value( 'assets_service' ) );
		$this->assertSame( $this->get_settings_service(), $this->get_private_property_value( 'settings_service' ) );
		$this->assertEquals( 'acfw', $this->get_private_property_value( 'name' ) );
		$this->assertEquals( 'acfw-block-checkout', $this->get_private_property_value( 'script_handle' ) );
	}
}
