<?php
/**
 * Comparison tabs block render callback.
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

$tabs = isset( $attributes['tabs'] ) && is_array( $attributes['tabs'] ) ? $attributes['tabs'] : array();

if ( empty( $tabs ) ) {
	return;
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-comparison-tabs',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="pivora-comparison-tabs__tablist" role="tablist" aria-label="<?php esc_attr_e( 'Plan comparison', 'pivora-core' ); ?>">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<?php
			$label = isset( $tab['label'] ) ? (string) $tab['label'] : sprintf(
				/* translators: %d: tab number */
				__( 'Tab %d', 'pivora-core' ),
				$index + 1
			);
			$is_active = 0 === $index;
			?>
			<button
				type="button"
				class="pivora-comparison-tabs__tab<?php echo $is_active ? ' is-active' : ''; ?>"
				role="tab"
				id="pivora-comparison-tab-<?php echo esc_attr( (string) $index ); ?>"
				aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
				aria-controls="pivora-comparison-panel-<?php echo esc_attr( (string) $index ); ?>"
				data-tab-index="<?php echo esc_attr( (string) $index ); ?>"
			>
				<?php echo esc_html( $label ); ?>
			</button>
		<?php endforeach; ?>
	</div>

	<?php foreach ( $tabs as $index => $tab ) : ?>
		<?php
		$columns = isset( $tab['columns'] ) && is_array( $tab['columns'] ) ? $tab['columns'] : array();
		$rows    = isset( $tab['rows'] ) && is_array( $tab['rows'] ) ? $tab['rows'] : array();
		$is_active = 0 === $index;
		?>
		<div
			class="pivora-comparison-tabs__panel<?php echo $is_active ? ' is-active' : ''; ?>"
			role="tabpanel"
			id="pivora-comparison-panel-<?php echo esc_attr( (string) $index ); ?>"
			aria-labelledby="pivora-comparison-tab-<?php echo esc_attr( (string) $index ); ?>"
			<?php echo $is_active ? '' : ' hidden'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		>
			<div class="pivora-comparison-tabs__table-wrap">
				<table class="pivora-comparison-tabs__table pivora-comparison-table">
					<thead>
						<tr>
							<th scope="col"><?php esc_html_e( 'Feature', 'pivora-core' ); ?></th>
							<?php foreach ( $columns as $column ) : ?>
								<th scope="col"><?php echo esc_html( (string) $column ); ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $rows as $row ) : ?>
							<?php
							if ( ! is_array( $row ) ) {
								continue;
							}

							$feature = isset( $row['feature'] ) ? (string) $row['feature'] : '';
							$values  = isset( $row['values'] ) && is_array( $row['values'] ) ? $row['values'] : array();
							?>
							<tr>
								<th scope="row"><?php echo esc_html( $feature ); ?></th>
								<?php foreach ( $columns as $column_index => $column ) : ?>
									<?php unset( $column ); ?>
									<td><?php echo esc_html( (string) ( $values[ $column_index ] ?? '' ) ); ?></td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php endforeach; ?>
</div>
