<?php
/**
 * Admin notices and theme compatibility.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shows a notice when the Pivora theme is not active.
 */
function pivora_core_theme_compat_notice(): void {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$theme = wp_get_theme();

	if ( 'pivora' === $theme->get_stylesheet() || 'Pivora' === $theme->get( 'Name' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'Pivora Core works best with the Pivora block theme active.', 'pivora-core' )
	);
}
add_action( 'admin_notices', 'pivora_core_theme_compat_notice' );
