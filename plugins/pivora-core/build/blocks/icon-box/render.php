<?php
/**
 * Icon box block render callback.
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

$icon    = isset( $attributes['icon'] ) ? (string) $attributes['icon'] : '';
$title   = isset( $attributes['title'] ) ? (string) $attributes['title'] : '';
$content = isset( $attributes['content'] ) ? (string) $attributes['content'] : '';

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-icon-box',
	array(
		'surfaceStyle' => 'surface',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<p class="pivora-icon-box__icon"><?php echo esc_html( $icon ); ?></p>
	<h3 class="pivora-icon-box__title"><?php echo wp_kses_post( $title ); ?></h3>
	<p class="pivora-icon-box__copy"><?php echo wp_kses_post( $content ); ?></p>
</div>
