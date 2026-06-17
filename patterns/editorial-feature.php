<?php
/**
 * Title: Editorial feature
 * Slug: pivora/editorial-feature
 * Categories: pivora-content, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-editorial-feature","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-editorial-feature">
	<!-- wp:group {"align":"wide","className":"pivora-editorial-feature__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-editorial-feature__inner">
		<!-- wp:columns {"verticalAlignment":"center","className":"pivora-editorial-feature__columns"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-editorial-feature__columns">
			<!-- wp:column {"verticalAlignment":"center","width":"48%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%">
				<!-- wp:group {"className":"pivora-editorial-feature__visual","layout":{"type":"constrained"}} -->
				<div class="wp-block-group pivora-editorial-feature__visual">
					<!-- wp:paragraph {"className":"pivora-editorial-feature__visual-label"} -->
					<p class="pivora-editorial-feature__visual-label"><?php esc_html_e( 'Featured', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"center","width":"52%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Featured Story', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":2,"fontSize":"huge"} -->
				<h2 class="wp-block-heading has-huge-font-size"><?php esc_html_e( 'Lead with a story your audience can act on.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-editorial-feature__lede","fontSize":"medium"} -->
				<p class="pivora-editorial-feature__lede has-medium-font-size"><?php esc_html_e( 'Use this section for featured articles, founder notes, campaign launches, or educational guides that deserve more visual weight.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"url":"<?php echo esc_url( home_url( '/blog/' ) ); ?>"} -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Read feature', 'pivora' ); ?></a></div>
					<!-- /wp:button -->

					<!-- wp:button {"className":"is-style-outline","url":"<?php echo esc_url( home_url( '/blog/' ) ); ?>"} -->
					<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Browse archive', 'pivora' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
