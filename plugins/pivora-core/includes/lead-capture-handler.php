<?php
/**
 * Lead capture form submission handling.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Processes lead capture form submissions.
 */
function pivora_core_process_lead_capture(): void {
	if ( ! isset( $_POST['pivora_lead_nonce'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		pivora_core_redirect_lead_capture( 'invalid' );
	}

	$nonce = sanitize_text_field( wp_unslash( (string) $_POST['pivora_lead_nonce'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( ! wp_verify_nonce( $nonce, 'pivora_lead_capture' ) ) {
		pivora_core_redirect_lead_capture( 'invalid' );
	}

	// Honeypot must stay empty.
	if ( ! empty( $_POST['pivora_lead_hp'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		pivora_core_redirect_lead_capture( 'success' );
	}

	$block_id = isset( $_POST['pivora_lead_block_id'] ) // phpcs:ignore WordPress.Security.NonceVerification.Missing
		? sanitize_key( wp_unslash( (string) $_POST['pivora_lead_block_id'] ) )
		: '';

	$name    = isset( $_POST['pivora_lead_name'] ) ? sanitize_text_field( wp_unslash( (string) $_POST['pivora_lead_name'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$email   = isset( $_POST['pivora_lead_email'] ) ? sanitize_email( wp_unslash( (string) $_POST['pivora_lead_email'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$message = isset( $_POST['pivora_lead_message'] ) ? sanitize_textarea_field( wp_unslash( (string) $_POST['pivora_lead_message'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

	$recipient = isset( $_POST['pivora_lead_recipient'] ) ? sanitize_email( wp_unslash( (string) $_POST['pivora_lead_recipient'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$webhook   = isset( $_POST['pivora_lead_webhook'] ) ? esc_url_raw( wp_unslash( (string) $_POST['pivora_lead_webhook'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( '' === $email || ! is_email( $email ) ) {
		pivora_core_redirect_lead_capture( 'email', $block_id );
	}

	$to = is_email( $recipient ) ? $recipient : get_option( 'admin_email' );

	$subject = sprintf(
		/* translators: %s: site name */
		__( 'New lead from %s', 'pivora-core' ),
		wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES )
	);

	$body_lines = array(
		sprintf( 'Email: %s', $email ),
	);

	if ( '' !== $name ) {
		array_unshift( $body_lines, sprintf( 'Name: %s', $name ) );
	}

	if ( '' !== $message ) {
		$body_lines[] = sprintf( "Message:\n%s", $message );
	}

	$body_lines[] = sprintf( 'Page: %s', wp_get_referer() ? wp_get_referer() : home_url( '/' ) );

	$body    = implode( "\n\n", $body_lines );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email );

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( '' !== $webhook ) {
		wp_remote_post(
			$webhook,
			array(
				'timeout' => 10,
				'headers' => array( 'Content-Type' => 'application/json' ),
				'body'    => wp_json_encode(
					array(
						'name'    => $name,
						'email'   => $email,
						'message' => $message,
						'source'  => 'pivora-lead-capture',
						'page'    => wp_get_referer(),
					)
				),
			)
		);
	}

	/**
	 * Fires after a lead capture form is processed.
	 *
	 * @param array<string, string> $lead Lead payload.
	 * @param bool                  $sent Whether wp_mail succeeded.
	 */
	do_action(
		'pivora_core_lead_submitted',
		array(
			'name'    => $name,
			'email'   => $email,
			'message' => $message,
		),
		$sent
	);

	pivora_core_redirect_lead_capture( $sent ? 'success' : 'error', $block_id );
}
add_action( 'admin_post_nopriv_pivora_lead_capture', 'pivora_core_process_lead_capture' );
add_action( 'admin_post_pivora_lead_capture', 'pivora_core_process_lead_capture' );

/**
 * Redirects back to the referring page with a status query arg.
 *
 * @param string $status   Submission status slug.
 * @param string $block_id Block instance id for scoping success messages.
 */
function pivora_core_redirect_lead_capture( string $status, string $block_id = '' ): void {
	$redirect = wp_get_referer();

	if ( ! $redirect ) {
		$redirect = home_url( '/' );
	}

	$redirect = remove_query_arg( array( 'pivora_lead_status', 'pivora_lead_block' ), $redirect );
	$redirect = add_query_arg(
		array(
			'pivora_lead_status' => sanitize_key( $status ),
			'pivora_lead_block'  => sanitize_key( $block_id ),
		),
		$redirect
	);

	wp_safe_redirect( $redirect );
	exit;
}

/**
 * Returns whether a lead capture success message should display for a block.
 *
 * @param string $block_id Block instance id.
 */
function pivora_core_lead_capture_show_success( string $block_id ): bool {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$status = isset( $_GET['pivora_lead_status'] ) ? sanitize_key( wp_unslash( (string) $_GET['pivora_lead_status'] ) ) : '';
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$query_block = isset( $_GET['pivora_lead_block'] ) ? sanitize_key( wp_unslash( (string) $_GET['pivora_lead_block'] ) ) : '';

	return 'success' === $status && $query_block === $block_id;
}
