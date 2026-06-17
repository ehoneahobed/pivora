<?php
/**
 * Third-party form plugin bridge for Pivora Core.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns detected form providers available on the site.
 *
 * @return array<string, array<string, string>>
 */
function pivora_core_get_form_providers(): array {
	$providers = array();

	if ( function_exists( 'wpforms' ) || class_exists( 'WPForms\WPForms' ) ) {
		$providers['wpforms'] = array(
			'label'     => 'WPForms',
			'shortcode' => 'wpforms',
		);
	}

	if ( class_exists( 'WPCF7' ) ) {
		$providers['cf7'] = array(
			'label'     => 'Contact Form 7',
			'shortcode' => 'contact-form-7',
		);
	}

	if ( defined( 'FORMINATOR_VERSION' ) || class_exists( 'Forminator' ) ) {
		$providers['forminator'] = array(
			'label'     => 'Forminator',
			'shortcode' => 'forminator_form',
		);
	}

	/**
	 * Filters registered form providers for the embed bridge.
	 *
	 * @param array<string, array<string, string>> $providers Provider map.
	 */
	return apply_filters( 'pivora_core_form_providers', $providers );
}

/**
 * Returns whether any supported form plugin is active.
 */
function pivora_core_has_form_plugin(): bool {
	return ! empty( pivora_core_get_form_providers() );
}

/**
 * Builds a shortcode for a provider and form id.
 *
 * @param string $provider Provider slug.
 * @param string $form_id  Form id or post id.
 */
function pivora_core_build_form_shortcode( string $provider, string $form_id ): string {
	$form_id = sanitize_text_field( $form_id );

	if ( '' === $form_id ) {
		return '';
	}

	switch ( $provider ) {
		case 'wpforms':
			return '[wpforms id="' . absint( $form_id ) . '"]';
		case 'cf7':
			return '[contact-form-7 id="' . esc_attr( $form_id ) . '"]';
		case 'forminator':
			return '[forminator_form id="' . absint( $form_id ) . '"]';
		default:
			/**
			 * Filters a custom provider shortcode.
			 *
			 * @param string $shortcode Empty default.
			 * @param string $provider  Provider slug.
			 * @param string $form_id   Form id.
			 */
			return (string) apply_filters( 'pivora_core_form_shortcode', '', $provider, $form_id );
	}
}

/**
 * Renders a style-preserving form embed wrapper.
 *
 * @param string $provider  Provider slug or "shortcode".
 * @param string $form_id     Form id when using a provider.
 * @param string $shortcode   Raw shortcode when provider is shortcode.
 */
function pivora_core_render_form_embed( string $provider, string $form_id = '', string $shortcode = '' ): string {
	$provider = sanitize_key( $provider );

	if ( 'shortcode' === $provider ) {
		$shortcode = trim( $shortcode );
	} else {
		$shortcode = pivora_core_build_form_shortcode( $provider, $form_id );
	}

	if ( '' === $shortcode ) {
		return '';
	}

	$provider_class = 'shortcode' === $provider ? 'custom' : $provider;

	ob_start();
	?>
	<div class="pivora-form-embed pivora-form-embed--<?php echo esc_attr( $provider_class ); ?>">
		<?php echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<?php
	return (string) ob_get_clean();
}
