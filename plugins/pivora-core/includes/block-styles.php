<?php
/**
 * Block style presets for Pivora Core blocks.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once PIVORA_CORE_PATH . 'includes/block-style-helpers.php';

/**
 * Registers shared block style variations for Pivora blocks.
 */
function pivora_core_register_block_styles(): void {
	$card_blocks = array(
		'pivora/icon-box',
		'pivora/testimonial-card',
		'pivora/team-member',
		'pivora/faq-item',
		'pivora/logo-grid',
	);

	$card_styles = array(
		'soft'    => __( 'Soft surface', 'pivora-core' ),
		'outline' => __( 'Outline surface', 'pivora-core' ),
		'minimal' => __( 'Minimal surface', 'pivora-core' ),
	);

	foreach ( $card_blocks as $block_name ) {
		foreach ( $card_styles as $slug => $label ) {
			register_block_style(
				$block_name,
				array(
					'name'  => $slug,
					'label' => $label,
				)
			);
		}
	}

	$social_styles = array(
		'centered' => __( 'Centered', 'pivora-core' ),
		'compact'  => __( 'Compact', 'pivora-core' ),
		'minimal'  => __( 'Minimal links', 'pivora-core' ),
	);

	foreach ( $social_styles as $slug => $label ) {
		register_block_style(
			'pivora/social-links-bar',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}
}
add_action( 'init', 'pivora_core_register_block_styles', 20 );
