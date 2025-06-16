<?php
/**
 * PaymentMethodServiceTest.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Unit\Services;

use AcquiredComForWooCommerce\Tests\Framework\TestCase;
use AcquiredComForWooCommerce\Tests\Framework\Traits\ApiClientMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\LoggerServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\Reflection;
use AcquiredComForWooCommerce\Services\PaymentMethodService;
use AcquiredComForWooCommerce\Tests\Framework\Traits\CustomerFactoryMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\CustomerServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\ScheduleServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\SettingsServiceMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\TokenFactoryMock;
use AcquiredComForWooCommerce\Tests\Framework\Traits\TokenServiceMock;

/**
 * PaymentMethodServiceTest class.
 *
 * @covers \AcquiredComForWooCommerce\Services\PaymentMethodService
 */
class PaymentMethodServiceTest extends TestCase {
	/**
	 * Traits.
	 */
	use Reflection;
	use ApiClientMock;
	use CustomerServiceMock;
	use LoggerServiceMock;
	use ScheduleServiceMock;
	use SettingsServiceMock;
	use TokenServiceMock;
	use CustomerFactoryMock;
	use TokenFactoryMock;

	/**
	 * PaymentMethodService class.
	 *
	 * @var PaymentMethodService
	 */
	private PaymentMethodService $service;

	/**
	 * Set up the test case.
	 *
	 * @return void
	 */
	protected function setUp() : void {
		parent::setUp();

		$this->mock_api_client();
		$this->mock_logger_service();
		$this->mock_customer_service();
		$this->mock_schedule_service();
		$this->mock_settings_service();
		$this->mock_token_service();
		$this->mock_customer_factory();
		$this->mock_token_factory();

		$this->service = new PaymentMethodService(
			$this->get_api_client(),
			$this->get_customer_service(),
			$this->get_logger_service(),
			$this->get_schedule_service(),
			$this->get_settings_service(),
			$this->get_token_service(),
			$this->get_customer_factory(),
			$this->get_token_factory(),
		);

		$this->initialize_reflection( $this->service );
	}

	/**
	 * Test constructor.
	 *
	 * @covers \AcquiredComForWooCommerce\Services\PaymentMethodService::__construct
	 * @return void
	 */
	public function test_constructor() : void {
		$this->assertSame( $this->get_api_client(), $this->get_private_property_value( 'api_client' ) );
		$this->assertSame( $this->get_customer_service(), $this->get_private_property_value( 'customer_service' ) );
		$this->assertSame( $this->get_logger_service(), $this->get_private_property_value( 'logger_service' ) );
		$this->assertSame( $this->get_schedule_service(), $this->get_private_property_value( 'schedule_service' ) );
		$this->assertSame( $this->get_settings_service(), $this->get_private_property_value( 'settings_service' ) );
		$this->assertSame( $this->get_token_service(), $this->get_private_property_value( 'token_service' ) );
		$this->assertSame( $this->get_customer_factory(), $this->get_private_property_value( 'customer_factory' ) );
		$this->assertSame( $this->get_token_factory(), $this->get_private_property_value( 'token_factory' ) );
	}

	/**
	 * Test is_transaction_success.
	 *
	 * @covers \AcquiredComForWooCommerce\Services\PaymentMethodService::is_transaction_success
	 * @return void
	 */
	public function test_is_transaction_success() : void {
		$this->assertTrue( $this->service->is_transaction_success( 'success' ) );
		$this->assertTrue( $this->service->is_transaction_success( 'settled' ) );
		$this->assertTrue( $this->service->is_transaction_success( 'executed' ) );
		$this->assertFalse( $this->service->is_transaction_success( 'failed' ) );
	}

	/**
	 * Test get_status_key returns correct key.
	 *
	 * @covers \AcquiredComForWooCommerce\Services\PaymentMethodService::get_status_key
	 * @return void
	 */
	public function test_get_status_key_returns_correct_key() : void {
		$this->assertEquals( 'acfw_payment_method_status', $this->service->get_status_key() );
	}

	/**
	 * Test get_scheduled_action_hook returns correct hook.
	 *
	 * @covers \AcquiredComForWooCommerce\Services\PaymentMethodService::get_scheduled_action_hook
	 * @return void
	 */
	public function test_get_scheduled_action_hook_returns_correct_hook() : void {
		$this->assertEquals( 'acfw_scheduled_save_payment_method', $this->service->get_scheduled_action_hook() );
	}
}
