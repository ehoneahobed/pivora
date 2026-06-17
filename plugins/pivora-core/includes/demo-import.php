<?php
/**
 * Demo kit import for Pivora Core.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns available demo kits (theme + plugin extras).
 *
 * @return array<string, array<string, mixed>>
 */
function pivora_get_demo_kits(): array {
	$kits = array(
		'business'       => array(
			'label'       => __( 'Business landing', 'pivora-core' ),
			'description' => __( 'Hero, metrics, features, testimonials, FAQ, pricing, and CTA.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-business-landing',
			'header'      => 'header',
			'footer'      => 'footer',
			'seed_posts'  => true,
			'woocommerce' => false,
		),
		'saas'           => array(
			'label'       => __( 'SaaS landing', 'pivora-core' ),
			'description' => __( 'Logo cloud, split metrics, comparison table, FAQ, and newsletter.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-saas-landing',
			'header'      => 'header-centered',
			'footer'      => 'footer-columns',
			'seed_posts'  => true,
			'woocommerce' => false,
		),
		'blog'           => array(
			'label'       => __( 'Editorial blog', 'pivora-core' ),
			'description' => __( 'Editorial feature, latest posts, newsletter, and CTA.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-blog-landing',
			'header'      => 'header-minimal',
			'footer'      => 'footer',
			'seed_posts'  => true,
			'woocommerce' => false,
		),
		'portfolio'      => array(
			'label'       => __( 'Portfolio studio', 'pivora-core' ),
			'description' => __( 'Portfolio grid, team, testimonials, and CTA.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-portfolio-landing',
			'header'      => 'header-minimal',
			'footer'      => 'footer-columns',
			'seed_posts'  => false,
			'seed_cpts'   => true,
			'woocommerce' => false,
		),
		'store'          => array(
			'label'       => __( 'Storefront', 'pivora-core' ),
			'description' => __( 'Store hero, product spotlight, categories, benefits, and CTA.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-store-landing',
			'header'      => 'header',
			'footer'      => 'footer-columns',
			'seed_posts'  => true,
			'woocommerce' => true,
		),
		'agency'         => array(
			'label'       => __( 'Agency landing', 'pivora-core' ),
			'description' => __( 'Plugin starter with services, integrations, lead capture, and team.', 'pivora-core' ),
			'pattern'     => 'pivora-core/starter-agency-landing',
			'header'      => 'header-centered',
			'footer'      => 'footer-columns',
			'seed_posts'  => true,
			'seed_cpts'   => true,
			'woocommerce' => false,
		),
		'local-business' => array(
			'label'       => __( 'Local business', 'pivora-core' ),
			'description' => __( 'Services, testimonials, FAQ, contact, and a clear call to action.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-local-business-landing',
			'header'      => 'header',
			'footer'      => 'footer',
			'seed_posts'  => true,
			'woocommerce' => false,
		),
		'nonprofit'      => array(
			'label'       => __( 'Nonprofit', 'pivora-core' ),
			'description' => __( 'Mission hero, impact metrics, programs, stories, and donation CTA.', 'pivora-core' ),
			'pattern'     => 'pivora/starter-nonprofit-landing',
			'header'      => 'header-centered',
			'footer'      => 'footer-columns',
			'seed_posts'  => true,
			'woocommerce' => false,
		),
	);

	$kits = array_merge( $kits, pivora_core_get_custom_kits() );

	/**
	 * Filters demo kits registered by Pivora Core.
	 *
	 * @param array<string, array<string, mixed>> $kits Demo kits keyed by slug.
	 */
	return apply_filters( 'pivora_demo_kits', $kits );
}


/**
 * Returns expanded block markup for a demo kit starter pattern.
 *
 * @param string $kit_slug Kit identifier.
 * @return string
 */
function pivora_get_demo_kit_markup( string $kit_slug ): string {
	$kits = pivora_get_demo_kits();

	if ( ! isset( $kits[ $kit_slug ] ) ) {
		return '';
	}

	$kit = $kits[ $kit_slug ];

	if ( ! empty( $kit['homepage_markup'] ) ) {
		return (string) $kit['homepage_markup'];
	}

	return pivora_expand_pattern_content(
		pivora_load_pattern_markup( (string) $kit['pattern'] )
	);
}


/**
 * Returns a signed front-end URL that renders a kit without importing it.
 *
 * @param string $kit_slug Kit identifier.
 * @return string
 */
function pivora_get_demo_kit_preview_url( string $kit_slug ): string {
	$kits = pivora_get_demo_kits();

	if ( ! isset( $kits[ $kit_slug ] ) ) {
		return '';
	}

	return add_query_arg(
		array(
			'pivora_demo_preview' => $kit_slug,
			'pivora_demo_nonce'   => wp_create_nonce( 'pivora_demo_preview_' . $kit_slug ),
		),
		home_url( '/' )
	);
}


/**
 * Loads block markup for a registered or file-based pattern slug.
 *
 * @param string $pattern_slug Pattern slug (pivora/* or pivora-core/*).
 * @return string
 */
function pivora_load_pattern_markup( string $pattern_slug ): string {
	$registry = WP_Block_Patterns_Registry::get_instance();

	if ( $registry->is_registered( $pattern_slug ) ) {
		$pattern = $registry->get_registered( $pattern_slug );

		if ( ! empty( $pattern['content'] ) ) {
			return (string) $pattern['content'];
		}
	}

	$paths = array();

	if ( str_starts_with( $pattern_slug, 'pivora-core/' ) ) {
		$paths[] = PIVORA_CORE_PATH . 'patterns/' . substr( $pattern_slug, 12 ) . '.php';
	}

	if ( str_starts_with( $pattern_slug, 'pivora/' ) && defined( 'PIVORA_PATH' ) ) {
		$paths[] = PIVORA_PATH . 'patterns/' . substr( $pattern_slug, 7 ) . '.php';
	}

	foreach ( $paths as $file ) {
		if ( ! file_exists( $file ) ) {
			continue;
		}

		ob_start();
		require $file;

		return trim( (string) ob_get_clean() );
	}

	return '';
}


/**
 * Expands nested pattern references into concrete block markup.
 *
 * @param string $content Block markup that may contain `wp:pattern` comments.
 * @return string
 */
function pivora_expand_pattern_content( string $content ): string {
	if ( '' === $content || ! str_contains( $content, 'wp:pattern' ) ) {
		return $content;
	}

	$expanded = $content;
	$guard    = 0;

	while ( $guard < 25 && str_contains( $expanded, 'wp:pattern' ) ) {
		if ( ! preg_match( '/<!-- wp:pattern \{"slug":"([^"]+)"[^}]*\} \/-->/', $expanded, $matches ) ) {
			break;
		}

		$pattern_markup = pivora_load_pattern_markup( $matches[1] );

		if ( '' === $pattern_markup ) {
			$expanded = str_replace( $matches[0], '', $expanded );
		} else {
			$expanded = str_replace( $matches[0], $pattern_markup, $expanded );
		}

		++$guard;
	}

	return $expanded;
}


/**
 * Ensures a published page exists and returns its ID.
 *
 * @param string $slug Page slug.
 * @param string $title Page title.
 * @return int
 */
function pivora_ensure_page( string $slug, string $title ): int {
	$existing = get_page_by_path( $slug, OBJECT, 'page' );

	if ( $existing instanceof WP_Post ) {
		return (int) $existing->ID;
	}

	$page_id = wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_status' => 'publish',
		),
		true
	);

	if ( is_wp_error( $page_id ) ) {
		return 0;
	}

	return (int) $page_id;
}


/**
 * Ensures a starter blog post exists.
 *
 * @param string $title Post title.
 * @param string $content Post content.
 */
function pivora_ensure_demo_post( string $title, string $content ): void {
	$existing = new WP_Query(
		array(
			'post_type'              => 'post',
			'title'                  => $title,
			'posts_per_page'         => 1,
			'post_status'            => 'any',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	if ( $existing->have_posts() ) {
		wp_reset_postdata();
		return;
	}

	wp_reset_postdata();

	wp_insert_post(
		array(
			'post_type'    => 'post',
			'post_title'   => $title,
			'post_content' => $content,
			'post_status'  => 'publish',
		)
	);
}


/**
 * Seeds demo blog posts used by archive previews.
 */
function pivora_seed_demo_posts(): void {
	pivora_ensure_demo_post(
		'Hello world',
		'Welcome to Pivora. This starter post helps you preview blog cards, archives, and single-post templates.'
	);
	pivora_ensure_demo_post(
		'Building with block patterns',
		'Patterns keep layouts consistent across landing pages, blog sections, and campaign pages without page-builder lock-in.'
	);
	pivora_ensure_demo_post(
		'Launching a WooCommerce storefront',
		'Pair Pivora with WooCommerce to test product archives, single product layouts, and store patterns.'
	);
}


/**
 * Activates WooCommerce store pages when the plugin is already active.
 *
 * @return true|WP_Error
 */
function pivora_core_prepare_woocommerce_demo() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return new WP_Error(
			'pivora_core_woocommerce_missing',
			__( 'Install and activate WooCommerce before importing the store demo kit.', 'pivora-core' )
		);
	}

	if ( class_exists( 'WC_Install' ) && is_callable( array( 'WC_Install', 'create_pages' ) ) ) {
		WC_Install::create_pages();
	}

	return true;
}


/**
 * Imports a demo kit into the current site.
 *
 * @param string               $kit_slug Kit identifier.
 * @param array<string, mixed> $args Import options.
 * @return true|WP_Error
 */
function pivora_import_demo_kit( string $kit_slug, array $args = array() ) {
	$kits = pivora_get_demo_kits();

	if ( ! isset( $kits[ $kit_slug ] ) ) {
		return new WP_Error( 'pivora_invalid_kit', __( 'Unknown demo kit.', 'pivora-core' ) );
	}

	$kit    = $kits[ $kit_slug ];
	$scopes = wp_parse_args(
		isset( $args['scopes'] ) && is_array( $args['scopes'] ) ? $args['scopes'] : array(),
		pivora_core_default_import_scopes()
	);

	$has_scope = false;

	foreach ( $scopes as $enabled ) {
		if ( $enabled ) {
			$has_scope = true;
			break;
		}
	}

	if ( ! $has_scope ) {
		return new WP_Error(
			'pivora_core_no_scopes',
			__( 'Select at least one import section before importing.', 'pivora-core' )
		);
	}

	$save_snapshot = ! isset( $args['save_snapshot'] ) || (bool) $args['save_snapshot'];
	$steps_done    = array();

	if ( $save_snapshot ) {
		pivora_core_save_import_snapshot();
		$steps_done[] = 'snapshot';
	}

	if ( ! empty( $scopes['homepage'] ) ) {
		$result = pivora_core_import_kit_homepage_scope( $kit_slug, $kit );

		if ( is_wp_error( $result ) ) {
			return $result;
		}

		$steps_done[] = 'homepage';

		pivora_core_seed_cpt_demo_content( $kit_slug );
		$steps_done[] = 'cpt_seed';
	}

	if ( ! empty( $scopes['pages'] ) ) {
		$pages = isset( $kit['pages'] ) && is_array( $kit['pages'] ) ? $kit['pages'] : null;
		pivora_core_import_kit_pages_scope( $pages );
		$steps_done[] = 'pages';
	}

	if ( ! empty( $scopes['blog_seed'] ) && ! empty( $kit['seed_posts'] ) ) {
		pivora_seed_demo_posts();
		$steps_done[] = 'blog_seed';
	}

	if ( ! empty( $scopes['woocommerce'] ) && ! empty( $kit['woocommerce'] ) ) {
		$woo_result = pivora_core_prepare_woocommerce_demo();

		if ( is_wp_error( $woo_result ) ) {
			return $woo_result;
		}

		$steps_done[] = 'woocommerce';
	}

	flush_rewrite_rules( false );

	set_transient( 'pivora_core_last_import_steps', $steps_done, MINUTE_IN_SECONDS );

	return true;
}


/**
 * Renders the fixed preview banner shown on live demo kit previews.
 *
 * @param array<string, mixed> $kit Demo kit configuration.
 * @param string               $kit_slug Kit identifier.
 */
function pivora_core_render_demo_preview_banner( array $kit, string $kit_slug ): void {
	$import_url = admin_url( 'admin.php?page=pivora-dashboard' );
	?>
	<div class="pivora-demo-kit-preview-banner" role="status">
		<p>
			<strong><?php esc_html_e( 'Preview only', 'pivora-core' ); ?></strong>
			<?php
			printf(
				/* translators: %s: demo kit label */
				esc_html__( 'You are viewing the %s starter. Nothing has been imported yet.', 'pivora-core' ),
				esc_html( (string) $kit['label'] )
			);
			?>
		</p>
		<div class="pivora-demo-kit-preview-banner__actions">
			<a class="pivora-demo-kit-preview-banner__link" href="<?php echo esc_url( $import_url ); ?>">
				<?php esc_html_e( 'Back to import', 'pivora-core' ); ?>
			</a>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin.php' ) ); ?>">
				<?php wp_nonce_field( 'pivora_import_demo_kit' ); ?>
				<input type="hidden" name="page" value="pivora-dashboard" />
				<input type="hidden" name="demo_kit" value="<?php echo esc_attr( $kit_slug ); ?>" />
				<button type="submit" class="pivora-demo-kit-preview-banner__button" name="pivora_import_demo_kit" value="1">
					<?php esc_html_e( 'Import this kit', 'pivora-core' ); ?>
				</button>
			</form>
		</div>
	</div>
	<?php
}


/**
 * Outputs inline styles for the preview banner.
 */
function pivora_core_render_demo_preview_banner_styles(): void {
	?>
	<style id="pivora-demo-kit-preview-banner-styles">
		.pivora-demo-kit-preview-banner {
			align-items: center;
			background: #0f172a;
			border-bottom: 1px solid rgba(255, 255, 255, 0.12);
			color: #fff;
			display: flex;
			flex-wrap: wrap;
			gap: 0.75rem 1.25rem;
			justify-content: space-between;
			left: 0;
			padding: 0.75rem clamp(1rem, 3vw, 1.5rem);
			position: sticky;
			right: 0;
			top: 0;
			z-index: 100000;
		}

		.pivora-demo-kit-preview-banner p {
			margin: 0;
		}

		.pivora-demo-kit-preview-banner__actions {
			align-items: center;
			display: flex;
			flex-wrap: wrap;
			gap: 0.65rem;
		}

		.pivora-demo-kit-preview-banner__link,
		.pivora-demo-kit-preview-banner__button {
			border-radius: 4px;
			font-size: 0.85rem;
			font-weight: 600;
			line-height: 1.2;
			padding: 0.45rem 0.8rem;
			text-decoration: none;
		}

		.pivora-demo-kit-preview-banner__link {
			border: 1px solid rgba(255, 255, 255, 0.24);
			color: #fff;
		}

		.pivora-demo-kit-preview-banner__button {
			background: #f8c95d;
			border: 0;
			color: #0f172a;
			cursor: pointer;
		}

		body.admin-bar .pivora-demo-kit-preview-banner {
			top: 32px;
		}

		@media (max-width: 782px) {
			body.admin-bar .pivora-demo-kit-preview-banner {
				top: 46px;
			}
		}
	</style>
	<?php
}


/**
 * Renders a full front-end preview document for a demo kit.
 *
 * @param string               $markup Expanded starter pattern markup.
 * @param array<string, mixed> $kit Demo kit configuration.
 * @param string               $kit_slug Kit identifier.
 */
function pivora_core_render_demo_kit_preview_document( string $markup, array $kit, string $kit_slug ): void {
	?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php pivora_core_render_demo_preview_banner( $kit, $kit_slug ); ?>
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block template output from do_blocks().
	echo do_blocks( '<!-- wp:template-part {"slug":"header","tagName":"header"} /-->' );
	echo '<main id="content" class="wp-block-group site-main site-main--front">';
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Demo kit pattern markup from registered patterns.
	echo do_blocks( $markup );
	echo '</main>';
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block template output from do_blocks().
	echo do_blocks( '<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->' );
	wp_footer();
	?>
	</body>
	</html>
	<?php
}


/**
 * Serves a live demo kit preview without importing content.
 */
function pivora_core_handle_demo_kit_preview(): void {
	if ( ! isset( $_GET['pivora_demo_preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to preview demo kits.', 'pivora-core' ) );
	}

	$kit_slug = sanitize_key( wp_unslash( (string) $_GET['pivora_demo_preview'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$nonce    = isset( $_GET['pivora_demo_nonce'] ) ? sanitize_text_field( wp_unslash( (string) $_GET['pivora_demo_nonce'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! wp_verify_nonce( $nonce, 'pivora_demo_preview_' . $kit_slug ) ) {
		wp_die( esc_html__( 'Demo preview link expired. Return to the import screen and try again.', 'pivora-core' ) );
	}

	$kits = pivora_get_demo_kits();

	if ( ! isset( $kits[ $kit_slug ] ) ) {
		wp_die( esc_html__( 'Unknown demo kit.', 'pivora-core' ) );
	}

	$kit    = $kits[ $kit_slug ];
	$markup = pivora_get_demo_kit_markup( $kit_slug );

	if ( '' === $markup ) {
		wp_die( esc_html__( 'Starter pattern markup could not be loaded.', 'pivora-core' ) );
	}

	add_filter(
		'pre_option_pivora_header_variant',
		static function () use ( $kit ): string {
			return (string) $kit['header'];
		}
	);

	add_filter(
		'pre_option_pivora_footer_variant',
		static function () use ( $kit ): string {
			return (string) $kit['footer'];
		}
	);

	add_filter(
		'body_class',
		static function ( array $classes ) use ( $kit, $kit_slug ): array {
			$classes[] = 'pivora-demo-kit-preview';
			$classes[] = 'pivora-demo-kit-' . $kit_slug;

			if ( in_array( $kit_slug, array( 'business', 'saas', 'agency', 'store' ), true ) ) {
				$classes[] = 'pivora-front-page';
			}

			if ( 'header-centered' === (string) $kit['header'] ) {
				$classes[] = 'pivora-hero--centered';
			}

			return $classes;
		}
	);

	add_action( 'wp_footer', 'pivora_core_render_demo_preview_banner_styles', 1 );

	status_header( 200 );
	nocache_headers();

	pivora_core_render_demo_kit_preview_document( $markup, $kit, $kit_slug );
	exit;
}
add_action( 'template_redirect', 'pivora_core_handle_demo_kit_preview', 0 );


/**
 * Handles demo import and rollback form submissions.
 */
function pivora_core_handle_demo_import_form(): void {
	if ( isset( $_POST['pivora_import_rollback'] ) ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		check_admin_referer( 'pivora_import_rollback' );

		$result = pivora_core_restore_import_snapshot();
		$query  = array( 'page' => 'pivora-dashboard' );

		if ( is_wp_error( $result ) ) {
			$query['pivora_rollback_error'] = rawurlencode( $result->get_error_message() );
		} else {
			$query['pivora_rollback_done'] = '1';
		}

		wp_safe_redirect( add_query_arg( $query, admin_url( 'admin.php' ) ) );
		exit;
	}

	if ( ! isset( $_POST['pivora_import_demo_kit'] ) && ! isset( $_POST['pivora_import_kit_file'] ) && ! isset( $_POST['pivora_save_kit_file'] ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	if ( isset( $_POST['pivora_import_kit_file'] ) || isset( $_POST['pivora_save_kit_file'] ) ) {
		check_admin_referer( 'pivora_import_kit_file' );

		if ( empty( $_FILES['pivora_kit_file'] ) || ! is_array( $_FILES['pivora_kit_file'] ) ) {
			wp_safe_redirect(
				add_query_arg(
					array(
						'page'              => 'pivora-dashboard',
						'pivora_demo_error' => rawurlencode( __( 'No kit file was uploaded.', 'pivora-core' ) ),
					),
					admin_url( 'admin.php' )
				)
			);
			exit;
		}

		$manifest = pivora_core_parse_kit_upload( wp_unslash( $_FILES['pivora_kit_file'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		if ( is_wp_error( $manifest ) ) {
			wp_safe_redirect(
				add_query_arg(
					array(
						'page'              => 'pivora-dashboard',
						'pivora_demo_error' => rawurlencode( $manifest->get_error_message() ),
					),
					admin_url( 'admin.php' )
				)
			);
			exit;
		}

		$kit_slug = sanitize_key( (string) $manifest['slug'] );
		$kit      = pivora_core_manifest_to_kit_config( $manifest );

		if ( isset( $_POST['pivora_save_kit_file'] ) ) {
			pivora_core_save_custom_kit( $kit_slug, $kit );

			wp_safe_redirect(
				add_query_arg(
					array(
						'page'             => 'pivora-dashboard',
						'pivora_kit_saved' => $kit_slug,
					),
					admin_url( 'admin.php' )
				)
			);
			exit;
		}

		$scopes = pivora_core_sanitize_import_scopes( wp_unslash( $_POST ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$result = pivora_core_import_kit_manifest(
			$manifest,
			array(
				'scopes'        => $scopes,
				'save_snapshot' => true,
			)
		);

		if ( is_wp_error( $result ) ) {
			$query = array(
				'page'              => 'pivora-dashboard',
				'pivora_demo_error' => rawurlencode( $result->get_error_message() ),
			);
		} else {
			pivora_core_save_custom_kit( $kit_slug, $kit );
			$query = array(
				'page'             => 'pivora-dashboard',
				'pivora_demo_done' => $kit_slug,
			);
		}

		wp_safe_redirect( add_query_arg( $query, admin_url( 'admin.php' ) ) );
		exit;
	}

	if ( ! isset( $_POST['pivora_import_demo_kit'] ) ) {
		return;
	}

	check_admin_referer( 'pivora_import_demo_kit' );

	$kit_slug = isset( $_POST['demo_kit'] ) ? sanitize_key( wp_unslash( (string) $_POST['demo_kit'] ) ) : '';
	$scopes   = pivora_core_sanitize_import_scopes( wp_unslash( $_POST ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$result   = pivora_import_demo_kit(
		$kit_slug,
		array(
			'scopes'        => $scopes,
			'save_snapshot' => true,
		)
	);

	if ( is_wp_error( $result ) ) {
		$query = array(
			'page'              => 'pivora-dashboard',
			'pivora_demo_error' => rawurlencode( $result->get_error_message() ),
		);
	} else {
		$query = array(
			'page'             => 'pivora-dashboard',
			'pivora_demo_done' => $kit_slug,
		);
	}

	wp_safe_redirect( add_query_arg( $query, admin_url( 'admin.php' ) ) );
	exit;
}
add_action( 'admin_init', 'pivora_core_handle_demo_import_form' );


/**
 * Returns labels for import progress steps.
 *
 * @return array<string, string>
 */
function pivora_core_import_step_labels(): array {
	return array(
		'snapshot'    => __( 'Saved site snapshot', 'pivora-core' ),
		'homepage'    => __( 'Updated homepage and site settings', 'pivora-core' ),
		'pages'       => __( 'Updated starter pages', 'pivora-core' ),
		'blog_seed'   => __( 'Seeded sample blog posts', 'pivora-core' ),
		'woocommerce' => __( 'Prepared WooCommerce store pages', 'pivora-core' ),
	);
}


/**
 * Renders the demo import admin screen.
 */
function pivora_core_render_demo_import_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$kits          = pivora_get_demo_kits();
	$active_kit    = get_option( 'pivora_active_demo_kit', '' );
	$done_kit      = isset( $_GET['pivora_demo_done'] ) ? sanitize_key( wp_unslash( (string) $_GET['pivora_demo_done'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$rollback_done = isset( $_GET['pivora_rollback_done'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$error         = '';
	if ( isset( $_GET['pivora_demo_error'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$raw_error = wp_unslash( $_GET['pivora_demo_error'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$error     = sanitize_text_field( rawurldecode( (string) $raw_error ) );
	}
	$rollback_error = '';
	if ( isset( $_GET['pivora_rollback_error'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$raw_rollback_error = wp_unslash( $_GET['pivora_rollback_error'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$rollback_error     = sanitize_text_field( rawurldecode( (string) $raw_rollback_error ) );
	}
	$import_steps          = get_transient( 'pivora_core_last_import_steps' );
	$step_labels           = pivora_core_import_step_labels();
	$scope_labels          = pivora_core_import_scope_labels();
	$has_snapshot          = pivora_core_has_import_snapshot();
	$front_page            = (int) get_option( 'page_on_front' );
	$front_url             = $front_page ? get_permalink( $front_page ) : home_url( '/' );
	$site_editor           = admin_url( 'site-editor.php' );
	$default_kit           = ( $active_kit && isset( $kits[ $active_kit ] ) ) ? $active_kit : 'business';
	$woo_plugins_url       = admin_url( 'plugin-install.php?s=woocommerce&tab=search&type=term' );
	$kit_saved             = isset( $_GET['pivora_kit_saved'] ) ? sanitize_key( wp_unslash( (string) $_GET['pivora_kit_saved'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$default_preview_label = sprintf(
		/* translators: %s: demo kit label */
		__( '%s preview', 'pivora-core' ),
		(string) $kits[ $default_kit ]['label']
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Starter Site Studio', 'pivora-core' ); ?></h1>

		<?php if ( $done_kit && isset( $kits[ $done_kit ] ) ) : ?>
			<div class="notice notice-success is-dismissible">
				<p>
					<?php
					printf(
						/* translators: %s: demo kit label */
						esc_html__( 'Imported the %s kit. Review the steps below, then open your site to confirm everything looks right.', 'pivora-core' ),
						esc_html( (string) $kits[ $done_kit ]['label'] )
					);
					?>
				</p>
			</div>
			<?php if ( is_array( $import_steps ) && ! empty( $import_steps ) ) : ?>
				<ol class="pivora-demo-import__progress">
					<?php foreach ( $import_steps as $step ) : ?>
						<?php if ( isset( $step_labels[ $step ] ) ) : ?>
							<li class="pivora-demo-import__progress-step is-done"><?php echo esc_html( $step_labels[ $step ] ); ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
					<li class="pivora-demo-import__progress-step is-done"><?php esc_html_e( 'Import complete', 'pivora-core' ); ?></li>
				</ol>
				<?php delete_transient( 'pivora_core_last_import_steps' ); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( $kit_saved && isset( $kits[ $kit_saved ] ) ) : ?>
			<div class="notice notice-success is-dismissible">
				<p>
					<?php
					printf(
						/* translators: %s: demo kit label */
						esc_html__( 'Saved the %s kit for future imports.', 'pivora-core' ),
						esc_html( (string) $kits[ $kit_saved ]['label'] )
					);
					?>
				</p>
			</div>
		<?php endif; ?>

		<?php if ( $rollback_done ) : ?>
			<div class="notice notice-success is-dismissible">
				<p><?php esc_html_e( 'Restored your site from the last import snapshot.', 'pivora-core' ); ?></p>
			</div>
		<?php endif; ?>

		<?php if ( $error ) : ?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo esc_html( $error ); ?></p>
			</div>
		<?php endif; ?>

		<?php if ( $rollback_error ) : ?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo esc_html( $rollback_error ); ?></p>
			</div>
		<?php endif; ?>

		<?php if ( $has_snapshot ) : ?>
			<div class="pivora-demo-import__rollback">
				<h2 class="pivora-demo-import__rollback-title"><?php esc_html_e( 'Rollback', 'pivora-core' ); ?></h2>
				<p><?php esc_html_e( 'Restore homepage content, reading settings, header/footer variants, and starter pages from before your last import.', 'pivora-core' ); ?></p>
				<form method="post">
					<?php wp_nonce_field( 'pivora_import_rollback' ); ?>
					<button type="submit" class="button button-secondary" name="pivora_import_rollback" value="1" onclick="return confirm('<?php echo esc_js( __( 'Restore the previous site state? This cannot be undone after another import.', 'pivora-core' ) ); ?>');">
						<?php esc_html_e( 'Restore previous state', 'pivora-core' ); ?>
					</button>
				</form>
			</div>
		<?php endif; ?>

		<p class="pivora-demo-import__intro">
			<?php esc_html_e( 'Preview each starter below, then import the one that fits your site. Existing pages with the same slug are updated—not duplicated.', 'pivora-core' ); ?>
		</p>

		<?php if ( $active_kit && isset( $kits[ $active_kit ] ) ) : ?>
			<p>
				<strong><?php esc_html_e( 'Active kit:', 'pivora-core' ); ?></strong>
				<?php echo esc_html( (string) $kits[ $active_kit ]['label'] ); ?>
			</p>
		<?php endif; ?>

		<div class="pivora-demo-import__kit-file">
			<h2><?php esc_html_e( 'Import a kit file', 'pivora-core' ); ?></h2>
			<p><?php esc_html_e( 'Upload a .pivora-kit.json file exported from another site or agency handoff.', 'pivora-core' ); ?></p>
			<form method="post" enctype="multipart/form-data" class="pivora-demo-import-kit-file-form">
				<?php wp_nonce_field( 'pivora_import_kit_file' ); ?>
				<input type="file" name="pivora_kit_file" accept=".json,application/json" required />
				<fieldset class="pivora-demo-import__scopes pivora-demo-import__scopes--inline">
					<legend><?php esc_html_e( 'Import sections', 'pivora-core' ); ?></legend>
					<?php foreach ( $scope_labels as $scope_key => $scope_label ) : ?>
						<label class="pivora-demo-import__scope">
							<input type="checkbox" name="import_scope_<?php echo esc_attr( $scope_key ); ?>" value="1" checked="checked" />
							<?php echo esc_html( $scope_label ); ?>
						</label>
					<?php endforeach; ?>
				</fieldset>
				<p class="pivora-demo-import__kit-file-actions">
					<button type="submit" class="button button-secondary" name="pivora_save_kit_file" value="1">
						<?php esc_html_e( 'Save kit only', 'pivora-core' ); ?>
					</button>
					<button type="submit" class="button button-primary" name="pivora_import_kit_file" value="1">
						<?php esc_html_e( 'Import kit file', 'pivora-core' ); ?>
					</button>
				</p>
			</form>
		</div>

		<form method="post" class="pivora-demo-import-form" data-woo-active="<?php echo class_exists( 'WooCommerce' ) ? '1' : '0'; ?>">
			<?php wp_nonce_field( 'pivora_import_demo_kit' ); ?>

			<div class="pivora-demo-import__grid" role="radiogroup" aria-label="<?php esc_attr_e( 'Demo kits', 'pivora-core' ); ?>">
				<?php foreach ( $kits as $slug => $kit ) : ?>
					<?php
					$preview_url   = pivora_get_demo_kit_preview_url( $slug );
					$preview_label = sprintf(
						/* translators: %s: demo kit label */
						__( '%s preview', 'pivora-core' ),
						(string) $kit['label']
					);
					$is_selected = $slug === $default_kit;
					?>
					<div class="pivora-demo-kit-card<?php echo $is_selected ? ' is-selected' : ''; ?>" data-kit="<?php echo esc_attr( $slug ); ?>" data-seed-posts="<?php echo ! empty( $kit['seed_posts'] ) ? '1' : '0'; ?>" data-woocommerce="<?php echo ! empty( $kit['woocommerce'] ) ? '1' : '0'; ?>">
						<div class="pivora-demo-kit-card__header">
							<input
								type="radio"
								id="pivora-demo-kit-<?php echo esc_attr( $slug ); ?>"
								name="demo_kit"
								value="<?php echo esc_attr( $slug ); ?>"
								data-preview-url="<?php echo esc_url( $preview_url ); ?>"
								data-preview-label="<?php echo esc_attr( $preview_label ); ?>"
								<?php checked( $slug, $default_kit ); ?>
							/>
							<div>
								<label class="pivora-demo-kit-card__title" for="pivora-demo-kit-<?php echo esc_attr( $slug ); ?>">
									<strong><?php echo esc_html( (string) $kit['label'] ); ?></strong>
								</label>
								<p class="pivora-demo-kit-card__description"><?php echo esc_html( (string) $kit['description'] ); ?></p>
								<?php if ( ! empty( $kit['custom'] ) ) : ?>
									<p class="pivora-demo-kit-card__note"><?php esc_html_e( 'Imported kit', 'pivora-core' ); ?></p>
								<?php elseif ( ! empty( $kit['woocommerce'] ) && ! class_exists( 'WooCommerce' ) ) : ?>
									<p class="pivora-demo-kit-card__note pivora-demo-kit-card__note--warning">
										<?php
										printf(
											/* translators: %s: plugins admin URL */
											wp_kses_post( __( 'Requires <a href="%s">WooCommerce</a> to be installed and active before import.', 'pivora-core' ) ),
											esc_url( $woo_plugins_url )
										);
										?>
									</p>
								<?php elseif ( str_starts_with( (string) $kit['pattern'], 'pivora-core/' ) ) : ?>
									<p class="pivora-demo-kit-card__note"><?php esc_html_e( 'Pivora Core pattern', 'pivora-core' ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="pivora-demo-kit-card__actions">
							<a class="button button-secondary" href="<?php echo esc_url( $preview_url ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'Open full preview', 'pivora-core' ); ?>
							</a>
							<a class="button button-link" href="<?php echo esc_url( pivora_core_get_kit_export_url( $slug ) ); ?>">
								<?php esc_html_e( 'Export JSON', 'pivora-core' ); ?>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<fieldset class="pivora-demo-import__scopes">
				<legend><?php esc_html_e( 'Import sections', 'pivora-core' ); ?></legend>
				<p class="description"><?php esc_html_e( 'Choose what to update. A snapshot is saved automatically before each import so you can roll back.', 'pivora-core' ); ?></p>
				<?php foreach ( $scope_labels as $scope_key => $scope_label ) : ?>
					<label class="pivora-demo-import__scope" data-scope="<?php echo esc_attr( $scope_key ); ?>">
						<input
							type="checkbox"
							name="import_scope_<?php echo esc_attr( $scope_key ); ?>"
							value="1"
							checked="checked"
						/>
						<?php echo esc_html( $scope_label ); ?>
					</label>
				<?php endforeach; ?>
			</fieldset>

			<div class="pivora-demo-import__preview">
				<div class="pivora-demo-import__preview-header">
					<p class="pivora-demo-import__preview-title">
						<?php
						printf(
							/* translators: %s: demo kit label */
							esc_html__( '%s preview', 'pivora-core' ),
							esc_html( (string) $kits[ $default_kit ]['label'] )
						);
						?>
					</p>
					<span class="description"><?php esc_html_e( 'Live preview — nothing is imported until you click Import.', 'pivora-core' ); ?></span>
				</div>
				<iframe
					class="pivora-demo-import__preview-frame"
					title="<?php echo esc_attr( $default_preview_label ); ?>"
					src="<?php echo esc_url( pivora_get_demo_kit_preview_url( $default_kit ) ); ?>"
					loading="lazy"
				></iframe>
			</div>

			<div class="pivora-demo-import__woo-notice" hidden>
				<p>
					<strong><?php esc_html_e( 'WooCommerce required', 'pivora-core' ); ?></strong>
					<?php
					printf(
						/* translators: %s: plugin install URL */
						wp_kses_post( __( 'Install and activate <a href="%s">WooCommerce</a> before importing the store kit.', 'pivora-core' ) ),
						esc_url( $woo_plugins_url )
					);
					?>
				</p>
			</div>

			<p class="submit">
				<button type="submit" class="button button-primary pivora-demo-import__submit" name="pivora_import_demo_kit" value="1">
					<?php esc_html_e( 'Import selected kit', 'pivora-core' ); ?>
				</button>
			</p>
		</form>

		<h2><?php esc_html_e( 'After import', 'pivora-core' ); ?></h2>
		<ul class="ul-disc pivora-demo-import__after">
			<li><a href="<?php echo esc_url( (string) $front_url ); ?>"><?php esc_html_e( 'View the home page', 'pivora-core' ); ?></a></li>
			<li><a href="<?php echo esc_url( $site_editor ); ?>"><?php esc_html_e( 'Open the Site Editor', 'pivora-core' ); ?></a></li>
			<li><?php esc_html_e( 'Custom blocks appear under the Pivora category in the block inserter.', 'pivora-core' ); ?></li>
		</ul>

		<p class="description">
			<?php esc_html_e( 'CLI: PIVORA_DEMO_KIT=agency npm run setup:demo · npm run kit:export -- business', 'pivora-core' ); ?>
		</p>
	</div>
	<?php
}
