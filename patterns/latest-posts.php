<?php
/**
 * Title: Latest posts section
 * Slug: pivora/latest-posts
 * Categories: pivora-content, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-posts-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-posts-section">
	<!-- wp:group {"align":"wide","className":"pivora-posts-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-posts-section__inner">
		<!-- wp:group {"className":"pivora-posts-section__header","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group pivora-posts-section__header">
			<!-- wp:group {"className":"pivora-posts-section__intro","layout":{"type":"default"}} -->
			<div class="wp-block-group pivora-posts-section__intro">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Publishing', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Designed for useful content, not only static pages.', 'pivora' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-posts-section__lede"} -->
				<p class="pivora-posts-section__lede"><?php esc_html_e( 'Archive, single, and home templates keep editorial content readable, fast, and easy to maintain.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:buttons {"className":"pivora-posts-section__action"} -->
			<div class="wp-block-buttons pivora-posts-section__action">
				<!-- wp:button {"className":"is-style-outline","url":"<?php echo esc_url( home_url( '/blog/' ) ); ?>"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'View Articles', 'pivora' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"pivora-latest-posts"} -->
		<div class="wp-block-query pivora-latest-posts">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
				<!-- wp:group {"tagName":"article","className":"pivora-card pivora-post-card","layout":{"type":"constrained"}} -->
				<article class="wp-block-group pivora-card pivora-post-card">
					<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/10"} /-->
					<!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->
					<!-- wp:post-excerpt {"moreText":"Read article","excerptLength":22} /-->
					<!-- wp:post-date {"fontSize":"small","className":"pivora-post-card__date"} /-->
				</article>
				<!-- /wp:group -->
			<!-- /wp:post-template -->

			<!-- wp:query-no-results -->
				<!-- wp:paragraph {"className":"pivora-posts-section__empty"} -->
				<p class="pivora-posts-section__empty"><?php esc_html_e( 'Publish your first post to populate this section.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:query-no-results -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
