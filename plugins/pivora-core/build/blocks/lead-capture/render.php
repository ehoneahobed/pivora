<?php
/**
 * Lead capture block render callback.
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

$block_instance_id = isset( $attributes['blockInstanceId'] ) && '' !== $attributes['blockInstanceId']
	? sanitize_key( (string) $attributes['blockInstanceId'] )
	: wp_unique_id( 'pivora-lead-' );

$show_name         = ! isset( $attributes['showName'] ) || (bool) $attributes['showName'];
$show_message      = ! isset( $attributes['showMessage'] ) || (bool) $attributes['showMessage'];
$layout            = isset( $attributes['layout'] ) ? sanitize_key( (string) $attributes['layout'] ) : 'stacked';
$button_text       = isset( $attributes['buttonText'] ) ? (string) $attributes['buttonText'] : __( 'Send message', 'pivora-core' );
$success_message   = isset( $attributes['successMessage'] ) ? (string) $attributes['successMessage'] : __( 'Thanks — we received your message.', 'pivora-core' );
$name_label        = isset( $attributes['nameLabel'] ) ? (string) $attributes['nameLabel'] : __( 'Full name', 'pivora-core' );
$email_label       = isset( $attributes['emailLabel'] ) ? (string) $attributes['emailLabel'] : __( 'Email address', 'pivora-core' );
$message_label     = isset( $attributes['messageLabel'] ) ? (string) $attributes['messageLabel'] : __( 'Message', 'pivora-core' );
$recipient_email   = isset( $attributes['recipientEmail'] ) ? sanitize_email( (string) $attributes['recipientEmail'] ) : '';
$webhook_url       = isset( $attributes['webhookUrl'] ) ? esc_url_raw( (string) $attributes['webhookUrl'] ) : '';

if ( ! in_array( $layout, array( 'stacked', 'inline' ), true ) ) {
	$layout = 'stacked';
}

$show_success = pivora_core_lead_capture_show_success( $block_instance_id );

$wrapper_attributes = pivora_core_get_block_wrapper_attributes(
	$attributes,
	'pivora-lead-capture pivora-lead-capture--' . $layout,
	array()
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id="<?php echo esc_attr( $block_instance_id ); ?>">
	<?php if ( $show_success ) : ?>
		<p class="pivora-lead-capture__notice pivora-lead-capture__notice--success" role="status">
			<?php echo esc_html( $success_message ); ?>
		</p>
	<?php else : ?>
		<form
			class="pivora-lead-capture__form"
			method="post"
			action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
		>
			<input type="hidden" name="action" value="pivora_lead_capture" />
			<input type="hidden" name="pivora_lead_block_id" value="<?php echo esc_attr( $block_instance_id ); ?>" />
			<input type="hidden" name="pivora_lead_recipient" value="<?php echo esc_attr( $recipient_email ); ?>" />
			<input type="hidden" name="pivora_lead_webhook" value="<?php echo esc_attr( $webhook_url ); ?>" />
			<?php wp_nonce_field( 'pivora_lead_capture', 'pivora_lead_nonce' ); ?>

			<div class="pivora-lead-capture__hp" aria-hidden="true">
				<label for="<?php echo esc_attr( $block_instance_id ); ?>-hp"><?php esc_html_e( 'Leave blank', 'pivora-core' ); ?></label>
				<input type="text" id="<?php echo esc_attr( $block_instance_id ); ?>-hp" name="pivora_lead_hp" value="" tabindex="-1" autocomplete="off" />
			</div>

			<?php if ( $show_name ) : ?>
				<label class="pivora-lead-capture__field" for="<?php echo esc_attr( $block_instance_id ); ?>-name">
					<span class="pivora-lead-capture__label"><?php echo esc_html( $name_label ); ?></span>
					<input
						class="pivora-lead-capture__input"
						type="text"
						id="<?php echo esc_attr( $block_instance_id ); ?>-name"
						name="pivora_lead_name"
						autocomplete="name"
					/>
				</label>
			<?php endif; ?>

			<label class="pivora-lead-capture__field" for="<?php echo esc_attr( $block_instance_id ); ?>-email">
				<span class="pivora-lead-capture__label"><?php echo esc_html( $email_label ); ?></span>
				<input
					class="pivora-lead-capture__input"
					type="email"
					id="<?php echo esc_attr( $block_instance_id ); ?>-email"
					name="pivora_lead_email"
					required
					autocomplete="email"
				/>
			</label>

			<?php if ( $show_message ) : ?>
				<label class="pivora-lead-capture__field" for="<?php echo esc_attr( $block_instance_id ); ?>-message">
					<span class="pivora-lead-capture__label"><?php echo esc_html( $message_label ); ?></span>
					<textarea
						class="pivora-lead-capture__textarea"
						id="<?php echo esc_attr( $block_instance_id ); ?>-message"
						name="pivora_lead_message"
						rows="4"
					></textarea>
				</label>
			<?php endif; ?>

			<button type="submit" class="pivora-lead-capture__submit wp-element-button">
				<?php echo esc_html( $button_text ); ?>
			</button>
		</form>
	<?php endif; ?>
</div>
