<?php
/**
 * Import snapshot and rollback for Starter Site Studio.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option key for the last import snapshot.
 */
const PIVORA_CORE_IMPORT_SNAPSHOT_OPTION = 'pivora_core_import_snapshot';

/**
 * Page slugs tracked for content rollback.
 *
 * @return string[]
 */
function pivora_core_snapshot_page_slugs(): array {
	return array( 'home', 'blog', 'contact', 'portfolio' );
}

/**
 * Returns post fields stored in a snapshot for a page slug.
 *
 * @param string $slug Page slug.
 * @return array<string, mixed>|null
 */
function pivora_core_get_page_snapshot_fields( string $slug ): ?array {
	$page = get_page_by_path( $slug, OBJECT, 'page' );

	if ( ! $page instanceof WP_Post ) {
		return null;
	}

	return array(
		'ID'           => (int) $page->ID,
		'post_content' => (string) $page->post_content,
		'post_title'   => (string) $page->post_title,
		'post_status'  => (string) $page->post_status,
		'template'     => (string) get_post_meta( $page->ID, '_wp_page_template', true ),
	);
}

/**
 * Whether a rollback snapshot exists.
 */
function pivora_core_has_import_snapshot(): bool {
	$snapshot = get_option( PIVORA_CORE_IMPORT_SNAPSHOT_OPTION, array() );

	return is_array( $snapshot ) && ! empty( $snapshot['saved_at'] );
}

/**
 * Saves site state before a kit import.
 *
 * @return bool
 */
function pivora_core_save_import_snapshot(): bool {
	$pages = array();

	foreach ( pivora_core_snapshot_page_slugs() as $slug ) {
		$fields = pivora_core_get_page_snapshot_fields( $slug );

		if ( null !== $fields ) {
			$pages[ $slug ] = $fields;
		}
	}

	$snapshot = array(
		'saved_at'               => time(),
		'show_on_front'          => (string) get_option( 'show_on_front', 'posts' ),
		'page_on_front'          => (int) get_option( 'page_on_front', 0 ),
		'page_for_posts'         => (int) get_option( 'page_for_posts', 0 ),
		'pivora_header_variant'  => (string) get_option( 'pivora_header_variant', 'header' ),
		'pivora_footer_variant'  => (string) get_option( 'pivora_footer_variant', 'footer' ),
		'pivora_active_demo_kit' => (string) get_option( 'pivora_active_demo_kit', '' ),
		'pages'                  => $pages,
	);

	return update_option( PIVORA_CORE_IMPORT_SNAPSHOT_OPTION, $snapshot, false );
}

/**
 * Restores the last import snapshot.
 *
 * @return true|WP_Error
 */
function pivora_core_restore_import_snapshot() {
	if ( ! pivora_core_has_import_snapshot() ) {
		return new WP_Error(
			'pivora_core_no_snapshot',
			__( 'No import snapshot is available to restore.', 'pivora-core' )
		);
	}

	$snapshot = get_option( PIVORA_CORE_IMPORT_SNAPSHOT_OPTION, array() );

	if ( ! is_array( $snapshot ) ) {
		return new WP_Error(
			'pivora_core_invalid_snapshot',
			__( 'The import snapshot is invalid.', 'pivora-core' )
		);
	}

	update_option( 'show_on_front', (string) ( $snapshot['show_on_front'] ?? 'posts' ), false );
	update_option( 'page_on_front', (int) ( $snapshot['page_on_front'] ?? 0 ), false );
	update_option( 'page_for_posts', (int) ( $snapshot['page_for_posts'] ?? 0 ), false );
	update_option( 'pivora_header_variant', (string) ( $snapshot['pivora_header_variant'] ?? 'header' ), false );
	update_option( 'pivora_footer_variant', (string) ( $snapshot['pivora_footer_variant'] ?? 'footer' ), false );
	update_option( 'pivora_active_demo_kit', (string) ( $snapshot['pivora_active_demo_kit'] ?? '' ), false );

	if ( ! empty( $snapshot['pages'] ) && is_array( $snapshot['pages'] ) ) {
		foreach ( $snapshot['pages'] as $slug => $fields ) {
			if ( ! is_array( $fields ) || empty( $fields['ID'] ) ) {
				continue;
			}

			wp_update_post(
				array(
					'ID'           => (int) $fields['ID'],
					'post_content' => (string) ( $fields['post_content'] ?? '' ),
					'post_title'   => (string) ( $fields['post_title'] ?? ucfirst( (string) $slug ) ),
					'post_status'  => (string) ( $fields['post_status'] ?? 'publish' ),
				)
			);

			$template = (string) ( $fields['template'] ?? '' );

			if ( '' === $template || 'default' === $template ) {
				delete_post_meta( (int) $fields['ID'], '_wp_page_template' );
			} else {
				update_post_meta( (int) $fields['ID'], '_wp_page_template', $template );
			}
		}
	}

	flush_rewrite_rules( false );

	return true;
}

/**
 * Deletes the stored import snapshot.
 */
function pivora_core_clear_import_snapshot(): void {
	delete_option( PIVORA_CORE_IMPORT_SNAPSHOT_OPTION );
}
