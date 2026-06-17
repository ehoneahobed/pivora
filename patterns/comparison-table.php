<?php
/**
 * Title: Comparison table
 * Slug: pivora/comparison-table
 * Categories: pivora-sections, pivora-business, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-comparison-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-comparison-section">
	<!-- wp:group {"align":"wide","className":"pivora-comparison-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-comparison-section__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Compare plans', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'See what each tier includes.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-section__lede"} -->
			<p class="pivora-section__lede"><?php esc_html_e( 'Use this table on pricing pages or upgrade flows. Edit rows to match your actual product packaging.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<?php if ( defined( 'PIVORA_CORE_VERSION' ) ) : ?>
			<?php pivora_block( 'pivora/comparison-tabs' ); ?>
		<?php else : ?>
		<!-- wp:table {"className":"pivora-comparison-table is-style-stripes"} -->
		<figure class="wp-block-table pivora-comparison-table is-style-stripes"><table><thead><tr><th><?php esc_html_e( 'Feature', 'pivora' ); ?></th><th><?php esc_html_e( 'Starter', 'pivora' ); ?></th><th><?php esc_html_e( 'Growth', 'pivora' ); ?></th><th><?php esc_html_e( 'Scale', 'pivora' ); ?></th></tr></thead><tbody><tr><td><?php esc_html_e( 'Core pages', 'pivora' ); ?></td><td><?php esc_html_e( 'Yes', 'pivora' ); ?></td><td><?php esc_html_e( 'Yes', 'pivora' ); ?></td><td><?php esc_html_e( 'Yes', 'pivora' ); ?></td></tr><tr><td><?php esc_html_e( 'Pattern library', 'pivora' ); ?></td><td><?php esc_html_e( 'Essential', 'pivora' ); ?></td><td><?php esc_html_e( 'Full', 'pivora' ); ?></td><td><?php esc_html_e( 'Full', 'pivora' ); ?></td></tr><tr><td><?php esc_html_e( 'Blog layouts', 'pivora' ); ?></td><td><?php esc_html_e( '1 layout', 'pivora' ); ?></td><td><?php esc_html_e( 'All layouts', 'pivora' ); ?></td><td><?php esc_html_e( 'All layouts', 'pivora' ); ?></td></tr><tr><td><?php esc_html_e( 'WooCommerce templates', 'pivora' ); ?></td><td><?php esc_html_e( '—', 'pivora' ); ?></td><td><?php esc_html_e( 'Yes', 'pivora' ); ?></td><td><?php esc_html_e( 'Yes', 'pivora' ); ?></td></tr><tr><td><?php esc_html_e( 'Priority support', 'pivora' ); ?></td><td><?php esc_html_e( '—', 'pivora' ); ?></td><td><?php esc_html_e( 'Email', 'pivora' ); ?></td><td><?php esc_html_e( 'Email + onboarding', 'pivora' ); ?></td></tr></tbody></table></figure>
		<!-- /wp:table -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
