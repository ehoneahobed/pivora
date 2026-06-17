<?php
/**
 * Theme setup and WordPress feature support.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers theme supports and editor defaults.
 */
function pivora_setup(): void {
	load_theme_textdomain( 'pivora', PIVORA_PATH . 'languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'block-template-parts' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'navigation-widgets', 'script', 'search-form', 'style' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles' );

	add_editor_style(
		array(
			'assets/css/editor.css',
			'assets/css/hero-variants.css',
			'assets/css/button-block-styles.css',
		)
	);
}
add_action( 'after_setup_theme', 'pivora_setup' );
