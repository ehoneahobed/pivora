<?php
/**
 * Team member block render callback.
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

$initials = isset( $attributes['initials'] ) ? (string) $attributes['initials'] : '';
$name     = isset( $attributes['name'] ) ? (string) $attributes['name'] : '';
$role     = isset( $attributes['role'] ) ? (string) $attributes['role'] : '';
$bio      = isset( $attributes['bio'] ) ? (string) $attributes['bio'] : '';

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-team-member',
	array(
		'surfaceStyle' => 'surface',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<p class="pivora-team-member__avatar"><?php echo esc_html( $initials ); ?></p>
	<h3 class="pivora-team-member__name"><?php echo wp_kses_post( $name ); ?></h3>
	<p class="pivora-team-member__role"><?php echo wp_kses_post( $role ); ?></p>
	<p class="pivora-team-member__bio"><?php echo wp_kses_post( $bio ); ?></p>
</div>
