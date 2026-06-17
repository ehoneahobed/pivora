<?php
/**
 * Post media helpers, including archive card placeholders.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the URL for the default post card placeholder image.
 *
 * @return string
 */
function pivora_get_post_placeholder_url(): string {
	return PIVORA_URI . 'assets/images/post-placeholder.svg';
}

/**
 * Whether a featured-image block should render a placeholder on the front end.
 *
 * @param array<string, mixed> $block Block data.
 * @return bool
 */
function pivora_should_render_post_placeholder( array $block ): bool {
	if ( is_admin() || is_singular() ) {
		return false;
	}

	if ( ! ( is_home() || is_archive() || is_search() || is_front_page() ) ) {
		return false;
	}

	$class_name = (string) ( $block['attrs']['className'] ?? '' );

	// Skip hero/aside featured areas on landing sections that are not post cards.
	if (
		str_contains( $class_name, 'pivora-single__' ) ||
		str_contains( $class_name, 'pivora-page__' )
	) {
		return false;
	}

	return true;
}

/**
 * Renders a placeholder featured image when a post has no thumbnail.
 *
 * @param string               $block_content Rendered block HTML.
 * @param array<string, mixed> $block Block data.
 * @return string
 */
function pivora_render_post_featured_image_placeholder( string $block_content, array $block ): string {
	if ( '' !== trim( $block_content ) || 'core/post-featured-image' !== ( $block['blockName'] ?? '' ) ) {
		return $block_content;
	}

	if ( ! pivora_should_render_post_placeholder( $block ) ) {
		return $block_content;
	}

	$post_id = (int) ( $block['context']['postId'] ?? 0 );
	if ( $post_id <= 0 ) {
		$post_id = (int) get_the_ID();
	}

	if ( $post_id <= 0 || has_post_thumbnail( $post_id ) ) {
		return $block_content;
	}

	$classes   = array( 'wp-block-post-featured-image', 'pivora-post-card__media--placeholder' );
	$raw_class = (string) ( $block['attrs']['className'] ?? '' );

	if ( '' !== $raw_class ) {
		foreach ( preg_split( '/\s+/', $raw_class ) as $class ) {
			$class = sanitize_html_class( (string) $class );
			if ( '' !== $class ) {
				$classes[] = $class;
			}
		}
	}

	$alt = sprintf(
		/* translators: %s: post title */
		__( 'Placeholder image for %s', 'pivora' ),
		get_the_title( $post_id )
	);

	$image = sprintf(
		'<img src="%1$s" alt="%2$s" class="pivora-post-card__placeholder-image" decoding="async" loading="lazy" width="800" height="500" />',
		esc_url( pivora_get_post_placeholder_url() ),
		esc_attr( $alt )
	);

	if ( ! empty( $block['attrs']['isLink'] ) ) {
		$image = sprintf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink( $post_id ) ),
			$image
		);
	}

	return sprintf(
		'<figure class="%1$s">%2$s</figure>',
		esc_attr( implode( ' ', array_unique( $classes ) ) ),
		$image
	);
}
add_filter( 'render_block', 'pivora_render_post_featured_image_placeholder', 10, 2 );
