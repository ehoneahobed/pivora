<?php
/**
 * Title: Integrations strip
 * Slug: pivora-core/integrations-strip
 * Categories: pivora-core, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora_Core
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-integrations-strip","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-integrations-strip">
	<!-- wp:group {"align":"wide","className":"pivora-integrations-strip__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-integrations-strip__inner">
		<!-- wp:paragraph {"align":"center","className":"pivora-integrations-strip__label"} -->
		<p class="has-text-align-center pivora-integrations-strip__label"><?php esc_html_e( 'Works with the tools your team already uses', 'pivora-core' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"pivora-integrations-strip__logos","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group pivora-integrations-strip__logos">
			<!-- wp:paragraph {"className":"pivora-integrations-strip__item"} -->
			<p class="pivora-integrations-strip__item"><?php esc_html_e( 'WooCommerce', 'pivora-core' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-integrations-strip__item"} -->
			<p class="pivora-integrations-strip__item"><?php esc_html_e( 'WPForms', 'pivora-core' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-integrations-strip__item"} -->
			<p class="pivora-integrations-strip__item"><?php esc_html_e( 'Yoast SEO', 'pivora-core' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-integrations-strip__item"} -->
			<p class="pivora-integrations-strip__item"><?php esc_html_e( 'Mailchimp', 'pivora-core' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-integrations-strip__item"} -->
			<p class="pivora-integrations-strip__item"><?php esc_html_e( 'Stripe', 'pivora-core' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
