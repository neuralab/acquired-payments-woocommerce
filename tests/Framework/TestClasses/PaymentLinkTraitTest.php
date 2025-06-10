<?php
/**
 * PaymentLinkTraitTest.
 */

declare( strict_types = 1 );

namespace AcquiredComForWooCommerce\Tests\Framework\TestClasses;

use AcquiredComForWooCommerce\Traits\PaymentLink;
use AcquiredComForWooCommerce\Tests\Framework\Traits\SettingsServiceMock;

/**
 * Implementation of PaymentLink trait for testing.
 */
class PaymentLinkTraitTest {
	/**
	 * Traits.
	 */
	use PaymentLink;
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
