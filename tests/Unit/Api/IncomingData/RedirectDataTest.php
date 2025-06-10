<?php
/**
 * Test RedirectData class.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Unit\Api\IncomingData;

use AcquiredComForWooCommerce\Api\IncomingData\RedirectData;
use AcquiredComForWooCommerce\Tests\Framework\TestCase;
use AcquiredComForWooCommerce\Tests\Framework\Traits\IncomingDataTestData;

/**
 * Test RedirectData class.
 *
 * @covers \AcquiredComForWooCommerce\Api\IncomingData\RedirectData
 */
class RedirectDataTest extends TestCase {
	/**
	 * Traits.
	 */
	use IncomingDataTestData;

	/**
	 * Test constructor properly initializes data and all getters work.
	 *
	 * @covers \AcquiredComForWooCommerce\Api\IncomingData\RedirectData::__construct
	 */
	public function test_constructor_initializes_data() : void {
		$test_data     = $this->get_test_redirect_data();
		$redirect_data = new RedirectData( $test_data );

		// Test that all getter methods return expected values
		$this->assertEquals( 'redirect', $redirect_data->get_type() );
		$this->assertEquals( 'transaction_123', $redirect_data->get_transaction_id() );
		$this->assertEquals( 'success', $redirect_data->get_transaction_status() );
		$this->assertEquals( 'order_456', $redirect_data->get_order_id() );
		$this->assertEquals( 1621234567, $redirect_data->get_timestamp() );
		$this->assertEquals( $test_data, $redirect_data->get_incoming_data() );
	}
}
