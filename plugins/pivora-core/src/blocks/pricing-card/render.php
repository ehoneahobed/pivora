<?php
/**
 * Pricing card block render callback.
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

$tier        = isset( $attributes['tier'] ) ? (string) $attributes['tier'] : '';
$price       = isset( $attributes['price'] ) ? (string) $attributes['price'] : '';
$term        = isset( $attributes['term'] ) ? (string) $attributes['term'] : '';
$description = isset( $attributes['description'] ) ? (string) $attributes['description'] : '';
$features    = isset( $attributes['features'] ) ? (string) $attributes['features'] : '';
$cta_text    = isset( $attributes['ctaText'] ) ? (string) $attributes['ctaText'] : '';
$cta_url     = isset( $attributes['ctaUrl'] ) ? (string) $attributes['ctaUrl'] : '';
$featured    = ! empty( $attributes['featured'] );
$badge_text  = isset( $attributes['badgeText'] ) ? (string) $attributes['badgeText'] : __( 'Popular', 'pivora-core' );
$cta_outline = ! empty( $attributes['ctaOutline'] );

$feature_items = array_values(
	array_filter(
		array_map( 'trim', explode( "\n", $features ) )
	)
);

$class_name = 'pivora-pricing-card pivora-price-card' . ( $featured ? ' pivora-price-card--featured' : '' );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => $class_name,
	)
);

$button_class = $cta_outline ? 'wp-block-button is-style-outline' : 'wp-block-button';
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $featured && '' !== $badge_text ) : ?>
		<p class="pivora-pricing-card__badge"><?php echo esc_html( $badge_text ); ?></p>
	<?php endif; ?>
	<p class="pivora-price-card__tier"><?php echo wp_kses_post( $tier ); ?></p>
	<h3 class="pivora-pricing-card__price">
		<span><?php echo wp_kses_post( $price ); ?></span>
		<span class="pivora-price-card__term"><?php echo wp_kses_post( $term ); ?></span>
	</h3>
	<p class="pivora-price-card__copy"><?php echo wp_kses_post( $description ); ?></p>
	<?php if ( ! empty( $feature_items ) ) : ?>
		<ul class="pivora-price-card__features">
			<?php foreach ( $feature_items as $feature ) : ?>
				<li><?php echo esc_html( $feature ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<div class="<?php echo esc_attr( $button_class ); ?>">
		<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $cta_url ?: '#' ); ?>">
			<?php echo wp_kses_post( $cta_text ); ?>
		</a>
	</div>
</div>
