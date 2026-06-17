<?php
/**
 * Title: Feature grid
 * Slug: pivora/feature-grid
 * Categories: pivora-business, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-feature-section","anchor":"patterns","layout":{"type":"constrained"}} -->
<div id="patterns" class="wp-block-group alignfull pivora-section pivora-feature-section">
	<!-- wp:group {"align":"wide","className":"pivora-feature-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-feature-section__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
		<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
		<p class="pivora-eyebrow"><?php esc_html_e( 'Theme Foundation', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'A clean foundation for every serious WordPress site.', 'pivora' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"pivora-section__lede"} -->
		<p class="pivora-section__lede"><?php esc_html_e( 'Start with a polished design system, semantic templates, and editor-native patterns. Then add only the plugins your site actually needs.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"pivora-feature-grid"} -->
	<div class="wp-block-columns pivora-feature-grid">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"pivora-card pivora-feature","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-card pivora-feature">
				<!-- wp:paragraph {"className":"pivora-feature__icon"} --><p class="pivora-feature__icon">01</p><!-- /wp:paragraph -->
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'SEO-ready structure', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-feature__copy"} -->
				<p class="pivora-feature__copy"><?php esc_html_e( 'Semantic templates, clear heading hierarchy, and crawlable patterns built for modern search workflows.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"pivora-card pivora-feature","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-card pivora-feature">
				<!-- wp:paragraph {"className":"pivora-feature__icon"} --><p class="pivora-feature__icon">02</p><!-- /wp:paragraph -->
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Editor-native flexibility', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-feature__copy"} -->
				<p class="pivora-feature__copy"><?php esc_html_e( 'Global styles, template parts, and section patterns stay editable in the Site Editor without proprietary panels.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"pivora-card pivora-feature","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-card pivora-feature">
				<!-- wp:paragraph {"className":"pivora-feature__icon"} --><p class="pivora-feature__icon">03</p><!-- /wp:paragraph -->
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Performance discipline', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-feature__copy"} -->
				<p class="pivora-feature__copy"><?php esc_html_e( 'Lean CSS, local assets, and stable layouts keep every page fast, accessible, and predictable.', 'pivora' ); ?></p>
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
