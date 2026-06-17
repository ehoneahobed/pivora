<?php
/**
 * Block editor integration for Pivora Core.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the Pivora block category in the editor.
 *
 * @param array<int, array<string, mixed>> $categories Registered block categories.
 * @return array<int, array<string, mixed>>
 */
function pivora_core_register_block_category( array $categories ): array {
	return array_merge(
		array(
			array(
				'slug'  => 'pivora',
				'title' => __( 'Pivora', 'pivora-core' ),
				'icon'  => 'layout',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'pivora_core_register_block_category', 10, 1 );
