<?php
/**
 * Title: Simple call to action
 * Slug: pivora/cta-simple
 * Categories: pivora-ctas
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-cta-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-cta-section">
	<!-- wp:group {"align":"wide","className":"pivora-cta-section__shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-cta-section__shell">
		<!-- wp:group {"className":"pivora-cta","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-cta">
			<!-- wp:group {"className":"pivora-cta__content","layout":{"type":"default"}} -->
			<div class="wp-block-group pivora-cta__content">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Get started', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":2} -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Ready to launch something sharper?', 'pivora' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-cta__lede"} -->
				<p class="pivora-cta__lede"><?php esc_html_e( 'Start with a fast foundation and shape it with native WordPress patterns.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:buttons {"className":"pivora-cta__action"} -->
			<div class="wp-block-buttons pivora-cta__action">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Start Building', 'pivora' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
