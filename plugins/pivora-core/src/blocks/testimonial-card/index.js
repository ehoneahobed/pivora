import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { quote, initials, name, role } = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-testimonial-card',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Author', 'pivora-core' ) }>
					<TextControl
						label={ __( 'Initials', 'pivora-core' ) }
						value={ initials }
						onChange={ ( value ) =>
							setAttributes( { initials: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<blockquote className="pivora-testimonial-card__quote">
					<RichText
						tagName="p"
						value={ quote }
						onChange={ ( value ) =>
							setAttributes( { quote: value } )
						}
						placeholder={ __(
							'Testimonial quote…',
							'pivora-core'
						) }
					/>
				</blockquote>
				<div className="pivora-testimonial-card__author">
					<p className="pivora-testimonial-card__avatar">
						{ initials }
					</p>
					<div className="pivora-testimonial-card__meta">
						<RichText
							tagName="p"
							className="pivora-testimonial-card__name"
							value={ name }
							onChange={ ( value ) =>
								setAttributes( { name: value } )
							}
							placeholder={ __( 'Name', 'pivora-core' ) }
						/>
						<RichText
							tagName="p"
							className="pivora-testimonial-card__role"
							value={ role }
							onChange={ ( value ) =>
								setAttributes( { role: value } )
							}
							placeholder={ __( 'Role', 'pivora-core' ) }
						/>
					</div>
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
