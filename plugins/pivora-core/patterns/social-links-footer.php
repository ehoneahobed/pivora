<?php
/**
 * Title: Social links footer row
 * Slug: pivora-core/social-links-footer
 * Categories: pivora-core, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora_Core
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-social-footer-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-social-footer-section">
	<!-- wp:group {"align":"wide","className":"pivora-social-footer-section__inner","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group alignwide pivora-social-footer-section__inner">
		<!-- wp:paragraph {"className":"pivora-social-footer-section__copy"} -->
		<p class="pivora-social-footer-section__copy"><?php esc_html_e( 'Stay connected for product updates and pattern drops.', 'pivora-core' ); ?></p>
		<!-- /wp:paragraph -->

		<?php
		pivora_core_block(
			'pivora/social-links-bar',
			array(
				'label' => __( 'Follow', 'pivora-core' ),
				'links' => array(
					array(
						'label' => 'X',
						'url'   => 'https://x.com/',
					),
					array(
						'label' => 'LinkedIn',
						'url'   => 'https://linkedin.com/',
					),
					array(
						'label' => 'GitHub',
						'url'   => 'https://github.com/',
					),
				),
			)
		);
		?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
