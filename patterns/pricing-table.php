<?php
/**
 * Title: Pricing table
 * Slug: pivora/pricing-table
 * Categories: pivora-business, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

$contact_url = home_url( '/contact/' );

$plans = array(
	array(
		'tier'        => __( 'Starter', 'pivora' ),
		'price'       => '$19',
		'term'        => __( '/mo', 'pivora' ),
		'description' => __( 'For lean launches and brochure sites.', 'pivora' ),
		'features'    => implode(
			"\n",
			array(
				__( 'Core pages', 'pivora' ),
				__( 'Pattern-based layouts', 'pivora' ),
				__( 'Email support', 'pivora' ),
			)
		),
		'ctaText'     => __( 'Choose Starter', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'featured'    => false,
		'ctaOutline'  => true,
	),
	array(
		'tier'        => __( 'Growth', 'pivora' ),
		'price'       => '$49',
		'term'        => __( '/mo', 'pivora' ),
		'description' => __( 'For teams shipping campaigns and content hubs.', 'pivora' ),
		'features'    => implode(
			"\n",
			array(
				__( 'Advanced sections', 'pivora' ),
				__( 'Landing pages', 'pivora' ),
				__( 'Priority support', 'pivora' ),
			)
		),
		'ctaText'     => __( 'Choose Growth', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'featured'    => true,
		'badgeText'   => __( 'Most popular', 'pivora' ),
		'ctaOutline'  => false,
	),
	array(
		'tier'        => __( 'Scale', 'pivora' ),
		'price'       => '$99',
		'term'        => __( '/mo', 'pivora' ),
		'description' => __( 'For multi-site rollouts and commerce.', 'pivora' ),
		'features'    => implode(
			"\n",
			array(
				__( 'Multi-site rollout', 'pivora' ),
				__( 'Commerce-ready layouts', 'pivora' ),
				__( 'Dedicated support', 'pivora' ),
			)
		),
		'ctaText'     => __( 'Choose Scale', 'pivora' ),
		'ctaUrl'      => $contact_url,
		'featured'    => false,
		'ctaOutline'  => true,
	),
);

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-pricing-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-pricing-section">
	<!-- wp:group {"align":"wide","className":"pivora-pricing-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-pricing-section__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Pricing', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Simple plans for growing websites.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-section__lede"} -->
			<p class="pivora-section__lede"><?php esc_html_e( 'Start lean, then scale with advanced layouts, landing pages, and commerce-ready sections when you need them.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"pivora-pricing"} -->
		<div class="wp-block-columns pivora-pricing">
			<?php if ( pivora_is_core_active() ) : ?>
				<?php foreach ( $plans as $plan ) : ?>
					<!-- wp:column -->
					<div class="wp-block-column">
						<?php pivora_block( 'pivora/pricing-card', $plan ); ?>
					</div>
					<!-- /wp:column -->
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( $plans as $plan ) : ?>
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:group {"className":"pivora-card pivora-price-card<?php echo $plan['featured'] ? ' pivora-price-card--featured' : ''; ?>","layout":{"type":"constrained"}} -->
						<div class="wp-block-group pivora-card pivora-price-card<?php echo $plan['featured'] ? ' pivora-price-card--featured' : ''; ?>">
							<?php if ( $plan['featured'] && ! empty( $plan['badgeText'] ) ) : ?>
								<!-- wp:paragraph {"className":"pivora-price-card__badge"} -->
								<p class="pivora-price-card__badge"><?php echo esc_html( (string) $plan['badgeText'] ); ?></p>
								<!-- /wp:paragraph -->
							<?php endif; ?>
							<!-- wp:paragraph {"className":"pivora-price-card__tier"} -->
							<p class="pivora-price-card__tier"><?php echo esc_html( $plan['tier'] ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:heading {"level":3} -->
							<h3 class="wp-block-heading"><?php echo esc_html( $plan['price'] ); ?><span class="pivora-price-card__term"><?php echo esc_html( $plan['term'] ); ?></span></h3>
							<!-- /wp:heading -->
							<!-- wp:paragraph {"className":"pivora-price-card__copy"} -->
							<p class="pivora-price-card__copy"><?php echo esc_html( $plan['description'] ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:buttons -->
							<div class="wp-block-buttons">
								<!-- wp:button {"className":"<?php echo $plan['ctaOutline'] ? 'is-style-outline' : ''; ?>","url":"<?php echo esc_url( $contact_url ); ?>"} -->
								<div class="wp-block-button <?php echo $plan['ctaOutline'] ? 'is-style-outline' : ''; ?>"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $contact_url ); ?>"><?php echo esc_html( $plan['ctaText'] ); ?></a></div>
								<!-- /wp:button -->
							</div>
							<!-- /wp:buttons -->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:column -->
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
