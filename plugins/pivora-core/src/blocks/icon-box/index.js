import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { SurfaceStylePanel, getModifierClassName } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { icon, title, content } = attributes;
	const blockProps = useBlockProps( {
		className: getModifierClassName( 'pivora-icon-box', attributes, {
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
				<PanelBody title={ __( 'Icon', 'pivora-core' ) }>
					<TextControl
						label={ __( 'Icon label', 'pivora-core' ) }
						help={ __(
							'Use numbers, initials, or emoji.',
							'pivora-core'
						) }
						value={ icon }
						onChange={ ( value ) =>
							setAttributes( { icon: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p className="pivora-icon-box__icon">{ icon }</p>
				<RichText
					tagName="h3"
					className="pivora-icon-box__title"
					value={ title }
					onChange={ ( value ) => setAttributes( { title: value } ) }
					placeholder={ __( 'Feature title', 'pivora-core' ) }
				/>
				<RichText
					tagName="p"
					className="pivora-icon-box__copy"
					value={ content }
					onChange={ ( value ) =>
						setAttributes( { content: value } )
					}
					placeholder={ __( 'Supporting copy…', 'pivora-core' ) }
				/>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
