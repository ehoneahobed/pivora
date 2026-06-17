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

	register_block_pattern_category(
		'pivora-starters',
		array( 'label' => __( 'Pivora Starters', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-editorial',
		array( 'label' => __( 'Pivora Editorial', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-saas',
		array( 'label' => __( 'Pivora SaaS', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-portfolio',
		array( 'label' => __( 'Pivora Portfolio', 'pivora' ) )
	);

	register_block_pattern_category(
		'pivora-local',
		array( 'label' => __( 'Pivora Local', 'pivora' ) )
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
		array(
			'name'       => 'pivora/faq-section',
			'title'      => __( 'FAQ section', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-saas', 'pivora-business' ),
			'file'       => 'patterns/faq-section.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/testimonials-grid',
			'title'      => __( 'Testimonials grid', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-business', 'pivora-saas' ),
			'file'       => 'patterns/testimonials-grid.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/logo-cloud',
			'title'      => __( 'Logo cloud', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-business', 'pivora-saas' ),
			'file'       => 'patterns/logo-cloud.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/team-grid',
			'title'      => __( 'Team grid', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-business', 'pivora-local' ),
			'file'       => 'patterns/team-grid.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/contact-section',
			'title'      => __( 'Contact section', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-business', 'pivora-local' ),
			'file'       => 'patterns/contact-section.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/newsletter-cta',
			'title'      => __( 'Newsletter CTA', 'pivora' ),
			'categories' => array( 'pivora-ctas', 'pivora-sections', 'pivora-editorial' ),
			'file'       => 'patterns/newsletter-cta.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/comparison-table',
			'title'      => __( 'Comparison table', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-business', 'pivora-saas' ),
			'file'       => 'patterns/comparison-table.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/page-header',
			'title'      => __( 'Page header', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-content', 'pivora-editorial' ),
			'file'       => 'patterns/page-header.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/footer-columns',
			'title'      => __( 'Footer columns', 'pivora' ),
			'categories' => array( 'pivora-sections', 'pivora-business' ),
			'file'       => 'patterns/footer-columns.php',
			'viewport'   => 1440,
		),
		array(
			'name'       => 'pivora/metrics-band-light',
			'title'      => __( 'Metrics band (light)', 'pivora' ),
			'categories' => array( 'pivora-business', 'pivora-sections', 'pivora-saas' ),
			'file'       => 'patterns/metrics-band-light.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/metrics-band-split',
			'title'      => __( 'Metrics band (split)', 'pivora' ),
			'categories' => array( 'pivora-business', 'pivora-sections', 'pivora-saas' ),
			'file'       => 'patterns/metrics-band-split.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/product-spotlight',
			'title'      => __( 'Product spotlight', 'pivora' ),
			'categories' => array( 'pivora-ecommerce', 'pivora-sections' ),
			'file'       => 'patterns/product-spotlight.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/product-categories',
			'title'      => __( 'Product categories', 'pivora' ),
			'categories' => array( 'pivora-ecommerce', 'pivora-sections' ),
			'file'       => 'patterns/product-categories.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/starter-business-landing',
			'title'      => __( 'Business landing starter', 'pivora' ),
			'categories' => array( 'pivora-starters' ),
			'file'       => 'patterns/starter-business-landing.php',
			'viewport'   => 1440,
		),
		array(
			'name'       => 'pivora/starter-saas-landing',
			'title'      => __( 'SaaS landing starter', 'pivora' ),
			'categories' => array( 'pivora-starters', 'pivora-saas' ),
			'file'       => 'patterns/starter-saas-landing.php',
			'viewport'   => 1440,
		),
		array(
			'name'       => 'pivora/starter-blog-landing',
			'title'      => __( 'Blog landing starter', 'pivora' ),
			'categories' => array( 'pivora-starters' ),
			'file'       => 'patterns/starter-blog-landing.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/starter-store-landing',
			'title'      => __( 'Store landing starter', 'pivora' ),
			'categories' => array( 'pivora-starters' ),
			'file'       => 'patterns/starter-store-landing.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora/starter-portfolio-landing',
			'title'      => __( 'Portfolio landing starter', 'pivora' ),
			'categories' => array( 'pivora-starters' ),
			'file'       => 'patterns/starter-portfolio-landing.php',
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
