<?php
/**
 * Plugin Name: Pivora Core
 * Plugin URI: https://github.com/ehoneahobed/pivora
 * Description: Custom blocks, demo import, and bonus patterns for the Pivora theme.
 * Version: 0.1.0
 * Requires at least: 6.5
 * Requires PHP: 8.0
 * Author: ehoneahobed
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pivora-core
 * Domain Path: /languages
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PIVORA_CORE_VERSION', '0.1.0' );
define( 'PIVORA_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'PIVORA_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once PIVORA_CORE_PATH . 'includes/class-pivora-core.php';
require_once PIVORA_CORE_PATH . 'includes/blocks.php';
require_once PIVORA_CORE_PATH . 'includes/patterns.php';
require_once PIVORA_CORE_PATH . 'includes/demo-import.php';
require_once PIVORA_CORE_PATH . 'includes/admin.php';

Pivora_Core::instance();
