<?php
/**
 * Title: Product categories
 * Slug: pivora/product-categories
 * Categories: pivora-ecommerce, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

$shop_url = esc_url( home_url( '/shop/' ) );
?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-product-categories","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-product-categories">
	<!-- wp:group {"align":"wide","className":"pivora-product-categories__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-product-categories__inner">
		<!-- wp:group {"className":"pivora-section__header-row","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
		<div class="wp-block-group pivora-section__header-row">
			<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
			<div class="wp-block-group pivora-section__heading">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Shop by category', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Browse collections that match how people shop.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-pivora-outline","url":"<?php echo $shop_url; ?>"} -->
				<div class="wp-block-button is-style-pivora-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo $shop_url; ?>"><?php esc_html_e( 'View shop', 'pivora' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"pivora-product-categories__grid","layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group pivora-product-categories__grid">
			<!-- wp:paragraph {"className":"pivora-product-category-card"} -->
			<p class="pivora-product-category-card"><a href="<?php echo $shop_url; ?>"><?php esc_html_e( 'New arrivals', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-product-category-card"} -->
			<p class="pivora-product-category-card"><a href="<?php echo $shop_url; ?>"><?php esc_html_e( 'Best sellers', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-product-category-card"} -->
			<p class="pivora-product-category-card"><a href="<?php echo $shop_url; ?>"><?php esc_html_e( 'Bundles', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-product-category-card"} -->
			<p class="pivora-product-category-card"><a href="<?php echo $shop_url; ?>"><?php esc_html_e( 'Accessories', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-product-category-card"} -->
			<p class="pivora-product-category-card"><a href="<?php echo $shop_url; ?>"><?php esc_html_e( 'Gifts', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-product-category-card"} -->
			<p class="pivora-product-category-card"><a href="<?php echo $shop_url; ?>"><?php esc_html_e( 'Sale', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
