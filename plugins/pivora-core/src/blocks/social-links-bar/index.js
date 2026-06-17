import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { label, links } = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-social-links-bar',
	} );

	const updateLink = ( index, field, value ) => {
		const nextLinks = links.map( ( link, linkIndex ) => {
			if ( linkIndex !== index ) {
				return link;
			}

			return {
				...link,
				[ field ]: value,
			};
		} );

		setAttributes( { links: nextLinks } );
	};

	const addLink = () => {
		setAttributes( {
			links: [
				...links,
				{
					label: __( 'New link', 'pivora-core' ),
					url: '',
				},
			],
		} );
	};

	const removeLink = ( index ) => {
		setAttributes( {
			links: links.filter( ( _, linkIndex ) => linkIndex !== index ),
		} );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Social links', 'pivora-core' ) }>
					{ links.map( ( link, index ) => (
						<div
							key={ `social-link-${ index }` }
							style={ { marginBottom: '1rem' } }
						>
							<TextControl
								label={ __( 'Label', 'pivora-core' ) }
								value={ link.label }
								onChange={ ( value ) =>
									updateLink( index, 'label', value )
								}
							/>
							<TextControl
								label={ __( 'URL', 'pivora-core' ) }
								value={ link.url }
								onChange={ ( value ) =>
									updateLink( index, 'url', value )
								}
							/>
							<Button
								variant="secondary"
								isDestructive
								onClick={ () => removeLink( index ) }
							>
								{ __( 'Remove link', 'pivora-core' ) }
							</Button>
						</div>
					) ) }
					<Button variant="primary" onClick={ addLink }>
						{ __( 'Add link', 'pivora-core' ) }
					</Button>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<RichText
					tagName="span"
					className="pivora-social-links-bar__label"
					value={ label }
					onChange={ ( value ) => setAttributes( { label: value } ) }
					placeholder={ __( 'Follow', 'pivora-core' ) }
				/>
				<ul className="pivora-social-links-bar__list">
					{ links.map( ( link, index ) => (
						<li key={ `social-link-preview-${ index }` }>
							<a href={ link.url || '#' }>{ link.label }</a>
						</li>
					) ) }
				</ul>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
