<?php
/**
 * Demo kit manifest import for Starter Site Studio.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Validates a kit manifest array.
 *
 * @param array<string, mixed> $manifest Kit manifest.
 * @return true|WP_Error
 */
function pivora_core_validate_kit_manifest( array $manifest ) {
	if ( ( $manifest['format'] ?? '' ) !== 'pivora-kit' ) {
		return new WP_Error(
			'pivora_core_invalid_manifest',
			__( 'This file is not a Pivora kit manifest.', 'pivora-core' )
		);
	}

	if ( empty( $manifest['slug'] ) || ! is_string( $manifest['slug'] ) ) {
		return new WP_Error(
			'pivora_core_manifest_slug',
			__( 'The kit manifest is missing a slug.', 'pivora-core' )
		);
	}

	if ( empty( $manifest['homepage_markup'] ) || ! is_string( $manifest['homepage_markup'] ) ) {
		return new WP_Error(
			'pivora_core_manifest_markup',
			__( 'The kit manifest is missing homepage markup.', 'pivora-core' )
		);
	}

	return true;
}

/**
 * Normalizes a manifest into kit registry shape.
 *
 * @param array<string, mixed> $manifest Kit manifest.
 * @return array<string, mixed>
 */
function pivora_core_manifest_to_kit_config( array $manifest ): array {
	$slug = sanitize_key( (string) $manifest['slug'] );

	return array(
		'label'           => sanitize_text_field( (string) ( $manifest['label'] ?? $slug ) ),
		'description'     => sanitize_text_field( (string) ( $manifest['description'] ?? '' ) ),
		'pattern'         => sanitize_text_field( (string) ( $manifest['pattern'] ?? '' ) ),
		'header'          => sanitize_key( (string) ( $manifest['header'] ?? 'header' ) ),
		'footer'          => sanitize_key( (string) ( $manifest['footer'] ?? 'footer' ) ),
		'seed_posts'      => ! empty( $manifest['seed_posts'] ),
		'woocommerce'     => ! empty( $manifest['woocommerce'] ),
		'homepage_markup' => (string) $manifest['homepage_markup'],
		'pages'           => isset( $manifest['pages'] ) && is_array( $manifest['pages'] ) ? $manifest['pages'] : array(),
		'custom'          => true,
		'manifest'        => $manifest,
	);
}

/**
 * Imports homepage scope from a kit config (built-in or manifest).
 *
 * @param string               $kit_slug Kit slug.
 * @param array<string, mixed> $kit Kit config.
 * @return true|WP_Error
 */
function pivora_core_import_kit_homepage_from_config( string $kit_slug, array $kit ) {
	$home_id = pivora_ensure_page( 'home', 'Home' );

	if ( 0 === $home_id ) {
		return new WP_Error( 'pivora_home_page', __( 'Could not create the home page.', 'pivora-core' ) );
	}

	if ( ! empty( $kit['homepage_markup'] ) ) {
		$pattern_markup = (string) $kit['homepage_markup'];
	} else {
		$pattern_markup = pivora_get_demo_kit_markup( $kit_slug );
	}

	if ( '' === $pattern_markup ) {
		return new WP_Error( 'pivora_pattern_missing', __( 'Starter pattern markup could not be loaded.', 'pivora-core' ) );
	}

	wp_update_post(
		array(
			'ID'           => $home_id,
			'post_content' => $pattern_markup,
		)
	);

	$blog_id = pivora_ensure_page( 'blog', 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home_id );

	if ( $blog_id ) {
		update_option( 'page_for_posts', $blog_id );
	}

	update_option( 'pivora_header_variant', (string) $kit['header'] );
	update_option( 'pivora_footer_variant', (string) $kit['footer'] );
	update_option( 'pivora_active_demo_kit', $kit_slug );

	return true;
}

/**
 * Imports starter pages from kit config or defaults.
 *
 * @param array<string, mixed>|null $pages Pages map from manifest.
 */
function pivora_core_import_kit_pages_from_config( ?array $pages = null ): void {
	$defaults = pivora_core_get_kit_export_pages();
	$pages    = is_array( $pages ) ? wp_parse_args( $pages, $defaults ) : $defaults;

	$contact_id   = pivora_ensure_page( 'contact', 'Contact' );
	$portfolio_id = pivora_ensure_page( 'portfolio', 'Portfolio' );

	if ( $contact_id && isset( $pages['contact'] ) && is_array( $pages['contact'] ) ) {
		wp_update_post(
			array(
				'ID'           => $contact_id,
				'post_content' => (string) ( $pages['contact']['content'] ?? '' ),
			)
		);

		$template = (string) ( $pages['contact']['template'] ?? '' );

		if ( '' === $template || 'default' === $template ) {
			delete_post_meta( $contact_id, '_wp_page_template' );
		} else {
			update_post_meta( $contact_id, '_wp_page_template', $template );
		}
	}

	if ( $portfolio_id && isset( $pages['portfolio'] ) && is_array( $pages['portfolio'] ) ) {
		wp_update_post(
			array(
				'ID'           => $portfolio_id,
				'post_content' => (string) ( $pages['portfolio']['content'] ?? '' ),
			)
		);

		$template = (string) ( $pages['portfolio']['template'] ?? 'page-landing' );
		update_post_meta( $portfolio_id, '_wp_page_template', $template );
	}
}

/**
 * Imports a kit from a manifest with optional scopes.
 *
 * @param array<string, mixed> $manifest Kit manifest.
 * @param array<string, mixed> $args Import options.
 * @return true|WP_Error
 */
function pivora_core_import_kit_manifest( array $manifest, array $args = array() ) {
	$valid = pivora_core_validate_kit_manifest( $manifest );

	if ( is_wp_error( $valid ) ) {
		return $valid;
	}

	$kit_slug = sanitize_key( (string) $manifest['slug'] );
	$kit      = pivora_core_manifest_to_kit_config( $manifest );

	$scopes = wp_parse_args(
		isset( $args['scopes'] ) && is_array( $args['scopes'] ) ? $args['scopes'] : array(),
		pivora_core_default_import_scopes()
	);

	$has_scope = false;

	foreach ( $scopes as $enabled ) {
		if ( $enabled ) {
			$has_scope = true;
			break;
		}
	}

	if ( ! $has_scope ) {
		return new WP_Error(
			'pivora_core_no_scopes',
			__( 'Select at least one import section before importing.', 'pivora-core' )
		);
	}

	$save_snapshot = ! isset( $args['save_snapshot'] ) || (bool) $args['save_snapshot'];
	$steps_done    = array();

	if ( $save_snapshot ) {
		pivora_core_save_import_snapshot();
		$steps_done[] = 'snapshot';
	}

	if ( ! empty( $scopes['homepage'] ) ) {
		$result = pivora_core_import_kit_homepage_from_config( $kit_slug, $kit );

		if ( is_wp_error( $result ) ) {
			return $result;
		}

		$steps_done[] = 'homepage';
	}

	if ( ! empty( $scopes['pages'] ) ) {
		pivora_core_import_kit_pages_from_config( $kit['pages'] );
		$steps_done[] = 'pages';
	}

	if ( ! empty( $scopes['blog_seed'] ) && ! empty( $kit['seed_posts'] ) ) {
		pivora_seed_demo_posts();
		$steps_done[] = 'blog_seed';
	}

	if ( ! empty( $scopes['woocommerce'] ) && ! empty( $kit['woocommerce'] ) ) {
		$woo_result = pivora_core_prepare_woocommerce_demo();

		if ( is_wp_error( $woo_result ) ) {
			return $woo_result;
		}

		$steps_done[] = 'woocommerce';
	}

	flush_rewrite_rules( false );
	set_transient( 'pivora_core_last_import_steps', $steps_done, MINUTE_IN_SECONDS );

	return true;
}

/**
 * Parses an uploaded kit JSON file.
 *
 * @param array<string, mixed> $file Uploaded file from `$_FILES`.
 * @return array<string, mixed>|WP_Error
 */
function pivora_core_parse_kit_upload( array $file ) {
	if ( empty( $file['tmp_name'] ) || ! is_uploaded_file( (string) $file['tmp_name'] ) ) {
		return new WP_Error( 'pivora_core_upload_missing', __( 'No kit file was uploaded.', 'pivora-core' ) );
	}

	$contents = file_get_contents( (string) $file['tmp_name'] ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	if ( false === $contents || '' === $contents ) {
		return new WP_Error( 'pivora_core_upload_empty', __( 'The uploaded kit file is empty.', 'pivora-core' ) );
	}

	$manifest = json_decode( $contents, true );

	if ( ! is_array( $manifest ) ) {
		return new WP_Error( 'pivora_core_upload_json', __( 'The kit file contains invalid JSON.', 'pivora-core' ) );
	}

	$valid = pivora_core_validate_kit_manifest( $manifest );

	if ( is_wp_error( $valid ) ) {
		return $valid;
	}

	return $manifest;
}
