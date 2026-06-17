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

if ( ! class_exists( 'WooCommerce' ) ) {
	echo '<div class="pivora-product-grid pivora-product-grid--empty"><p>' . esc_html__( 'Install and activate WooCommerce to display products.', 'pivora-core' ) . '</p></div>';
	return;
}

$product_ids    = isset( $attributes['productIds'] ) && is_array( $attributes['productIds'] ) ? array_map( 'intval', $attributes['productIds'] ) : array();
$posts_to_show  = isset( $attributes['postsToShow'] ) ? max( 1, min( 6, (int) $attributes['postsToShow'] ) ) : 3;
$columns        = isset( $attributes['columns'] ) ? max( 1, min( 4, (int) $attributes['columns'] ) ) : 3;
$order_by       = isset( $attributes['orderBy'] ) ? sanitize_key( (string) $attributes['orderBy'] ) : 'date';
$order          = isset( $attributes['order'] ) ? strtoupper( sanitize_key( (string) $attributes['order'] ) ) : 'DESC';
$show_price     = ! isset( $attributes['showPrice'] ) || (bool) $attributes['showPrice'];
$button_text    = isset( $attributes['buttonText'] ) ? (string) $attributes['buttonText'] : __( 'View product', 'pivora-core' );

$query_args = array(
	'post_type'              => 'product',
	'post_status'            => 'publish',
	'posts_per_page'         => $posts_to_show,
	'orderby'                => 'date',
	'order'                  => 'DESC',
	'no_found_rows'          => true,
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
);

if ( ! empty( $product_ids ) ) {
	$query_args['post__in'] = array_values( array_filter( $product_ids ) );
	$query_args['orderby']  = 'post__in';
	$query_args['posts_per_page'] = count( $query_args['post__in'] );
} else {
	if ( in_array( $order_by, array( 'date', 'title', 'menu_order' ), true ) ) {
		$query_args['orderby'] = $order_by;
	}

	if ( in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$query_args['order'] = $order;
	}
}

$query = new WP_Query( $query_args );

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
			?>
			<li class="pivora-product-grid__item pivora-card pivora-product-card">
				<a class="pivora-product-card__media" href="<?php echo esc_url( get_permalink() ); ?>">
					<?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'pivora-product-card__image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
				<h3 class="pivora-product-card__title">
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
				</h3>
				<?php if ( $show_price ) : ?>
					<p class="pivora-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== $button_text ) : ?>
					<a class="pivora-product-card__button" href="<?php echo esc_url( get_permalink() ); ?>">
						<?php echo esc_html( $button_text ); ?>
					</a>
				<?php endif; ?>
			</li>
			<?php
		endwhile;
		?>
	</ul>
</div>
<?php
wp_reset_postdata();
