<?php
/**
 * Title: Agency hero (centered, logo strip)
 * Slug: pivora/hero-agency
 * Categories: pivora-saas, pivora-portfolio
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--agency pivora-hero--centered","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--agency pivora-hero--centered">
	<!-- wp:group {"align":"wide","className":"pivora-hero__content","layout":{"type":"constrained","contentSize":"920px","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide pivora-hero__content">
		<!-- wp:paragraph {"align":"center","className":"pivora-hero__pill"} -->
		<p class="has-text-align-center pivora-hero__pill"><?php esc_html_e( '✨ Video editor and analytics, multichannel publishing — all in one.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","level":1,"className":"pivora-hero__title"} -->
		<h1 class="wp-block-heading has-text-align-center pivora-hero__title"><?php echo wp_kses_post( __( 'A <span class="pivora-hero__highlight pivora-hero__highlight--teal">CREATIVE</span> VIDEO CREATION AGENCY THAT DRIVES ENGAGEMENT', 'pivora' ) ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","className":"pivora-hero__lede","fontSize":"medium"} -->
		<p class="has-text-align-center pivora-hero__lede has-medium-font-size"><?php esc_html_e( 'We help businesses boost customer engagement through personalized, interactive video experiences.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"pivora-hero__trust","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group pivora-hero__trust">
			<!-- wp:group {"className":"pivora-hero__avatars","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group pivora-hero__avatars">
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">AK</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">JL</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">MR</p><!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">ST</p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:paragraph {"className":"pivora-hero__trust-copy"} -->
			<p class="pivora-hero__trust-copy"><?php esc_html_e( 'We are trusted by Fortune 500 companies', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:buttons {"className":"pivora-hero__actions","layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons pivora-hero__actions">
			<!-- wp:button {"className":"is-style-pivora-hero-teal","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
			<div class="wp-block-button is-style-pivora-hero-teal"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Request a demo →', 'pivora' ); ?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-pivora-hero-ink-outline","url":"<?php echo esc_url( home_url( '/#patterns' ) ); ?>"} -->
			<div class="wp-block-button is-style-pivora-hero-ink-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#patterns' ) ); ?>"><?php esc_html_e( '▶ Create your own', 'pivora' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"pivora-hero__logos","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-hero__logos">
		<!-- wp:paragraph {"align":"center","className":"pivora-hero__logos-label"} -->
		<p class="has-text-align-center pivora-hero__logos-label"><?php esc_html_e( 'Companies who trust us →', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"pivora-hero__logos-row","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group pivora-hero__logos-row">
			<!-- wp:paragraph {"className":"pivora-hero__logo-item pivora-hero__logo-item--accent"} --><p class="pivora-hero__logo-item pivora-hero__logo-item--accent"><?php esc_html_e( 'Netflix', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Stripe', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Google', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'X', 'pivora' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"pivora-hero__logo-item"} --><p class="pivora-hero__logo-item"><?php esc_html_e( 'Zara', 'pivora' ); ?></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
