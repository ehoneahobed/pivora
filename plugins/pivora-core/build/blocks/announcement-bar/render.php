<?php
/**
 * Announcement bar block render callback.
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

$schedule_start = isset( $attributes['scheduleStart'] ) ? (string) $attributes['scheduleStart'] : '';
$schedule_end   = isset( $attributes['scheduleEnd'] ) ? (string) $attributes['scheduleEnd'] : '';

if ( ! pivora_core_announcement_is_scheduled_visible( $schedule_start, $schedule_end ) ) {
	return;
}

$announcement_id = isset( $attributes['announcementId'] ) ? (string) $attributes['announcementId'] : 'default';
$message         = isset( $attributes['message'] ) ? (string) $attributes['message'] : '';
$link_text       = isset( $attributes['linkText'] ) ? (string) $attributes['linkText'] : '';
$link_url        = isset( $attributes['linkUrl'] ) ? (string) $attributes['linkUrl'] : '';
$dismissible     = ! isset( $attributes['dismissible'] ) || (bool) $attributes['dismissible'];

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-announcement-bar',
	array(
		'barStyle' => 'bar',
	),
	array(
		'data-announcement-id' => $announcement_id,
		'data-dismissible'     => $dismissible ? 'true' : 'false',
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="pivora-announcement-bar__inner">
		<p class="pivora-announcement-bar__message"><?php echo wp_kses_post( $message ); ?></p>
		<?php if ( '' !== $link_text ) : ?>
			<a class="pivora-announcement-bar__link" href="<?php echo esc_url( $link_url ?: '#' ); ?>">
				<?php echo wp_kses_post( $link_text ); ?>
			</a>
		<?php endif; ?>
	</div>
	<?php if ( $dismissible ) : ?>
		<button
			type="button"
			class="pivora-announcement-bar__dismiss"
			aria-label="<?php esc_attr_e( 'Dismiss announcement', 'pivora-core' ); ?>"
		>
			×
		</button>
	<?php endif; ?>
</div>
