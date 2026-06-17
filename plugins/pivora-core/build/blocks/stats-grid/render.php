<?php
/**
 * Stats grid block render callback.
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

$stats   = isset( $attributes['stats'] ) && is_array( $attributes['stats'] ) ? $attributes['stats'] : array();
$columns = isset( $attributes['columns'] ) ? max( 1, min( 4, (int) $attributes['columns'] ) ) : 3;
$variant = isset( $attributes['variant'] ) ? sanitize_key( (string) $attributes['variant'] ) : 'premium';

if ( ! in_array( $variant, array( 'default', 'premium', 'light' ), true ) ) {
	$variant = 'premium';
}

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-stats-grid pivora-metrics' . ( 'default' !== $variant ? ' pivora-metrics--' . $variant : '' ),
	array(
		'surfaceStyle' => 'surface',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="<?php echo esc_attr( '--pivora-stats-columns: ' . $columns . ';' ); ?>">
	<ul class="pivora-stats-grid__list">
		<?php foreach ( $stats as $stat ) : ?>
			<?php
			if ( ! is_array( $stat ) ) {
				continue;
			}

			$value       = isset( $stat['value'] ) ? (string) $stat['value'] : '';
			$label       = isset( $stat['label'] ) ? (string) $stat['label'] : '';
			$description = isset( $stat['description'] ) ? (string) $stat['description'] : '';

			if ( '' === $value && '' === $label ) {
				continue;
			}
			?>
			<li class="pivora-stats-grid__item pivora-metric">
				<?php if ( '' !== $label ) : ?>
					<p class="pivora-metric__label"><?php echo esc_html( $label ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== $value ) : ?>
					<p class="pivora-stats-grid__value"><?php echo esc_html( $value ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== $description ) : ?>
					<p class="pivora-metric__copy"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
