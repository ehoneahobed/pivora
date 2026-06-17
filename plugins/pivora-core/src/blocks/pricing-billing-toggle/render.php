<?php
/**
 * Pricing billing toggle block render callback.
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

$monthly_label = isset( $attributes['monthlyLabel'] ) ? (string) $attributes['monthlyLabel'] : __( 'Billed Monthly', 'pivora-core' );
$yearly_label  = isset( $attributes['yearlyLabel'] ) ? (string) $attributes['yearlyLabel'] : __( 'Billed Yearly', 'pivora-core' );
$save_label    = isset( $attributes['saveLabel'] ) ? (string) $attributes['saveLabel'] : '';
$default_cycle = isset( $attributes['defaultCycle'] ) ? (string) $attributes['defaultCycle'] : 'monthly';
$style_variant = isset( $attributes['styleVariant'] ) ? (string) $attributes['styleVariant'] : 'default';

if ( ! in_array( $default_cycle, array( 'monthly', 'yearly' ), true ) ) {
	$default_cycle = 'monthly';
}

$toggle_class = 'pivora-pricing-toggle';

if ( 'default' !== $style_variant ) {
	$toggle_class .= ' pivora-pricing-toggle--' . sanitize_html_class( $style_variant );
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'             => $toggle_class,
		'data-default-cycle' => $default_cycle,
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<button
		type="button"
		class="pivora-pricing-toggle__option<?php echo 'monthly' === $default_cycle ? ' pivora-pricing-toggle__option--active' : ''; ?>"
		data-billing-cycle="monthly"
		aria-pressed="<?php echo 'monthly' === $default_cycle ? 'true' : 'false'; ?>"
	>
		<?php echo esc_html( $monthly_label ); ?>
	</button>
	<button
		type="button"
		class="pivora-pricing-toggle__option<?php echo 'yearly' === $default_cycle ? ' pivora-pricing-toggle__option--active' : ''; ?>"
		data-billing-cycle="yearly"
		aria-pressed="<?php echo 'yearly' === $default_cycle ? 'true' : 'false'; ?>"
	>
		<?php echo esc_html( $yearly_label ); ?>
	</button>
	<?php if ( '' !== $save_label ) : ?>
		<span class="pivora-pricing-toggle__save"><?php echo esc_html( $save_label ); ?></span>
	<?php endif; ?>
</div>
