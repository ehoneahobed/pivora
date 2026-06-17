<?php
/**
 * Case study custom post type.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the case study post type.
 */
function pivora_core_register_case_study_cpt(): void {
	register_post_type(
		'pivora_case_study',
		array(
			'labels'          => array(
				'name'               => __( 'Case studies', 'pivora-core' ),
				'singular_name'      => __( 'Case study', 'pivora-core' ),
				'add_new'            => __( 'Add case study', 'pivora-core' ),
				'add_new_item'       => __( 'Add case study', 'pivora-core' ),
				'edit_item'          => __( 'Edit case study', 'pivora-core' ),
				'new_item'           => __( 'New case study', 'pivora-core' ),
				'view_item'          => __( 'View case study', 'pivora-core' ),
				'search_items'       => __( 'Search case studies', 'pivora-core' ),
				'not_found'          => __( 'No case studies found.', 'pivora-core' ),
				'not_found_in_trash' => __( 'No case studies found in Trash.', 'pivora-core' ),
				'menu_name'          => __( 'Case studies', 'pivora-core' ),
			),
			'public'          => true,
			'show_ui'         => true,
			'show_in_menu'    => 'pivora-dashboard',
			'show_in_rest'    => true,
			'menu_icon'       => 'dashicons-portfolio',
			'supports'        => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'has_archive'     => true,
			'rewrite'         => array( 'slug' => 'case-studies' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'pivora_core_register_case_study_cpt', 9 );

/**
 * Registers case study meta fields.
 */
function pivora_core_register_case_study_meta(): void {
	$meta_fields = array(
		'_pivora_case_study_tag'     => 'string',
		'_pivora_case_study_client'  => 'string',
		'_pivora_case_study_variant' => 'string',
	);

	foreach ( $meta_fields as $meta_key => $type ) {
		register_post_meta(
			'pivora_case_study',
			$meta_key,
			array(
				'type'              => $type,
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => static fn() => current_user_can( 'edit_posts' ),
			)
		);
	}
}
add_action( 'init', 'pivora_core_register_case_study_meta', 20 );

/**
 * Renders case study meta box.
 *
 * @param WP_Post $post Current post.
 */
function pivora_core_render_case_study_meta_box( WP_Post $post ): void {
	$tag     = (string) get_post_meta( $post->ID, '_pivora_case_study_tag', true );
	$client  = (string) get_post_meta( $post->ID, '_pivora_case_study_client', true );
	$variant = (string) get_post_meta( $post->ID, '_pivora_case_study_variant', true );

	wp_nonce_field( 'pivora_case_study_meta', 'pivora_case_study_meta_nonce' );
	?>
	<p>
		<label for="pivora_case_study_tag"><strong><?php esc_html_e( 'Project tag', 'pivora-core' ); ?></strong></label>
		<input type="text" class="widefat" id="pivora_case_study_tag" name="pivora_case_study_tag" value="<?php echo esc_attr( $tag ); ?>" placeholder="<?php esc_attr_e( 'Brand', 'pivora-core' ); ?>" />
	</p>
	<p>
		<label for="pivora_case_study_client"><strong><?php esc_html_e( 'Client name', 'pivora-core' ); ?></strong></label>
		<input type="text" class="widefat" id="pivora_case_study_client" name="pivora_case_study_client" value="<?php echo esc_attr( $client ); ?>" />
	</p>
	<p>
		<label for="pivora_case_study_variant"><strong><?php esc_html_e( 'Card style', 'pivora-core' ); ?></strong></label>
		<select class="widefat" id="pivora_case_study_variant" name="pivora_case_study_variant">
			<option value="default" <?php selected( $variant, 'default' ); ?>><?php esc_html_e( 'Default', 'pivora-core' ); ?></option>
			<option value="accent" <?php selected( $variant, 'accent' ); ?>><?php esc_html_e( 'Accent', 'pivora-core' ); ?></option>
			<option value="highlight" <?php selected( $variant, 'highlight' ); ?>><?php esc_html_e( 'Highlight', 'pivora-core' ); ?></option>
		</select>
	</p>
	<?php
}

/**
 * Adds case study meta boxes.
 */
function pivora_core_add_case_study_meta_boxes(): void {
	add_meta_box(
		'pivora-case-study-details',
		__( 'Case study details', 'pivora-core' ),
		'pivora_core_render_case_study_meta_box',
		'pivora_case_study',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes_pivora_case_study', 'pivora_core_add_case_study_meta_boxes' );

/**
 * Saves case study meta.
 *
 * @param int $post_id Post id.
 */
function pivora_core_save_case_study_meta( int $post_id ): void {
	if ( ! isset( $_POST['pivora_case_study_meta_nonce'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( (string) $_POST['pivora_case_study_meta_nonce'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( ! wp_verify_nonce( $nonce, 'pivora_case_study_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$tag     = isset( $_POST['pivora_case_study_tag'] ) ? sanitize_text_field( wp_unslash( (string) $_POST['pivora_case_study_tag'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$client  = isset( $_POST['pivora_case_study_client'] ) ? sanitize_text_field( wp_unslash( (string) $_POST['pivora_case_study_client'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$variant = isset( $_POST['pivora_case_study_variant'] ) ? sanitize_key( wp_unslash( (string) $_POST['pivora_case_study_variant'] ) ) : 'default'; // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( ! in_array( $variant, array( 'default', 'accent', 'highlight' ), true ) ) {
		$variant = 'default';
	}

	update_post_meta( $post_id, '_pivora_case_study_tag', $tag );
	update_post_meta( $post_id, '_pivora_case_study_client', $client );
	update_post_meta( $post_id, '_pivora_case_study_variant', $variant );
}
add_action( 'save_post_pivora_case_study', 'pivora_core_save_case_study_meta' );
