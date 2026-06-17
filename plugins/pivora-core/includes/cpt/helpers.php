<?php
/**
 * CPT data helpers for Pivora Core.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns initials from a display name.
 *
 * @param string $name Person or company name.
 */
function pivora_core_get_initials_from_name( string $name ): string {
	$parts = preg_split( '/\s+/', trim( $name ) );

	if ( false === $parts ) {
		$parts = array();
	}

	if ( empty( $parts ) ) {
		return '';
	}

	if ( 1 === count( $parts ) ) {
		return strtoupper( substr( (string) $parts[0], 0, 2 ) );
	}

	return strtoupper( substr( (string) $parts[0], 0, 1 ) . substr( (string) $parts[1], 0, 1 ) );
}

/**
 * Returns team member card data from a CPT post.
 *
 * @param int $post_id Team member post id.
 * @return array<string, mixed>|null
 */
function pivora_core_get_team_member_data( int $post_id ): ?array {
	$post = get_post( $post_id );

	if ( ! $post || 'pivora_team_member' !== $post->post_type || 'publish' !== $post->post_status ) {
		return null;
	}

	$name     = get_the_title( $post );
	$role     = (string) get_post_meta( $post_id, '_pivora_team_role', true );
	$initials = (string) get_post_meta( $post_id, '_pivora_team_initials', true );
	$bio      = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 24, '…' );
	$image_id = (int) get_post_thumbnail_id( $post );

	if ( '' === $initials ) {
		$initials = pivora_core_get_initials_from_name( $name );
	}

	return array(
		'memberId' => $post_id,
		'name'     => $name,
		'role'     => $role,
		'bio'      => $bio,
		'initials' => $initials,
		'imageId'  => $image_id,
	);
}

/**
 * Returns logo grid item data from a client logo post.
 *
 * @param int $post_id Client logo post id.
 * @return array<string, mixed>|null
 */
function pivora_core_get_client_logo_data( int $post_id ): ?array {
	$post = get_post( $post_id );

	if ( ! $post || 'pivora_client_logo' !== $post->post_type || 'publish' !== $post->post_status ) {
		return null;
	}

	$image_id  = (int) get_post_thumbnail_id( $post );
	$image_url = $image_id > 0 ? (string) wp_get_attachment_image_url( $image_id, 'medium' ) : '';

	return array(
		'name'     => get_the_title( $post ),
		'url'      => (string) get_post_meta( $post_id, '_pivora_logo_url', true ),
		'imageId'  => $image_id,
		'imageUrl' => $image_url,
	);
}

/**
 * Returns case study card data from a CPT post.
 *
 * @param int $post_id Case study post id.
 * @return array<string, mixed>|null
 */
function pivora_core_get_case_study_card_data( int $post_id ): ?array {
	$post = get_post( $post_id );

	if ( ! $post || 'pivora_case_study' !== $post->post_type || 'publish' !== $post->post_status ) {
		return null;
	}

	$tag      = (string) get_post_meta( $post_id, '_pivora_case_study_tag', true );
	$client   = (string) get_post_meta( $post_id, '_pivora_case_study_client', true );
	$excerpt  = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 22, '…' );
	$image_id = (int) get_post_thumbnail_id( $post );
	$variant  = (string) get_post_meta( $post_id, '_pivora_case_study_variant', true );

	if ( ! in_array( $variant, array( 'default', 'accent', 'highlight' ), true ) ) {
		$variant = 'default';
	}

	return array(
		'id'      => $post_id,
		'title'   => get_the_title( $post ),
		'tag'     => $tag,
		'client'  => $client,
		'excerpt' => $excerpt,
		'url'     => get_permalink( $post ),
		'imageId' => $image_id,
		'variant' => $variant,
	);
}

/**
 * Queries client logos for the logo grid block.
 *
 * @param int    $posts_to_show Number of logos.
 * @param string $industry_slug Optional industry taxonomy slug.
 * @return array<int, array<string, mixed>>
 */
function pivora_core_query_client_logos( int $posts_to_show, string $industry_slug = '' ): array {
	$args = array(
		'post_type'      => 'pivora_client_logo',
		'post_status'    => 'publish',
		'posts_per_page' => max( 1, min( 24, $posts_to_show ) ),
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	);

	if ( '' !== $industry_slug ) {
		$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'pivora_logo_industry',
				'field'    => 'slug',
				'terms'    => sanitize_title( $industry_slug ),
			),
		);
	}

	$query = new WP_Query( $args );
	$logos = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$logo = pivora_core_get_client_logo_data( get_the_ID() );

			if ( $logo ) {
				$logos[] = $logo;
			}
		}
	}

	wp_reset_postdata();

	return $logos;
}
