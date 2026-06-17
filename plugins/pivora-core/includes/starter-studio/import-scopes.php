<?php
/**
 * Scoped kit import helpers for Starter Site Studio.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default import scope flags.
 *
 * @return array<string, bool>
 */
function pivora_core_default_import_scopes(): array {
	return array(
		'homepage'    => true,
		'pages'       => true,
		'blog_seed'   => true,
		'woocommerce' => true,
	);
}

/**
 * Sanitizes import scope flags from a request array.
 *
 * @param array<string, mixed> $source Request values.
 * @return array<string, bool>
 */
function pivora_core_sanitize_import_scopes( array $source ): array {
	$scopes = pivora_core_default_import_scopes();

	foreach ( array_keys( $scopes ) as $key ) {
		$scopes[ $key ] = ! empty( $source[ 'import_scope_' . $key ] );
	}

	return $scopes;
}

/**
 * Returns human-readable labels for import scopes.
 *
 * @return array<string, string>
 */
function pivora_core_import_scope_labels(): array {
	return array(
		'homepage'    => __( 'Homepage and site settings', 'pivora-core' ),
		'pages'       => __( 'Starter pages (contact and portfolio)', 'pivora-core' ),
		'blog_seed'   => __( 'Sample blog posts', 'pivora-core' ),
		'woocommerce' => __( 'WooCommerce store pages', 'pivora-core' ),
	);
}

/**
 * Applies homepage import scope for a kit.
 *
 * @param string               $kit_slug Kit slug.
 * @param array<string, mixed> $kit Kit config.
 * @return true|WP_Error
 */
function pivora_core_import_kit_homepage_scope( string $kit_slug, array $kit ) {
	return pivora_core_import_kit_homepage_from_config( $kit_slug, $kit );
}

/**
 * Applies starter pages import scope.
 *
 * @param array<string, mixed>|null $pages Optional pages map from a manifest.
 */
function pivora_core_import_kit_pages_scope( ?array $pages = null ): void {
	pivora_core_import_kit_pages_from_config( $pages );
}
