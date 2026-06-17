<?php
/**
 * Title: Newsletter CTA
 * Slug: pivora/newsletter-cta
 * Categories: pivora-ctas, pivora-sections, pivora-editorial
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-newsletter-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-newsletter-section">
	<!-- wp:group {"align":"wide","className":"pivora-newsletter-section__shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-newsletter-section__shell">
		<!-- wp:group {"className":"pivora-newsletter","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-newsletter">
			<!-- wp:group {"className":"pivora-newsletter__content","layout":{"type":"default"}} -->
			<div class="wp-block-group pivora-newsletter__content">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Newsletter', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":2} -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Practical notes for people shipping with WordPress.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-newsletter__lede"} -->
				<p class="pivora-newsletter__lede"><?php esc_html_e( 'Built-in email capture works without a plugin. Swap in the Form Embed block for Mailchimp, WPForms, or your ESP embed.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<?php if ( defined( 'PIVORA_CORE_VERSION' ) ) : ?>
				<?php
				pivora_block(
					'pivora/lead-capture',
					array(
						'showName'    => false,
						'showMessage' => false,
						'layout'      => 'inline',
						'buttonText'  => __( 'Subscribe', 'pivora' ),
					)
				);
				?>
			<?php else : ?>
			<!-- wp:group {"className":"pivora-newsletter__form","layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group pivora-newsletter__form">
				<!-- wp:paragraph {"className":"pivora-newsletter__input"} -->
				<p class="pivora-newsletter__input"><?php esc_html_e( 'you@company.com', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"pivora-newsletter__action"} -->
				<div class="wp-block-buttons pivora-newsletter__action">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Subscribe', 'pivora' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
