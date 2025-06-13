<?php
/**
 * CustomerConstructorMock.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Framework\Traits;

use Mockery;
use Mockery\MockInterface;
use Exception;

/**
 * CustomerConstructorMock.
 */
trait CustomerConstructorMock {
	/**
	 * Mock WC_Customer constructor with optional exception.
	 *
	 * @param int $user_id
	 * @param string|null
	 * @return MockInterface
	 */
	private function mock_wc_customer_constructor( int $user_id, ?string $exception_message = null ) : MockInterface {
		$customer = Mockery::mock( 'overload:WC_Customer' );

		if ( $exception_message ) {
			$customer->shouldReceive( '__construct' )
				->with( $user_id )
				->andThrow( new Exception( $exception_message ) );
		} else {
			$customer->shouldReceive( '__construct' )
				->with( $user_id )
				->once();
		}

		return $customer;
	}
}
