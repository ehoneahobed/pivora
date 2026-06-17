<?php
/**
 * Sidebar template part and optional classic widget area bridge.
 *
 * Block themes render sidebars as template parts (parts/sidebar.html). The
 * registered widget area below exists so plugin widgets can still be placed
 * via the Legacy Widget block in the Site Editor.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the Sidebar template part area for the Site Editor.
 *
 * WordPress only ships header, footer, and general areas by default. Themes
 * that use a sidebar template part must register the area explicitly.
 *
 * @param array<int, array<string, string>> $areas Registered template part areas.
 * @return array<int, array<string, string>>
 */
function pivora_register_template_part_areas( array $areas ): array {
	$areas[] = array(
		'area'        => 'sidebar',
		'area_tag'    => 'aside',
		'description' => __( 'The Sidebar area is for secondary content such as search, categories, and widgets.', 'pivora' ),
		'icon'        => 'sidebar',
		'label'       => _x( 'Sidebar', 'template part area', 'pivora' ),
	);

	return $areas;
}
add_filter( 'default_wp_template_part_areas', 'pivora_register_template_part_areas' );

/**
 * Registers the classic widget area used by the Legacy Widget block.
 */
function pivora_register_widget_areas(): void {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'pivora' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Optional widget area for plugin widgets. Edit the Sidebar template part in the Site Editor, or add a Legacy Widget block that targets this area.', 'pivora' ),
			'before_widget' => '<div id="%1$s" class="pivora-sidebar__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="pivora-sidebar__title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'pivora_register_widget_areas' );
