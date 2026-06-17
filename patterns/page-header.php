<?php
/**
 * Title: Page header
 * Slug: pivora/page-header
 * Categories: pivora-sections, pivora-content, pivora-editorial
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-page-header-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-page-header-section">
	<!-- wp:group {"align":"wide","className":"pivora-page-header","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-page-header">
		<?php if ( defined( 'PIVORA_CORE_VERSION' ) ) : ?>
			<?php pivora_block( 'pivora/seo-breadcrumb' ); ?>
		<?php else : ?>
		<!-- wp:paragraph {"className":"pivora-page-header__breadcrumb"} -->
		<p class="pivora-page-header__breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'pivora' ); ?></a> <span aria-hidden="true">/</span> <?php esc_html_e( 'About', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->
		<?php endif; ?>

		<!-- wp:heading {"level":1} -->
		<h1 class="wp-block-heading"><?php esc_html_e( 'About the studio', 'pivora' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"pivora-page-header__lede"} -->
		<p class="pivora-page-header__lede"><?php esc_html_e( 'A short introduction for interior pages. Replace the title, breadcrumb trail, and summary with content that matches the page you are editing.', 'pivora' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
