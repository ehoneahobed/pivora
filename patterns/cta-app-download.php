<?php
/**
 * Title: App download CTA
 * Slug: pivora/cta-app-download
 * Categories: pivora-ctas, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-cta pivora-cta--app-download","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-cta pivora-cta--app-download">
	<!-- wp:group {"align":"wide","className":"pivora-cta__download-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-cta__download-shell">
		<!-- wp:paragraph {"className":"pivora-cta__download-eyebrow"} -->
		<p class="pivora-cta__download-eyebrow"><?php esc_html_e( 'Project management app', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Download our free project management app for clients', 'pivora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"pivora-cta__download-lede"} -->
		<p class="pivora-cta__download-lede"><?php esc_html_e( 'End-to-end payments and financial management in a single solution.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"pivora-cta__download-actions","layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons pivora-cta__download-actions">
			<!-- wp:button {"className":"is-style-pivora-hero-purple","url":"#"} -->
			<div class="wp-block-button is-style-pivora-hero-purple"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Playstore', 'pivora' ); ?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-pivora-cta-coral","url":"#"} -->
			<div class="wp-block-button is-style-pivora-cta-coral"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Google Play', 'pivora' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
