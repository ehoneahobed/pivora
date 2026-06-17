<?php
/**
 * Title: Process steps
 * Slug: pivora/process-steps
 * Categories: pivora-sections, pivora-business
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-process-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-process-section">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'How it works', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'A simple launch process.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->

		<?php if ( defined( 'PIVORA_CORE_VERSION' ) ) : ?>
			<?php pivora_block( 'pivora/process-steps', array( 'layout' => 'horizontal' ) ); ?>
		<?php else : ?>
			<!-- wp:list {"ordered":true,"className":"pivora-process-steps-fallback"} -->
			<ol class="pivora-process-steps-fallback">
				<li><?php esc_html_e( 'Discover goals and content requirements.', 'pivora' ); ?></li>
				<li><?php esc_html_e( 'Design layouts with native patterns and blocks.', 'pivora' ); ?></li>
				<li><?php esc_html_e( 'Launch with performance and accessibility in mind.', 'pivora' ); ?></li>
			</ol>
			<!-- /wp:list -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
