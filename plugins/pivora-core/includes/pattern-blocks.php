<?php
/**
 * Pattern block helpers for Pivora Core.
 *
 * @package Pivora_Core
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
function pivora_core_block( string $name, array $attributes = array() ): void {
	$json = wp_json_encode( $attributes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );

	echo sprintf(
		"<!-- wp:%s %s /-->\n",
		$name,
		$json ?: '{}'
	);
}
