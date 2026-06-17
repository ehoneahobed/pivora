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
	const { initials, name, role, bio } = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-team-member',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Avatar', 'pivora-core' ) }>
					<TextControl
						label={ __( 'Initials', 'pivora-core' ) }
						help={ __(
							'Use two letters until you add a photo block above.',
							'pivora-core'
						) }
						value={ initials }
						onChange={ ( value ) =>
							setAttributes( { initials: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p className="pivora-team-member__avatar">{ initials }</p>
				<RichText
					tagName="h3"
					className="pivora-team-member__name"
					value={ name }
					onChange={ ( value ) => setAttributes( { name: value } ) }
					placeholder={ __( 'Name', 'pivora-core' ) }
				/>
				<RichText
					tagName="p"
					className="pivora-team-member__role"
					value={ role }
					onChange={ ( value ) => setAttributes( { role: value } ) }
					placeholder={ __( 'Role', 'pivora-core' ) }
				/>
				<RichText
					tagName="p"
					className="pivora-team-member__bio"
					value={ bio }
					onChange={ ( value ) => setAttributes( { bio: value } ) }
					placeholder={ __( 'Short bio…', 'pivora-core' ) }
				/>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
