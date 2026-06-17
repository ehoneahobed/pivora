<?php
/**
 * Title: Jobs hero (search + visual)
 * Slug: pivora/hero-jobs-search
 * Categories: pivora-saas, pivora-business
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--jobs-search","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--jobs-search">
	<!-- wp:group {"align":"wide","className":"pivora-hero__jobs-search-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-hero__jobs-search-shell">
		<!-- wp:columns {"verticalAlignment":"center","className":"pivora-hero__jobs-search-columns"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-hero__jobs-search-columns">
			<!-- wp:column {"width":"54%","className":"pivora-hero__column pivora-hero__column--copy"} -->
			<div class="wp-block-column is-vertically-aligned-center pivora-hero__column pivora-hero__column--copy" style="flex-basis:54%">
				<!-- wp:heading {"level":1,"className":"pivora-hero__title"} -->
				<h1 class="wp-block-heading pivora-hero__title"><?php echo wp_kses_post( __( 'Discover more than 5000+ <span class="pivora-hero__highlight pivora-hero__highlight--purple-underline">Jobs</span>', 'pivora' ) ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-hero__lede"} -->
				<p class="pivora-hero__lede"><?php esc_html_e( 'Great platform for job seekers searching for new career heights and passionate about startups.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"pivora-hero__job-search pivora-hero__job-search--split","layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group pivora-hero__job-search pivora-hero__job-search--split">
					<!-- wp:paragraph {"className":"pivora-hero__job-search-field"} -->
					<p class="pivora-hero__job-search-field"><?php esc_html_e( '🔍 Job title or keyword', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-hero__job-search-field"} -->
					<p class="pivora-hero__job-search-field"><?php esc_html_e( '📍 Florence, Italy', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:buttons {"className":"pivora-hero__job-search-action"} -->
					<div class="wp-block-buttons pivora-hero__job-search-action">
						<!-- wp:button {"className":"is-style-pivora-hero-purple","url":"<?php echo esc_url( home_url( '/blog/' ) ); ?>"} -->
						<div class="wp-block-button is-style-pivora-hero-purple"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Search my job', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->

				<!-- wp:paragraph {"className":"pivora-hero__tags"} -->
				<p class="pivora-hero__tags"><?php esc_html_e( 'Popular: UI Designer, UX Researcher, Android, Admin', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"46%","className":"pivora-hero__column pivora-hero__column--visual"} -->
			<div class="wp-block-column is-vertically-aligned-center pivora-hero__column pivora-hero__column--visual" style="flex-basis:46%">
				<!-- wp:group {"className":"pivora-hero__jobs-visual","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__jobs-visual">
					<!-- wp:paragraph {"className":"pivora-hero__jobs-figure"} -->
					<p class="pivora-hero__jobs-figure"><?php esc_html_e( 'Your photo or illustration', 'pivora' ); ?></p>
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
