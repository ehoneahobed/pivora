<?php
/**
 * Registers Pivora Core custom post types.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once PIVORA_CORE_PATH . 'includes/cpt/helpers.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/client-logo.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/case-study.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/team-member.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/team-member-card.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/case-study-card.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/admin-columns.php';
require_once PIVORA_CORE_PATH . 'includes/cpt/seed-demo.php';
