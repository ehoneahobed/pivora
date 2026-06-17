import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	RangeControl,
	SelectControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { DisplayConditionPanel } from '../shared/display-condition-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const {
		ctaId,
		title,
		message,
		buttonText,
		buttonUrl,
		position,
		delaySeconds,
	} = attributes;

	const blockProps = useBlockProps( {
		className: `pivora-slide-in-cta pivora-slide-in-cta--${ position } is-visible`,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Slide-in settings', 'pivora-core' ) }>
					<TextControl
						label={ __( 'CTA ID', 'pivora-core' ) }
						help={ __(
							'Change when the offer changes so visitors see it again.',
							'pivora-core'
						) }
						value={ ctaId }
						onChange={ ( value ) =>
							setAttributes( { ctaId: value } )
						}
					/>
					<SelectControl
						label={ __( 'Position', 'pivora-core' ) }
						value={ position }
						options={ [
							{
								label: __( 'Bottom right', 'pivora-core' ),
								value: 'bottom-right',
							},
							{
								label: __( 'Bottom left', 'pivora-core' ),
								value: 'bottom-left',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { position: value } )
						}
					/>
					<RangeControl
						label={ __( 'Delay (seconds)', 'pivora-core' ) }
						value={ delaySeconds }
						onChange={ ( value ) =>
							setAttributes( { delaySeconds: value } )
						}
						min={ 0 }
						max={ 30 }
					/>
					<TextControl
						label={ __( 'Button URL', 'pivora-core' ) }
						value={ buttonUrl }
						onChange={ ( value ) =>
							setAttributes( { buttonUrl: value } )
						}
					/>
				</PanelBody>
				<DisplayConditionPanel
					attributes={ attributes }
					setAttributes={ setAttributes }
				/>
			</InspectorControls>
			<div { ...blockProps } role="dialog" aria-modal="true">
				<button
					type="button"
					className="pivora-slide-in-cta__dismiss"
					aria-label={ __( 'Dismiss', 'pivora-core' ) }
				>
					×
				</button>
				<RichText
					tagName="h3"
					className="pivora-slide-in-cta__title"
					value={ title }
					onChange={ ( value ) => setAttributes( { title: value } ) }
					placeholder={ __( 'CTA title…', 'pivora-core' ) }
				/>
				<RichText
					tagName="p"
					className="pivora-slide-in-cta__message"
					value={ message }
					onChange={ ( value ) =>
						setAttributes( { message: value } )
					}
					placeholder={ __( 'Supporting copy…', 'pivora-core' ) }
				/>
				<RichText
					tagName="a"
					className="pivora-slide-in-cta__button wp-element-button"
					value={ buttonText }
					onChange={ ( value ) =>
						setAttributes( { buttonText: value } )
					}
					placeholder={ __( 'Button label', 'pivora-core' ) }
					href={ buttonUrl || '#' }
				/>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
