<?php
/**
 * Title: Announcement bar
 * Slug: pivora-core/announcement-bar
 * Categories: pivora-core, pivora-sections
 * Viewport width: 1440
 *
 * @package Pivora_Core
 */

pivora_core_block(
	'pivora/announcement-bar',
	array(
		'announcementId' => 'pivora-launch',
		'message'        => __( 'Pivora 1.0 is live — explore the new pattern library and custom blocks.', 'pivora-core' ),
		'linkText'       => __( 'View demo', 'pivora-core' ),
		'linkUrl'        => home_url( '/' ),
		'dismissible'    => true,
	)
);
