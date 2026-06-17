<?php
/**
 * Title: Pricing table (green band)
 * Slug: pivora/pricing-table-green-band
 * Categories: pivora-business, pivora-sections, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

$contact_url = home_url( '/contact/' );

$plans = array(
	array(
		'variant'     => 'spotlight',
		'tier'        => __( 'Starter', 'pivora' ),
		'description' => __( 'Starter pack to help you get started.', 'pivora' ),
		'price'       => __( 'Free', 'pivora' ),
		'term'        => '',
		'ctaText'     => __( 'Get Started', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'ctaOutline'  => true,
	),
	array(
		'variant'     => 'spotlight',
		'tier'        => __( 'Pro', 'pivora' ),
		'description' => __( 'More power for small teams creating projects with confidence.', 'pivora' ),
		'price'       => '$20',
		'term'        => __( '/ month', 'pivora' ),
		'ctaText'     => __( 'Get Started', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'featured'    => true,
		'badgeText'   => __( 'Recommended', 'pivora' ),
	),
	array(
		'variant'     => 'spotlight',
		'tier'        => __( 'Business+', 'pivora' ),
		'description' => __( 'For companies that need to manage work happening across multiple teams.', 'pivora' ),
		'price'       => '$100',
		'term'        => __( '/ month', 'pivora' ),
		'ctaText'     => __( 'Get Started', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'ctaOutline'  => true,
	),
	array(
		'variant'     => 'spotlight',
		'tier'        => __( 'Enterprise', 'pivora' ),
		'description' => __( 'For enterprise teams that need additional security, control, and support.', 'pivora' ),
		'price'       => __( 'Custom', 'pivora' ),
		'term'        => '',
		'ctaText'     => __( 'Contact Sales', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'ctaOutline'  => true,
	),
);
?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-pricing-section pivora-pricing-section--green-band","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-pricing-section pivora-pricing-section--green-band">
	<!-- wp:group {"align":"wide","className":"pivora-pricing-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-pricing-section__inner">
		<!-- wp:group {"className":"pivora-section__heading pivora-pricing-green-band__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading pivora-pricing-green-band__heading">
			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'We offer great price plan for the application', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
			<?php if ( pivora_is_core_active() ) : ?>
				<?php
				pivora_block(
					'pivora/pricing-billing-toggle',
					array(
						'monthlyLabel' => __( 'Monthly', 'pivora' ),
						'yearlyLabel'  => __( 'Yearly', 'pivora' ),
						'saveLabel'    => __( 'save up to 30%', 'pivora' ),
						'defaultCycle' => 'monthly',
						'styleVariant' => 'green',
					)
				);
				?>
			<?php else : ?>
			<!-- wp:group {"className":"pivora-pricing-toggle pivora-pricing-toggle--green","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
			<div class="wp-block-group pivora-pricing-toggle pivora-pricing-toggle--green">
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option pivora-pricing-toggle__option--active"} -->
				<p class="pivora-pricing-toggle__option pivora-pricing-toggle__option--active"><?php esc_html_e( 'Monthly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option"} -->
				<p class="pivora-pricing-toggle__option"><?php esc_html_e( 'Yearly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__save"} -->
				<p class="pivora-pricing-toggle__save"><?php esc_html_e( 'save up to 30%', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
		<!-- wp:columns {"className":"pivora-pricing pivora-pricing--green-band"} -->
		<div class="wp-block-columns pivora-pricing pivora-pricing--green-band">
			<?php foreach ( $plans as $plan ) : ?>
				<!-- wp:column -->
				<div class="wp-block-column">
					<?php if ( pivora_is_core_active() ) : ?>
						<?php pivora_block( 'pivora/pricing-card', $plan ); ?>
					<?php else : ?>
						<!-- wp:group {"className":"pivora-card pivora-price-card","layout":{"type":"constrained"}} -->
						<div class="wp-block-group pivora-card pivora-price-card">
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
