<?php
/**
 * Shipping progress block render callback.
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
	pivora_core_render_woocommerce_inactive_notice( 'pivora-shipping-progress' );
	return;
}

$goal_amount      = isset( $attributes['goalAmount'] ) ? (float) $attributes['goalAmount'] : 0.0;
$message          = isset( $attributes['message'] ) ? (string) $attributes['message'] : __( 'Add {amount} more for free shipping.', 'pivora-core' );
$success_message  = isset( $attributes['successMessage'] ) ? (string) $attributes['successMessage'] : __( 'You unlocked free shipping.', 'pivora-core' );

if ( $goal_amount <= 0 ) {
	$detected = pivora_core_detect_free_shipping_minimum();
	$goal_amount = null !== $detected ? $detected : 100.0;
}

$subtotal = pivora_core_get_cart_subtotal();
$progress = $goal_amount > 0 ? min( 100, max( 0, ( $subtotal / $goal_amount ) * 100 ) ) : 0;
$remaining = max( 0, $goal_amount - $subtotal );
$is_complete = $remaining <= 0.00001;

$display_message = $is_complete
	? $success_message
	: str_replace( '{amount}', wp_strip_all_tags( wc_price( $remaining ) ), $message );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'             => 'pivora-shipping-progress' . ( $is_complete ? ' is-complete' : '' ),
		'data-goal-amount'  => (string) $goal_amount,
		'data-message'      => $message,
		'data-success'      => $success_message,
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<p class="pivora-shipping-progress__message"><?php echo esc_html( $display_message ); ?></p>
	<div
		class="pivora-shipping-progress__bar"
		role="progressbar"
		aria-valuemin="0"
		aria-valuemax="100"
		aria-valuenow="<?php echo esc_attr( (string) (int) round( $progress ) ); ?>"
	>
		<span class="pivora-shipping-progress__fill" style="<?php echo esc_attr( 'width:' . $progress . '%;' ); ?>"></span>
	</div>
</div>
