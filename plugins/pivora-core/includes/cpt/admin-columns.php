<?php
/**
 * Admin list table enhancements for Pivora CPTs.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns CPT slugs that receive admin column enhancements.
 *
 * @return array<int, string>
 */
function pivora_core_get_cpt_admin_column_types(): array {
	return array(
		'pivora_client_logo',
		'pivora_case_study',
		'pivora_team_member',
	);
}

/**
 * Adds thumbnail and excerpt columns to Pivora CPT list tables.
 *
 * @param array<string, string> $columns Existing columns.
 */
function pivora_core_cpt_admin_columns( array $columns ): array {
	$new_columns = array();

	foreach ( $columns as $key => $label ) {
		$new_columns[ $key ] = $label;

		if ( 'title' === $key ) {
			$new_columns['pivora_thumb'] = __( 'Image', 'pivora-core' );
		}
	}

	if ( ! isset( $new_columns['pivora_excerpt'] ) ) {
		$new_columns['pivora_excerpt'] = __( 'Excerpt', 'pivora-core' );
	}

	return $new_columns;
}

foreach ( pivora_core_get_cpt_admin_column_types() as $cpt_type ) {
	add_filter( "manage_{$cpt_type}_posts_columns", 'pivora_core_cpt_admin_columns' );
}

/**
 * Renders custom admin column cells.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post id.
 */
function pivora_core_cpt_admin_column_content( string $column, int $post_id ): void {
	if ( 'pivora_thumb' === $column ) {
		if ( has_post_thumbnail( $post_id ) ) {
			echo get_the_post_thumbnail( $post_id, array( 48, 48 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			return;
		}

		echo '—';
		return;
	}

	if ( 'pivora_excerpt' === $column ) {
		$post = get_post( $post_id );

		if ( ! $post ) {
			echo '—';
			return;
		}

		$excerpt = has_excerpt( $post ) ? $post->post_excerpt : wp_trim_words( wp_strip_all_tags( $post->post_content ), 12, '…' );
		echo esc_html( $excerpt );
	}
}

foreach ( pivora_core_get_cpt_admin_column_types() as $cpt_type ) {
	add_action( "manage_{$cpt_type}_posts_custom_column", 'pivora_core_cpt_admin_column_content', 10, 2 );
}

/**
 * Sets column widths for Pivora CPT tables.
 */
function pivora_core_cpt_admin_column_styles(): void {
	$screen = get_current_screen();

	if ( ! $screen || ! in_array( $screen->post_type, pivora_core_get_cpt_admin_column_types(), true ) ) {
		return;
	}

	echo '<style>.column-pivora_thumb{width:72px}.column-pivora_excerpt{width:28%}</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'admin_head', 'pivora_core_cpt_admin_column_styles' );
