<?php
/**
 * Slide-in CTA block render callback.
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

$cta_id        = isset( $attributes['ctaId'] ) ? sanitize_key( (string) $attributes['ctaId'] ) : 'default';
$title         = isset( $attributes['title'] ) ? (string) $attributes['title'] : '';
$message       = isset( $attributes['message'] ) ? (string) $attributes['message'] : '';
$button_text   = isset( $attributes['buttonText'] ) ? (string) $attributes['buttonText'] : '';
$button_url    = isset( $attributes['buttonUrl'] ) ? (string) $attributes['buttonUrl'] : '';
$position      = isset( $attributes['position'] ) ? sanitize_key( (string) $attributes['position'] ) : 'bottom-right';
$delay_seconds = isset( $attributes['delaySeconds'] ) ? max( 0, min( 30, (int) $attributes['delaySeconds'] ) ) : 4;

if ( ! in_array( $position, array( 'bottom-right', 'bottom-left' ), true ) ) {
	$position = 'bottom-right';
}

$title_id = wp_unique_id( 'pivora-slide-in-title-' );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'              => 'pivora-slide-in-cta pivora-slide-in-cta--' . $position,
		'data-cta-id'        => $cta_id,
		'data-delay-seconds' => (string) $delay_seconds,
		'role'               => 'dialog',
		'aria-modal'         => 'true',
		'aria-labelledby'    => $title_id,
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> hidden>
	<button
		type="button"
		class="pivora-slide-in-cta__dismiss"
		aria-label="<?php esc_attr_e( 'Dismiss', 'pivora-core' ); ?>"
	>
		×
	</button>
	<?php if ( '' !== $title ) : ?>
		<h3 class="pivora-slide-in-cta__title" id="<?php echo esc_attr( $title_id ); ?>">
			<?php echo wp_kses_post( $title ); ?>
		</h3>
	<?php endif; ?>
	<?php if ( '' !== $message ) : ?>
		<p class="pivora-slide-in-cta__message"><?php echo wp_kses_post( $message ); ?></p>
	<?php endif; ?>
	<?php if ( '' !== $button_text ) : ?>
		<a class="pivora-slide-in-cta__button wp-element-button" href="<?php echo esc_url( $button_url ?: '#' ); ?>">
			<?php echo wp_kses_post( $button_text ); ?>
		</a>
	<?php endif; ?>
</div>
