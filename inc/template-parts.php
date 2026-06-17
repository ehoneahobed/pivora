<?php
/**
 * Active header and footer template part variants.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns registered header template part slugs.
 *
 * @return array<string, string>
 */
function pivora_get_header_variants(): array {
	return array(
		'header'          => __( 'Default header', 'pivora' ),
		'header-centered' => __( 'Centered header', 'pivora' ),
		'header-minimal'  => __( 'Minimal header', 'pivora' ),
	);
}


/**
 * Returns registered footer template part slugs.
 *
 * @return array<string, string>
 */
function pivora_get_footer_variants(): array {
	return array(
		'footer'          => __( 'Simple footer', 'pivora' ),
		'footer-columns'  => __( 'Footer columns', 'pivora' ),
	);
}


/**
 * Returns the active header template part slug.
 *
 * @return string
 */
function pivora_get_active_header_slug(): string {
	$variant = (string) get_option( 'pivora_header_variant', 'header' );
	$allowed = pivora_get_header_variants();

	return isset( $allowed[ $variant ] ) ? $variant : 'header';
}


/**
 * Returns the active footer template part slug.
 *
 * @return string
 */
function pivora_get_active_footer_slug(): string {
	$variant = (string) get_option( 'pivora_footer_variant', 'footer' );
	$allowed = pivora_get_footer_variants();

	return isset( $allowed[ $variant ] ) ? $variant : 'footer';
}


/**
 * Swaps template part slugs at render time based on saved variants.
 *
 * @param array<string, mixed> $parsed_block Parsed block data.
 * @return array<string, mixed>
 */
function pivora_filter_template_part_variants( array $parsed_block ): array {
	if ( 'core/template-part' !== ( $parsed_block['blockName'] ?? '' ) ) {
		return $parsed_block;
	}

	$slug = (string) ( $parsed_block['attrs']['slug'] ?? '' );

	if ( 'header' === $slug ) {
		$parsed_block['attrs']['slug'] = pivora_get_active_header_slug();
	}

	if ( 'footer' === $slug ) {
		$parsed_block['attrs']['slug'] = pivora_get_active_footer_slug();
	}

	return $parsed_block;
}
add_filter( 'render_block_data', 'pivora_filter_template_part_variants', 10, 1 );
