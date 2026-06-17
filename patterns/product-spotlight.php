<?php
/**
 * Title: Product spotlight
 * Slug: pivora/product-spotlight
 * Categories: pivora-ecommerce, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

$shop_url = esc_url( home_url( '/shop/' ) );
?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-product-spotlight","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-product-spotlight">
	<!-- wp:group {"align":"wide","className":"pivora-product-spotlight__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-product-spotlight__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Featured products', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Best sellers from your catalog.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","inherit":false},"className":"pivora-product-spotlight__query"} -->
		<div class="wp-block-query pivora-product-spotlight__query">
			<!-- wp:post-template {"className":"pivora-product-spotlight__grid","layout":{"type":"grid","columnCount":3}} -->
				<!-- wp:group {"className":"pivora-card pivora-product-card","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-card pivora-product-card">
					<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","className":"pivora-product-card__media"} /-->
					<!-- wp:post-title {"level":3,"isLink":true,"className":"pivora-product-card__title"} /-->
					<!-- wp:paragraph {"className":"pivora-product-card__price"} -->
					<p class="pivora-product-card__price"><?php esc_html_e( 'View product', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->

			<!-- wp:query-no-results -->
				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Add WooCommerce products to populate this grid, or replace this Query Loop with WooCommerce product blocks.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:query-no-results -->
		</div>
		<!-- /wp:query -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"url":"<?php echo $shop_url; ?>"} -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo $shop_url; ?>"><?php esc_html_e( 'View all products', 'pivora' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
