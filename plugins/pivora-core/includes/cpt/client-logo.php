<?php
/**
 * Client logo custom post type.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the client logo post type and industry taxonomy.
 */
function pivora_core_register_client_logo_cpt(): void {
	register_taxonomy(
		'pivora_logo_industry',
		'pivora_client_logo',
		array(
			'labels'            => array(
				'name'          => __( 'Logo industries', 'pivora-core' ),
				'singular_name' => __( 'Logo industry', 'pivora-core' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => false,
		)
	);

	register_post_type(
		'pivora_client_logo',
		array(
			'labels'              => array(
				'name'               => __( 'Client logos', 'pivora-core' ),
				'singular_name'      => __( 'Client logo', 'pivora-core' ),
				'add_new'            => __( 'Add logo', 'pivora-core' ),
				'add_new_item'       => __( 'Add client logo', 'pivora-core' ),
				'edit_item'          => __( 'Edit client logo', 'pivora-core' ),
				'new_item'           => __( 'New client logo', 'pivora-core' ),
				'view_item'          => __( 'View client logo', 'pivora-core' ),
				'search_items'       => __( 'Search client logos', 'pivora-core' ),
				'not_found'          => __( 'No client logos found.', 'pivora-core' ),
				'not_found_in_trash' => __( 'No client logos found in Trash.', 'pivora-core' ),
				'menu_name'          => __( 'Client logos', 'pivora-core' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => 'pivora-dashboard',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-format-image',
			'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'         => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
		)
	);
}
add_action( 'init', 'pivora_core_register_client_logo_cpt', 9 );

/**
 * Registers client logo meta fields.
 */
function pivora_core_register_client_logo_meta(): void {
	register_post_meta(
		'pivora_client_logo',
		'_pivora_logo_url',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'esc_url_raw',
			'auth_callback'     => static fn() => current_user_can( 'edit_posts' ),
		)
	);
}
add_action( 'init', 'pivora_core_register_client_logo_meta', 20 );

/**
 * Renders the logo URL meta box.
 *
 * @param WP_Post $post Current post.
 */
function pivora_core_render_client_logo_meta_box( WP_Post $post ): void {
	$url = (string) get_post_meta( $post->ID, '_pivora_logo_url', true );
	wp_nonce_field( 'pivora_client_logo_meta', 'pivora_client_logo_meta_nonce' );
	?>
	<p>
		<label for="pivora_logo_url"><strong><?php esc_html_e( 'Logo link URL', 'pivora-core' ); ?></strong></label>
		<input type="url" class="widefat" id="pivora_logo_url" name="pivora_logo_url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://" />
	</p>
	<?php
}

/**
 * Adds client logo meta boxes.
 */
function pivora_core_add_client_logo_meta_boxes(): void {
	add_meta_box(
		'pivora-client-logo-details',
		__( 'Logo details', 'pivora-core' ),
		'pivora_core_render_client_logo_meta_box',
		'pivora_client_logo',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes_pivora_client_logo', 'pivora_core_add_client_logo_meta_boxes' );

/**
 * Saves client logo meta.
 *
 * @param int $post_id Post id.
 */
function pivora_core_save_client_logo_meta( int $post_id ): void {
	if ( ! isset( $_POST['pivora_client_logo_meta_nonce'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( (string) $_POST['pivora_client_logo_meta_nonce'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( ! wp_verify_nonce( $nonce, 'pivora_client_logo_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$url = isset( $_POST['pivora_logo_url'] ) ? esc_url_raw( wp_unslash( (string) $_POST['pivora_logo_url'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	update_post_meta( $post_id, '_pivora_logo_url', $url );
}
add_action( 'save_post_pivora_client_logo', 'pivora_core_save_client_logo_meta' );
