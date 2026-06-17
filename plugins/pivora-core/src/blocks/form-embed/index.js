import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

const PROVIDER_OPTIONS = [
	{ label: __( 'Auto-detect first plugin', 'pivora-core' ), value: 'auto' },
	{ label: 'WPForms', value: 'wpforms' },
	{ label: 'Contact Form 7', value: 'cf7' },
	{ label: 'Forminator', value: 'forminator' },
	{ label: __( 'Custom shortcode', 'pivora-core' ), value: 'shortcode' },
];

function Edit( { attributes, setAttributes } ) {
	const { provider, formId, shortcode, placeholderText } = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-form-embed',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Form source', 'pivora-core' ) }>
					<SelectControl
						label={ __( 'Provider', 'pivora-core' ) }
						value={ provider }
						options={ PROVIDER_OPTIONS }
						onChange={ ( value ) =>
							setAttributes( { provider: value } )
						}
					/>
					{ 'shortcode' !== provider && (
						<TextControl
							label={ __( 'Form ID', 'pivora-core' ) }
							value={ formId }
							onChange={ ( value ) =>
								setAttributes( { formId: value } )
							}
						/>
					) }
					{ 'shortcode' === provider && (
						<TextControl
							label={ __( 'Shortcode', 'pivora-core' ) }
							value={ shortcode }
							onChange={ ( value ) =>
								setAttributes( { shortcode: value } )
							}
						/>
					) }
					<TextControl
						label={ __( 'Editor placeholder', 'pivora-core' ) }
						value={ placeholderText }
						onChange={ ( value ) =>
							setAttributes( { placeholderText: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p className="pivora-form-embed__placeholder">
					{ placeholderText }
				</p>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
