<?php
/**
 * Pivora theme bootstrap.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PIVORA_VERSION', '0.1.0' );
define( 'PIVORA_PATH', trailingslashit( get_template_directory() ) );
define( 'PIVORA_URI', trailingslashit( get_template_directory_uri() ) );

require_once PIVORA_PATH . 'inc/setup.php';
require_once PIVORA_PATH . 'inc/assets.php';
require_once PIVORA_PATH . 'inc/patterns.php';
require_once PIVORA_PATH . 'inc/template-tags.php';
require_once PIVORA_PATH . 'inc/post-media.php';
require_once PIVORA_PATH . 'inc/blog-layouts.php';
require_once PIVORA_PATH . 'inc/blog-archive.php';
require_once PIVORA_PATH . 'inc/woocommerce.php';
