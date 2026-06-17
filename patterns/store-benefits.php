<?php
/**
 * Title: Store benefits
 * Slug: pivora/store-benefits
 * Categories: pivora-ecommerce, pivora-sections
 * Viewport width: 1200
 *
 * @package Pivora
 */

$benefits = array(
	array(
		'icon'    => '01',
		'title'   => __( 'Fast product browsing', 'pivora' ),
		'content' => __( 'Responsive product cards and stable image ratios keep store grids easy to scan.', 'pivora' ),
	),
	array(
		'icon'    => '02',
		'title'   => __( 'Accessible checkout styling', 'pivora' ),
		'content' => __( 'Form fields, buttons, notices, and tables inherit the same readable design language.', 'pivora' ),
	),
	array(
		'icon'    => '03',
		'title'   => __( 'Plugin-safe foundation', 'pivora' ),
		'content' => __( 'Commerce behavior stays in WooCommerce while the theme handles presentation.', 'pivora' ),
	),
);

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-store-benefits-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-store-benefits-section">
	<!-- wp:group {"align":"wide","className":"pivora-store-benefits-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-store-benefits-section__inner">
		<!-- wp:group {"className":"pivora-store-benefits","layout":{"type":"grid","minimumColumnWidth":"220px"}} -->
		<div class="wp-block-group pivora-store-benefits">
			<?php if ( pivora_is_core_active() ) : ?>
				<?php foreach ( $benefits as $benefit ) : ?>
					<?php pivora_block( 'pivora/icon-box', $benefit ); ?>
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( $benefits as $benefit ) : ?>
					<!-- wp:group {"className":"pivora-store-benefit","layout":{"type":"constrained"}} -->
					<div class="wp-block-group pivora-store-benefit">
						<!-- wp:heading {"level":3} -->
						<h3 class="wp-block-heading"><?php echo esc_html( $benefit['title'] ); ?></h3>
						<!-- /wp:heading -->
						<!-- wp:paragraph -->
						<p><?php echo esc_html( $benefit['content'] ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
