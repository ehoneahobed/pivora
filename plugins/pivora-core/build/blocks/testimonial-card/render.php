<?php
/**
 * Testimonial card block render callback.
 *
 * @package Pivora_Core
 *
 * @var array<string, mixed> $attributes Block attributes.
 * @var string               $content    Block content.
 * @var WP_Block             $block      Block instance.
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$quote    = isset( $attributes['quote'] ) ? (string) $attributes['quote'] : '';
$initials = isset( $attributes['initials'] ) ? (string) $attributes['initials'] : '';
$name     = isset( $attributes['name'] ) ? (string) $attributes['name'] : '';
$role     = isset( $attributes['role'] ) ? (string) $attributes['role'] : '';

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-testimonial-card',
	array(
		'surfaceStyle' => 'surface',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<blockquote class="pivora-testimonial-card__quote">
		<p><?php echo wp_kses_post( $quote ); ?></p>
	</blockquote>
	<div class="pivora-testimonial-card__author">
		<p class="pivora-testimonial-card__avatar"><?php echo esc_html( $initials ); ?></p>
		<div class="pivora-testimonial-card__meta">
			<p class="pivora-testimonial-card__name"><?php echo wp_kses_post( $name ); ?></p>
			<p class="pivora-testimonial-card__role"><?php echo wp_kses_post( $role ); ?></p>
		</div>
	</div>
</div>
