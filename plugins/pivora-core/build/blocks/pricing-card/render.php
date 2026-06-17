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

$to_feature_items = static function ( string $value ): array {
	return array_values(
		array_filter(
			array_map( 'trim', explode( "\n", $value ) )
		)
	);
};

$tier        = isset( $attributes['tier'] ) ? (string) $attributes['tier'] : '';
$price       = isset( $attributes['price'] ) ? (string) $attributes['price'] : '';
$term        = isset( $attributes['term'] ) ? (string) $attributes['term'] : '';
$price_yearly = isset( $attributes['priceYearly'] ) ? (string) $attributes['priceYearly'] : '';
$term_yearly  = isset( $attributes['termYearly'] ) ? (string) $attributes['termYearly'] : '';
$description = isset( $attributes['description'] ) ? (string) $attributes['description'] : '';
$features    = isset( $attributes['features'] ) ? (string) $attributes['features'] : '';
$cta_text    = isset( $attributes['ctaText'] ) ? (string) $attributes['ctaText'] : '';
$cta_url     = isset( $attributes['ctaUrl'] ) ? (string) $attributes['ctaUrl'] : '';
$featured    = ! empty( $attributes['featured'] );
$badge_text  = isset( $attributes['badgeText'] ) ? (string) $attributes['badgeText'] : __( 'Popular', 'pivora-core' );
$cta_outline = ! empty( $attributes['ctaOutline'] );
$variant     = isset( $attributes['variant'] ) ? (string) $attributes['variant'] : 'classic';

$included_features = isset( $attributes['includedFeatures'] ) ? (string) $attributes['includedFeatures'] : '';
$excluded_features = isset( $attributes['excludedFeatures'] ) ? (string) $attributes['excludedFeatures'] : '';

$included_items = $to_feature_items( $included_features );
$excluded_items = $to_feature_items( $excluded_features );

if ( empty( $included_items ) && '' !== $features ) {
	$included_items = $to_feature_items( $features );
}

$yearly_price = '' !== $price_yearly ? $price_yearly : $price;
$yearly_term  = '' !== $term_yearly ? $term_yearly : $term;
$has_dual_pricing = ( '' !== $price_yearly && $price_yearly !== $price ) || ( '' !== $term_yearly && $term_yearly !== $term );

$class_name = 'pivora-pricing-card pivora-price-card';

if ( 'spotlight' === $variant ) {
	$class_name .= ' pivora-price-card--spotlight';
}

if ( $featured ) {
	$class_name .= ' pivora-price-card--featured';
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => $class_name,
	)
);

$button_class = $cta_outline ? 'wp-block-button is-style-outline' : 'wp-block-button';

$render_price = static function () use ( $price, $term, $yearly_price, $yearly_term, $has_dual_pricing ): void {
	?>
	<h3 class="pivora-pricing-card__price">
		<span class="pivora-pricing-card__price-value pivora-pricing-card__price-value--monthly">
			<?php echo wp_kses_post( $price ); ?>
		</span>
		<?php if ( $has_dual_pricing ) : ?>
			<span class="pivora-pricing-card__price-value pivora-pricing-card__price-value--yearly">
				<?php echo wp_kses_post( $yearly_price ); ?>
			</span>
		<?php endif; ?>
		<?php if ( '' !== $term ) : ?>
			<span class="pivora-price-card__term pivora-price-card__term--monthly">
				<?php echo wp_kses_post( $term ); ?>
			</span>
		<?php endif; ?>
		<?php if ( $has_dual_pricing && '' !== $yearly_term ) : ?>
			<span class="pivora-price-card__term pivora-price-card__term--yearly">
				<?php echo wp_kses_post( $yearly_term ); ?>
			</span>
		<?php endif; ?>
	</h3>
	<?php
};

$render_features = static function () use ( $included_items, $excluded_items, $variant ): void {
	if ( empty( $included_items ) && empty( $excluded_items ) ) {
		return;
	}

	$list_class = 'spotlight' === $variant
		? 'pivora-price-card__feature-list'
		: 'pivora-price-card__features';
	?>
	<ul class="<?php echo esc_attr( $list_class ); ?>">
		<?php foreach ( $included_items as $feature ) : ?>
			<li<?php echo 'spotlight' === $variant ? ' class="pivora-price-card__feature pivora-price-card__feature--included"' : ''; ?>>
				<?php echo esc_html( $feature ); ?>
			</li>
		<?php endforeach; ?>
		<?php if ( 'spotlight' === $variant ) : ?>
			<?php foreach ( $excluded_items as $feature ) : ?>
				<li class="pivora-price-card__feature pivora-price-card__feature--excluded">
					<?php echo esc_html( $feature ); ?>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<?php
};
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $featured && '' !== $badge_text && 'spotlight' !== $variant ) : ?>
		<p class="pivora-pricing-card__badge"><?php echo esc_html( $badge_text ); ?></p>
	<?php endif; ?>

	<p class="pivora-price-card__tier"><?php echo wp_kses_post( $tier ); ?></p>

	<?php if ( 'spotlight' === $variant ) : ?>
		<p class="pivora-price-card__copy"><?php echo wp_kses_post( $description ); ?></p>
		<?php $render_price(); ?>
		<div class="<?php echo esc_attr( $button_class ); ?>">
			<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $cta_url ?: '#' ); ?>">
				<?php echo wp_kses_post( $cta_text ); ?>
			</a>
		</div>
		<?php $render_features(); ?>
	<?php else : ?>
		<?php $render_price(); ?>
		<p class="pivora-price-card__copy"><?php echo wp_kses_post( $description ); ?></p>
		<?php $render_features(); ?>
		<div class="<?php echo esc_attr( $button_class ); ?>">
			<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $cta_url ?: '#' ); ?>">
				<?php echo wp_kses_post( $cta_text ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
