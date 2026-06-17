<?php
/**
 * Title: Email signup CTA
 * Slug: pivora/cta-email-signup
 * Categories: pivora-ctas, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-cta pivora-cta--email-band","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-cta pivora-cta--email-band">
	<!-- wp:group {"align":"wide","className":"pivora-cta__email-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-cta__email-shell">
		<!-- wp:group {"className":"pivora-cta__email-inner","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-cta__email-inner">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Ready to get started?', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-cta__email-lede"} -->
			<p class="pivora-cta__email-lede"><?php esc_html_e( 'Products on online services or over the Internet. Electronic commerce draws on technologies such as mobile commerce application.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"pivora-cta__signup-form","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group pivora-cta__signup-form">
				<!-- wp:paragraph {"className":"pivora-cta__signup-input"} -->
				<p class="pivora-cta__signup-input"><?php esc_html_e( 'Enter your email address', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"pivora-cta__signup-action"} -->
				<div class="wp-block-buttons pivora-cta__signup-action">
					<!-- wp:button {"className":"is-style-pivora-hero-green","url":"#"} -->
					<div class="wp-block-button is-style-pivora-hero-green"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Sign Up', 'pivora' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
