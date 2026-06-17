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
<!-- wp:group {"align":"full","className":"pivora-section pivora-store-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-store-hero">
	<!-- wp:group {"align":"wide","className":"pivora-store-hero__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-store-hero__inner">
		<!-- wp:columns {"verticalAlignment":"center","className":"pivora-store-hero__columns"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-store-hero__columns">
			<!-- wp:column {"verticalAlignment":"center","width":"56%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Online Store', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":1,"fontSize":"huge"} -->
				<h1 class="wp-block-heading has-huge-font-size"><?php esc_html_e( 'Launch a product-focused storefront that still feels fast.', 'pivora' ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-store-hero__lede","fontSize":"medium"} -->
				<p class="pivora-store-hero__lede has-medium-font-size"><?php esc_html_e( 'Pair Pivora with WooCommerce for clean product grids, accessible checkout styling, and conversion-ready store sections.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"pivora-store-hero__actions"} -->
				<div class="wp-block-buttons pivora-store-hero__actions">
					<!-- wp:button {"url":"<?php echo esc_url( home_url( '/shop/' ) ); ?>"} -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Shop collection', 'pivora' ); ?></a></div>
					<!-- /wp:button -->

					<!-- wp:button {"className":"is-style-outline","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
					<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn more', 'pivora' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"center","width":"44%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:44%">
				<!-- wp:group {"className":"pivora-product-preview","layout":{"type":"constrained"}} -->
				<div class="wp-block-group pivora-product-preview">
					<!-- wp:group {"className":"pivora-product-preview__image","layout":{"type":"constrained"}} -->
					<div class="wp-block-group pivora-product-preview__image"></div>
					<!-- /wp:group -->

					<!-- wp:paragraph {"className":"pivora-product-preview__label"} -->
					<p class="pivora-product-preview__label"><?php esc_html_e( 'Signature product', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading"><?php esc_html_e( 'Everyday carry kit', 'pivora' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-product-preview__price"} -->
					<p class="pivora-product-preview__price"><?php esc_html_e( '$84.00', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
