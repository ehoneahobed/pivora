<?php
/**
 * FAQ item block render callback.
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

$question        = isset( $attributes['question'] ) ? (string) $attributes['question'] : '';
$answer          = isset( $attributes['answer'] ) ? (string) $attributes['answer'] : '';
$open_by_default = ! empty( $attributes['openByDefault'] );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-faq-item',
	)
);
?>
<details <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo $open_by_default ? 'open' : ''; ?>>
	<summary><span><?php echo wp_kses_post( $question ); ?></span></summary>
	<p><?php echo wp_kses_post( $answer ); ?></p>
</details>
