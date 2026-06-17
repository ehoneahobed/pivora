<?php
/**
 * Frontend and editor asset loading.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns a version string based on file modification time when available.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function pivora_asset_version( string $relative_path ): string {
	$file = PIVORA_PATH . ltrim( $relative_path, '/' );

	if ( file_exists( $file ) ) {
		return (string) filemtime( $file );
	}

	return PIVORA_VERSION;
}

/**
 * Enqueues frontend assets.
 */
function pivora_enqueue_assets(): void {
	wp_enqueue_style(
		'pivora-base',
		PIVORA_URI . 'assets/css/base.css',
		array(),
		pivora_asset_version( 'assets/css/base.css' )
	);

	wp_enqueue_style(
		'pivora-hero-variants',
		PIVORA_URI . 'assets/css/hero-variants.css',
		array( 'pivora-base' ),
		pivora_asset_version( 'assets/css/hero-variants.css' )
	);

	wp_enqueue_style(
		'pivora-button-block-styles',
		PIVORA_URI . 'assets/css/button-block-styles.css',
		array( 'pivora-base' ),
		pivora_asset_version( 'assets/css/button-block-styles.css' )
	);

	wp_enqueue_style(
		'pivora-cta-variants',
		PIVORA_URI . 'assets/css/cta-variants.css',
		array( 'pivora-base' ),
		pivora_asset_version( 'assets/css/cta-variants.css' )
	);

	if ( function_exists( 'pivora_is_woocommerce_active' ) && pivora_is_woocommerce_active() ) {
		wp_enqueue_style(
			'pivora-woocommerce',
			PIVORA_URI . 'assets/css/woocommerce.css',
			array( 'pivora-base' ),
			pivora_asset_version( 'assets/css/woocommerce.css' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'pivora_enqueue_assets' );
