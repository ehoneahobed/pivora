<?php
/**
 * Pivora Core plugin compatibility layer for the theme.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether Pivora Core is active.
 */
function pivora_is_core_active(): bool {
	return defined( 'PIVORA_CORE_VERSION' );
}


/**
 * Recommends Pivora Core when the companion plugin is not active.
 */
function pivora_core_missing_notice(): void {
	if ( pivora_is_core_active() || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if ( $screen && ! in_array( $screen->id, array( 'themes', 'appearance_page_pivora-reset-templates', 'dashboard', 'site-editor', 'edit-page', 'edit-post' ), true ) ) {
		return;
	}

	$plugins_url = admin_url( 'plugin-install.php?s=pivora+core&tab=search&type=term' );

	echo '<div class="notice notice-warning"><p><strong>' . esc_html__( 'Pivora Core recommended', 'pivora' ) . '</strong> — ';
	printf(
		/* translators: %s: plugins admin URL */
		esc_html__( 'Custom blocks power FAQ, pricing, testimonials, and post grid patterns. Install Pivora Core for the full editor experience. %s', 'pivora' ),
		'<a href="' . esc_url( $plugins_url ) . '">' . esc_html__( 'Get Pivora Core', 'pivora' ) . '</a>'
	);
	echo '</p></div>';
}
add_action( 'admin_notices', 'pivora_core_missing_notice' );
