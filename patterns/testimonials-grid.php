<?php
/**
 * Title: Testimonials grid
 * Slug: pivora/testimonials-grid
 * Categories: pivora-sections, pivora-business, pivora-saas
 * Viewport width: 1200
 *
 * @package Pivora
 */

$testimonials = array(
	array(
		'quote'    => __( 'We replaced three plugins and still launch landing pages in an afternoon. Patterns are the whole workflow now.', 'pivora' ),
		'initials' => 'AL',
		'name'     => __( 'Avery Lane', 'pivora' ),
		'role'     => __( 'Marketing lead, Northline Studio', 'pivora' ),
	),
	array(
		'quote'    => __( 'Blog layouts, store templates, and sidebars all work from the admin. Our clients edit without calling us every week.', 'pivora' ),
		'initials' => 'MR',
		'name'     => __( 'Morgan Reyes', 'pivora' ),
		'role'     => __( 'Founder, Reyes Digital', 'pivora' ),
	),
	array(
		'quote'    => __( 'Performance scores stayed green after we rebuilt the homepage with Pivora patterns. No custom CSS hacks required.', 'pivora' ),
		'initials' => 'SK',
		'name'     => __( 'Sam Kim', 'pivora' ),
		'role'     => __( 'Engineering manager, Harbor Labs', 'pivora' ),
	),
);

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-testimonials-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-testimonials-section">
	<!-- wp:group {"align":"wide","className":"pivora-testimonials-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-testimonials-section__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Testimonials', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Teams ship faster when the editor stays out of the way.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-section__lede"} -->
			<p class="pivora-section__lede"><?php esc_html_e( 'Pivora keeps marketing pages consistent without locking content into a page builder.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"pivora-testimonials-grid"} -->
		<div class="wp-block-columns pivora-testimonials-grid">
			<?php if ( pivora_is_core_active() ) : ?>
				<?php foreach ( $testimonials as $testimonial ) : ?>
					<!-- wp:column -->
					<div class="wp-block-column">
						<?php pivora_block( 'pivora/testimonial-card', $testimonial ); ?>
					</div>
					<!-- /wp:column -->
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( $testimonials as $testimonial ) : ?>
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:group {"className":"pivora-card pivora-testimonial","layout":{"type":"default"}} -->
						<div class="wp-block-group pivora-card pivora-testimonial">
							<!-- wp:quote {"className":"is-style-pivora-testimonial"} -->
							<blockquote class="wp-block-quote is-style-pivora-testimonial">
								<p><?php echo esc_html( $testimonial['quote'] ); ?></p>
							</blockquote>
							<!-- /wp:quote -->
							<!-- wp:group {"className":"pivora-testimonial__author","layout":{"type":"flex","flexWrap":"nowrap"}} -->
							<div class="wp-block-group pivora-testimonial__author">
								<!-- wp:paragraph {"className":"pivora-testimonial__avatar"} -->
								<p class="pivora-testimonial__avatar"><?php echo esc_html( $testimonial['initials'] ); ?></p>
								<!-- /wp:paragraph -->
								<!-- wp:group {"className":"pivora-testimonial__meta","layout":{"type":"default"}} -->
								<div class="wp-block-group pivora-testimonial__meta">
									<!-- wp:paragraph {"className":"pivora-testimonial__name"} -->
									<p class="pivora-testimonial__name"><?php echo esc_html( $testimonial['name'] ); ?></p>
									<!-- /wp:paragraph -->
									<!-- wp:paragraph {"className":"pivora-testimonial__role"} -->
									<p class="pivora-testimonial__role"><?php echo esc_html( $testimonial['role'] ); ?></p>
									<!-- /wp:paragraph -->
								</div>
								<!-- /wp:group -->
							</div>
							<!-- /wp:group -->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:column -->
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
