<?php
/**
 * Compatibility with popular SEO plugins.
 *
 * Prevents the theme from outputting markup that duplicates SEO plugin features.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether a supported SEO plugin is active.
 */
function pivora_has_seo_plugin(): bool {
	return pivora_is_yoast_seo_active()
		|| pivora_is_rank_math_active()
		|| pivora_is_seo_framework_active();
}

/**
 * Whether Yoast SEO is active.
 */
function pivora_is_yoast_seo_active(): bool {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'WPSEO_Options', false );
}

/**
 * Whether Rank Math is active.
 */
function pivora_is_rank_math_active(): bool {
	return defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath', false );
}

/**
 * Whether The SEO Framework is active.
 */
function pivora_is_seo_framework_active(): bool {
	return defined( 'THE_SEO_FRAMEWORK_VERSION' ) || function_exists( 'the_seo_framework' );
}

/**
 * Adds a body class when an SEO plugin manages breadcrumbs/schema.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function pivora_seo_plugin_body_class( array $classes ): array {
	if ( pivora_has_seo_plugin() ) {
		$classes[] = 'pivora-has-seo-plugin';
	}

	return $classes;
}
add_filter( 'body_class', 'pivora_seo_plugin_body_class' );

/**
 * Hides decorative breadcrumb trails in the page-header pattern when an SEO plugin is active.
 */
function pivora_seo_plugin_compat_styles(): void {
	if ( ! pivora_has_seo_plugin() ) {
		return;
	}

	$css = '.pivora-has-seo-plugin .pivora-page-header__breadcrumb{display:none;}';

	wp_add_inline_style( 'pivora-base', $css );
}
add_action( 'wp_enqueue_scripts', 'pivora_seo_plugin_compat_styles', 20 );

/**
 * Hides decorative breadcrumbs in the block editor when an SEO plugin is active.
 */
function pivora_seo_plugin_editor_compat_styles(): void {
	if ( ! pivora_has_seo_plugin() ) {
		return;
	}

	$css = '.editor-styles-wrapper .pivora-page-header__breadcrumb{display:none;}';

	wp_register_style( 'pivora-seo-plugin-editor-compat', false, array( 'wp-edit-blocks' ), PIVORA_VERSION );
	wp_enqueue_style( 'pivora-seo-plugin-editor-compat' );
	wp_add_inline_style( 'pivora-seo-plugin-editor-compat', $css );
}
add_action( 'enqueue_block_editor_assets', 'pivora_seo_plugin_editor_compat_styles' );
