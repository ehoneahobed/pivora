<?php
/**
 * Title: Business hero (left aligned)
 * Slug: pivora/hero-business
 * Categories: pivora-business
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--image pivora-hero--left","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--image pivora-hero--left">
	<!-- wp:group {"align":"wide","className":"pivora-hero__content","layout":{"type":"constrained","contentSize":"780px","justifyContent":"left"}} -->
	<div class="wp-block-group alignwide pivora-hero__content">
		<!-- wp:paragraph {"className":"pivora-hero__badge"} -->
		<p class="pivora-hero__badge"><?php esc_html_e( 'Block-first WordPress theme', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"huge"} -->
		<h1 class="wp-block-heading has-huge-font-size"><?php esc_html_e( 'Build premium WordPress sites without theme bloat.', 'pivora' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"pivora-hero__lede","fontSize":"medium"} -->
		<p class="pivora-hero__lede has-medium-font-size"><?php esc_html_e( 'Pivora is a fast, accessible, SEO-ready block theme for business websites, editorial brands, portfolios, and WooCommerce stores.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"pivora-hero__actions"} -->
		<div class="wp-block-buttons pivora-hero__actions">
			<!-- wp:button {"className":"is-style-pivora-hero-gold","url":"<?php echo esc_url( home_url( '/#patterns' ) ); ?>"} -->
			<div class="wp-block-button is-style-pivora-hero-gold"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#patterns' ) ); ?>"><?php esc_html_e( 'Explore Patterns', 'pivora' ); ?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-pivora-hero-gold-outline","url":"<?php echo esc_url( home_url( '/blog/' ) ); ?>"} -->
			<div class="wp-block-button is-style-pivora-hero-gold-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'View Templates', 'pivora' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:group {"className":"pivora-hero__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group pivora-hero__meta">
			<!-- wp:paragraph --><p><?php esc_html_e( 'Full Site Editing', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph --><p><?php esc_html_e( 'Style variations', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph --><p><?php esc_html_e( 'WooCommerce-ready', 'pivora' ); ?></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
