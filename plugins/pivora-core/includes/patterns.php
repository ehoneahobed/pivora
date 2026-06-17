<?php
/**
 * Plugin-only block pattern registration.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once PIVORA_CORE_PATH . 'includes/pattern-blocks.php';

/**
 * Registers Pivora Core pattern categories.
 */
function pivora_core_register_pattern_categories(): void {
	register_block_pattern_category(
		'pivora-core',
		array( 'label' => __( 'Pivora Core', 'pivora-core' ) )
	);
}
add_action( 'init', 'pivora_core_register_pattern_categories' );


/**
 * Registers bundled plugin patterns.
 */
function pivora_core_register_patterns(): void {
	$patterns = array(
		array(
			'name'       => 'pivora-core/lead-capture-band',
			'title'      => __( 'Lead capture band', 'pivora-core' ),
			'categories' => array( 'pivora-core', 'pivora-ctas' ),
			'file'       => 'patterns/lead-capture-band.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora-core/integrations-strip',
			'title'      => __( 'Integrations strip', 'pivora-core' ),
			'categories' => array( 'pivora-core', 'pivora-saas' ),
			'file'       => 'patterns/integrations-strip.php',
			'viewport'   => 1200,
		),
		array(
			'name'       => 'pivora-core/starter-agency-landing',
			'title'      => __( 'Agency landing starter', 'pivora-core' ),
			'categories' => array( 'pivora-core', 'pivora-starters' ),
			'file'       => 'patterns/starter-agency-landing.php',
			'viewport'   => 1440,
		),
		array(
			'name'       => 'pivora-core/announcement-bar',
			'title'      => __( 'Announcement bar', 'pivora-core' ),
			'categories' => array( 'pivora-core', 'pivora-sections' ),
			'file'       => 'patterns/announcement-bar.php',
			'viewport'   => 1440,
		),
		array(
			'name'       => 'pivora-core/social-links-footer',
			'title'      => __( 'Social links footer row', 'pivora-core' ),
			'categories' => array( 'pivora-core', 'pivora-sections' ),
			'file'       => 'patterns/social-links-footer.php',
			'viewport'   => 1200,
		),
	);

	$registry = WP_Block_Patterns_Registry::get_instance();

	foreach ( $patterns as $pattern ) {
		if ( $registry->is_registered( $pattern['name'] ) ) {
			continue;
		}

		$file = PIVORA_CORE_PATH . $pattern['file'];

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
add_action( 'init', 'pivora_core_register_patterns', 20 );
