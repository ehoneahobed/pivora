<?php
/**
 * Title: Service grid
 * Slug: pivora/service-grid
 * Categories: pivora-business, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-service-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-service-section">
	<!-- wp:group {"align":"wide","className":"pivora-service-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-service-section__inner">
		<!-- wp:columns {"className":"pivora-service-section__layout","verticalAlignment":"center"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-service-section__layout">
			<!-- wp:column {"verticalAlignment":"center","width":"56%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Multi-purpose', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'One foundation for many site types.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-service-section__lede"} -->
				<p class="pivora-service-section__lede"><?php esc_html_e( 'Pivora adapts through patterns and style variations—not bundled feature bloat. Start lean, then add only what the site actually needs.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"center","width":"44%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:44%">
				<!-- wp:group {"className":"pivora-service-grid","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-service-grid">
					<!-- wp:paragraph {"className":"pivora-service-chip"} -->
					<p class="pivora-service-chip"><?php esc_html_e( 'Business websites', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-service-chip"} -->
					<p class="pivora-service-chip"><?php esc_html_e( 'SaaS landing pages', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-service-chip"} -->
					<p class="pivora-service-chip"><?php esc_html_e( 'Editorial blogs', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-service-chip"} -->
					<p class="pivora-service-chip"><?php esc_html_e( 'Portfolios', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-service-chip"} -->
					<p class="pivora-service-chip"><?php esc_html_e( 'Local services', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-service-chip"} -->
					<p class="pivora-service-chip"><?php esc_html_e( 'Online stores', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->
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
