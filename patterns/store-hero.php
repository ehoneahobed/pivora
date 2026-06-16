<?php
/**
 * Title: Store hero
 * Slug: pivora/store-hero
 * Categories: pivora-ecommerce, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-store-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-store-hero">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"56%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Online Store', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"huge"} -->
			<h1 class="wp-block-heading has-huge-font-size"><?php esc_html_e( 'Launch a product-focused storefront that still feels fast.', 'pivora' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"medium"} -->
			<p class="has-medium-font-size"><?php esc_html_e( 'Pair Pivora with WooCommerce for clean product grids, accessible checkout styling, and conversion-ready store sections.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Shop Collection', 'pivora' ); ?></a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Learn More', 'pivora' ); ?></a></div><!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"44%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:44%">
			<!-- wp:group {"className":"pivora-product-preview","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-product-preview">
				<!-- wp:group {"className":"pivora-product-preview__image","layout":{"type":"constrained"}} --><div class="wp-block-group pivora-product-preview__image"></div><!-- /wp:group -->
				<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Signature Product', 'pivora' ); ?></h3><!-- /wp:heading -->
				<!-- wp:paragraph --><p><?php esc_html_e( '$84.00', 'pivora' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
