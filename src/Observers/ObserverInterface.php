<?php
/**
 * ObserverInterface.
 */

declare(strict_types=1);

namespace AcquiredComForWooCommerce\Observers;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * ObserverInterface interface.
 */
interface ObserverInterface {
	public function init_hooks() : void;
}
