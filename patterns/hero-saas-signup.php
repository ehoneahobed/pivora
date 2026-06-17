<?php
/**
 * Title: SaaS hero (email signup)
 * Slug: pivora/hero-saas-signup
 * Categories: pivora-saas
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--saas-signup pivora-hero--centered","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--saas-signup pivora-hero--centered">
	<!-- wp:group {"align":"wide","className":"pivora-hero__content","layout":{"type":"constrained","contentSize":"820px","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide pivora-hero__content">
		<!-- wp:group {"className":"pivora-hero__features","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group pivora-hero__features">
			<!-- wp:paragraph {"className":"pivora-hero__feature"} --><p class="pivora-hero__feature"><?php esc_html_e( '12,625 leads in database', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__feature"} --><p class="pivora-hero__feature"><?php esc_html_e( 'More than 20+ niches', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__feature"} --><p class="pivora-hero__feature"><?php esc_html_e( 'Advanced filters', 'pivora' ); ?></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:heading {"textAlign":"center","level":1,"className":"pivora-hero__title"} -->
		<h1 class="wp-block-heading has-text-align-center pivora-hero__title"><?php echo wp_kses_post( __( 'The <span class="pivora-hero__highlight pivora-hero__highlight--green">simplest</span> way to find leads in the indie space.', 'pivora' ) ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","className":"pivora-hero__lede","fontSize":"medium"} -->
		<p class="has-text-align-center pivora-hero__lede has-medium-font-size"><?php esc_html_e( 'The best B2B database of SaaS owners, indie hackers, startup founders, and more — built for your outbound workflow.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"pivora-hero__signup","layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group pivora-hero__signup">
			<!-- wp:paragraph {"className":"pivora-hero__signup-input"} -->
			<p class="pivora-hero__signup-input"><?php esc_html_e( 'you@company.com', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"className":"pivora-hero__signup-action","layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons pivora-hero__signup-action">
				<!-- wp:button {"className":"is-style-pivora-hero-green","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
				<div class="wp-block-button is-style-pivora-hero-green"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Get sample', 'pivora' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:paragraph {"align":"center","className":"pivora-hero__signup-hint"} -->
		<p class="has-text-align-center pivora-hero__signup-hint"><?php esc_html_e( 'Get a sample right in your inbox. No login required.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"pivora-hero__trust","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group pivora-hero__trust">
			<!-- wp:group {"className":"pivora-hero__avatars","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group pivora-hero__avatars">
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">EV</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">NH</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">PL</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">RS</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">TK</p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:paragraph {"className":"pivora-hero__stars"} -->
			<p class="pivora-hero__stars" aria-hidden="true">★★★★★</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-hero__trust-copy"} -->
			<p class="pivora-hero__trust-copy"><?php esc_html_e( 'Bought by 100+ makers', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"pivora-hero__preview","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-hero__preview">
		<!-- wp:group {"className":"pivora-hero__preview-card","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-hero__preview-card">
			<!-- wp:group {"className":"pivora-hero__preview-head","layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group pivora-hero__preview-head">
				<!-- wp:paragraph {"className":"pivora-hero__preview-col"} --><p class="pivora-hero__preview-col"><?php esc_html_e( 'Company', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-col"} --><p class="pivora-hero__preview-col"><?php esc_html_e( 'Type', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-col"} --><p class="pivora-hero__preview-col"><?php esc_html_e( 'Email', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-col"} --><p class="pivora-hero__preview-col"><?php esc_html_e( 'Founder', 'pivora' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"pivora-hero__preview-row","layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group pivora-hero__preview-row">
				<!-- wp:paragraph {"className":"pivora-hero__preview-cell"} --><p class="pivora-hero__preview-cell"><?php esc_html_e( 'Splitpay', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-tag"} --><p class="pivora-hero__preview-tag"><?php esc_html_e( 'Productivity', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-cell"} --><p class="pivora-hero__preview-cell">founder@splitpay.io</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-cell"} --><p class="pivora-hero__preview-cell"><?php esc_html_e( 'Alex Rivera', 'pivora' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"pivora-hero__preview-row","layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group pivora-hero__preview-row">
				<!-- wp:paragraph {"className":"pivora-hero__preview-cell"} --><p class="pivora-hero__preview-cell"><?php esc_html_e( 'Design Kit', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-tag pivora-hero__preview-tag--amber"} --><p class="pivora-hero__preview-tag pivora-hero__preview-tag--amber"><?php esc_html_e( 'Design tools', 'pivora' ); ?></p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-cell"} --><p class="pivora-hero__preview-cell">hello@designkit.app</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__preview-cell"} --><p class="pivora-hero__preview-cell"><?php esc_html_e( 'Maya Chen', 'pivora' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
