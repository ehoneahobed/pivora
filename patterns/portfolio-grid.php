<?php
/**
 * Title: Portfolio grid
 * Slug: pivora/portfolio-grid
 * Categories: pivora-content, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"wide","className":"pivora-section pivora-portfolio","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide pivora-section pivora-portfolio">
	<!-- wp:group {"className":"pivora-section__header-row","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
	<div class="wp-block-group pivora-section__header-row">
		<!-- wp:group {"layout":{"type":"constrained","contentSize":"680px"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Selected Work', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Showcase projects with clean, scannable cards.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"pivora-portfolio-grid","layout":{"type":"grid","minimumColumnWidth":"260px"}} -->
	<div class="wp-block-group pivora-portfolio-grid">
		<!-- wp:group {"className":"pivora-project-card","layout":{"type":"constrained"}} -->
		<div class="wp-block-group pivora-project-card"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Brand system', 'pivora' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph --><p><?php esc_html_e( 'Identity, web presence, and launch system for a growing company.', 'pivora' ); ?></p><!-- /wp:paragraph --></div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"pivora-project-card","layout":{"type":"constrained"}} -->
		<div class="wp-block-group pivora-project-card"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Commerce refresh', 'pivora' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph --><p><?php esc_html_e( 'A faster product discovery experience for an online store.', 'pivora' ); ?></p><!-- /wp:paragraph --></div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"pivora-project-card","layout":{"type":"constrained"}} -->
		<div class="wp-block-group pivora-project-card"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Editorial hub', 'pivora' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph --><p><?php esc_html_e( 'A content-first publication layout for guides and analysis.', 'pivora' ); ?></p><!-- /wp:paragraph --></div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
