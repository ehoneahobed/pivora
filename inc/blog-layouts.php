<?php
/**
 * Blog archive layout switching and single-post template helpers.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the blog template part area used by archive query layouts.
 *
 * @param array<int, array<string, string>> $areas Registered template part areas.
 * @return array<int, array<string, string>>
 */
function pivora_register_blog_template_part_area( array $areas ): array {
	$areas[] = array(
		'area'        => 'blog',
		'area_tag'    => 'section',
		'label'       => __( 'Blog', 'pivora' ),
		'description' => __( 'Blog archive query layouts.', 'pivora' ),
		'icon'        => 'symbolFilledIcon',
	);

	return $areas;
}
add_filter( 'default_wp_template_part_areas', 'pivora_register_blog_template_part_area' );

/**
 * Returns supported blog archive layout slugs and labels.
 *
 * @return array<string, string>
 */
function pivora_get_blog_archive_layouts(): array {
	return array(
		'grid'     => __( 'Card grid', 'pivora' ),
		'list'     => __( 'Split list', 'pivora' ),
		'magazine' => __( 'Magazine lead', 'pivora' ),
		'compact'  => __( 'Compact cards', 'pivora' ),
	);
}

/**
 * Returns the active blog archive layout slug.
 *
 * @return string
 */
function pivora_get_blog_archive_layout(): string {
	$layout  = get_option( 'pivora_blog_archive_layout', 'grid' );
	$layouts = pivora_get_blog_archive_layouts();

	if ( ! isset( $layouts[ $layout ] ) ) {
		return 'grid';
	}

	return $layout;
}

/**
 * Returns supported single-post layout slugs and labels.
 *
 * @return array<string, string>
 */
function pivora_get_single_post_layouts(): array {
	return array(
		'classic'  => __( 'Classic band', 'pivora' ),
		'magazine' => __( 'Magazine hero', 'pivora' ),
		'minimal'  => __( 'Minimal focus', 'pivora' ),
		'feature'  => __( 'Feature split', 'pivora' ),
	);
}

/**
 * Returns the default single-post layout slug for posts without a custom template.
 *
 * @return string
 */
function pivora_get_default_single_post_layout(): string {
	$layout  = get_option( 'pivora_single_post_layout', 'classic' );
	$layouts = pivora_get_single_post_layouts();

	if ( ! isset( $layouts[ $layout ] ) || 'classic' === $layout ) {
		return 'classic';
	}

	return $layout;
}

/**
 * Adds layout-specific body classes on blog and single views.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function pivora_blog_layout_body_classes( array $classes ): array {
	if ( is_home() || is_archive() || is_search() ) {
		$classes[] = 'pivora-blog-layout-' . pivora_get_blog_archive_layout();
	}

	if ( is_singular( 'post' ) ) {
		$template_slug = get_page_template_slug( get_queried_object_id() );

		if ( is_string( $template_slug ) && str_starts_with( $template_slug, 'single-' ) ) {
			$classes[] = 'pivora-single-layout-' . substr( $template_slug, 7 );
		} else {
			$classes[] = 'pivora-single-layout-' . pivora_get_default_single_post_layout();
		}
	}

	return $classes;
}
add_filter( 'body_class', 'pivora_blog_layout_body_classes' );

/**
 * Renders a theme template part file by slug.
 *
 * @param string $slug Template part slug without extension.
 * @return string
 */
function pivora_render_theme_template_part( string $slug ): string {
	$path = get_theme_file_path( 'parts/' . $slug . '.html' );

	if ( ! is_readable( $path ) ) {
		return '';
	}

	$content = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local theme template part.

	if ( false === $content ) {
		return '';
	}

	return do_blocks( $content );
}

/**
 * Swaps the shared blog query template part for the selected layout.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block data.
 * @return string
 */
function pivora_render_blog_query_template_part( string $block_content, array $block ): string {
	if ( 'core/template-part' !== ( $block['blockName'] ?? '' ) ) {
		return $block_content;
	}

	$slug = $block['attrs']['slug'] ?? '';

	if ( 'blog-query' !== $slug ) {
		return $block_content;
	}

	$layout   = pivora_get_blog_archive_layout();
	$part     = pivora_render_theme_template_part( 'blog-query-' . $layout );
	$fallback = pivora_render_theme_template_part( 'blog-query-grid' );
	$markup   = '' !== $part ? $part : $fallback;

	return pivora_prepend_blog_toolbar_to_archive( $markup );
}
add_filter( 'render_block', 'pivora_render_blog_query_template_part', 10, 2 );

/**
 * Applies the default single layout when a post has no custom template selected.
 *
 * @param string[] $templates Candidate single templates.
 * @return string[]
 */
function pivora_filter_single_template_hierarchy( array $templates ): array {
	if ( ! is_single() ) {
		return $templates;
	}

	$post_id = get_queried_object_id();

	if ( $post_id && get_page_template_slug( $post_id ) ) {
		return $templates;
	}

	$layout = pivora_get_default_single_post_layout();

	if ( 'classic' === $layout ) {
		return $templates;
	}

	array_unshift( $templates, 'single-' . $layout );

	return $templates;
}
add_filter( 'single_template_hierarchy', 'pivora_filter_single_template_hierarchy' );

/**
 * Registers the Appearance screen for blog layout settings.
 */
function pivora_register_blog_layout_settings_page(): void {
	add_theme_page(
		__( 'Pivora Blog Layouts', 'pivora' ),
		__( 'Blog Layouts', 'pivora' ),
		'edit_theme_options',
		'pivora-blog-layouts',
		'pivora_render_blog_layout_settings_page'
	);
}
add_action( 'admin_menu', 'pivora_register_blog_layout_settings_page' );

/**
 * Registers blog layout theme settings.
 */
function pivora_register_blog_layout_settings(): void {
	register_setting(
		'pivora_blog_layouts',
		'pivora_blog_archive_layout',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'pivora_sanitize_blog_archive_layout',
			'default'           => 'grid',
		)
	);

	register_setting(
		'pivora_blog_layouts',
		'pivora_single_post_layout',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'pivora_sanitize_single_post_layout',
			'default'           => 'classic',
		)
	);
}
add_action( 'admin_init', 'pivora_register_blog_layout_settings' );

/**
 * Sanitizes the blog archive layout setting.
 *
 * @param mixed $value Raw submitted value.
 * @return string
 */
function pivora_sanitize_blog_archive_layout( $value ): string {
	$value   = is_string( $value ) ? $value : '';
	$layouts = pivora_get_blog_archive_layouts();

	return isset( $layouts[ $value ] ) ? $value : 'grid';
}

/**
 * Sanitizes the default single-post layout setting.
 *
 * @param mixed $value Raw submitted value.
 * @return string
 */
function pivora_sanitize_single_post_layout( $value ): string {
	$value   = is_string( $value ) ? $value : '';
	$layouts = pivora_get_single_post_layouts();

	return isset( $layouts[ $value ] ) ? $value : 'classic';
}

/**
 * Renders the blog layout settings screen under Appearance.
 */
function pivora_render_blog_layout_settings_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$archive_layout = pivora_get_blog_archive_layout();
	$single_layout  = pivora_get_default_single_post_layout();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Pivora Blog Layouts', 'pivora' ); ?></h1>
		<p><?php esc_html_e( 'Switch blog archive and single-post presentation without installing a plugin. Per-post templates in the editor still override the default single layout.', 'pivora' ); ?></p>

		<form method="post" action="options.php">
			<?php settings_fields( 'pivora_blog_layouts' ); ?>

			<h2><?php esc_html_e( 'Archive layout', 'pivora' ); ?></h2>
			<p><?php esc_html_e( 'Applies to the blog index, archives, search results, and the post index fallback.', 'pivora' ); ?></p>
			<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e( 'Archive style', 'pivora' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><?php esc_html_e( 'Archive style', 'pivora' ); ?></legend>
								<?php foreach ( pivora_get_blog_archive_layouts() as $slug => $label ) : ?>
									<label style="display:block;margin-bottom:0.65rem;">
										<input type="radio" name="pivora_blog_archive_layout" value="<?php echo esc_attr( $slug ); ?>" <?php checked( $archive_layout, $slug ); ?> />
										<?php echo esc_html( $label ); ?>
									</label>
								<?php endforeach; ?>
							</fieldset>
						</td>
					</tr>
				</tbody>
			</table>

			<h2><?php esc_html_e( 'Single post default', 'pivora' ); ?></h2>
			<p><?php esc_html_e( 'Used for posts unless you choose a different template in the post editor sidebar.', 'pivora' ); ?></p>
			<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e( 'Single style', 'pivora' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><?php esc_html_e( 'Single style', 'pivora' ); ?></legend>
								<?php foreach ( pivora_get_single_post_layouts() as $slug => $label ) : ?>
									<label style="display:block;margin-bottom:0.65rem;">
										<input type="radio" name="pivora_single_post_layout" value="<?php echo esc_attr( $slug ); ?>" <?php checked( $single_layout, $slug ); ?> />
										<?php echo esc_html( $label ); ?>
									</label>
								<?php endforeach; ?>
							</fieldset>
						</td>
					</tr>
				</tbody>
			</table>

			<?php submit_button( __( 'Save blog layouts', 'pivora' ) ); ?>
		</form>

		<hr />
		<h2><?php esc_html_e( 'Per-post overrides', 'pivora' ); ?></h2>
		<p><?php esc_html_e( 'Edit any post, open the Template panel in the sidebar, and choose one of the Pivora single templates:', 'pivora' ); ?></p>
		<ul style="list-style:disc;padding-left:1.25rem;">
			<li><?php esc_html_e( 'Classic band (default file: single.html)', 'pivora' ); ?></li>
			<li><?php esc_html_e( 'Magazine hero', 'pivora' ); ?></li>
			<li><?php esc_html_e( 'Minimal focus', 'pivora' ); ?></li>
			<li><?php esc_html_e( 'Feature split', 'pivora' ); ?></li>
		</ul>
	</div>
	<?php
}
