import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { SurfaceStylePanel, getModifierClassName } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { question, answer, openByDefault } = attributes;
	const blockProps = useBlockProps( {
		className: getModifierClassName( 'pivora-faq-item', attributes, {
			surfaceStyle: 'surface',
		} ),
	} );

	return (
		<>
			<SurfaceStylePanel
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<InspectorControls>
				<PanelBody title={ __( 'FAQ settings', 'pivora-core' ) }>
					<ToggleControl
						label={ __( 'Open by default', 'pivora-core' ) }
						checked={ openByDefault }
						onChange={ ( value ) =>
							setAttributes( { openByDefault: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<details { ...blockProps } open={ openByDefault || undefined }>
				<summary>
					<RichText
						tagName="span"
						value={ question }
						onChange={ ( value ) =>
							setAttributes( { question: value } )
						}
						placeholder={ __( 'Question', 'pivora-core' ) }
						allowedFormats={ [] }
					/>
				</summary>
				<RichText
					tagName="p"
					value={ answer }
					onChange={ ( value ) => setAttributes( { answer: value } ) }
					placeholder={ __( 'Answer…', 'pivora-core' ) }
				/>
			</details>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
