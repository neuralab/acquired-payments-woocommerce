<?php
/**
 * PHP Scoper config.
 */

declare( strict_types = 1 );

/**
 * Finder class.
 *
 * @disregard
 */
$finder = Isolated\Symfony\Component\Finder\Finder::class;

return [
	'prefix'                  => 'AcquiredComForWooCommerce\\Dependency',
	'output-dir'              => 'vendor-build',
	'finders'                 => [
		$finder::create()
			->files()
			->ignoreVCS( true )
			->notName( '/LICENSE|.*\\.md|Makefile|composer\\.json|composer\\.lock/' )
			->exclude(
				[
					'doc',
					'test',
					'test_old',
					'tests',
					'Tests',
					'vendor-bin',
				]
			)
			->in( 'vendor' ),
	],
	'exclude-files'           => [
		'vendor/brain/monkey/inc/api.php',
		'vendor/brain/monkey/inc/patchwork-loader.php',
		'vendor/brain/monkey/inc/wp-helper-functions.php',
		'vendor/brain/monkey/inc/wp-hook-functions.php',
	],
	'php-version'             => '8.1',
	'patchers'                => [],
	'exclude-namespaces'      => [
		'AcquiredComForWooCommerce',
		'Composer\Autoload',
		'PHPUnit',
		'DeepCopy\DeepCopy',
		'PharIo',
		'SebastianBergmann',
		'Brain\Monkey',
		'Mockery',
		'Patchwork',
		'PHP_CodeSniffer',
		'Neuralab',
	],
	'exclude-classes'         => [],
	'exclude-functions'       => [],
	'exclude-constants'       => [],
	'expose-global-constants' => true,
	'expose-global-classes'   => true,
	'expose-global-functions' => true,
	'expose-namespaces'       => [],
	'expose-classes'          => [],
	'expose-functions'        => [],
	'expose-constants'        => [],
];
