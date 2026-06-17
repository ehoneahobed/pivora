<?php
/**
 * Team grid block render callback.
 *
 * @package Pivora_Core
 *
 * @var array<string, mixed> $attributes Block attributes.
 * @var string               $content    Block content.
 * @var WP_Block             $block      Block instance.
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$posts_to_show = isset( $attributes['postsToShow'] ) ? max( 1, min( 9, (int) $attributes['postsToShow'] ) ) : 3;
$columns       = isset( $attributes['columns'] ) ? max( 1, min( 4, (int) $attributes['columns'] ) ) : 3;

$query = new WP_Query(
	array(
		'post_type'      => 'pivora_team_member',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_to_show,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-team-grid',
		'style' => '--pivora-team-columns: ' . $columns . ';',
	)
);

if ( ! $query->have_posts() ) {
	$add_url = admin_url( 'post-new.php?post_type=pivora_team_member' );
	?>
	<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<p class="pivora-team-grid__empty">
			<?php
			printf(
				/* translators: %s: admin new team member URL */
				wp_kses_post( __( 'No team members yet. <a href="%s">Add your first profile</a>.', 'pivora-core' ) ),
				esc_url( $add_url )
			);
			?>
		</p>
	</div>
	<?php
	wp_reset_postdata();
	return;
}
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="pivora-team-grid__list">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			$member = pivora_core_get_team_member_data( get_the_ID() );

			if ( $member ) {
				pivora_core_render_team_member_card( $member, $attributes );
			}
		endwhile;
		?>
	</div>
</div>
<?php
wp_reset_postdata();
