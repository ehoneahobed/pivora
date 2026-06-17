<?php
/**
 * Team member custom post type.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the team member post type.
 */
function pivora_core_register_team_member_cpt(): void {
	register_post_type(
		'pivora_team_member',
		array(
			'labels'              => array(
				'name'               => __( 'Team members', 'pivora-core' ),
				'singular_name'      => __( 'Team member', 'pivora-core' ),
				'add_new'            => __( 'Add team member', 'pivora-core' ),
				'add_new_item'       => __( 'Add team member', 'pivora-core' ),
				'edit_item'          => __( 'Edit team member', 'pivora-core' ),
				'new_item'           => __( 'New team member', 'pivora-core' ),
				'view_item'          => __( 'View team member', 'pivora-core' ),
				'search_items'       => __( 'Search team members', 'pivora-core' ),
				'not_found'          => __( 'No team members found.', 'pivora-core' ),
				'not_found_in_trash' => __( 'No team members found in Trash.', 'pivora-core' ),
				'menu_name'          => __( 'Team members', 'pivora-core' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => 'pivora-dashboard',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-groups',
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'has_archive'         => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
		)
	);
}
add_action( 'init', 'pivora_core_register_team_member_cpt', 9 );

/**
 * Registers team member meta fields.
 */
function pivora_core_register_team_member_meta(): void {
	$meta_fields = array(
		'_pivora_team_role'     => 'string',
		'_pivora_team_initials' => 'string',
	);

	foreach ( $meta_fields as $meta_key => $type ) {
		register_post_meta(
			'pivora_team_member',
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
add_action( 'init', 'pivora_core_register_team_member_meta', 20 );

/**
 * Renders team member meta box.
 *
 * @param WP_Post $post Current post.
 */
function pivora_core_render_team_member_meta_box( WP_Post $post ): void {
	$role     = (string) get_post_meta( $post->ID, '_pivora_team_role', true );
	$initials = (string) get_post_meta( $post->ID, '_pivora_team_initials', true );

	wp_nonce_field( 'pivora_team_member_meta', 'pivora_team_member_meta_nonce' );
	?>
	<p>
		<label for="pivora_team_role"><strong><?php esc_html_e( 'Role', 'pivora-core' ); ?></strong></label>
		<input type="text" class="widefat" id="pivora_team_role" name="pivora_team_role" value="<?php echo esc_attr( $role ); ?>" />
	</p>
	<p>
		<label for="pivora_team_initials"><strong><?php esc_html_e( 'Initials', 'pivora-core' ); ?></strong></label>
		<input type="text" class="widefat" id="pivora_team_initials" name="pivora_team_initials" value="<?php echo esc_attr( $initials ); ?>" maxlength="3" placeholder="JL" />
	</p>
	<p class="description"><?php esc_html_e( 'Add a featured image for a photo avatar. Initials are used when no image is set.', 'pivora-core' ); ?></p>
	<?php
}

/**
 * Adds team member meta boxes.
 */
function pivora_core_add_team_member_meta_boxes(): void {
	add_meta_box(
		'pivora-team-member-details',
		__( 'Team member details', 'pivora-core' ),
		'pivora_core_render_team_member_meta_box',
		'pivora_team_member',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes_pivora_team_member', 'pivora_core_add_team_member_meta_boxes' );

/**
 * Saves team member meta.
 *
 * @param int $post_id Post id.
 */
function pivora_core_save_team_member_meta( int $post_id ): void {
	if ( ! isset( $_POST['pivora_team_member_meta_nonce'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( (string) $_POST['pivora_team_member_meta_nonce'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( ! wp_verify_nonce( $nonce, 'pivora_team_member_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$role     = isset( $_POST['pivora_team_role'] ) ? sanitize_text_field( wp_unslash( (string) $_POST['pivora_team_role'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$initials = isset( $_POST['pivora_team_initials'] ) ? strtoupper( sanitize_text_field( wp_unslash( (string) $_POST['pivora_team_initials'] ) ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

	update_post_meta( $post_id, '_pivora_team_role', $role );
	update_post_meta( $post_id, '_pivora_team_initials', $initials );
}
add_action( 'save_post_pivora_team_member', 'pivora_core_save_team_member_meta' );
