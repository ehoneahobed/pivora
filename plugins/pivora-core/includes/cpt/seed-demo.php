<?php
/**
 * Demo CPT seed content for starter kits.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates or updates a CPT post by title.
 *
 * @param string               $post_type Post type slug.
 * @param string               $title     Post title.
 * @param array<string, mixed> $args      Optional post args.
 * @return int Post id.
 */
function pivora_core_upsert_cpt_post( string $post_type, string $title, array $args = array() ): int {
	$existing = get_posts(
		array(
			'post_type'      => $post_type,
			'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
			'title'          => $title,
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	$postarr = wp_parse_args(
		$args,
		array(
			'post_type'   => $post_type,
			'post_title'  => $title,
			'post_status' => 'publish',
		)
	);

	if ( ! empty( $existing ) ) {
		$postarr['ID'] = (int) $existing[0];
		$post_id       = wp_update_post( $postarr, true );
	} else {
		$post_id = wp_insert_post( $postarr, true );
	}

	if ( is_wp_error( $post_id ) ) {
		return 0;
	}

	return (int) $post_id;
}

/**
 * Seeds CPT demo content for portfolio and agency kits.
 *
 * @param string $kit_slug Demo kit slug.
 */
function pivora_core_seed_cpt_demo_content( string $kit_slug ): void {
	if ( ! in_array( $kit_slug, array( 'portfolio', 'agency', 'saas', 'business' ), true ) ) {
		return;
	}

	$logos = array(
		array(
			'title' => 'Northline',
			'url'   => 'https://example.com',
		),
		array(
			'title' => 'Harbor Labs',
			'url'   => 'https://example.com',
		),
		array(
			'title' => 'Reyes Digital',
			'url'   => 'https://example.com',
		),
		array(
			'title' => 'Fieldnote',
			'url'   => 'https://example.com',
		),
		array(
			'title' => 'Summit Co.',
			'url'   => 'https://example.com',
		),
		array(
			'title' => 'Atlas Press',
			'url'   => 'https://example.com',
		),
	);

	foreach ( $logos as $index => $logo ) {
		$post_id = pivora_core_upsert_cpt_post(
			'pivora_client_logo',
			$logo['title'],
			array(
				'menu_order' => $index,
			)
		);

		if ( $post_id > 0 ) {
			update_post_meta( $post_id, '_pivora_logo_url', $logo['url'] );
		}
	}

	if ( in_array( $kit_slug, array( 'portfolio', 'agency' ), true ) ) {
		$case_studies = array(
			array(
				'title'   => __( 'Brand system', 'pivora-core' ),
				'excerpt' => __( 'Identity, web presence, and launch system for a growing company.', 'pivora-core' ),
				'tag'     => __( 'Brand', 'pivora-core' ),
				'variant' => 'default',
			),
			array(
				'title'   => __( 'Commerce refresh', 'pivora-core' ),
				'excerpt' => __( 'A faster product discovery experience for an online store.', 'pivora-core' ),
				'tag'     => __( 'Commerce', 'pivora-core' ),
				'variant' => 'accent',
			),
			array(
				'title'   => __( 'Editorial hub', 'pivora-core' ),
				'excerpt' => __( 'A content-first publication layout for guides and analysis.', 'pivora-core' ),
				'tag'     => __( 'Editorial', 'pivora-core' ),
				'variant' => 'highlight',
			),
		);

		foreach ( $case_studies as $index => $study ) {
			$post_id = pivora_core_upsert_cpt_post(
				'pivora_case_study',
				$study['title'],
				array(
					'post_excerpt' => $study['excerpt'],
					'menu_order'   => $index,
				)
			);

			if ( $post_id > 0 ) {
				update_post_meta( $post_id, '_pivora_case_study_tag', $study['tag'] );
				update_post_meta( $post_id, '_pivora_case_study_variant', $study['variant'] );
			}
		}
	}

	if ( in_array( $kit_slug, array( 'portfolio', 'agency', 'business' ), true ) ) {
		$team = array(
			array(
				'title'    => __( 'Jordan Lee', 'pivora-core' ),
				'role'     => __( 'Founder & strategist', 'pivora-core' ),
				'initials' => 'JL',
				'bio'      => __( 'Leads discovery, information architecture, and the first draft of every major launch.', 'pivora-core' ),
			),
			array(
				'title'    => __( 'Priya Nair', 'pivora-core' ),
				'role'     => __( 'Design lead', 'pivora-core' ),
				'initials' => 'PN',
				'bio'      => __( 'Shapes the visual system, pattern library, and editor experience clients actually use.', 'pivora-core' ),
			),
			array(
				'title'    => __( 'Marcus Cole', 'pivora-core' ),
				'role'     => __( 'Engineering', 'pivora-core' ),
				'initials' => 'MC',
				'bio'      => __( 'Keeps templates accessible, performant, and compatible with the plugins you choose.', 'pivora-core' ),
			),
		);

		foreach ( $team as $index => $member ) {
			$post_id = pivora_core_upsert_cpt_post(
				'pivora_team_member',
				$member['title'],
				array(
					'post_excerpt' => $member['bio'],
					'menu_order'   => $index,
				)
			);

			if ( $post_id > 0 ) {
				update_post_meta( $post_id, '_pivora_team_role', $member['role'] );
				update_post_meta( $post_id, '_pivora_team_initials', $member['initials'] );
			}
		}
	}
}
