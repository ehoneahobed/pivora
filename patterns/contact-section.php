<?php
/**
 * Title: Contact section
 * Slug: pivora/contact-section
 * Categories: pivora-sections, pivora-business, pivora-local
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-contact-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-contact-section">
	<!-- wp:group {"align":"wide","className":"pivora-contact-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-contact-section__inner">
		<!-- wp:columns {"className":"pivora-contact-section__layout"} -->
		<div class="wp-block-columns pivora-contact-section__layout">
			<!-- wp:column {"width":"42%"} -->
			<div class="wp-block-column" style="flex-basis:42%">
				<!-- wp:group {"className":"pivora-contact-section__intro","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-contact-section__intro">
					<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
					<p class="pivora-eyebrow"><?php esc_html_e( 'Contact', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:heading -->
					<h2 class="wp-block-heading"><?php esc_html_e( 'Tell us what you are building.', 'pivora' ); ?></h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-section__lede"} -->
					<p class="pivora-section__lede"><?php esc_html_e( 'Share a few details and we will reply within one business day. Replace the form area with your preferred forms plugin when you are ready.', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:group {"className":"pivora-contact-details","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-contact-details">
						<!-- wp:paragraph {"className":"pivora-contact-details__item"} -->
						<p class="pivora-contact-details__item"><strong><?php esc_html_e( 'Email', 'pivora' ); ?></strong><br><a href="mailto:hello@example.com">hello@example.com</a></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"pivora-contact-details__item"} -->
						<p class="pivora-contact-details__item"><strong><?php esc_html_e( 'Phone', 'pivora' ); ?></strong><br><a href="tel:+15550123456">+1 (555) 012-3456</a></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"pivora-contact-details__item"} -->
						<p class="pivora-contact-details__item"><strong><?php esc_html_e( 'Studio', 'pivora' ); ?></strong><br><?php esc_html_e( '120 Market Street, Suite 400', 'pivora' ); ?><br><?php esc_html_e( 'San Francisco, CA', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"58%"} -->
			<div class="wp-block-column" style="flex-basis:58%">
				<!-- wp:group {"className":"pivora-card pivora-contact-form-card","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-card pivora-contact-form-card">
					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading"><?php esc_html_e( 'Project inquiry', 'pivora' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-contact-form-card__hint"} -->
					<p class="pivora-contact-form-card__hint"><?php esc_html_e( 'Insert a form block from WPForms, Gravity Forms, or Contact Form 7 in this card. The layout below is a visual placeholder.', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:group {"className":"pivora-contact-form-placeholder","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-contact-form-placeholder">
						<!-- wp:paragraph {"className":"pivora-contact-form-placeholder__field"} -->
						<p class="pivora-contact-form-placeholder__field"><?php esc_html_e( 'Full name', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"pivora-contact-form-placeholder__field"} -->
						<p class="pivora-contact-form-placeholder__field"><?php esc_html_e( 'Work email', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"pivora-contact-form-placeholder__field pivora-contact-form-placeholder__field--area"} -->
						<p class="pivora-contact-form-placeholder__field pivora-contact-form-placeholder__field--area"><?php esc_html_e( 'What are you trying to launch?', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button -->
						<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Send message', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
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
