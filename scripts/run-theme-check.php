<?php
/**
 * CLI runner for the Theme Check plugin (wp-env).
 *
 * Usage: wp eval-file scripts/run-theme-check.php pivora
 *
 * @package Pivora
 */

if ( ! defined( 'ABSPATH' ) ) {
	require_once '/var/www/html/wp-load.php';
}

if ( ! defined( 'WP_PLUGIN_DIR' ) ) {
	fwrite( STDERR, "WordPress is not loaded.\n" );
	exit( 1 );
}

require_once WP_PLUGIN_DIR . '/theme-check/checkbase.php';

$slug  = isset( $args[0] ) ? sanitize_key( (string) $args[0] ) : 'pivora';
$theme = wp_get_theme( $slug );

if ( ! $theme->exists() ) {
	fwrite( STDERR, "Theme not found: {$slug}\n" );
	exit( 1 );
}

$pass = run_themechecks_against_theme( $theme, $slug );

global $themechecks;

$error_count      = 0;
$required_failures = 0;

foreach ( $themechecks as $check ) {
	if ( ! $check instanceof themecheck ) {
		continue;
	}

	$messages = $check->getError();

	if ( empty( $messages ) ) {
		continue;
	}

	foreach ( (array) $messages as $message ) {
		if ( ! is_string( $message ) || '' === trim( $message ) ) {
			continue;
		}

		$plain = wp_strip_all_tags( $message );
		echo $plain . PHP_EOL;

		++$error_count;

		if ( false !== stripos( $plain, 'REQUIRED' ) ) {
			++$required_failures;
		}
	}
}

if ( $required_failures > 0 ) {
	fwrite( STDERR, "Theme Check failed with {$required_failures} required issue(s).\n" );
	exit( 1 );
}

if ( $error_count > 0 ) {
	echo "Theme Check passed with {$error_count} warning(s)/note(s)." . PHP_EOL;
	exit( 0 );
}

echo "Theme Check passed for {$slug}." . PHP_EOL;
exit( 0 );
