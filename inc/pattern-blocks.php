<?php
/**
 * Helpers for composing block patterns with Pivora Core blocks.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Outputs a self-closing block comment for pattern registration.
 *
 * @param string               $name       Block name, e.g. pivora/faq-item.
 * @param array<string, mixed> $attributes Block attributes.
 */
function pivora_block( string $name, array $attributes = array() ): void {
	$json = wp_json_encode( $attributes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );

	$attrs = $json ? $json : '{}';

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block pattern JSON from wp_json_encode().
	printf(
		"<!-- wp:%s %s /-->\n",
		esc_html( $name ),
		$attrs // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}
