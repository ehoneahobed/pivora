<?php
/**
 * PHPUnit bootstrap for Pivora Core tests.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

$autoload = dirname( __DIR__, 3 ) . '/vendor/autoload.php';

if ( file_exists( $autoload ) ) {
	require_once $autoload;
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/tmp/wordpress/' );
}

if ( ! defined( 'OBJECT' ) ) {
	define( 'OBJECT', 'OBJECT' );
}

if ( ! function_exists( '__' ) ) {
	/**
	 * Minimal translation stub for unit tests.
	 *
	 * @param string $text Text.
	 * @return string
	 */
	function __( string $text ): string {
		return $text;
	}
}

if ( ! class_exists( 'WP_Error' ) ) {
	/**
	 * Minimal WP_Error stub for unit tests.
	 */
	class WP_Error { // phpcs:ignore Generic.Classes.DuplicateClassName.Found
		/**
		 * @param string $code Error code.
		 * @param string $message Error message.
		 */
		public function __construct(
			public string $code = '',
			public string $message = ''
		) {
		}
	}
}

require_once dirname( __DIR__ ) . '/includes/starter-studio/snapshot.php';
