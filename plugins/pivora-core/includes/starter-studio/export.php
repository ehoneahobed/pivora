<?php
/**
 * Demo kit export helpers for Starter Site Studio.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Kit manifest format version.
 */
const PIVORA_CORE_KIT_MANIFEST_VERSION = 1;

/**
 * Option key for user-imported custom kits.
 */
const PIVORA_CORE_CUSTOM_KITS_OPTION = 'pivora_core_custom_kits';

/**
 * Returns saved custom kits keyed by slug.
 *
 * @return array<string, array<string, mixed>>
 */
function pivora_core_get_custom_kits(): array {
	$kits = get_option( PIVORA_CORE_CUSTOM_KITS_OPTION, array() );

	return is_array( $kits ) ? $kits : array();
}

/**
 * Persists a custom kit manifest.
 *
 * @param string               $slug Kit slug.
 * @param array<string, mixed> $manifest Kit manifest.
 * @return bool
 */
function pivora_core_save_custom_kit( string $slug, array $manifest ): bool {
	$kits          = pivora_core_get_custom_kits();
	$kits[ $slug ] = $manifest;

	return update_option( PIVORA_CORE_CUSTOM_KITS_OPTION, $kits, false );
}

/**
 * Deletes a saved custom kit.
 *
 * @param string $slug Kit slug.
 * @return bool
 */
function pivora_core_delete_custom_kit( string $slug ): bool {
	$kits = pivora_core_get_custom_kits();

	if ( ! isset( $kits[ $slug ] ) ) {
		return false;
	}

	unset( $kits[ $slug ] );

	return update_option( PIVORA_CORE_CUSTOM_KITS_OPTION, $kits, false );
}

/**
 * Extracts pattern slugs referenced in block markup.
 *
 * @param string $markup Block markup.
 * @return string[]
 */
function pivora_core_extract_pattern_slugs_from_markup( string $markup ): array {
	if ( '' === $markup || ! str_contains( $markup, 'wp:pattern' ) ) {
		return array();
	}

	preg_match_all( '/<!-- wp:pattern \{"slug":"([^"]+)"/', $markup, $matches );

	if ( empty( $matches[1] ) ) {
		return array();
	}

	return array_values( array_unique( array_map( 'strval', $matches[1] ) ) );
}

/**
 * Returns default starter page markup included in kit exports.
 *
 * @return array<string, array<string, string>>
 */
function pivora_core_get_kit_export_pages(): array {
	$contact_markup = pivora_load_pattern_markup( 'pivora/contact-section' );

	if ( '' === $contact_markup ) {
		$contact_markup = '<!-- wp:paragraph --><p>Reach out to discuss your next project.</p><!-- /wp:paragraph -->';
	}

	return array(
		'contact'   => array(
			'content'  => $contact_markup,
			'template' => '',
		),
		'portfolio' => array(
			'content'  => pivora_load_pattern_markup( 'pivora/starter-portfolio-landing' ),
			'template' => 'page-landing',
		),
	);
}

/**
 * Builds an exportable kit manifest.
 *
 * @param string $kit_slug Kit slug.
 * @return array<string, mixed>|WP_Error
 */
function pivora_core_build_kit_manifest( string $kit_slug ) {
	$builtin = pivora_get_demo_kits();
	$custom  = pivora_core_get_custom_kits();
	$all     = array_merge( $builtin, $custom );

	if ( ! isset( $all[ $kit_slug ] ) ) {
		return new WP_Error( 'pivora_core_unknown_kit', __( 'Unknown demo kit.', 'pivora-core' ) );
	}

	$kit = $all[ $kit_slug ];

	if ( ! empty( $kit['homepage_markup'] ) ) {
		$homepage_markup = (string) $kit['homepage_markup'];
	} else {
		$homepage_markup = pivora_get_demo_kit_markup( $kit_slug );

		if ( '' === $homepage_markup ) {
			return new WP_Error(
				'pivora_core_export_markup_missing',
				__( 'Starter pattern markup could not be loaded for export.', 'pivora-core' )
			);
		}
	}

	$pages = isset( $kit['pages'] ) && is_array( $kit['pages'] )
		? $kit['pages']
		: pivora_core_get_kit_export_pages();

	return array(
		'format'          => 'pivora-kit',
		'version'         => PIVORA_CORE_KIT_MANIFEST_VERSION,
		'exported_at'     => gmdate( 'c' ),
		'slug'            => $kit_slug,
		'label'           => (string) ( $kit['label'] ?? $kit_slug ),
		'description'     => (string) ( $kit['description'] ?? '' ),
		'pattern'         => (string) ( $kit['pattern'] ?? '' ),
		'header'          => (string) ( $kit['header'] ?? 'header' ),
		'footer'          => (string) ( $kit['footer'] ?? 'footer' ),
		'seed_posts'      => ! empty( $kit['seed_posts'] ),
		'woocommerce'     => ! empty( $kit['woocommerce'] ),
		'pattern_slugs'   => pivora_core_extract_pattern_slugs_from_markup( $homepage_markup ),
		'homepage_markup' => $homepage_markup,
		'pages'           => $pages,
	);
}

/**
 * Encodes a kit manifest as JSON for download.
 *
 * @param string $kit_slug Kit slug.
 * @return string|WP_Error
 */
function pivora_core_export_kit_json( string $kit_slug ) {
	$manifest = pivora_core_build_kit_manifest( $kit_slug );

	if ( is_wp_error( $manifest ) ) {
		return $manifest;
	}

	$json = wp_json_encode( $manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	if ( ! is_string( $json ) ) {
		return new WP_Error( 'pivora_core_export_encode', __( 'Could not encode the kit manifest.', 'pivora-core' ) );
	}

	return $json;
}

/**
 * Handles kit export download requests.
 */
function pivora_core_handle_kit_export_download(): void {
	if ( ! isset( $_GET['pivora_export_kit'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to export demo kits.', 'pivora-core' ) );
	}

	$kit_slug = sanitize_key( wp_unslash( (string) $_GET['pivora_export_kit'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$nonce    = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( (string) $_GET['_wpnonce'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! wp_verify_nonce( $nonce, 'pivora_export_kit_' . $kit_slug ) ) {
		wp_die( esc_html__( 'Export link expired. Return to Starter Kits and try again.', 'pivora-core' ) );
	}

	$json = pivora_core_export_kit_json( $kit_slug );

	if ( is_wp_error( $json ) ) {
		wp_die( esc_html( $json->get_error_message() ) );
	}

	$filename = sanitize_file_name( $kit_slug . '.pivora-kit.json' );

	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON export payload.
	echo $json;
	exit;
}
add_action( 'admin_init', 'pivora_core_handle_kit_export_download' );

/**
 * Returns the admin export URL for a kit.
 *
 * @param string $kit_slug Kit slug.
 * @return string
 */
function pivora_core_get_kit_export_url( string $kit_slug ): string {
	return wp_nonce_url(
		add_query_arg(
			array(
				'page'              => 'pivora-dashboard',
				'pivora_export_kit' => $kit_slug,
			),
			admin_url( 'admin.php' )
		),
		'pivora_export_kit_' . $kit_slug
	);
}
