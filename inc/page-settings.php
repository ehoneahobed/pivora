<?php
/**
 * Per-page display options for the block editor.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers page-level display metadata.
 */
function pivora_register_page_display_meta(): void {
	register_post_meta(
		'page',
		'pivora_hide_page_title',
		array(
			'auth_callback' => static function (): bool {
				return current_user_can( 'edit_pages' );
			},
			'default'       => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'boolean',
		)
	);
}
add_action( 'init', 'pivora_register_page_display_meta' );

/**
 * Hides the template post title on the front end when requested.
 *
 * @param string $content Rendered block HTML.
 * @param array  $block   Parsed block data.
 * @return string
 */
function pivora_maybe_hide_page_title_block( string $content, array $block ): string {
	if ( 'core/post-title' !== ( $block['blockName'] ?? '' ) || ! is_page() || is_admin() ) {
		return $content;
	}

	$post_id = get_queried_object_id();

	if ( $post_id && get_post_meta( $post_id, 'pivora_hide_page_title', true ) ) {
		return '';
	}

	return $content;
}
add_filter( 'render_block', 'pivora_maybe_hide_page_title_block', 10, 2 );

/**
 * Enqueues the page display panel for the block editor.
 */
function pivora_enqueue_page_editor_settings(): void {
	wp_enqueue_script(
		'pivora-page-editor-settings',
		PIVORA_URI . 'assets/js/editor-page-settings.js',
		array( 'wp-plugins', 'wp-edit-post', 'wp-components', 'wp-data', 'wp-core-data', 'wp-element', 'wp-i18n' ),
		pivora_asset_version( 'assets/js/editor-page-settings.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'pivora_enqueue_page_editor_settings' );
