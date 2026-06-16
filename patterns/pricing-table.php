<?php
/**
 * Title: Pricing table
 * Slug: pivora/pricing-table
 * Categories: pivora-business, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"wide","className":"pivora-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide pivora-section">
	<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"constrained","contentSize":"720px"}} -->
	<div class="wp-block-group pivora-section__heading">
		<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
		<p class="pivora-eyebrow"><?php esc_html_e( 'Pricing', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Simple plans for growing websites.', 'pivora' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"className":"pivora-pricing"} -->
	<div class="wp-block-columns pivora-pricing">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"pivora-card pivora-price-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-card pivora-price-card">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Starter', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"fontSize":"x-large"} -->
				<p class="has-x-large-font-size"><?php esc_html_e( '$19', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul><li><?php esc_html_e( 'Core pages', 'pivora' ); ?></li><li><?php esc_html_e( 'Pattern-based layouts', 'pivora' ); ?></li><li><?php esc_html_e( 'Email support', 'pivora' ); ?></li></ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"pivora-card pivora-price-card pivora-price-card--featured","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-card pivora-price-card pivora-price-card--featured">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Growth', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"fontSize":"x-large"} -->
				<p class="has-x-large-font-size"><?php esc_html_e( '$49', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul><li><?php esc_html_e( 'Advanced sections', 'pivora' ); ?></li><li><?php esc_html_e( 'Landing pages', 'pivora' ); ?></li><li><?php esc_html_e( 'Priority support', 'pivora' ); ?></li></ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"pivora-card pivora-price-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-card pivora-price-card">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Scale', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"fontSize":"x-large"} -->
				<p class="has-x-large-font-size"><?php esc_html_e( '$99', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul><li><?php esc_html_e( 'Multi-site rollout', 'pivora' ); ?></li><li><?php esc_html_e( 'Commerce-ready layouts', 'pivora' ); ?></li><li><?php esc_html_e( 'Dedicated support', 'pivora' ); ?></li></ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
