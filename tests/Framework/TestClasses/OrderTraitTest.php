<?php
/**
 * OrderTraitTest.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Framework\TestClasses;

use AcquiredComForWooCommerce\Traits\Order;
use AcquiredComForWooCommerce\Tests\Framework\Traits\SettingsServiceMock;

/**
 * Implementation of Order trait for testing.
 */
class OrderTraitTest {
	/**
	 * Traits.
	 */
	use Order;
	use SettingsServiceMock;

	/**
	 * Constructor.
	 *
	 * @param array $config
	 */
	public function __construct( private array $config ) {
		$this->mock_settings_service();
	}
}
