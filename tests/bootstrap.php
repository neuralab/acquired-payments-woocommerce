<?php
/**
 * Bootstrap the tests.
 */

declare( strict_types = 1 );

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__ ) . '/' );
}

define( 'WP_DEBUG', true );
