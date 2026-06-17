<?php
/**
 * Process steps block render callback.
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

$steps  = isset( $attributes['steps'] ) && is_array( $attributes['steps'] ) ? $attributes['steps'] : array();
$layout = isset( $attributes['layout'] ) ? sanitize_key( (string) $attributes['layout'] ) : 'vertical';

if ( ! in_array( $layout, array( 'vertical', 'horizontal' ), true ) ) {
	$layout = 'vertical';
}

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-process-steps',
	array(
		'layout'       => 'layout',
		'surfaceStyle' => 'surface',
	)
);
?>
<ol <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php foreach ( $steps as $index => $step ) : ?>
		<?php
		if ( ! is_array( $step ) ) {
			continue;
		}

		$number      = isset( $step['number'] ) ? (string) $step['number'] : (string) ( $index + 1 );
		$title       = isset( $step['title'] ) ? (string) $step['title'] : '';
		$description = isset( $step['description'] ) ? (string) $step['description'] : '';

		if ( '' === $title && '' === $description ) {
			continue;
		}
		?>
		<li class="pivora-process-steps__item">
			<span class="pivora-process-steps__number"><?php echo esc_html( $number ); ?></span>
			<div class="pivora-process-steps__content">
				<?php if ( '' !== $title ) : ?>
					<h3 class="pivora-process-steps__title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( '' !== $description ) : ?>
					<p class="pivora-process-steps__description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</div>
		</li>
	<?php endforeach; ?>
</ol>
