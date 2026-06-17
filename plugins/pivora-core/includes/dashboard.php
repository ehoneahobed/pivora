<?php
/**
 * Pivora Core admin dashboard and menus.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the Pivora admin menu.
 */
function pivora_core_register_admin_menu(): void {
	add_menu_page(
		__( 'Pivora Dashboard', 'pivora-core' ),
		__( 'Pivora', 'pivora-core' ),
		'edit_theme_options',
		'pivora-dashboard',
		'pivora_core_render_starter_kits_page',
		'dashicons-layout',
		58
	);

	add_submenu_page(
		'pivora-dashboard',
		__( 'Starter Kits', 'pivora-core' ),
		__( 'Starter Kits', 'pivora-core' ),
		'edit_theme_options',
		'pivora-dashboard',
		'pivora_core_render_starter_kits_page'
	);

	add_submenu_page(
		'pivora-dashboard',
		__( 'Blocks', 'pivora-core' ),
		__( 'Blocks', 'pivora-core' ),
		'edit_theme_options',
		'pivora-core-blocks',
		'pivora_core_render_blocks_help_page'
	);

	add_submenu_page(
		'pivora-dashboard',
		__( 'Help', 'pivora-core' ),
		__( 'Help', 'pivora-core' ),
		'edit_theme_options',
		'pivora-core-help',
		'pivora_core_render_help_page'
	);
}
add_action( 'admin_menu', 'pivora_core_register_admin_menu' );

/**
 * Redirects legacy demo import URLs to the dashboard.
 */
function pivora_core_redirect_legacy_demo_import_page(): void {
	if ( ! is_admin() ) {
		return;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( (string) $_GET['page'] ) ) : '';

	if ( 'pivora-demo-import' !== $page ) {
		return;
	}

	wp_safe_redirect( admin_url( 'admin.php?page=pivora-dashboard' ) );
	exit;
}
add_action( 'admin_init', 'pivora_core_redirect_legacy_demo_import_page', 5 );

/**
 * Enqueues dashboard assets on Pivora admin screens.
 *
 * @param string $hook_suffix Current admin page hook.
 */
function pivora_core_enqueue_dashboard_assets( string $hook_suffix ): void {
	$allowed_hooks = array(
		'toplevel_page_pivora-dashboard',
		'pivora_page_pivora-core-blocks',
		'pivora_page_pivora-core-help',
	);

	if ( ! in_array( $hook_suffix, $allowed_hooks, true ) ) {
		return;
	}

	wp_enqueue_style(
		'pivora-demo-import-admin',
		PIVORA_CORE_URL . 'assets/demo-import-admin.css',
		array(),
		PIVORA_CORE_VERSION
	);

	if ( 'toplevel_page_pivora-dashboard' === $hook_suffix ) {
		wp_enqueue_script(
			'pivora-demo-import-admin',
			PIVORA_CORE_URL . 'assets/demo-import-admin.js',
			array(),
			PIVORA_CORE_VERSION,
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'pivora_core_enqueue_dashboard_assets' );

/**
 * Renders the blocks help screen.
 */
function pivora_core_render_blocks_help_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$blocks = array(
		'icon-box'               => __( 'Icon box — feature cards with icon, title, and copy.', 'pivora-core' ),
		'logo-grid'              => __( 'Logo grid — trust bar with text or image logos.', 'pivora-core' ),
		'stats-grid'             => __( 'Stats grid — impact metrics with labels and copy.', 'pivora-core' ),
		'process-steps'          => __( 'Process steps — numbered workflow or timeline.', 'pivora-core' ),
		'comparison-tabs'        => __( 'Comparison tabs — tabbed feature comparison tables.', 'pivora-core' ),
		'product-grid'           => __( 'Product grid — curated WooCommerce product cards.', 'pivora-core' ),
		'testimonial-card'       => __( 'Testimonial card — quote, avatar, and role.', 'pivora-core' ),
		'pricing-card'           => __( 'Pricing card — plan name, price, features, and CTA.', 'pivora-core' ),
		'pricing-billing-toggle' => __( 'Pricing billing toggle — switch monthly/yearly pricing.', 'pivora-core' ),
		'faq-item'               => __( 'FAQ item — accessible accordion item.', 'pivora-core' ),
		'announcement-bar'       => __( 'Announcement bar — dismissible top banner.', 'pivora-core' ),
		'social-links-bar'       => __( 'Social links bar — themed icon row.', 'pivora-core' ),
		'curated-post-grid'      => __( 'Curated post grid — hand-picked posts with card layout.', 'pivora-core' ),
		'team-member'            => __( 'Team member — avatar, name, role, and bio.', 'pivora-core' ),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Pivora blocks', 'pivora-core' ); ?></h1>
		<p><?php esc_html_e( 'Custom blocks appear under the Pivora category in the block inserter. They work on any block theme that exposes standard color and spacing presets.', 'pivora-core' ); ?></p>
		<p><?php esc_html_e( 'Use the block sidebar for typography, colors, spacing, borders, and alignment. Card blocks and the social links bar include additional style panels.', 'pivora-core' ); ?></p>
		<ul class="ul-disc">
			<?php foreach ( $blocks as $slug => $description ) : ?>
				<li><code>pivora/<?php echo esc_html( $slug ); ?></code> — <?php echo esc_html( $description ); ?></li>
			<?php endforeach; ?>
		</ul>
		<p>
			<a class="button button-secondary" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>">
				<?php esc_html_e( 'Create a page to try blocks', 'pivora-core' ); ?>
			</a>
		</p>
	</div>
	<?php
}

/**
 * Renders the help screen.
 */
function pivora_core_render_help_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$docs_root = defined( 'PIVORA_PATH' ) ? trailingslashit( PIVORA_PATH ) . 'docs/' : '';
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Pivora help', 'pivora-core' ); ?></h1>
		<p><?php esc_html_e( 'Pivora Core adds starter kits, custom blocks, and conversion-focused patterns. The theme handles templates and global styling.', 'pivora-core' ); ?></p>
		<h2><?php esc_html_e( 'Quick links', 'pivora-core' ); ?></h2>
		<ul class="ul-disc">
			<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=pivora-dashboard' ) ); ?>"><?php esc_html_e( 'Starter Kits', 'pivora-core' ); ?></a></li>
			<li><a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>"><?php esc_html_e( 'Site Editor', 'pivora-core' ); ?></a></li>
			<li><a href="https://github.com/ehoneahobed/pivora" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'GitHub repository', 'pivora-core' ); ?></a></li>
		</ul>
		<h2><?php esc_html_e( 'CLI', 'pivora-core' ); ?></h2>
		<p><code>PIVORA_DEMO_KIT=agency npm run setup:demo</code></p>
		<?php if ( $docs_root && file_exists( $docs_root . 'CORE_PLUGIN_ROADMAP.md' ) ) : ?>
			<p class="description"><?php esc_html_e( 'Developer docs: docs/CORE_PLUGIN_ROADMAP.md in the theme repository.', 'pivora-core' ); ?></p>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Starter kits page callback (implemented in demo-import.php).
 */
function pivora_core_render_starter_kits_page(): void {
	pivora_core_render_demo_import_page();
}
