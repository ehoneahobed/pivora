<?php
/**
 * Title: Pricing table (spotlight)
 * Slug: pivora/pricing-table-spotlight
 * Categories: pivora-business, pivora-sections, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

$contact_url = home_url( '/contact/' );

$plans = array(
	array(
		'variant'           => 'spotlight',
		'tier'              => __( 'Freebie', 'pivora' ),
		'description'       => __( 'Ideal for individuals who need quick access to basic features.', 'pivora' ),
		'price'             => '$0',
		'term'              => __( '/ Month', 'pivora' ),
		'includedFeatures'  => implode(
			"\n",
			array(
				__( '20,000+ of PNG & SVG graphics', 'pivora' ),
				__( 'Access to 100 million stock images', 'pivora' ),
			)
		),
		'excludedFeatures'  => implode(
			"\n",
			array(
				__( 'Upload custom icons and fonts', 'pivora' ),
				__( 'Unlimited Sharing', 'pivora' ),
				__( 'Upload graphics & video in up to 4K', 'pivora' ),
				__( 'Unlimited Projects', 'pivora' ),
				__( 'Instant Access to our design system', 'pivora' ),
				__( 'Create teams to collaborate on designs', 'pivora' ),
			)
		),
		'ctaText'           => __( 'Get Started Now', 'pivora' ),
		'ctaUrl'            => $contact_url,
		'ctaOutline'        => true,
	),
	array(
		'variant'           => 'spotlight',
		'tier'              => __( 'Professional', 'pivora' ),
		'description'       => __( 'Ideal for individuals who need advanced features and tools for client work.', 'pivora' ),
		'price'             => '$25',
		'term'              => __( '/ Month', 'pivora' ),
		'includedFeatures'  => implode(
			"\n",
			array(
				__( '20,000+ of PNG & SVG graphics', 'pivora' ),
				__( 'Access to 100 million stock images', 'pivora' ),
				__( 'Upload custom icons and fonts', 'pivora' ),
				__( 'Unlimited Sharing', 'pivora' ),
				__( 'Upload graphics & video in up to 4K', 'pivora' ),
				__( 'Unlimited Projects', 'pivora' ),
				__( 'Instant Access to our design system', 'pivora' ),
				__( 'Create teams to collaborate on designs', 'pivora' ),
			)
		),
		'excludedFeatures'  => '',
		'ctaText'           => __( 'Get Started Now', 'pivora' ),
		'ctaUrl'            => $contact_url,
		'featured'          => true,
	),
	array(
		'variant'           => 'spotlight',
		'tier'              => __( 'Enterprise', 'pivora' ),
		'description'       => __( 'Ideal for businesses who need personalized services and security for large teams.', 'pivora' ),
		'price'             => '$100',
		'term'              => __( '/ Month', 'pivora' ),
		'includedFeatures'  => implode(
			"\n",
			array(
				__( '20,000+ of PNG & SVG graphics', 'pivora' ),
				__( 'Access to 100 million stock images', 'pivora' ),
				__( 'Upload custom icons and fonts', 'pivora' ),
				__( 'Unlimited Sharing', 'pivora' ),
				__( 'Upload graphics & video in up to 4K', 'pivora' ),
				__( 'Unlimited Projects', 'pivora' ),
				__( 'Instant Access to our design system', 'pivora' ),
				__( 'Create teams to collaborate on designs', 'pivora' ),
			)
		),
		'excludedFeatures'  => '',
		'ctaText'           => __( 'Get Started Now', 'pivora' ),
		'ctaUrl'            => $contact_url,
		'ctaOutline'        => true,
	),
);

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-pricing-section pivora-pricing-section--spotlight","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-pricing-section pivora-pricing-section--spotlight">
	<!-- wp:group {"align":"wide","className":"pivora-pricing-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-pricing-section__inner">
		<!-- wp:group {"className":"pivora-section__heading pivora-pricing-spotlight__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading pivora-pricing-spotlight__heading">
			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Choose a plan that is right for you', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","className":"pivora-section__lede"} -->
			<p class="has-text-align-center pivora-section__lede"><?php esc_html_e( 'Try Pivora for free. Upgrade to unlock advanced sections, patterns, and support.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<?php if ( pivora_is_core_active() ) : ?>
				<?php
				pivora_block(
					'pivora/pricing-billing-toggle',
					array(
						'monthlyLabel' => __( 'Pay Monthly', 'pivora' ),
						'yearlyLabel'  => __( 'Pay Yearly', 'pivora' ),
						'saveLabel'    => __( 'Save 25%', 'pivora' ),
						'defaultCycle' => 'monthly',
					)
				);
				?>
			<?php else : ?>
			<!-- wp:group {"className":"pivora-pricing-toggle","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
			<div class="wp-block-group pivora-pricing-toggle">
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option pivora-pricing-toggle__option--active"} -->
				<p class="pivora-pricing-toggle__option pivora-pricing-toggle__option--active"><?php esc_html_e( 'Pay Monthly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option"} -->
				<p class="pivora-pricing-toggle__option"><?php esc_html_e( 'Pay Yearly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"pivora-pricing-toggle__save"} -->
				<p class="pivora-pricing-toggle__save"><?php esc_html_e( 'Save 25%', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"pivora-pricing pivora-pricing--spotlight"} -->
		<div class="wp-block-columns pivora-pricing pivora-pricing--spotlight">
			<?php foreach ( $plans as $plan ) : ?>
				<!-- wp:column -->
				<div class="wp-block-column">
					<?php if ( pivora_is_core_active() ) : ?>
						<?php pivora_block( 'pivora/pricing-card', $plan ); ?>
					<?php else : ?>
						<!-- wp:group {"className":"pivora-card pivora-price-card pivora-price-card--spotlight<?php echo ! empty( $plan['featured'] ) ? ' pivora-price-card--featured' : ''; ?>","layout":{"type":"constrained"}} -->
						<div class="wp-block-group pivora-card pivora-price-card pivora-price-card--spotlight<?php echo ! empty( $plan['featured'] ) ? ' pivora-price-card--featured' : ''; ?>">
							<!-- wp:paragraph {"className":"pivora-price-card__tier"} -->
							<p class="pivora-price-card__tier"><?php echo esc_html( (string) $plan['tier'] ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:paragraph {"className":"pivora-price-card__copy"} -->
							<p class="pivora-price-card__copy"><?php echo esc_html( (string) $plan['description'] ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:heading {"level":3} -->
							<h3 class="wp-block-heading"><?php echo esc_html( (string) $plan['price'] ); ?><span class="pivora-price-card__term"><?php echo esc_html( (string) $plan['term'] ); ?></span></h3>
							<!-- /wp:heading -->
						</div>
						<!-- /wp:group -->
					<?php endif; ?>
				</div>
				<!-- /wp:column -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
