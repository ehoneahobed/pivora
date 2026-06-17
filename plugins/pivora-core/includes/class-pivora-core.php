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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_pricing_toggle_script' ) );
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

	/**
	 * Enqueues pricing toggle interactions for legacy and block-based toggles.
	 */
	public function enqueue_pricing_toggle_script(): void {
		$asset_file = PIVORA_CORE_PATH . 'build/blocks/pricing-billing-toggle/view.asset.php';

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$asset = include $asset_file;

		wp_enqueue_script(
			'pivora-pricing-billing-toggle',
			plugins_url( 'build/blocks/pricing-billing-toggle/view.js', PIVORA_CORE_PATH . 'pivora-core.php' ),
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}
