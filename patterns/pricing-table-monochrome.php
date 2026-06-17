<?php
/**
 * Title: Pricing table (monochrome scale)
 * Slug: pivora/pricing-table-monochrome
 * Categories: pivora-business, pivora-sections, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

$contact_url = home_url( '/contact/' );

$plans = array(
	array(
		'tier'             => __( 'Free', 'pivora' ),
		'description'      => __( 'For small teams', 'pivora' ),
		'price'            => '$0',
		'term'             => __( 'per user/month, billed annually', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Real-time contact syncing', 'pivora' ),
				__( 'Automatic data enrichment', 'pivora' ),
				__( 'Up to 3 seats', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Get Started', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'ctaOutline'       => true,
	),
	array(
		'tier'             => __( 'Basic', 'pivora' ),
		'description'      => __( 'For growing teams', 'pivora' ),
		'price'            => '$39',
		'term'             => __( '-15% per user/month, billed annually', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Private lists', 'pivora' ),
				__( 'Enhanced email sending', 'pivora' ),
				__( 'No seat limits', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Get Started', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'ctaOutline'       => true,
	),
	array(
		'tier'             => __( 'Pro', 'pivora' ),
		'description'      => __( 'For scaling businesses', 'pivora' ),
		'price'            => '$59',
		'term'             => __( '-15% per user/month, billed annually', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Fully adjustable permissions', 'pivora' ),
				__( 'Advanced data enrichment', 'pivora' ),
				__( 'Priority support', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Get Started', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'featured'         => true,
	),
	array(
		'tier'             => __( 'Enterprise', 'pivora' ),
		'description'      => __( 'For big corporations', 'pivora' ),
		'price'            => '$129',
		'term'             => __( 'per user/month, billed annually', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Unlimited reporting', 'pivora' ),
				__( 'SAML and SSO', 'pivora' ),
				__( 'Custom billing', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Contact Our Sales', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'ctaOutline'       => true,
	),
);
?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-pricing-section pivora-pricing-section--monochrome","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-pricing-section pivora-pricing-section--monochrome">
	<!-- wp:group {"align":"wide","className":"pivora-pricing-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-pricing-section__inner">
		<!-- wp:group {"className":"pivora-section__heading pivora-pricing-monochrome__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading pivora-pricing-monochrome__heading">
			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'From Startup to Enterprise.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","className":"pivora-section__lede"} -->
			<p class="has-text-align-center pivora-section__lede"><?php esc_html_e( 'Perfectly tailored for every stage of growth. Get started today, no credit card needed.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
			<?php if ( pivora_is_core_active() ) : ?>
				<?php
				pivora_block(
					'pivora/pricing-billing-toggle',
					array(
						'monthlyLabel' => __( 'Billed Monthly', 'pivora' ),
						'yearlyLabel'  => __( 'Billed Annually', 'pivora' ),
						'saveLabel'    => '',
						'defaultCycle' => 'yearly',
						'styleVariant' => 'mono',
					)
				);
				?>
			<?php else : ?>
			<!-- wp:group {"className":"pivora-pricing-toggle pivora-pricing-toggle--mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
			<div class="wp-block-group pivora-pricing-toggle pivora-pricing-toggle--mono">
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option"} -->
				<p class="pivora-pricing-toggle__option"><?php esc_html_e( 'Billed Monthly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option pivora-pricing-toggle__option--active"} -->
				<p class="pivora-pricing-toggle__option pivora-pricing-toggle__option--active"><?php esc_html_e( 'Billed Annually', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
		<!-- wp:columns {"className":"pivora-pricing pivora-pricing--monochrome"} -->
		<div class="wp-block-columns pivora-pricing pivora-pricing--monochrome">
			<?php foreach ( $plans as $plan ) : ?>
				<!-- wp:column -->
				<div class="wp-block-column">
					<?php if ( pivora_is_core_active() ) : ?>
						<?php pivora_block( 'pivora/pricing-card', $plan ); ?>
					<?php else : ?>
						<!-- wp:group {"className":"pivora-card pivora-price-card<?php echo ! empty( $plan['featured'] ) ? ' pivora-price-card--featured' : ''; ?>","layout":{"type":"constrained"}} -->
						<div class="wp-block-group pivora-card pivora-price-card<?php echo ! empty( $plan['featured'] ) ? ' pivora-price-card--featured' : ''; ?>">
							<p class="pivora-price-card__tier"><?php echo esc_html( (string) $plan['tier'] ); ?></p>
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
