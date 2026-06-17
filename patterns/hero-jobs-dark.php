<?php
/**
 * Title: Jobs hero (dark search)
 * Slug: pivora/hero-jobs-dark
 * Categories: pivora-saas, pivora-business
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--jobs-dark","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--jobs-dark">
	<!-- wp:group {"align":"wide","className":"pivora-hero__jobs-dark-shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-hero__jobs-dark-shell">
		<!-- wp:columns {"verticalAlignment":"center","className":"pivora-hero__jobs-dark-columns"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-hero__jobs-dark-columns">
			<!-- wp:column {"width":"58%","className":"pivora-hero__column pivora-hero__column--copy"} -->
			<div class="wp-block-column is-vertically-aligned-center pivora-hero__column pivora-hero__column--copy" style="flex-basis:58%">
				<!-- wp:heading {"level":1,"className":"pivora-hero__title"} -->
				<h1 class="wp-block-heading pivora-hero__title"><?php esc_html_e( 'Dream jobs waiting for you!', 'pivora' ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-hero__lede"} -->
				<p class="pivora-hero__lede"><?php esc_html_e( 'The search for your dream job is now made easy. Browse roles by title, view requirements, and apply in minutes.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"pivora-hero__job-search","layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group pivora-hero__job-search">
					<!-- wp:paragraph {"className":"pivora-hero__job-search-input"} -->
					<p class="pivora-hero__job-search-input"><?php esc_html_e( '🔍 Job title or keyword', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:buttons {"className":"pivora-hero__job-search-action"} -->
					<div class="wp-block-buttons pivora-hero__job-search-action">
						<!-- wp:button {"className":"is-style-pivora-hero-ink","url":"<?php echo esc_url( home_url( '/blog/' ) ); ?>"} -->
						<div class="wp-block-button is-style-pivora-hero-ink"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Search job', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"42%","className":"pivora-hero__column pivora-hero__column--profiles"} -->
			<div class="wp-block-column is-vertically-aligned-center pivora-hero__column pivora-hero__column--profiles" style="flex-basis:42%">
				<!-- wp:group {"className":"pivora-hero__candidate","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__candidate">
					<!-- wp:paragraph {"className":"pivora-hero__candidate-avatar"} -->
					<p class="pivora-hero__candidate-avatar">EJ</p>
					<!-- /wp:paragraph -->

					<!-- wp:group {"className":"pivora-hero__candidate-card","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-hero__candidate-card">
						<!-- wp:paragraph {"className":"pivora-hero__candidate-name"} -->
						<p class="pivora-hero__candidate-name"><?php esc_html_e( 'Elena Joe', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"pivora-hero__candidate-status"} -->
						<p class="pivora-hero__candidate-status"><?php esc_html_e( 'Interview stage completed', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:group {"className":"pivora-hero__candidate-meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
						<div class="wp-block-group pivora-hero__candidate-meta">
							<!-- wp:paragraph {"className":"pivora-hero__status-badge pivora-hero__status-badge--done"} -->
							<p class="pivora-hero__status-badge pivora-hero__status-badge--done"><?php esc_html_e( 'Done', 'pivora' ); ?></p>
							<!-- /wp:paragraph -->

							<!-- wp:paragraph {"className":"pivora-hero__stars"} -->
							<p class="pivora-hero__stars" aria-hidden="true">★★★★★</p>
							<!-- /wp:paragraph -->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"pivora-hero__candidate pivora-hero__candidate--offset","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__candidate pivora-hero__candidate--offset">
					<!-- wp:paragraph {"className":"pivora-hero__candidate-avatar"} -->
					<p class="pivora-hero__candidate-avatar">RA</p>
					<!-- /wp:paragraph -->

					<!-- wp:group {"className":"pivora-hero__candidate-card","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-hero__candidate-card">
						<!-- wp:paragraph {"className":"pivora-hero__candidate-name"} -->
						<p class="pivora-hero__candidate-name"><?php esc_html_e( 'Richard Andre', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"pivora-hero__candidate-status"} -->
						<p class="pivora-hero__candidate-status"><?php esc_html_e( 'Update contract agreement', 'pivora' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:group {"className":"pivora-hero__candidate-meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
						<div class="wp-block-group pivora-hero__candidate-meta">
							<!-- wp:paragraph {"className":"pivora-hero__status-badge pivora-hero__status-badge--pending"} -->
							<p class="pivora-hero__status-badge pivora-hero__status-badge--pending"><?php esc_html_e( 'Pending', 'pivora' ); ?></p>
							<!-- /wp:paragraph -->

							<!-- wp:paragraph {"className":"pivora-hero__stars"} -->
							<p class="pivora-hero__stars" aria-hidden="true">★★★★★</p>
							<!-- /wp:paragraph -->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->

		<!-- wp:group {"className":"pivora-hero__logo-carousel","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group pivora-hero__logo-carousel">
			<!-- wp:paragraph {"className":"pivora-hero__carousel-control"} -->
			<p class="pivora-hero__carousel-control" aria-hidden="true">‹</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Google', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Airbnb', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Uber Eats', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Amazon', 'pivora' ); ?></p><!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-hero__carousel-control"} -->
			<p class="pivora-hero__carousel-control" aria-hidden="true">›</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
