<?php
/**
 * Title: Team grid
 * Slug: pivora/team-grid
 * Categories: pivora-sections, pivora-business, pivora-local
 * Viewport width: 1200
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-section pivora-team-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull pivora-section pivora-team-section">
	<!-- wp:group {"align":"wide","className":"pivora-team-section__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-team-section__inner">
		<!-- wp:group {"className":"pivora-section__heading","layout":{"type":"default"}} -->
		<div class="wp-block-group pivora-section__heading">
			<!-- wp:paragraph {"className":"pivora-eyebrow"} -->
			<p class="pivora-eyebrow"><?php esc_html_e( 'Team', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'People who keep launches calm and on schedule.', 'pivora' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"pivora-section__lede"} -->
			<p class="pivora-section__lede"><?php esc_html_e( 'Manage team profiles under Pivora → Team members, or keep manual cards in the editor.', 'pivora' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<?php if ( defined( 'PIVORA_CORE_VERSION' ) ) : ?>
			<?php
			pivora_block(
				'pivora/team-grid',
				array(
					'postsToShow' => 3,
					'columns'     => 3,
				)
			);
			?>
		<?php else : ?>
			<?php
			$members = array(
				array(
					'initials' => 'JL',
					'name'     => __( 'Jordan Lee', 'pivora' ),
					'role'     => __( 'Founder & strategist', 'pivora' ),
					'bio'      => __( 'Leads discovery, information architecture, and the first draft of every major launch.', 'pivora' ),
				),
				array(
					'initials' => 'PN',
					'name'     => __( 'Priya Nair', 'pivora' ),
					'role'     => __( 'Design lead', 'pivora' ),
					'bio'      => __( 'Shapes the visual system, pattern library, and editor experience clients actually use.', 'pivora' ),
				),
				array(
					'initials' => 'MC',
					'name'     => __( 'Marcus Cole', 'pivora' ),
					'role'     => __( 'Engineering', 'pivora' ),
					'bio'      => __( 'Keeps templates accessible, performant, and compatible with the plugins you choose.', 'pivora' ),
				),
			);
			?>
		<!-- wp:columns {"className":"pivora-team-grid"} -->
		<div class="wp-block-columns pivora-team-grid">
			<?php foreach ( $members as $member ) : ?>
				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:group {"className":"pivora-card pivora-team-member","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-card pivora-team-member">
						<!-- wp:paragraph {"className":"pivora-team-member__avatar"} -->
						<p class="pivora-team-member__avatar"><?php echo esc_html( $member['initials'] ); ?></p>
						<!-- /wp:paragraph -->
						<!-- wp:heading {"level":3,"className":"pivora-team-member__name"} -->
						<h3 class="wp-block-heading pivora-team-member__name"><?php echo esc_html( $member['name'] ); ?></h3>
						<!-- /wp:heading -->
						<!-- wp:paragraph {"className":"pivora-team-member__role"} -->
						<p class="pivora-team-member__role"><?php echo esc_html( $member['role'] ); ?></p>
						<!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-team-member__bio"} -->
						<p class="pivora-team-member__bio"><?php echo esc_html( $member['bio'] ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:column -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:columns -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
