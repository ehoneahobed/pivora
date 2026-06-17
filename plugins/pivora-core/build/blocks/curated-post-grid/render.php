<?php
/**
 * Curated post grid block render callback.
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

$posts_to_show      = isset( $attributes['postsToShow'] ) ? max( 1, min( 6, (int) $attributes['postsToShow'] ) ) : 3;
$order_by           = isset( $attributes['orderBy'] ) ? sanitize_key( (string) $attributes['orderBy'] ) : 'date';
$order              = isset( $attributes['order'] ) ? strtoupper( sanitize_key( (string) $attributes['order'] ) ) : 'DESC';
$show_image         = ! isset( $attributes['showFeaturedImage'] ) || (bool) $attributes['showFeaturedImage'];
$show_date          = ! isset( $attributes['showDate'] ) || (bool) $attributes['showDate'];
$excerpt_length     = isset( $attributes['excerptLength'] ) ? max( 10, min( 60, (int) $attributes['excerptLength'] ) ) : 22;
$read_more_text     = isset( $attributes['readMoreText'] ) ? (string) $attributes['readMoreText'] : __( 'Read article', 'pivora-core' );
$read_more_text     = '' !== $read_more_text ? $read_more_text : __( 'Read article', 'pivora-core' );

if ( ! in_array( $order_by, array( 'date', 'title' ), true ) ) {
	$order_by = 'date';
}

if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
	$order = 'DESC';
}

$query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $posts_to_show,
		'orderby'             => $order_by,
		'order'               => $order,
		'ignore_sticky_posts' => true,
	)
);

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'pivora-curated-post-grid pivora-latest-posts',
	)
);

if ( ! $query->have_posts() ) {
	echo '<div ' . $wrapper_attributes . '><p class="pivora-posts-section__empty">' . esc_html__( 'Publish your first post to populate this section.', 'pivora-core' ) . '</p></div>';
	wp_reset_postdata();
	return;
}
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<ul class="pivora-curated-post-grid__list">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			$permalink = get_permalink();
			?>
			<li class="pivora-curated-post-card pivora-post-card">
				<?php if ( $show_image ) : ?>
					<div class="pivora-curated-post-card__media">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php echo esc_url( $permalink ); ?>" class="pivora-curated-post-card__image-link">
								<?php
								the_post_thumbnail(
									'large',
									array(
										'class'   => 'pivora-curated-post-card__image',
										'loading' => 'lazy',
										'alt'     => the_title_attribute( array( 'echo' => false ) ),
									)
								);
								?>
							</a>
						<?php else : ?>
							<a href="<?php echo esc_url( $permalink ); ?>" class="pivora-curated-post-card__image-link pivora-curated-post-card__image-link--placeholder" aria-hidden="true" tabindex="-1">
								<span class="pivora-curated-post-card__placeholder-image"></span>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<h3 class="pivora-curated-post-card__title">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="pivora-curated-post-card__excerpt">
					<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), $excerpt_length, '…' ) ); ?>
					<?php if ( '' !== $read_more_text ) : ?>
						<a class="pivora-curated-post-card__more" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $read_more_text ); ?></a>
					<?php endif; ?>
				</div>
				<?php if ( $show_date ) : ?>
					<time class="pivora-curated-post-card__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				<?php endif; ?>
			</li>
			<?php
		endwhile;
		?>
	</ul>
</div>
<?php
wp_reset_postdata();
