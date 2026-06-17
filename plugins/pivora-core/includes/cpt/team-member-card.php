<?php
/**
 * Team member card markup helpers.
 *
 * @package Pivora_Core
 */

/**
 * Renders a team member card.
 *
 * @param array<string, mixed> $member     Member data.
 * @param array<string, mixed> $attributes Block attributes for surface modifiers.
 */
function pivora_core_render_team_member_card( array $member, array $attributes = array() ): void {
	$name     = isset( $member['name'] ) ? (string) $member['name'] : '';
	$role     = isset( $member['role'] ) ? (string) $member['role'] : '';
	$bio      = isset( $member['bio'] ) ? (string) $member['bio'] : '';
	$initials = isset( $member['initials'] ) ? (string) $member['initials'] : '';
	$image_id = isset( $member['imageId'] ) ? (int) $member['imageId'] : 0;

	$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
		$attributes,
		'pivora-team-member',
		array(
			'surfaceStyle' => 'surface',
		)
	);
	?>
	<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php if ( $image_id > 0 ) : ?>
			<div class="pivora-team-member__avatar pivora-team-member__avatar--image">
				<?php
				echo wp_get_attachment_image(
					$image_id,
					'thumbnail',
					false,
					array(
						'class' => 'pivora-team-member__photo',
						'alt'   => $name,
					)
				);
				?>
			</div>
		<?php else : ?>
			<p class="pivora-team-member__avatar"><?php echo esc_html( $initials ); ?></p>
		<?php endif; ?>
		<?php if ( '' !== $name ) : ?>
			<h3 class="pivora-team-member__name"><?php echo esc_html( $name ); ?></h3>
		<?php endif; ?>
		<?php if ( '' !== $role ) : ?>
			<p class="pivora-team-member__role"><?php echo esc_html( $role ); ?></p>
		<?php endif; ?>
		<?php if ( '' !== $bio ) : ?>
			<p class="pivora-team-member__bio"><?php echo esc_html( $bio ); ?></p>
		<?php endif; ?>
	</div>
	<?php
}
