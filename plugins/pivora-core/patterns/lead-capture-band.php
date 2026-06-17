<?php
/**
 * Title: Lead capture band
 * Slug: pivora-core/lead-capture-band
 * Categories: pivora-core, pivora-ctas
 * Viewport width: 1200
 *
 * @package Pivora_Core
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-lead-capture-band","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-lead-capture-band">
	<!-- wp:group {"align":"wide","className":"pivora-lead-capture-band__shell","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-lead-capture-band__shell">
		<!-- wp:columns {"verticalAlignment":"center","className":"pivora-lead-capture-band__layout"} -->
		<div class="wp-block-columns are-vertically-aligned-center pivora-lead-capture-band__layout">
			<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
				<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
				<p class="pivora-eyebrow"><?php esc_html_e( 'Get the playbook', 'pivora-core' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading -->
				<h2 class="wp-block-heading"><?php esc_html_e( 'Download the launch checklist we use on client projects.', 'pivora-core' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Replace this band with your forms plugin or link the button to a lead magnet PDF.', 'pivora-core' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%">
				<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
				<div class="wp-block-buttons">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Download checklist', 'pivora-core' ); ?></a></div>
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
