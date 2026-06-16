<?php
/**
 * Pattern categories.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Pivora pattern categories for the block editor.
 */
function pivora_register_pattern_categories(): void {
	register_block_pattern_category(
		'pivora-business',
		array( 'label' => __( 'Pivora Business', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-content',
		array( 'label' => __( 'Pivora Content', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-sections',
		array( 'label' => __( 'Pivora Sections', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-ecommerce',
		array( 'label' => __( 'Pivora Ecommerce', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-ctas',
		array( 'label' => __( 'Pivora CTAs', 'pivora' ) )
	);
}
add_action( 'init', 'pivora_register_pattern_categories' );


/**
 * Registers bundled block patterns from the theme pattern directory.
 */
function pivora_register_patterns(): void {
	$patterns = array(
		array(
			'name'       => 'pivora/hero-business',
			'title'      => __( 'Business hero', 'pivora' ),
			'categories' => array( 'pivora-business' ),
			'file'       => 'patterns/hero-business.php',
			'viewport'   => 1440,
		),
		array(
			'name'       => 'pivora/metrics-band',
			'title'      => __( 'Metrics band', 'pivora' ),
			'categories' => array( 'pivora-business', 'pivora-sections' ),
			'file'       => 'patterns/metrics-band.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/feature-grid',
			'title'      => __( 'Feature grid', 'pivora' ),
			'categories' => array( 'pivora-business', 'pivora-sections' ),
			'file'       => 'patterns/feature-grid.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/service-grid',
			'title'      => __( 'Service grid', 'pivora' ),
			'categories' => array( 'pivora-business', 'pivora-sections' ),
			'file'       => 'patterns/service-grid.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/pricing-table',
			'title'      => __( 'Pricing table', 'pivora' ),
			'categories' => array( 'pivora-business', 'pivora-sections' ),
			'file'       => 'patterns/pricing-table.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/portfolio-grid',
			'title'      => __( 'Portfolio grid', 'pivora' ),
			'categories' => array( 'pivora-content', 'pivora-sections' ),
			'file'       => 'patterns/portfolio-grid.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/editorial-feature',
			'title'      => __( 'Editorial feature', 'pivora' ),
			'categories' => array( 'pivora-content', 'pivora-sections' ),
			'file'       => 'patterns/editorial-feature.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/latest-posts',
			'title'      => __( 'Latest posts section', 'pivora' ),
			'categories' => array( 'pivora-content', 'pivora-sections' ),
			'file'       => 'patterns/latest-posts.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/store-hero',
			'title'      => __( 'Store hero', 'pivora' ),
			'categories' => array( 'pivora-ecommerce', 'pivora-sections' ),
			'file'       => 'patterns/store-hero.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/store-benefits',
			'title'      => __( 'Store benefits', 'pivora' ),
			'categories' => array( 'pivora-ecommerce', 'pivora-sections' ),
			'file'       => 'patterns/store-benefits.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/cta-simple',
			'title'      => __( 'Simple call to action', 'pivora' ),
			'categories' => array( 'pivora-ctas' ),
			'file'       => 'patterns/cta-simple.php',
			'viewport'   => 1200,
		),
	);

	$registry = WP_Block_Patterns_Registry::get_instance();

	foreach ( $patterns as $pattern ) {
		if ( $registry->is_registered( $pattern['name'] ) ) {
			continue;
		}

		$file = PIVORA_PATH . $pattern['file'];

		if ( ! file_exists( $file ) ) {
			continue;
		}

		ob_start();
		require $file;
		$pattern_content = trim( (string) ob_get_clean() );

		if ( '' === $pattern_content ) {
			continue;
		}

		register_block_pattern(
			$pattern['name'],
			array(
				'title'         => $pattern['title'],
				'categories'    => $pattern['categories'],
				'content'       => $pattern_content,
				'viewportWidth' => $pattern['viewport'],
			)
		);
	}
}
add_action( 'init', 'pivora_register_patterns', 20 );
