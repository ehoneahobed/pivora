<?php
/**
 * Team member block render callback.
 *
 * @package Pivora_Core
 *
 * @var array<string, mixed> $attributes Block attributes.
 * @var string               $content    Block content.
 * @var WP_Block             $block      Block instance.
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$member_id = isset( $attributes['memberId'] ) ? (int) $attributes['memberId'] : 0;

if ( $member_id > 0 ) {
	$member = pivora_core_get_team_member_data( $member_id );

	if ( $member ) {
		pivora_core_render_team_member_card( $member, $attributes );
		return;
	}
}

$initials = isset( $attributes['initials'] ) ? (string) $attributes['initials'] : '';
$name     = isset( $attributes['name'] ) ? (string) $attributes['name'] : '';
$role     = isset( $attributes['role'] ) ? (string) $attributes['role'] : '';
$bio      = isset( $attributes['bio'] ) ? (string) $attributes['bio'] : '';
$image_id = isset( $attributes['imageId'] ) ? (int) $attributes['imageId'] : 0;

pivora_core_render_team_member_card(
	array(
		'name'     => $name,
		'role'     => $role,
		'bio'      => $bio,
		'initials' => $initials,
		'imageId'  => $image_id,
	),
	$attributes
);
