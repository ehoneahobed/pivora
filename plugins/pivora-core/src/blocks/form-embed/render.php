<?php
/**
 * Form embed block render callback.
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

$provider         = isset( $attributes['provider'] ) ? sanitize_key( (string) $attributes['provider'] ) : 'auto';
$form_id          = isset( $attributes['formId'] ) ? sanitize_text_field( (string) $attributes['formId'] ) : '';
$shortcode        = isset( $attributes['shortcode'] ) ? (string) $attributes['shortcode'] : '';
$placeholder_text = isset( $attributes['placeholderText'] ) ? (string) $attributes['placeholderText'] : __( 'Select a form provider and ID in the block settings, or paste a shortcode.', 'pivora-core' );

if ( 'auto' === $provider ) {
	$providers = pivora_core_get_form_providers();
	$provider  = ! empty( $providers ) ? (string) array_key_first( $providers ) : '';
}

$embed_html = '';

if ( 'shortcode' === $provider ) {
	$embed_html = pivora_core_render_form_embed( 'shortcode', '', $shortcode );
} elseif ( '' !== $provider && '' !== $form_id ) {
	$embed_html = pivora_core_render_form_embed( $provider, $form_id );
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-form-embed',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( '' !== $embed_html ) : ?>
		<?php echo $embed_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php else : ?>
		<p class="pivora-form-embed__placeholder"><?php echo esc_html( $placeholder_text ); ?></p>
	<?php endif; ?>
</div>
