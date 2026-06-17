import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useEffect, useRef } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function setSectionBillingCycle( section, cycle ) {
	if ( ! section ) {
		return;
	}

	section.setAttribute( 'data-billing-cycle', cycle );
}

function Edit( { attributes, setAttributes } ) {
	const { monthlyLabel, yearlyLabel, saveLabel, defaultCycle, styleVariant } =
		attributes;
	const toggleRef = useRef( null );

	const toggleClass = `pivora-pricing-toggle${
		styleVariant && styleVariant !== 'default'
			? ` pivora-pricing-toggle--${ styleVariant }`
			: ''
	}`;

	const blockProps = useBlockProps( {
		ref: toggleRef,
		className: toggleClass,
		'data-default-cycle': defaultCycle,
	} );

	useEffect( () => {
		const section = toggleRef.current?.closest( '.pivora-pricing-section' );
		setSectionBillingCycle( section, defaultCycle );
	}, [ defaultCycle ] );

	function activateCycle( cycle ) {
		setAttributes( { defaultCycle: cycle } );

		const section = toggleRef.current?.closest( '.pivora-pricing-section' );
		setSectionBillingCycle( section, cycle );
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Toggle settings', 'pivora-core' ) }>
					<SelectControl
						label={ __( 'Default billing cycle', 'pivora-core' ) }
						value={ defaultCycle }
						options={ [
							{
								label: __( 'Monthly', 'pivora-core' ),
								value: 'monthly',
							},
							{
								label: __( 'Yearly', 'pivora-core' ),
								value: 'yearly',
							},
						] }
						onChange={ ( value ) => activateCycle( value ) }
					/>
					<SelectControl
						label={ __( 'Style variant', 'pivora-core' ) }
						value={ styleVariant }
						options={ [
							{
								label: __( 'Default', 'pivora-core' ),
								value: 'default',
							},
							{
								label: __( 'Purple', 'pivora-core' ),
								value: 'purple',
							},
							{
								label: __( 'Green', 'pivora-core' ),
								value: 'green',
							},
							{
								label: __( 'Monochrome', 'pivora-core' ),
								value: 'mono',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { styleVariant: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<button
					type="button"
					className={
						defaultCycle === 'monthly'
							? 'pivora-pricing-toggle__option pivora-pricing-toggle__option--active'
							: 'pivora-pricing-toggle__option'
					}
					onClick={ () => activateCycle( 'monthly' ) }
					aria-pressed={ defaultCycle === 'monthly' }
				>
					<RichText
						tagName="span"
						value={ monthlyLabel }
						onChange={ ( value ) =>
							setAttributes( { monthlyLabel: value } )
						}
						placeholder={ __( 'Monthly label', 'pivora-core' ) }
						allowedFormats={ [] }
					/>
				</button>
				<button
					type="button"
					className={
						defaultCycle === 'yearly'
							? 'pivora-pricing-toggle__option pivora-pricing-toggle__option--active'
							: 'pivora-pricing-toggle__option'
					}
					onClick={ () => activateCycle( 'yearly' ) }
					aria-pressed={ defaultCycle === 'yearly' }
				>
					<RichText
						tagName="span"
						value={ yearlyLabel }
						onChange={ ( value ) =>
							setAttributes( { yearlyLabel: value } )
						}
						placeholder={ __( 'Yearly label', 'pivora-core' ) }
						allowedFormats={ [] }
					/>
				</button>
				<span className="pivora-pricing-toggle__save">
					<RichText
						tagName="span"
						value={ saveLabel }
						onChange={ ( value ) =>
							setAttributes( { saveLabel: value } )
						}
						placeholder={ __( 'Save label', 'pivora-core' ) }
						allowedFormats={ [] }
					/>
				</span>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
