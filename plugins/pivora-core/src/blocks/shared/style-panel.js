/**
 * Shared style inspector panels for Pivora Core blocks.
 */

import {
	InspectorControls,
	BlockControls,
	AlignmentToolbar,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export const LINK_STYLE_OPTIONS = [
	{ label: __( 'Pill', 'pivora-core' ), value: 'pill' },
	{ label: __( 'Solid', 'pivora-core' ), value: 'solid' },
	{ label: __( 'Ghost', 'pivora-core' ), value: 'ghost' },
	{ label: __( 'Plain text', 'pivora-core' ), value: 'plain' },
];

export const LAYOUT_OPTIONS = [
	{
		label: __( 'Inline (label beside links)', 'pivora-core' ),
		value: 'inline',
	},
	{ label: __( 'Stacked', 'pivora-core' ), value: 'stacked' },
	{ label: __( 'Label above links', 'pivora-core' ), value: 'label-above' },
];

export const SURFACE_STYLE_OPTIONS = [
	{ label: __( 'Card', 'pivora-core' ), value: 'card' },
	{ label: __( 'Soft', 'pivora-core' ), value: 'soft' },
	{ label: __( 'Outline', 'pivora-core' ), value: 'outline' },
	{ label: __( 'Minimal', 'pivora-core' ), value: 'minimal' },
];

export const BAR_STYLE_OPTIONS = [
	{ label: __( 'Default', 'pivora-core' ), value: 'default' },
	{ label: __( 'Compact', 'pivora-core' ), value: 'compact' },
	{ label: __( 'Bold', 'pivora-core' ), value: 'bold' },
];

/**
 * Builds modifier class names for editor preview parity.
 *
 * @param {string}                 baseClass   Block base class.
 * @param {Object}                 attributes  Block attributes.
 * @param {Object<string, string>} modifierMap Attribute to modifier map.
 * @return {string} Combined modifier class names for the block wrapper.
 */
export function getModifierClassName( baseClass, attributes, modifierMap ) {
	const classes = [ baseClass ];

	Object.entries( modifierMap ).forEach( ( [ attributeKey, modifier ] ) => {
		const value = attributes[ attributeKey ];

		if ( value && value !== 'default' && value !== 'card' ) {
			classes.push( `${ baseClass }--${ modifier }-${ value }` );
		}
	} );

	if ( attributes.showLabel === false ) {
		classes.push( `${ baseClass }--no-label` );
	}

	return classes.join( ' ' );
}

/**
 * Alignment toolbar for content positioning.
 *
 * @param {Object}   props               Component props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Attribute setter.
 * @param {string}   props.attributeKey  Attribute key for alignment.
 */
export function ContentAlignToolbar( {
	attributes,
	setAttributes,
	attributeKey = 'contentAlign',
} ) {
	const value = attributes[ attributeKey ] || 'left';

	return (
		<BlockControls group="block">
			<AlignmentToolbar
				value={ value }
				onChange={ ( nextValue ) =>
					setAttributes( {
						[ attributeKey ]: nextValue || 'left',
					} )
				}
			/>
		</BlockControls>
	);
}

/**
 * Inspector panel for social links bar layout and link styles.
 *
 * @param {Object}   props               Component props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Attribute setter.
 */
export function SocialLinksStylePanel( { attributes, setAttributes } ) {
	const { layout, linkStyle, showLabel, labelTransform, contentAlign } =
		attributes;

	return (
		<>
			<ContentAlignToolbar
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<InspectorControls>
				<PanelBody
					title={ __( 'Layout & alignment', 'pivora-core' ) }
					initialOpen={ true }
				>
					<SelectControl
						label={ __( 'Layout', 'pivora-core' ) }
						value={ layout || 'inline' }
						options={ LAYOUT_OPTIONS }
						onChange={ ( value ) =>
							setAttributes( { layout: value } )
						}
					/>
					<SelectControl
						label={ __( 'Content alignment', 'pivora-core' ) }
						value={ contentAlign || 'left' }
						options={ [
							{
								label: __( 'Left', 'pivora-core' ),
								value: 'left',
							},
							{
								label: __( 'Center', 'pivora-core' ),
								value: 'center',
							},
							{
								label: __( 'Right', 'pivora-core' ),
								value: 'right',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { contentAlign: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Show label', 'pivora-core' ) }
						checked={ showLabel !== false }
						onChange={ ( value ) =>
							setAttributes( { showLabel: value } )
						}
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Link appearance', 'pivora-core' ) }
					initialOpen={ true }
				>
					<SelectControl
						label={ __( 'Link style', 'pivora-core' ) }
						value={ linkStyle || 'pill' }
						options={ LINK_STYLE_OPTIONS }
						onChange={ ( value ) =>
							setAttributes( { linkStyle: value } )
						}
					/>
					<SelectControl
						label={ __( 'Label text style', 'pivora-core' ) }
						value={ labelTransform || 'uppercase' }
						options={ [
							{
								label: __( 'Uppercase label', 'pivora-core' ),
								value: 'uppercase',
							},
							{
								label: __( 'Sentence case', 'pivora-core' ),
								value: 'normal',
							},
							{
								label: __( 'Muted label', 'pivora-core' ),
								value: 'muted',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { labelTransform: value } )
						}
					/>
					<p className="components-base-control__help">
						{ __(
							'Use the block Typography and Colors panels for fonts, sizes, and palette.',
							'pivora-core'
						) }
					</p>
				</PanelBody>
			</InspectorControls>
		</>
	);
}

/**
 * Inspector panel for card-like block surfaces.
 *
 * @param {Object}   props               Component props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Attribute setter.
 */
export function SurfaceStylePanel( { attributes, setAttributes } ) {
	return (
		<InspectorControls>
			<PanelBody title={ __( 'Surface style', 'pivora-core' ) }>
				<SelectControl
					label={ __( 'Card appearance', 'pivora-core' ) }
					value={ attributes.surfaceStyle || 'card' }
					options={ SURFACE_STYLE_OPTIONS }
					onChange={ ( value ) =>
						setAttributes( { surfaceStyle: value } )
					}
				/>
				<p className="components-base-control__help">
					{ __(
						'Typography, colors, spacing, and borders are available in the block sidebar.',
						'pivora-core'
					) }
				</p>
			</PanelBody>
		</InspectorControls>
	);
}

/**
 * Inspector panel for announcement bar density.
 *
 * @param {Object}   props               Component props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Attribute setter.
 */
export function BarStylePanel( { attributes, setAttributes } ) {
	return (
		<InspectorControls>
			<PanelBody title={ __( 'Bar style', 'pivora-core' ) }>
				<SelectControl
					label={ __( 'Appearance', 'pivora-core' ) }
					value={ attributes.barStyle || 'default' }
					options={ BAR_STYLE_OPTIONS }
					onChange={ ( value ) =>
						setAttributes( { barStyle: value } )
					}
				/>
			</PanelBody>
		</InspectorControls>
	);
}
