<?php
/**
 * Lightweight display conditions for Pivora blocks.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cookie name used to detect returning visitors.
 */
const PIVORA_CORE_RETURNING_VISITOR_COOKIE = 'pivora_returning_visitor';

/**
 * Returns supported display condition types.
 *
 * @return array<string, string>
 */
function pivora_core_get_display_condition_types(): array {
	$types = array(
		'always'       => __( 'Always show', 'pivora-core' ),
		'logged_in'    => __( 'Logged-in users only', 'pivora-core' ),
		'logged_out'   => __( 'Logged-out visitors only', 'pivora-core' ),
		'url_contains' => __( 'URL contains', 'pivora-core' ),
		'first_visit'  => __( 'First visit only', 'pivora-core' ),
	);

	/**
	 * Filters display condition types available in the block editor.
	 *
	 * @param array<string, string> $types Condition key => label.
	 */
	return apply_filters( 'pivora_core_display_condition_types', $types );
}

/**
 * Whether block attributes pass the configured display condition.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return bool
 */
function pivora_core_passes_display_condition( array $attributes ): bool {
	$condition = isset( $attributes['displayCondition'] )
		? sanitize_key( (string) $attributes['displayCondition'] )
		: 'always';
	$value     = isset( $attributes['displayConditionValue'] )
		? (string) $attributes['displayConditionValue']
		: '';

	if ( '' === $condition || 'always' === $condition ) {
		return true;
	}

	$passes = match ( $condition ) {
		'logged_in'    => is_user_logged_in(),
		'logged_out'   => ! is_user_logged_in(),
		'url_contains' => '' !== $value && pivora_core_request_uri_contains( $value ),
		'first_visit'  => ! isset( $_COOKIE[ PIVORA_CORE_RETURNING_VISITOR_COOKIE ] ),
		default        => true,
	};

	/**
	 * Filters whether a block passes its display condition.
	 *
	 * @param bool                 $passes     Whether the block should render.
	 * @param string               $condition  Condition key.
	 * @param string               $value      Condition value.
	 * @param array<string, mixed> $attributes Block attributes.
	 */
	return (bool) apply_filters(
		'pivora_core_display_condition_passes',
		$passes,
		$condition,
		$value,
		$attributes
	);
}

/**
 * Whether the current request URI contains a substring.
 *
 * @param string $needle Substring to match.
 */
function pivora_core_request_uri_contains( string $needle ): bool {
	if ( '' === $needle ) {
		return false;
	}

	$uri = isset( $_SERVER['REQUEST_URI'] )
		? sanitize_text_field( wp_unslash( (string) $_SERVER['REQUEST_URI'] ) )
		: '';

	return '' !== $uri && str_contains( strtolower( $uri ), strtolower( $needle ) );
}

/**
 * Marks the current visitor as returning when a first-visit block renders.
 */
function pivora_core_mark_returning_visitor(): void {
	if ( headers_sent() || isset( $_COOKIE[ PIVORA_CORE_RETURNING_VISITOR_COOKIE ] ) ) {
		return;
	}

	setcookie(
		PIVORA_CORE_RETURNING_VISITOR_COOKIE,
		'1',
		time() + YEAR_IN_SECONDS,
		COOKIEPATH ? COOKIEPATH : '/',
		COOKIE_DOMAIN,
		is_ssl(),
		true
	);
}

/**
 * Hides block output when display conditions are not met.
 *
 * @param string   $block_content Block HTML.
 * @param array    $block         Parsed block.
 * @param WP_Block $block_instance Block instance (unused, required by filter).
 * @return string
 */
function pivora_core_filter_block_display_condition( string $block_content, array $block, WP_Block $block_instance ): string {
	unset( $block_instance );
	$block_name = (string) ( $block['blockName'] ?? '' );

	if ( ! str_starts_with( $block_name, 'pivora/' ) ) {
		return $block_content;
	}

	$attributes = is_array( $block['attrs'] ?? null ) ? $block['attrs'] : array();

	if ( ! pivora_core_passes_display_condition( $attributes ) ) {
		return '';
	}

	$condition = isset( $attributes['displayCondition'] )
		? sanitize_key( (string) $attributes['displayCondition'] )
		: 'always';

	if ( 'first_visit' === $condition ) {
		pivora_core_mark_returning_visitor();
	}

	return $block_content;
}
add_filter( 'render_block', 'pivora_core_filter_block_display_condition', 10, 3 );
