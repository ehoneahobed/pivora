<?php
/**
 * WooCommerce presentation support.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Determines whether WooCommerce is active.
 *
 * @return bool
 */
function pivora_is_woocommerce_active(): bool {
	return class_exists( 'WooCommerce' );
}

/**
 * Registers WooCommerce theme support.
 */
function pivora_add_woocommerce_support(): void {
	add_theme_support(
		'woocommerce',
		array(
			'gallery_thumbnail_image_width' => 160,
			'product_grid'                  => array(
				'default_columns' => 3,
				'default_rows'    => 4,
				'max_columns'     => 4,
				'min_columns'     => 2,
			),
			'single_image_width'            => 720,
			'thumbnail_image_width'         => 420,
		)
	);

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'pivora_add_woocommerce_support' );
