<?php
/**
 * Case study card markup helpers.
 *
 * @package Pivora_Core
 */

/**
 * Renders a case study project card.
 *
 * @param array<string, mixed> $study Case study card data.
 */
function pivora_core_render_case_study_card( array $study ): void {
	$title    = isset( $study['title'] ) ? (string) $study['title'] : '';
	$tag      = isset( $study['tag'] ) ? (string) $study['tag'] : '';
	$excerpt  = isset( $study['excerpt'] ) ? (string) $study['excerpt'] : '';
	$url      = isset( $study['url'] ) ? (string) $study['url'] : '';
	$variant  = isset( $study['variant'] ) ? sanitize_key( (string) $study['variant'] ) : 'default';
	$image_id = isset( $study['imageId'] ) ? (int) $study['imageId'] : 0;

	$classes = array( 'pivora-project-card' );

	if ( 'accent' === $variant ) {
		$classes[] = 'pivora-project-card--accent';
	} elseif ( 'highlight' === $variant ) {
		$classes[] = 'pivora-project-card--highlight';
	}

	$class_attr = implode( ' ', $classes );
	?>
	<?php if ( '' !== $url ) : ?>
		<a class="<?php echo esc_attr( $class_attr ); ?>" href="<?php echo esc_url( $url ); ?>">
	<?php else : ?>
		<article class="<?php echo esc_attr( $class_attr ); ?>">
	<?php endif; ?>
		<?php if ( $image_id > 0 ) : ?>
			<div class="pivora-project-card__media">
				<?php
				echo wp_get_attachment_image(
					$image_id,
					'large',
					false,
					array(
						'class'   => 'pivora-project-card__image',
						'loading' => 'lazy',
					)
				);
				?>
			</div>
		<?php endif; ?>
		<?php if ( '' !== $tag ) : ?>
			<p class="pivora-project-card__tag"><?php echo esc_html( $tag ); ?></p>
		<?php endif; ?>
		<?php if ( '' !== $title ) : ?>
			<h3 class="pivora-project-card__title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>
		<?php if ( '' !== $excerpt ) : ?>
			<p class="pivora-project-card__copy"><?php echo esc_html( $excerpt ); ?></p>
		<?php endif; ?>
	<?php if ( '' !== $url ) : ?>
		</a>
	<?php else : ?>
		</article>
	<?php endif; ?>
	<?php
}
