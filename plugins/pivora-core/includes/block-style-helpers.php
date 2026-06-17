<?php
/**
 * Shared block styling helpers for Pivora Core dynamic blocks.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Builds a BEM-style modifier class for a block.
 *
 * @param string $base_class Block base class.
 * @param string $modifier Modifier name.
 * @param string $value Modifier value.
 * @return string
 */
function pivora_core_block_modifier_class( string $base_class, string $modifier, string $value ): string {
	if ( '' === $value || 'default' === $value ) {
		return '';
	}

	return $base_class . '--' . $modifier . '-' . sanitize_html_class( $value );
}

/**
 * Builds modifier classes from attribute values.
 *
 * @param string                $base_class Block base class.
 * @param array<string, mixed>  $attributes Block attributes.
 * @param array<string, string> $modifier_map Attribute key => modifier slug.
 * @return string
 */
function pivora_core_build_block_modifier_classes( string $base_class, array $attributes, array $modifier_map ): string {
	$classes = array( $base_class );

	foreach ( $modifier_map as $attribute_key => $modifier_slug ) {
		if ( empty( $attributes[ $attribute_key ] ) ) {
			continue;
		}

		$modifier_class = pivora_core_block_modifier_class(
			$base_class,
			$modifier_slug,
			(string) $attributes[ $attribute_key ]
		);

		if ( '' !== $modifier_class ) {
			$classes[] = $modifier_class;
		}
	}

	if ( isset( $attributes['showLabel'] ) && ! $attributes['showLabel'] ) {
		$classes[] = $base_class . '--no-label';
	}

	return implode( ' ', array_unique( $classes ) );
}

/**
 * Returns wrapper attributes with shared modifier classes applied.
 *
 * @param array<string, mixed>  $attributes Block attributes.
 * @param string                $base_class Block base class.
 * @param array<string, string> $modifier_map Attribute key => modifier slug.
 * @param array<string, mixed>  $extra Extra wrapper args.
 * @return string
 */
function pivora_core_get_block_wrapper_attributes( array $attributes, string $base_class, array $modifier_map = array(), array $extra = array() ): string {
	$extra['class'] = pivora_core_build_block_modifier_classes( $base_class, $attributes, $modifier_map );

	return get_block_wrapper_attributes( $extra );
}
