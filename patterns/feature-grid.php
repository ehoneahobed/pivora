<?php
/**
 * Title: Feature grid
 * Slug: pivora/feature-grid
 * Categories: pivora-business, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

$features = array(
	array(
		'icon'    => '01',
		'title'   => __( 'SEO-ready structure', 'pivora' ),
		'content' => __( 'Semantic templates, clear heading hierarchy, and crawlable patterns built for modern search workflows.', 'pivora' ),
	),
	array(
		'icon'    => '02',
		'title'   => __( 'Editor-native flexibility', 'pivora' ),
		'content' => __( 'Global styles, template parts, and section patterns stay editable in the Site Editor without proprietary panels.', 'pivora' ),
	),
	array(
		'icon'    => '03',
		'title'   => __( 'Performance discipline', 'pivora' ),
		'content' => __( 'Lean CSS, local assets, and stable layouts keep every page fast, accessible, and predictable.', 'pivora' ),
	),
);

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-feature-section","anchor":"patterns","layout":{"type":"constrained"}} -->
<div id="patterns" class="wp-block-group alignfull pivora-section pivora-feature-section">
	<!-- wp:group {"align":"wide","className":"pivora-feature-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-feature-section__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Theme Foundation', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'A clean foundation for every serious WordPress site.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-section__lede"} -->
			<p class="pivora-section__lede"><?php esc_html_e( 'Start with a polished design system, semantic templates, and editor-native patterns. Then add only the plugins your site actually needs.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"pivora-feature-grid"} -->
		<div class="wp-block-columns pivora-feature-grid">
			<?php if ( pivora_is_core_active() ) : ?>
				<?php foreach ( $features as $feature ) : ?>
					<!-- wp:column -->
					<div class="wp-block-column">
						<?php
						pivora_block(
							'pivora/icon-box',
							array(
								'icon'    => $feature['icon'],
								'title'   => $feature['title'],
								'content' => $feature['content'],
							)
						);
						?>
					</div>
					<!-- /wp:column -->
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( $features as $feature ) : ?>
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:group {"className":"pivora-card pivora-feature","layout":{"type":"constrained"}} -->
						<div class="wp-block-group pivora-card pivora-feature">
							<!-- wp:paragraph {"className":"pivora-feature__icon"} -->
							<p class="pivora-feature__icon"><?php echo esc_html( $feature['icon'] ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:heading {"level":3} -->
							<h3 class="wp-block-heading"><?php echo esc_html( $feature['title'] ); ?></h3>
							<!-- /wp:heading -->
							<!-- wp:paragraph {"className":"pivora-feature__copy"} -->
							<p class="pivora-feature__copy"><?php echo esc_html( $feature['content'] ); ?></p>
							<!-- /wp:paragraph -->
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
