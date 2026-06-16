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
<!-- wp:group {"align":"wide","className":"pivora-section pivora-editorial-feature","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide pivora-section pivora-editorial-feature">
	<!-- wp:columns {"verticalAlignment":"center"} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Featured Story', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"fontSize":"huge"} -->
			<h2 class="wp-block-heading has-huge-font-size"><?php esc_html_e( 'Lead with a story your audience can act on.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%">
			<!-- wp:paragraph {"fontSize":"medium"} -->
			<p class="has-medium-font-size"><?php esc_html_e( 'Use this section for featured articles, founder notes, campaign launches, or educational guides that deserve more visual weight.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Read Feature', 'pivora' ); ?></a></div><!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
