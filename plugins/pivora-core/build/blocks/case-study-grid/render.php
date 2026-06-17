<?php
/**
 * Case study grid block render callback.
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
		'post_type'      => 'pivora_case_study',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_to_show,
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	)
);

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-case-study-grid pivora-portfolio-grid',
		'style' => '--pivora-case-study-columns: ' . $columns . ';',
	)
);

if ( ! $query->have_posts() ) {
	$add_url = admin_url( 'post-new.php?post_type=pivora_case_study' );
	?>
	<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<p class="pivora-case-study-grid__empty">
			<?php
			printf(
				/* translators: %s: admin new case study URL */
				wp_kses_post( __( 'No case studies yet. <a href="%s">Add your first project</a>.', 'pivora-core' ) ),
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
	<div class="pivora-case-study-grid__list">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			$study = pivora_core_get_case_study_card_data( get_the_ID() );

			if ( $study ) {
				pivora_core_render_case_study_card( $study );
			}
		endwhile;
		?>
	</div>
</div>
<?php
wp_reset_postdata();
