<?php
/**
 * Mini cart block render callback.
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

if ( ! pivora_core_is_woocommerce_active() ) {
	pivora_core_render_woocommerce_inactive_notice( 'pivora-mini-cart' );
	return;
}

$cart_label     = isset( $attributes['cartLabel'] ) ? (string) $attributes['cartLabel'] : __( 'Cart', 'pivora-core' );
$show_count     = ! isset( $attributes['showCount'] ) || (bool) $attributes['showCount'];
$checkout_text  = isset( $attributes['checkoutText'] ) ? (string) $attributes['checkoutText'] : __( 'Checkout', 'pivora-core' );
$count          = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
$panel_id       = wp_unique_id( 'pivora-mini-cart-panel-' );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-mini-cart',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<button
		type="button"
		class="pivora-mini-cart__toggle"
		aria-expanded="false"
		aria-controls="<?php echo esc_attr( $panel_id ); ?>"
	>
		<span class="pivora-mini-cart__label"><?php echo esc_html( $cart_label ); ?></span>
		<?php if ( $show_count ) : ?>
			<span class="pivora-mini-cart__count"><?php echo esc_html( (string) $count ); ?></span>
		<?php endif; ?>
	</button>
	<div class="pivora-mini-cart__panel" id="<?php echo esc_attr( $panel_id ); ?>" hidden>
		<div class="pivora-mini-cart__widget widget_shopping_cart_content">
			<?php woocommerce_mini_cart(); ?>
		</div>
		<?php if ( '' !== $checkout_text ) : ?>
			<a class="pivora-mini-cart__checkout wp-element-button" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
				<?php echo esc_html( $checkout_text ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>
