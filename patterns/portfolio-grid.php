<?php
/**
 * Title: Portfolio grid
 * Slug: pivora/portfolio-grid
 * Categories: pivora-content, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-portfolio-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-portfolio-section">
	<!-- wp:group {"align":"wide","className":"pivora-portfolio-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-portfolio-section__inner">
		<!-- wp:group {"className":"pivora-section__header-row","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group pivora-section__header-row">
			<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
			<div class="wp-block-group pivora-section__heading">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Selected Work', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Showcase projects with clean, scannable cards.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons pivora-portfolio-section__action">
				<!-- wp:button {"className":"is-style-outline","url":"<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'View all work', 'pivora' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<?php if ( defined( 'PIVORA_CORE_VERSION' ) ) : ?>
			<?php
			pivora_block(
				'pivora/case-study-grid',
				array(
					'postsToShow' => 3,
					'columns'     => 3,
				)
			);
			?>
		<?php else : ?>
		<!-- wp:group {"className":"pivora-portfolio-grid","layout":{"type":"grid","minimumColumnWidth":"260px"}} -->
		<div class="wp-block-group pivora-portfolio-grid">
			<!-- wp:group {"className":"pivora-project-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-project-card">
				<!-- wp:paragraph {"className":"pivora-project-card__tag"} -->
				<p class="pivora-project-card__tag"><?php esc_html_e( 'Brand', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Brand system', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Identity, web presence, and launch system for a growing company.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"pivora-project-card pivora-project-card--accent","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-project-card pivora-project-card--accent">
				<!-- wp:paragraph {"className":"pivora-project-card__tag"} -->
				<p class="pivora-project-card__tag"><?php esc_html_e( 'Commerce', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Commerce refresh', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'A faster product discovery experience for an online store.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"pivora-project-card pivora-project-card--highlight","layout":{"type":"constrained"}} -->
			<div class="wp-block-group pivora-project-card pivora-project-card--highlight">
				<!-- wp:paragraph {"className":"pivora-project-card__tag"} -->
				<p class="pivora-project-card__tag"><?php esc_html_e( 'Editorial', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php esc_html_e( 'Editorial hub', 'pivora' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'A content-first publication layout for guides and analysis.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
