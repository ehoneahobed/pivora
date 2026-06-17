<?php
/**
 * Logo grid block render callback.
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

$heading = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : '';
$logos   = isset( $attributes['logos'] ) && is_array( $attributes['logos'] ) ? $attributes['logos'] : array();

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-logo-grid',
	array(
		'surfaceStyle' => 'surface',
	)
);
?>
<section <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( '' !== $heading ) : ?>
		<p class="pivora-logo-grid__heading"><?php echo wp_kses_post( $heading ); ?></p>
	<?php endif; ?>
	<ul class="pivora-logo-grid__list">
		<?php foreach ( $logos as $logo ) : ?>
			<?php
			$name      = isset( $logo['name'] ) ? (string) $logo['name'] : '';
			$url       = isset( $logo['url'] ) ? (string) $logo['url'] : '';
			$image_id  = isset( $logo['imageId'] ) ? (int) $logo['imageId'] : 0;
			$image_url = isset( $logo['imageUrl'] ) ? (string) $logo['imageUrl'] : '';

			if ( '' === $name && 0 === $image_id && '' === $image_url ) {
				continue;
			}
			?>
			<li class="pivora-logo-grid__item">
				<?php if ( '' !== $url ) : ?>
					<a class="pivora-logo-grid__link" href="<?php echo esc_url( $url ); ?>">
				<?php endif; ?>
				<?php if ( $image_id > 0 ) : ?>
					<?php echo wp_get_attachment_image( $image_id, 'medium', false, array( 'class' => 'pivora-logo-grid__image', 'alt' => $name ) ); ?>
				<?php elseif ( '' !== $image_url ) : ?>
					<img class="pivora-logo-grid__image" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy" decoding="async" />
				<?php else : ?>
					<span class="pivora-logo-grid__label"><?php echo esc_html( $name ); ?></span>
				<?php endif; ?>
				<?php if ( '' !== $url ) : ?>
					</a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
