<?php
/**
 * Title: Footer columns
 * Slug: pivora/footer-columns
 * Categories: pivora-sections, pivora-business
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"tagName":"footer","align":"full","className":"site-footer pivora-footer-columns","layout":{"type":"constrained"}} -->
<footer class="wp-block-group alignfull site-footer pivora-footer-columns">
	<!-- wp:group {"align":"wide","className":"pivora-footer-columns__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-footer-columns__inner">
		<!-- wp:columns {"className":"pivora-footer-columns__grid"} -->
		<div class="wp-block-columns pivora-footer-columns__grid">
			<!-- wp:column {"width":"34%"} -->
			<div class="wp-block-column" style="flex-basis:34%">
				<!-- wp:site-title {"level":0,"isLink":false,"className":"pivora-footer-columns__brand"} /-->

				<!-- wp:paragraph {"className":"pivora-footer-columns__blurb"} -->
				<p class="pivora-footer-columns__blurb"><?php esc_html_e( 'Pivora is a block-first WordPress foundation for business sites, editorial brands, and stores that need speed without lock-in.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"22%"} -->
			<div class="wp-block-column" style="flex-basis:22%">
				<!-- wp:heading {"level":4,"className":"pivora-footer-columns__title"} -->
				<h4 class="wp-block-heading pivora-footer-columns__title"><?php esc_html_e( 'Product', 'pivora' ); ?></h4>
				<!-- /wp:heading -->

				<!-- wp:list {"className":"pivora-footer-columns__links"} -->
				<ul class="pivora-footer-columns__links">
					<li><a href="<?php echo esc_url( home_url( '/features/' ) ); ?>"><?php esc_html_e( 'Features', 'pivora' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'Pricing', 'pivora' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/changelog/' ) ); ?>"><?php esc_html_e( 'Changelog', 'pivora' ); ?></a></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"22%"} -->
			<div class="wp-block-column" style="flex-basis:22%">
				<!-- wp:heading {"level":4,"className":"pivora-footer-columns__title"} -->
				<h4 class="wp-block-heading pivora-footer-columns__title"><?php esc_html_e( 'Company', 'pivora' ); ?></h4>
				<!-- /wp:heading -->

				<!-- wp:list {"className":"pivora-footer-columns__links"} -->
				<ul class="pivora-footer-columns__links">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'pivora' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'pivora' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'pivora' ); ?></a></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"22%"} -->
			<div class="wp-block-column" style="flex-basis:22%">
				<!-- wp:heading {"level":4,"className":"pivora-footer-columns__title"} -->
				<h4 class="wp-block-heading pivora-footer-columns__title"><?php esc_html_e( 'Stay in touch', 'pivora' ); ?></h4>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-footer-columns__note"} -->
				<p class="pivora-footer-columns__note"><?php esc_html_e( 'Monthly launch notes. No spam.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"pivora-footer-columns__cta"} -->
				<div class="wp-block-buttons pivora-footer-columns__cta">
					<!-- wp:button {"className":"is-style-pivora-outline"} -->
					<div class="wp-block-button is-style-pivora-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Subscribe', 'pivora' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->

		<!-- wp:separator {"className":"pivora-footer-columns__divider"} -->
		<hr class="wp-block-separator has-alpha-channel-opacity pivora-footer-columns__divider"/>
		<!-- /wp:separator -->

		<!-- wp:group {"className":"pivora-footer-columns__meta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group pivora-footer-columns__meta">
			<!-- wp:paragraph {"className":"pivora-footer-columns__copyright","fontSize":"small"} -->
			<p class="pivora-footer-columns__copyright has-small-font-size">© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"pivora-footer-columns__legal","fontSize":"small"} -->
			<p class="pivora-footer-columns__legal has-small-font-size"><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'pivora' ); ?></a> · <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'pivora' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</footer>
<!-- /wp:group -->
