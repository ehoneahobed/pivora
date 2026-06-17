<?php
/**
 * Block style variations for core blocks.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Pivora block styles on core blocks.
 */
function pivora_register_block_styles(): void {
	$button_styles = array(
		'pivora-outline'           => __( 'Outline', 'pivora' ),
		'pivora-pill'              => __( 'Pill', 'pivora' ),
		'pivora-ghost'             => __( 'Ghost', 'pivora' ),
		'pivora-hero-gold'         => __( 'Hero gold', 'pivora' ),
		'pivora-hero-gold-outline' => __( 'Hero gold outline', 'pivora' ),
		'pivora-hero-teal'         => __( 'Hero teal', 'pivora' ),
		'pivora-hero-teal-outline' => __( 'Hero teal outline', 'pivora' ),
		'pivora-hero-green'        => __( 'Hero green', 'pivora' ),
		'pivora-hero-ink-outline'  => __( 'Hero ink outline', 'pivora' ),
		'pivora-hero-purple'       => __( 'Hero purple', 'pivora' ),
		'pivora-hero-purple-soft'  => __( 'Hero purple soft', 'pivora' ),
		'pivora-hero-ink'          => __( 'Hero ink', 'pivora' ),
		'pivora-cta-amber'         => __( 'CTA amber', 'pivora' ),
		'pivora-cta-coral'         => __( 'CTA coral', 'pivora' ),
	);

	foreach ( $button_styles as $slug => $label ) {
		register_block_style(
			'core/button',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}

	$group_styles = array(
		'pivora-card'     => __( 'Card', 'pivora' ),
		'pivora-band'     => __( 'Band', 'pivora' ),
		'pivora-bordered' => __( 'Bordered', 'pivora' ),
	);

	foreach ( $group_styles as $slug => $label ) {
		register_block_style(
			'core/group',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}

	$image_styles = array(
		'pivora-rounded' => __( 'Rounded', 'pivora' ),
		'pivora-shadow'  => __( 'Shadow', 'pivora' ),
	);

	foreach ( $image_styles as $slug => $label ) {
		register_block_style(
			'core/image',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}

	$list_styles = array(
		'pivora-checklist' => __( 'Checkmarks', 'pivora' ),
		'pivora-steps'     => __( 'Steps', 'pivora' ),
	);

	foreach ( $list_styles as $slug => $label ) {
		register_block_style(
			'core/list',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}

	$quote_styles = array(
		'pivora-testimonial' => __( 'Testimonial', 'pivora' ),
		'pivora-pullquote'   => __( 'Pull quote', 'pivora' ),
	);

	foreach ( $quote_styles as $slug => $label ) {
		register_block_style(
			'core/quote',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}
}
add_action( 'init', 'pivora_register_block_styles' );
