<?php
/**
 * SEO plugin integration helpers for Pivora Core.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether Yoast SEO is active.
 */
function pivora_core_is_yoast_seo_active(): bool {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'WPSEO_Options', false );
}

/**
 * Whether Rank Math is active.
 */
function pivora_core_is_rank_math_active(): bool {
	return defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath', false );
}

/**
 * Whether The SEO Framework is active.
 */
function pivora_core_is_seo_framework_active(): bool {
	return defined( 'THE_SEO_FRAMEWORK_VERSION' ) || function_exists( 'the_seo_framework' );
}

/**
 * Whether a supported SEO plugin is active.
 */
function pivora_core_has_seo_plugin(): bool {
	return pivora_core_is_yoast_seo_active()
		|| pivora_core_is_rank_math_active()
		|| pivora_core_is_seo_framework_active();
}

/**
 * Returns breadcrumb HTML from an active SEO plugin or a theme-safe fallback.
 *
 * @return string
 */
function pivora_core_get_seo_breadcrumb_html(): string {
	$html = '';

	if ( pivora_core_is_rank_math_active() && class_exists( '\RankMath\Frontend\Breadcrumb' ) ) {
		$html = (string) \RankMath\Frontend\Breadcrumb::get();
	} elseif ( pivora_core_is_yoast_seo_active() && function_exists( 'yoast_breadcrumb' ) ) {
		$html = (string) yoast_breadcrumb(
			'<p class="pivora-page-header__breadcrumb">',
			'</p>',
			false
		);
	} elseif ( pivora_core_is_seo_framework_active() && function_exists( 'the_seo_framework' ) ) {
		$tsf = the_seo_framework();

		if ( is_object( $tsf ) && isset( $tsf->breadcrumb ) && is_object( $tsf->breadcrumb ) ) {
			ob_start();
			$tsf->breadcrumb()->display();
			$html = (string) ob_get_clean();
		}
	}

	if ( '' === trim( $html ) ) {
		$html = pivora_core_get_fallback_breadcrumb_html();
	}

	/**
	 * Filters breadcrumb HTML before the SEO breadcrumb block wraps it.
	 *
	 * @param string $html Breadcrumb markup.
	 */
	return (string) apply_filters( 'pivora_core_seo_breadcrumb_html', $html );
}

/**
 * Builds a simple breadcrumb trail when no SEO plugin output is available.
 *
 * @return string
 */
function pivora_core_get_fallback_breadcrumb_html(): string {
	$crumbs = array(
		array(
			'url'   => home_url( '/' ),
			'label' => __( 'Home', 'pivora-core' ),
		),
	);

	if ( is_singular() ) {
		$crumbs[] = array(
			'url'   => '',
			'label' => get_the_title(),
		);
	} elseif ( is_archive() ) {
		$crumbs[] = array(
			'url'   => '',
			'label' => get_the_archive_title(),
		);
	} elseif ( is_search() ) {
		$crumbs[] = array(
			'url'   => '',
			'label' => sprintf(
				/* translators: %s: search query. */
				__( 'Search results for "%s"', 'pivora-core' ),
				get_search_query()
			),
		);
	}

	$parts = array();

	foreach ( $crumbs as $index => $crumb ) {
		$is_last = ( count( $crumbs ) - 1 === $index );

		if ( ! $is_last && '' !== $crumb['url'] ) {
			$parts[] = sprintf(
				'<a href="%s">%s</a>',
				esc_url( $crumb['url'] ),
				esc_html( $crumb['label'] )
			);
			$parts[] = '<span aria-hidden="true"> / </span>';
			continue;
		}

		$parts[] = sprintf( '<span>%s</span>', esc_html( $crumb['label'] ) );
	}

	return '<p class="pivora-page-header__breadcrumb">' . implode( '', $parts ) . '</p>';
}

/**
 * Renders breadcrumb markup for the SEO breadcrumb block.
 */
function pivora_core_render_seo_breadcrumb(): void {
	$html = pivora_core_get_seo_breadcrumb_html();

	if ( '' === trim( $html ) ) {
		return;
	}

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => 'pivora-seo-breadcrumb',
		)
	);

	printf(
		'<nav %1$s aria-label="%2$s">%3$s</nav>',
		$wrapper_attributes, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_attr__( 'Breadcrumb', 'pivora-core' ),
		$html // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SEO plugin or escaped fallback markup.
	);
}
