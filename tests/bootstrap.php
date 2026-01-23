<?php
/**
 * Bootstrap the tests.
 */

declare( strict_types = 1 );

require_once dirname( __DIR__ ) . '/vendor-build/autoload.php';
require_once dirname( __DIR__ ) . '/tests/Stubs/WC_Payment_Gateway.php';
require_once dirname( __DIR__ ) . '/tests/Stubs/AbstractPaymentMethodType.php';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__ ) . '/' );
}

define( 'WP_DEBUG', true );
