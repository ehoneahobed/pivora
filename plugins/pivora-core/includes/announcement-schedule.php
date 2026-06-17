<?php
/**
 * Announcement bar scheduling helpers.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Parses a schedule date string into a UTC timestamp.
 *
 * @param string $value Date or datetime string.
 */
function pivora_core_parse_schedule_date( string $value ): ?int {
	$value = trim( $value );

	if ( '' === $value ) {
		return null;
	}

	$timestamp = strtotime( $value );

	if ( false === $timestamp ) {
		return null;
	}

	return $timestamp;
}

/**
 * Returns whether an announcement should render for the current time.
 *
 * @param string $schedule_start Optional start datetime.
 * @param string $schedule_end   Optional end datetime.
 */
function pivora_core_announcement_is_scheduled_visible( string $schedule_start, string $schedule_end ): bool {
	$now = time();

	$start = pivora_core_parse_schedule_date( $schedule_start );
	$end   = pivora_core_parse_schedule_date( $schedule_end );

	if ( null !== $start && $now < $start ) {
		return false;
	}

	if ( null !== $end && $now > $end ) {
		return false;
	}

	return true;
}
