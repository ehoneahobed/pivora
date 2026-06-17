<?php
/**
 * Reset customized block templates back to theme files.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Deletes database copies of theme templates and template parts.
 *
 * When a theme template is edited in the Site Editor, WordPress saves a customized
 * copy that overrides the file in the theme. This removes those copies so the
 * theme file is used again.
 *
 * @return array{templates: string[], parts: string[]}
 */
function pivora_reset_template_customizations(): array {
	$deleted = array(
		'templates' => array(),
		'parts'     => array(),
	);
	$theme   = get_stylesheet();

	foreach ( array( 'wp_template' => 'templates', 'wp_template_part' => 'parts' ) as $post_type => $key ) {
		$items = get_block_templates(
			array(
				'theme' => $theme,
			),
			$post_type
		);

		foreach ( $items as $item ) {
			if ( empty( $item->wp_id ) || ! $item->has_theme_file ) {
				continue;
			}

			$result = wp_delete_post( (int) $item->wp_id, true );

			if ( $result ) {
				$deleted[ $key ][] = $item->slug;
			}
		}
	}

	if ( function_exists( 'wp_clean_theme_json_cache' ) ) {
		wp_clean_theme_json_cache();
	}

	return $deleted;
}

/**
 * Registers the template reset screen under Appearance.
 */
function pivora_register_template_reset_page(): void {
	add_theme_page(
		__( 'Reset Templates', 'pivora' ),
		__( 'Reset Templates', 'pivora' ),
		'edit_theme_options',
		'pivora-reset-templates',
		'pivora_render_template_reset_page'
	);
}
add_action( 'admin_menu', 'pivora_register_template_reset_page' );

/**
 * Handles the reset form submission.
 */
function pivora_handle_template_reset_form(): void {
	if ( ! isset( $_POST['pivora_reset_templates'] ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	check_admin_referer( 'pivora_reset_templates' );

	$deleted = pivora_reset_template_customizations();

	$query = array(
		'page'              => 'pivora-reset-templates',
		'pivora_reset_done' => 1,
		'templates'         => count( $deleted['templates'] ),
		'parts'             => count( $deleted['parts'] ),
	);

	wp_safe_redirect( add_query_arg( $query, admin_url( 'themes.php' ) ) );
	exit;
}
add_action( 'admin_init', 'pivora_handle_template_reset_form' );

/**
 * Renders the template reset admin screen.
 */
function pivora_render_template_reset_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$theme   = get_stylesheet();
	$custom  = array(
		'templates' => array(),
		'parts'     => array(),
	);

	foreach ( array( 'wp_template' => 'templates', 'wp_template_part' => 'parts' ) as $post_type => $key ) {
		$items = get_block_templates( array( 'theme' => $theme ), $post_type );

		foreach ( $items as $item ) {
			if ( ! empty( $item->wp_id ) && $item->has_theme_file ) {
				$custom[ $key ][] = $item->title ?: $item->slug;
			}
		}
	}

	$done = isset( $_GET['pivora_reset_done'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Reset template customizations', 'pivora' ); ?></h1>

		<?php if ( $done ) : ?>
			<div class="notice notice-success is-dismissible">
				<p>
					<?php
					printf(
						/* translators: 1: number of templates reset, 2: number of template parts reset */
						esc_html__( 'Reset complete. %1$d templates and %2$d template parts now use the theme files again.', 'pivora' ),
						isset( $_GET['templates'] ) ? (int) $_GET['templates'] : 0, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
						isset( $_GET['parts'] ) ? (int) $_GET['parts'] : 0 // phpcs:ignore WordPress.Security.NonceVerification.Recommended
					);
					?>
				</p>
			</div>
		<?php endif; ?>

		<p><?php esc_html_e( 'Editing a template in the Site Editor saves a customized copy in the database. That copy overrides the theme file until it is reset. WordPress often hides the reset control, so this screen restores all customized Pivora templates and template parts to the versions shipped with the theme.', 'pivora' ); ?></p>

		<?php if ( empty( $custom['templates'] ) && empty( $custom['parts'] ) ) : ?>
			<p><strong><?php esc_html_e( 'No customized templates were found. The theme files are already in use.', 'pivora' ); ?></strong></p>
		<?php else : ?>
			<h2><?php esc_html_e( 'Customized items', 'pivora' ); ?></h2>
			<ul class="ul-disc">
				<?php foreach ( $custom['templates'] as $title ) : ?>
					<li><?php echo esc_html( (string) $title ); ?></li>
				<?php endforeach; ?>
				<?php foreach ( $custom['parts'] as $title ) : ?>
					<li><?php echo esc_html( (string) $title ); ?></li>
				<?php endforeach; ?>
			</ul>

			<form method="post">
				<?php wp_nonce_field( 'pivora_reset_templates' ); ?>
				<p>
					<button type="submit" class="button button-primary" name="pivora_reset_templates" value="1">
						<?php esc_html_e( 'Reset all customized templates', 'pivora' ); ?>
					</button>
				</p>
			</form>
		<?php endif; ?>

		<h2><?php esc_html_e( 'Site Editor shortcut', 'pivora' ); ?></h2>
		<p><?php esc_html_e( 'To reset a single template manually: open the template (not this grid), then use the ⋮ menu in the top toolbar and choose “Clear customizations” or “Reset template”. That option only appears after you open the template editor.', 'pivora' ); ?></p>
	</div>
	<?php
}
