<?php
/**
 * Title: Sale split CTA
 * Slug: pivora/cta-sale-split
 * Categories: pivora-ctas, pivora-ecommerce
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-cta pivora-cta--sale-split","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-section pivora-cta pivora-cta--sale-split">
	<!-- wp:group {"align":"wide","className":"pivora-cta__sale-grid","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-cta__sale-grid">
		<!-- wp:group {"className":"pivora-cta__sale-panel","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-cta__sale-panel">
			<!-- wp:paragraph {"className":"pivora-cta__sale-label"} -->
			<p class="pivora-cta__sale-label"><?php esc_html_e( 'Sale', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Enjoy up to 70% off!', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-cta__sale-copy"} -->
			<p class="pivora-cta__sale-copy"><?php esc_html_e( 'Grab your limited-time discount and enjoy 70% off on all our products.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"className":"pivora-cta__sale-actions"} -->
			<div class="wp-block-buttons pivora-cta__sale-actions">
				<!-- wp:button {"className":"is-style-pivora-cta-amber","url":"#"} -->
				<div class="wp-block-button is-style-pivora-cta-amber"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Shop now', 'pivora' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"pivora-cta__sale-visual","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-cta__sale-visual" aria-hidden="true"></div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
