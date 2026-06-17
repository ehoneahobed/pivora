<?php
/**
 * Title: Pricing table (soft purple)
 * Slug: pivora/pricing-table-soft-purple
 * Categories: pivora-business, pivora-sections, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

$contact_url = home_url( '/contact/' );

$plans = array(
	array(
		'variant'          => 'spotlight',
		'tier'             => __( 'Free', 'pivora' ),
		'description'      => __( 'Description of the tier list will go here. Keep it short and impactful.', 'pivora' ),
		'price'            => '$0',
		'term'             => __( '/ month', 'pivora' ),
		'priceYearly'      => '$0',
		'termYearly'       => __( '/ month, billed yearly', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Amazing feature one', 'pivora' ),
				__( 'Wonderful feature two', 'pivora' ),
				__( 'Priceless feature three', 'pivora' ),
				__( 'Splendid feature four', 'pivora' ),
			)
		),
		'excludedFeatures' => implode(
			"\n",
			array(
				__( 'Delightful feature five', 'pivora' ),
				__( 'Instant access support', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Try for Free', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'ctaOutline'       => true,
	),
	array(
		'variant'          => 'spotlight',
		'tier'             => __( 'Pro', 'pivora' ),
		'description'      => __( 'Description of the tier list will go here. Keep it short and impactful.', 'pivora' ),
		'price'            => '$12',
		'term'             => __( '/ month', 'pivora' ),
		'priceYearly'      => '$10',
		'termYearly'       => __( '/ month, billed yearly', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Everything in Free, plus', 'pivora' ),
				__( 'Amazing feature one', 'pivora' ),
				__( 'Wonderful feature two', 'pivora' ),
				__( 'Priceless feature three', 'pivora' ),
				__( 'Splendid feature four', 'pivora' ),
				__( 'Delightful feature five', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Subscribe now', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'featured'         => true,
	),
	array(
		'variant'          => 'spotlight',
		'tier'             => __( 'Enterprise', 'pivora' ),
		'description'      => __( 'Description of the tier list will go here. Keep it short and impactful.', 'pivora' ),
		'price'            => __( 'Custom', 'pivora' ),
		'term'             => __( 'contact sales', 'pivora' ),
		'priceYearly'      => __( 'Custom', 'pivora' ),
		'termYearly'       => __( 'yearly billing only', 'pivora' ),
		'includedFeatures' => implode(
			"\n",
			array(
				__( 'Everything in Pro plan, plus', 'pivora' ),
				__( 'Amazing feature one', 'pivora' ),
				__( 'Wonderful feature two', 'pivora' ),
				__( 'Priceless feature three', 'pivora' ),
				__( 'Splendid feature four', 'pivora' ),
				__( 'Delightful feature five', 'pivora' ),
			)
		),
		'ctaText'          => __( 'Contact Sales', 'pivora' ),
		'ctaUrl'           => $contact_url,
		'ctaOutline'       => true,
	),
);
?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-pricing-section pivora-pricing-section--soft-purple","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-pricing-section pivora-pricing-section--soft-purple">
	<!-- wp:group {"align":"wide","className":"pivora-pricing-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-pricing-section__inner">
		<!-- wp:group {"className":"pivora-section__heading pivora-pricing-soft-purple__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading pivora-pricing-soft-purple__heading">
			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Our Pricing', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
			<?php if ( pivora_is_core_active() ) : ?>
				<?php
				pivora_block(
					'pivora/pricing-billing-toggle',
					array(
						'monthlyLabel'  => __( 'Billed Monthly', 'pivora' ),
						'yearlyLabel'   => __( 'Billed Yearly', 'pivora' ),
						'saveLabel'     => __( '(save 15%)', 'pivora' ),
						'defaultCycle'  => 'yearly',
						'styleVariant'  => 'purple',
					)
				);
				?>
			<?php else : ?>
			<!-- wp:group {"className":"pivora-pricing-toggle pivora-pricing-toggle--purple","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
			<div class="wp-block-group pivora-pricing-toggle pivora-pricing-toggle--purple">
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option"} -->
				<p class="pivora-pricing-toggle__option"><?php esc_html_e( 'Billed Monthly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__option pivora-pricing-toggle__option--active"} -->
				<p class="pivora-pricing-toggle__option pivora-pricing-toggle__option--active"><?php esc_html_e( 'Billed Yearly', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"pivora-pricing-toggle__save"} -->
				<p class="pivora-pricing-toggle__save"><?php esc_html_e( '(save 15%)', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"pivora-pricing pivora-pricing--soft-purple"} -->
		<div class="wp-block-columns pivora-pricing pivora-pricing--soft-purple">
			<?php foreach ( $plans as $plan ) : ?>
				<!-- wp:column -->
				<div class="wp-block-column">
					<?php if ( pivora_is_core_active() ) : ?>
						<?php pivora_block( 'pivora/pricing-card', $plan ); ?>
					<?php else : ?>
						<!-- wp:group {"className":"pivora-card pivora-price-card","layout":{"type":"constrained"}} -->
						<div class="wp-block-group pivora-card pivora-price-card">
							<!-- wp:paragraph {"className":"pivora-price-card__tier"} -->
							<p class="pivora-price-card__tier"><?php echo esc_html( (string) $plan['tier'] ); ?></p>
							<!-- /wp:paragraph -->
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
