<?php
/**
 * Title: FAQ section
 * Slug: pivora/faq-section
 * Categories: pivora-sections, pivora-saas, pivora-business
 * Viewport width: 1200
 *
 * @package Pivora
 */

$faq_items = array(
	array(
		'question' => __( 'Do I need a page builder?', 'pivora' ),
		'answer'   => __( 'No. Pivora is built for the native block editor. Patterns, templates, and style variations cover most landing pages without extra plugins.', 'pivora' ),
	),
	array(
		'question' => __( 'Can I change blog layouts site-wide?', 'pivora' ),
		'answer'   => __( 'Yes. Use Appearance → Blog Layouts to switch archive and single-post templates without touching code.', 'pivora' ),
	),
	array(
		'question' => __( 'Does Pivora work with WooCommerce?', 'pivora' ),
		'answer'   => __( 'Yes. Store patterns and WooCommerce templates are included. Styles load only when WooCommerce is active.', 'pivora' ),
	),
	array(
		'question' => __( 'Will my pages stay fast?', 'pivora' ),
		'answer'   => __( 'The theme ships lean CSS, local assets, and block-first layouts designed for stable performance scores.', 'pivora' ),
	),
);

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-faq-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-faq-section">
	<!-- wp:group {"align":"wide","className":"pivora-faq-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-faq-section__inner">
		<!-- wp:columns {"className":"pivora-faq-section__layout"} -->
		<div class="wp-block-columns pivora-faq-section__layout">
			<!-- wp:column {"width":"38%"} -->
			<div class="wp-block-column" style="flex-basis:38%">
				<!-- wp:group {"className":"pivora-faq-section__intro","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-faq-section__intro">
					<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
					<p class="pivora-eyebrow"><?php esc_html_e( 'FAQ', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:heading -->
					<h2 class="wp-block-heading"><?php esc_html_e( 'Answers before you commit to a build.', 'pivora' ); ?></h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"pivora-section__lede"} -->
					<p class="pivora-section__lede"><?php esc_html_e( 'Common questions about launching with Pivora, block patterns, and keeping the editor simple for your team.', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"62%"} -->
			<div class="wp-block-column" style="flex-basis:62%">
				<!-- wp:group {"className":"pivora-faq-list","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-faq-list">
					<?php if ( pivora_is_core_active() ) : ?>
						<?php foreach ( $faq_items as $item ) : ?>
							<?php
							pivora_block(
								'pivora/faq-item',
								array(
									'question' => $item['question'],
									'answer'   => $item['answer'],
								)
							);
							?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php foreach ( $faq_items as $item ) : ?>
							<!-- wp:details {"className":"pivora-faq-item"} -->
							<details class="wp-block-details pivora-faq-item">
								<summary><?php echo esc_html( $item['question'] ); ?></summary>
								<!-- wp:paragraph -->
								<p><?php echo esc_html( $item['answer'] ); ?></p>
								<!-- /wp:paragraph -->
							</details>
							<!-- /wp:details -->
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
