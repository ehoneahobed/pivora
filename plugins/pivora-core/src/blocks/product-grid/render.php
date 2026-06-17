<?php
/**
 * Product grid block render callback.
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

if ( ! pivora_core_is_woocommerce_active() ) {
	pivora_core_render_woocommerce_inactive_notice( 'pivora-product-grid' );
	return;
}

$columns    = isset( $attributes['columns'] ) ? max( 1, min( 4, (int) $attributes['columns'] ) ) : 3;
$query_args = pivora_core_build_product_query_args( $attributes );
$query      = new WP_Query( $query_args );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-product-grid pivora-product-spotlight__grid',
	)
);

if ( ! $query->have_posts() ) {
	echo '<div ' . $wrapper_attributes . '><p class="pivora-product-grid__empty">' . esc_html__( 'Add products to your store to populate this grid.', 'pivora-core' ) . '</p></div>';
	wp_reset_postdata();
	return;
}
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="<?php echo esc_attr( '--pivora-product-columns: ' . $columns . ';' ); ?>">
	<ul class="pivora-product-grid__list">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			$product = wc_get_product( get_the_ID() );

			if ( ! $product ) {
				continue;
			}

			pivora_core_render_product_card( $product, $attributes );
		endwhile;
		?>
	</ul>
</div>
<?php
wp_reset_postdata();
