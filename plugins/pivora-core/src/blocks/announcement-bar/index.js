import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { BarStylePanel, getModifierClassName } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { announcementId, message, linkText, linkUrl, dismissible } =
		attributes;
	const blockProps = useBlockProps( {
		className: getModifierClassName(
			'pivora-announcement-bar',
			attributes,
			{
				barStyle: 'bar',
			}
		),
	} );

	return (
		<>
			<BarStylePanel
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<InspectorControls>
				<PanelBody
					title={ __( 'Announcement settings', 'pivora-core' ) }
				>
					<TextControl
						label={ __( 'Announcement ID', 'pivora-core' ) }
						help={ __(
							'Change this when the message changes so dismiss resets for visitors.',
							'pivora-core'
						) }
						value={ announcementId }
						onChange={ ( value ) =>
							setAttributes( { announcementId: value } )
						}
					/>
					<TextControl
						label={ __( 'Link URL', 'pivora-core' ) }
						value={ linkUrl }
						onChange={ ( value ) =>
							setAttributes( { linkUrl: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Dismissible', 'pivora-core' ) }
						checked={ dismissible }
						onChange={ ( value ) =>
							setAttributes( { dismissible: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div
				{ ...blockProps }
				data-announcement-id={ announcementId }
				data-dismissible={ dismissible ? 'true' : 'false' }
			>
				<div className="pivora-announcement-bar__inner">
					<RichText
						tagName="p"
						className="pivora-announcement-bar__message"
						value={ message }
						onChange={ ( value ) =>
							setAttributes( { message: value } )
						}
						placeholder={ __(
							'Announcement message…',
							'pivora-core'
						) }
					/>
					<RichText
						tagName="a"
						className="pivora-announcement-bar__link"
						value={ linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
						placeholder={ __( 'Link label', 'pivora-core' ) }
						href={ linkUrl || '#' }
					/>
				</div>
				{ dismissible && (
					<button
						type="button"
						className="pivora-announcement-bar__dismiss"
						aria-label={ __(
							'Dismiss announcement',
							'pivora-core'
						) }
					>
						×
					</button>
				) }
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
