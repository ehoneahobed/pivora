<?php
/**
 * Title: Pricing table
 * Slug: pivora/pricing-table
 * Categories: pivora-business, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

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
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:group {"className":"pivora-card pivora-price-card","layout":{"type":"constrained"}} -->
				<div class="wp-block-group pivora-card pivora-price-card">
					<!-- wp:paragraph {"className":"pivora-price-card__tier"} -->
					<p class="pivora-price-card__tier"><?php esc_html_e( 'Starter', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading"><?php esc_html_e( '$19', 'pivora' ); ?><span class="pivora-price-card__term"><?php esc_html_e( '/mo', 'pivora' ); ?></span></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-price-card__copy"} -->
					<p class="pivora-price-card__copy"><?php esc_html_e( 'For lean launches and brochure sites.', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:list {"className":"pivora-price-card__features"} -->
					<ul class="pivora-price-card__features">
						<li><?php esc_html_e( 'Core pages', 'pivora' ); ?></li>
						<li><?php esc_html_e( 'Pattern-based layouts', 'pivora' ); ?></li>
						<li><?php esc_html_e( 'Email support', 'pivora' ); ?></li>
					</ul>
					<!-- /wp:list -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button {"className":"is-style-outline","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
						<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Choose Starter', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:group {"className":"pivora-card pivora-price-card pivora-price-card--featured","layout":{"type":"constrained"}} -->
				<div class="wp-block-group pivora-card pivora-price-card pivora-price-card--featured">
					<!-- wp:paragraph {"className":"pivora-price-card__badge"} -->
					<p class="pivora-price-card__badge"><?php esc_html_e( 'Most popular', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-price-card__tier"} -->
					<p class="pivora-price-card__tier"><?php esc_html_e( 'Growth', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading"><?php esc_html_e( '$49', 'pivora' ); ?><span class="pivora-price-card__term"><?php esc_html_e( '/mo', 'pivora' ); ?></span></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-price-card__copy"} -->
					<p class="pivora-price-card__copy"><?php esc_html_e( 'For teams shipping campaigns and content hubs.', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:list {"className":"pivora-price-card__features"} -->
					<ul class="pivora-price-card__features">
						<li><?php esc_html_e( 'Advanced sections', 'pivora' ); ?></li>
						<li><?php esc_html_e( 'Landing pages', 'pivora' ); ?></li>
						<li><?php esc_html_e( 'Priority support', 'pivora' ); ?></li>
					</ul>
					<!-- /wp:list -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button {"url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
						<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Choose Growth', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:group {"className":"pivora-card pivora-price-card","layout":{"type":"constrained"}} -->
				<div class="wp-block-group pivora-card pivora-price-card">
					<!-- wp:paragraph {"className":"pivora-price-card__tier"} -->
					<p class="pivora-price-card__tier"><?php esc_html_e( 'Scale', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading"><?php esc_html_e( '$99', 'pivora' ); ?><span class="pivora-price-card__term"><?php esc_html_e( '/mo', 'pivora' ); ?></span></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-price-card__copy"} -->
					<p class="pivora-price-card__copy"><?php esc_html_e( 'For multi-site rollouts and commerce.', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:list {"className":"pivora-price-card__features"} -->
					<ul class="pivora-price-card__features">
						<li><?php esc_html_e( 'Multi-site rollout', 'pivora' ); ?></li>
						<li><?php esc_html_e( 'Commerce-ready layouts', 'pivora' ); ?></li>
						<li><?php esc_html_e( 'Dedicated support', 'pivora' ); ?></li>
					</ul>
					<!-- /wp:list -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button {"className":"is-style-outline","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
						<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Choose Scale', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
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
