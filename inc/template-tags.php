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
	}

	return $classes;
}
add_filter( 'body_class', 'pivora_body_classes' );
