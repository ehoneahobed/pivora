<?php
/**
 * WooCommerce integration helpers for Pivora Core.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns whether WooCommerce is active.
 */
function pivora_core_is_woocommerce_active(): bool {
	return class_exists( 'WooCommerce' );
}

/**
 * Renders a WooCommerce inactive notice for store blocks.
 *
 * @param string $block_class Block base class.
 */
function pivora_core_render_woocommerce_inactive_notice( string $block_class ): void {
	echo '<div class="' . esc_attr( $block_class ) . ' ' . esc_attr( $block_class ) . '--inactive"><p>' . esc_html__( 'Install and activate WooCommerce to use this block.', 'pivora-core' ) . '</p></div>';
}

/**
 * Builds a product query from block attributes.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return array<string, mixed>
 */
function pivora_core_build_product_query_args( array $attributes ): array {
	$product_ids   = isset( $attributes['productIds'] ) && is_array( $attributes['productIds'] ) ? array_map( 'intval', $attributes['productIds'] ) : array();
	$posts_to_show = isset( $attributes['postsToShow'] ) ? max( 1, min( 12, (int) $attributes['postsToShow'] ) ) : 3;
	$order_by      = isset( $attributes['orderBy'] ) ? sanitize_key( (string) $attributes['orderBy'] ) : 'date';
	$order         = isset( $attributes['order'] ) ? strtoupper( sanitize_key( (string) $attributes['order'] ) ) : 'DESC';
	$category_id   = isset( $attributes['categoryId'] ) ? (int) $attributes['categoryId'] : 0;
	$source        = isset( $attributes['source'] ) ? sanitize_key( (string) $attributes['source'] ) : 'latest';

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

	if ( ! empty( $product_ids ) || 'products' === $source ) {
		$ids = array_values( array_filter( $product_ids ) );

		if ( ! empty( $ids ) ) {
			$query_args['post__in']       = $ids;
			$query_args['orderby']        = 'post__in';
			$query_args['posts_per_page'] = count( $ids );
			return $query_args;
		}
	}

	if ( 'category' === $source && $category_id > 0 ) {
		$query_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => array( $category_id ),
			),
		);
	}

	if ( in_array( $order_by, array( 'date', 'title', 'menu_order', 'price' ), true ) ) {
		$query_args['orderby'] = $order_by;
	}

	if ( in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$query_args['order'] = $order;
	}

	return $query_args;
}

/**
 * Renders a single product card.
 *
 * @param WC_Product           $product    WooCommerce product.
 * @param array<string, mixed> $attributes Block attributes.
 */
function pivora_core_render_product_card( WC_Product $product, array $attributes ): void {
	$show_price  = ! isset( $attributes['showPrice'] ) || (bool) $attributes['showPrice'];
	$button_text = isset( $attributes['buttonText'] ) ? (string) $attributes['buttonText'] : __( 'View product', 'pivora-core' );
	?>
	<li class="pivora-product-grid__item pivora-card pivora-product-card">
		<a class="pivora-product-card__media" href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'pivora-product-card__image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
		<h3 class="pivora-product-card__title">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
		</h3>
		<?php if ( $show_price ) : ?>
			<p class="pivora-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
		<?php endif; ?>
		<?php if ( '' !== $button_text ) : ?>
			<a class="pivora-product-card__button" href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif; ?>
	</li>
	<?php
}

/**
 * Returns the cart subtotal as a float.
 */
function pivora_core_get_cart_subtotal(): float {
	if ( ! pivora_core_is_woocommerce_active() || ! WC()->cart ) {
		return 0.0;
	}

	return (float) WC()->cart->get_displayed_subtotal();
}

/**
 * Attempts to detect the lowest free-shipping minimum from zones.
 */
function pivora_core_detect_free_shipping_minimum(): ?float {
	if ( ! pivora_core_is_woocommerce_active() || ! class_exists( 'WC_Shipping_Zones' ) ) {
		return null;
	}

	$minimums = array();
	$zone_ids = array( 0 );

	foreach ( WC_Shipping_Zones::get_zones() as $zone_data ) {
		if ( isset( $zone_data['zone_id'] ) ) {
			$zone_ids[] = (int) $zone_data['zone_id'];
		}
	}

	foreach ( array_unique( $zone_ids ) as $zone_id ) {
		$zone = WC_Shipping_Zones::get_zone( $zone_id );

		if ( ! $zone ) {
			continue;
		}

		foreach ( $zone->get_shipping_methods( true ) as $method ) {
			if ( 'free_shipping' !== $method->id || 'yes' !== $method->enabled ) {
				continue;
			}

			if ( isset( $method->min_amount ) && is_numeric( $method->min_amount ) && (float) $method->min_amount > 0 ) {
				$minimums[] = (float) $method->min_amount;
			}
		}
	}

	if ( empty( $minimums ) ) {
		return null;
	}

	return min( $minimums );
}

/**
 * Seeds simple demo products when the store kit imports and the catalog is empty.
 */
function pivora_core_seed_store_products(): void {
	if ( ! pivora_core_is_woocommerce_active() ) {
		return;
	}

	$existing = wc_get_products(
		array(
			'limit'  => 1,
			'return' => 'ids',
			'status' => 'publish',
		)
	);

	if ( ! empty( $existing ) ) {
		return;
	}

	if ( ! class_exists( 'WC_Product_Simple' ) ) {
		return;
	}

	$products = array(
		array(
			'name'  => __( 'Summit Backpack', 'pivora-core' ),
			'price' => '89',
			'desc'  => __( 'Everyday carry pack with padded laptop sleeve.', 'pivora-core' ),
		),
		array(
			'name'  => __( 'Harbor Tote', 'pivora-core' ),
			'price' => '54',
			'desc'  => __( 'Structured canvas tote for market runs and studio days.', 'pivora-core' ),
		),
		array(
			'name'  => __( 'Northline Mug', 'pivora-core' ),
			'price' => '24',
			'desc'  => __( 'Matte ceramic mug with a comfortable handle.', 'pivora-core' ),
		),
		array(
			'name'  => __( 'Fieldnote Journal', 'pivora-core' ),
			'price' => '18',
			'desc'  => __( 'Lay-flat notebook with dot grid pages.', 'pivora-core' ),
		),
	);

	foreach ( $products as $product_data ) {
		$product = new WC_Product_Simple();
		$product->set_name( $product_data['name'] );
		$product->set_regular_price( $product_data['price'] );
		$product->set_description( $product_data['desc'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->save();
	}
}

/**
 * Enqueues WooCommerce cart fragment scripts when store blocks are present.
 */
function pivora_core_enqueue_woocommerce_block_assets(): void {
	if ( ! pivora_core_is_woocommerce_active() ) {
		return;
	}

	$needs_fragments = has_block( 'pivora/mini-cart' ) || has_block( 'pivora/shipping-progress' );

	if ( ! $needs_fragments ) {
		return;
	}

	wp_enqueue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'pivora_core_enqueue_woocommerce_block_assets' );
