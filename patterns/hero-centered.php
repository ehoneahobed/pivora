<?php
/**
 * Title: Centered hero (image background)
 * Slug: pivora/hero-centered
 * Categories: pivora-business, pivora-saas
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--image pivora-hero--centered","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--image pivora-hero--centered">
	<!-- wp:group {"align":"wide","className":"pivora-hero__content","layout":{"type":"constrained","contentSize":"860px","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide pivora-hero__content">
		<!-- wp:paragraph {"align":"center","className":"pivora-hero__badge"} -->
		<p class="has-text-align-center pivora-hero__badge"><?php esc_html_e( 'Block-first WordPress theme', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"huge"} -->
		<h1 class="wp-block-heading has-text-align-center has-huge-font-size"><?php esc_html_e( 'Launch polished sites faster with block patterns.', 'pivora' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","className":"pivora-hero__lede","fontSize":"medium"} -->
		<p class="has-text-align-center pivora-hero__lede has-medium-font-size"><?php esc_html_e( 'Drop in editable sections, tune your copy, and ship a premium marketing site without custom theme code.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"pivora-hero__actions","layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons pivora-hero__actions">
			<!-- wp:button {"className":"is-style-pivora-hero-gold","url":"<?php echo esc_url( home_url( '/#patterns' ) ); ?>"} -->
			<div class="wp-block-button is-style-pivora-hero-gold"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#patterns' ) ); ?>"><?php esc_html_e( 'Explore Patterns', 'pivora' ); ?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-pivora-hero-gold-outline","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
			<div class="wp-block-button is-style-pivora-hero-gold-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book a Demo', 'pivora' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:group {"className":"pivora-hero__meta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
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
