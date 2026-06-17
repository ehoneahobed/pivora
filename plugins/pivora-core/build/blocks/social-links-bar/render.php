<?php
/**
 * Social links bar block render callback.
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

$label = isset( $attributes['label'] ) ? (string) $attributes['label'] : '';
$links = isset( $attributes['links'] ) && is_array( $attributes['links'] ) ? $attributes['links'] : array();

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-social-links-bar',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<span class="pivora-social-links-bar__label"><?php echo wp_kses_post( $label ); ?></span>
	<ul class="pivora-social-links-bar__list">
		<?php foreach ( $links as $link ) : ?>
			<?php
			$link_label = isset( $link['label'] ) ? (string) $link['label'] : '';
			$link_url   = isset( $link['url'] ) ? (string) $link['url'] : '';
			if ( '' === $link_label ) {
				continue;
			}
			?>
			<li>
				<a href="<?php echo esc_url( $link_url ?: '#' ); ?>"><?php echo esc_html( $link_label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
