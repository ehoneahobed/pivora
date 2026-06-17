<?php
/**
 * Template helpers and document classes.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds scoped body classes used by theme templates.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function pivora_body_classes( array $classes ): array {
	if ( is_front_page() ) {
		$classes[] = 'pivora-front-page';

		if ( 'header-centered' === pivora_get_active_header_slug() ) {
			$classes[] = 'pivora-hero--centered';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'pivora_body_classes' );

/**
 * Returns a sanitized front-end URL for pattern and template links.
 *
 * @param string $path Site path relative to home, e.g. `/blog/` or `/#patterns`.
 * @return string
 */
function pivora_url( string $path = '/' ): string {
	return esc_url( home_url( $path ) );
}
