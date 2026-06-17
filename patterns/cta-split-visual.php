<?php
/**
 * Title: Split visual CTA
 * Slug: pivora/cta-split-visual
 * Categories: pivora-ctas, pivora-business, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-cta pivora-cta--split-visual","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-section pivora-cta pivora-cta--split-visual">
	<!-- wp:group {"align":"wide","className":"pivora-cta__split-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-cta__split-shell">
		<!-- wp:columns {"verticalAlignment":"center","className":"pivora-cta__split-columns"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-cta__split-columns">
			<!-- wp:column {"width":"50%","className":"pivora-cta__column pivora-cta__column--visual"} -->
			<div class="wp-block-column is-vertically-aligned-center pivora-cta__column pivora-cta__column--visual" style="flex-basis:50%">
				<!-- wp:group {"className":"pivora-cta__visual-wrap","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-cta__visual-wrap">
					<!-- wp:group {"className":"pivora-cta__portrait","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-cta__portrait" aria-hidden="true">
						<!-- wp:group {"className":"pivora-cta__portrait-dots","layout":{"type":"default"}} -->
						<div class="wp-block-group pivora-cta__portrait-dots"></div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"pivora-cta__verified-card","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-cta__verified-card">
						<!-- wp:heading {"level":3} -->
						<h3 class="wp-block-heading"><?php esc_html_e( '100k+ Verified Users', 'pivora' ); ?></h3>
						<!-- /wp:heading -->

						<!-- wp:group {"className":"pivora-cta__verified-user","layout":{"type":"flex","flexWrap":"nowrap"}} -->
						<div class="wp-block-group pivora-cta__verified-user">
							<!-- wp:paragraph {"className":"pivora-cta__verified-avatar"} -->
							<p class="pivora-cta__verified-avatar" aria-hidden="true">EP</p>
							<!-- /wp:paragraph -->

							<!-- wp:group {"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:paragraph {"className":"pivora-cta__verified-name"} -->
								<p class="pivora-cta__verified-name"><?php esc_html_e( 'Eleanor Pena', 'pivora' ); ?></p>
								<!-- /wp:paragraph -->

								<!-- wp:paragraph {"className":"pivora-cta__verified-role"} -->
								<p class="pivora-cta__verified-role"><?php esc_html_e( 'Member of Film Design', 'pivora' ); ?></p>
								<!-- /wp:paragraph -->
							</div>
							<!-- /wp:group -->
						</div>
						<!-- /wp:group -->

						<!-- wp:group {"className":"pivora-cta__verified-user","layout":{"type":"flex","flexWrap":"nowrap"}} -->
						<div class="wp-block-group pivora-cta__verified-user">
							<!-- wp:paragraph {"className":"pivora-cta__verified-avatar"} -->
							<p class="pivora-cta__verified-avatar" aria-hidden="true">AF</p>
							<!-- /wp:paragraph -->

							<!-- wp:group {"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:paragraph {"className":"pivora-cta__verified-name"} -->
								<p class="pivora-cta__verified-name"><?php esc_html_e( 'Albert Flores', 'pivora' ); ?></p>
								<!-- /wp:paragraph -->

								<!-- wp:paragraph {"className":"pivora-cta__verified-role"} -->
								<p class="pivora-cta__verified-role"><?php esc_html_e( 'Member of Film Design', 'pivora' ); ?></p>
								<!-- /wp:paragraph -->
							</div>
							<!-- /wp:group -->
						</div>
						<!-- /wp:group -->

						<!-- wp:group {"className":"pivora-cta__verified-user","layout":{"type":"flex","flexWrap":"nowrap"}} -->
						<div class="wp-block-group pivora-cta__verified-user">
							<!-- wp:paragraph {"className":"pivora-cta__verified-avatar"} -->
							<p class="pivora-cta__verified-avatar" aria-hidden="true">WW</p>
							<!-- /wp:paragraph -->

							<!-- wp:group {"layout":{"type":"default"}} -->
							<div class="wp-block-group">
								<!-- wp:paragraph {"className":"pivora-cta__verified-name"} -->
								<p class="pivora-cta__verified-name"><?php esc_html_e( 'Wade Warren', 'pivora' ); ?></p>
								<!-- /wp:paragraph -->

								<!-- wp:paragraph {"className":"pivora-cta__verified-role"} -->
								<p class="pivora-cta__verified-role"><?php esc_html_e( 'Member of Film Design', 'pivora' ); ?></p>
								<!-- /wp:paragraph -->
							</div>
							<!-- /wp:group -->
						</div>
						<!-- /wp:group -->

						<!-- wp:paragraph {"className":"pivora-cta__verified-link"} -->
						<p class="pivora-cta__verified-link"><?php esc_html_e( 'See More >', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"50%","className":"pivora-cta__column pivora-cta__column--copy"} -->
			<div class="wp-block-column is-vertically-aligned-center pivora-cta__column pivora-cta__column--copy" style="flex-basis:50%">
				<!-- wp:heading {"level":2} -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'My little garret repair to desire he esteem.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-cta__split-lede"} -->
				<p class="pivora-cta__split-lede"><?php esc_html_e( 'Just like we said before, we have tons of features that will helps you to manage you wallet. From income, outcome, monthly usage, and etc.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"pivora-cta__split-actions"} -->
				<div class="wp-block-buttons pivora-cta__split-actions">
					<!-- wp:button {"className":"is-style-pivora-hero-teal","url":"#"} -->
					<div class="wp-block-button is-style-pivora-hero-teal"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Try for free', 'pivora' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
