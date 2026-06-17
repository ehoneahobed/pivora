<?php
/**
 * Pivora Core bootstrap class.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin loader.
 */
final class Pivora_Core {

	/**
	 * Plugin singleton.
	 */
	private static ?Pivora_Core $instance = null;

	/**
	 * Returns the plugin instance.
	 */
	public static function instance(): Pivora_Core {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Registers hooks.
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'init', array( $this, 'register_blocks' ), 9 );
	}

	/**
	 * Loads plugin translations.
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain(
			'pivora-core',
			false,
			dirname( plugin_basename( PIVORA_CORE_PATH . 'pivora-core.php' ) ) . '/languages'
		);
	}

	/**
	 * Registers compiled blocks discovered in the build directory.
	 */
	public function register_blocks(): void {
		$blocks_dir = PIVORA_CORE_PATH . 'build/blocks/';

		if ( ! is_dir( $blocks_dir ) ) {
			return;
		}

		$block_paths = glob( $blocks_dir . '*', GLOB_ONLYDIR ) ?: array();

		foreach ( $block_paths as $block_path ) {
			if ( ! file_exists( $block_path . '/block.json' ) ) {
				continue;
			}

			register_block_type( $block_path );
		}
	}
}
