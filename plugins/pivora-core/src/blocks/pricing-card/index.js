import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	TextareaControl,
	ToggleControl,
	SelectControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useEffect, useRef, useState } from '@wordpress/element';
import metadata from './block.json';
import './style.scss';

function featureItems( value ) {
	return value
		.split( '\n' )
		.map( ( feature ) => feature.trim() )
		.filter( Boolean );
}

function FeatureList( { included, excluded, variant } ) {
	const includedItems = featureItems( included );
	const excludedItems = featureItems( excluded );
	const listClass =
		variant === 'spotlight'
			? 'pivora-price-card__feature-list'
			: 'pivora-price-card__features';

	if ( ! includedItems.length && ! excludedItems.length ) {
		return null;
	}

	return (
		<ul className={ listClass }>
			{ includedItems.map( ( feature ) => (
				<li
					key={ `included-${ feature }` }
					className="pivora-price-card__feature pivora-price-card__feature--included"
				>
					{ feature }
				</li>
			) ) }
			{ variant === 'spotlight' &&
				excludedItems.map( ( feature ) => (
					<li
						key={ `excluded-${ feature }` }
						className="pivora-price-card__feature pivora-price-card__feature--excluded"
					>
						{ feature }
					</li>
				) ) }
		</ul>
	);
}

function PriceRow( { price, term, priceYearly, termYearly, setAttributes } ) {
	const priceRef = useRef( null );
	const [ billingCycle, setBillingCycle ] = useState( 'monthly' );

	useEffect( () => {
		const section = priceRef.current?.closest( '.pivora-pricing-section' );

		if ( ! section ) {
			return undefined;
		}

		const syncCycle = () => {
			setBillingCycle(
				section.getAttribute( 'data-billing-cycle' ) === 'yearly'
					? 'yearly'
					: 'monthly'
			);
		};

		syncCycle();

		/* global MutationObserver */
		const observer = new MutationObserver( syncCycle );
		observer.observe( section, {
			attributes: true,
			attributeFilter: [ 'data-billing-cycle' ],
		} );

		return () => observer.disconnect();
	}, [] );

	const isYearly = billingCycle === 'yearly';
	const displayPrice = isYearly && priceYearly ? priceYearly : price;
	const displayTerm = isYearly && termYearly ? termYearly : term;

	return (
		<h3 ref={ priceRef } className="pivora-pricing-card__price">
			<RichText
				tagName="span"
				className="pivora-pricing-card__price-value"
				value={ displayPrice }
				onChange={ ( value ) =>
					setAttributes(
						isYearly ? { priceYearly: value } : { price: value }
					)
				}
				withoutInteractiveFormatting
			/>
			<RichText
				tagName="span"
				className="pivora-price-card__term"
				value={ displayTerm }
				onChange={ ( value ) =>
					setAttributes(
						isYearly ? { termYearly: value } : { term: value }
					)
				}
				withoutInteractiveFormatting
			/>
		</h3>
	);
}

function Edit( { attributes, setAttributes } ) {
	const {
		tier,
		price,
		term,
		priceYearly,
		termYearly,
		description,
		features,
		includedFeatures,
		excludedFeatures,
		ctaText,
		ctaUrl,
		featured,
		badgeText,
		ctaOutline,
		variant,
	} = attributes;

	const isSpotlight = variant === 'spotlight';
	const resolvedIncluded = includedFeatures || features;

	const blockProps = useBlockProps( {
		className: `pivora-pricing-card pivora-price-card${
			isSpotlight ? ' pivora-price-card--spotlight' : ''
		}${ featured ? ' pivora-price-card--featured' : '' }`,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Plan settings', 'pivora-core' ) }>
					<SelectControl
						label={ __( 'Card style', 'pivora-core' ) }
						value={ variant }
						options={ [
							{
								label: __( 'Classic', 'pivora-core' ),
								value: 'classic',
							},
							{
								label: __( 'Spotlight', 'pivora-core' ),
								value: 'spotlight',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { variant: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Featured plan', 'pivora-core' ) }
						checked={ featured }
						onChange={ ( value ) =>
							setAttributes( { featured: value } )
						}
					/>
					<TextControl
						label={ __( 'Price', 'pivora-core' ) }
						value={ price }
						onChange={ ( value ) =>
							setAttributes( { price: value } )
						}
					/>
					<TextControl
						label={ __( 'Billing term', 'pivora-core' ) }
						value={ term }
						onChange={ ( value ) =>
							setAttributes( { term: value } )
						}
					/>
					<TextControl
						label={ __( 'Yearly price', 'pivora-core' ) }
						help={ __(
							'Optional. Shown when visitors switch to yearly billing.',
							'pivora-core'
						) }
						value={ priceYearly }
						onChange={ ( value ) =>
							setAttributes( { priceYearly: value } )
						}
					/>
					<TextControl
						label={ __( 'Yearly billing term', 'pivora-core' ) }
						value={ termYearly }
						onChange={ ( value ) =>
							setAttributes( { termYearly: value } )
						}
					/>
					{ isSpotlight ? (
						<>
							<TextareaControl
								label={ __(
									'Included features',
									'pivora-core'
								) }
								help={ __(
									'One feature per line. Shown with a checkmark.',
									'pivora-core'
								) }
								value={ includedFeatures }
								onChange={ ( value ) =>
									setAttributes( {
										includedFeatures: value,
									} )
								}
							/>
							<TextareaControl
								label={ __(
									'Excluded features',
									'pivora-core'
								) }
								help={ __(
									'One feature per line. Shown with an X icon.',
									'pivora-core'
								) }
								value={ excludedFeatures }
								onChange={ ( value ) =>
									setAttributes( {
										excludedFeatures: value,
									} )
								}
							/>
						</>
					) : (
						<TextareaControl
							label={ __( 'Features', 'pivora-core' ) }
							help={ __(
								'One feature per line.',
								'pivora-core'
							) }
							value={ features }
							onChange={ ( value ) =>
								setAttributes( { features: value } )
							}
						/>
					) }
					<ToggleControl
						label={ __( 'Outline button', 'pivora-core' ) }
						checked={ ctaOutline }
						onChange={ ( value ) =>
							setAttributes( { ctaOutline: value } )
						}
					/>
					{ ! isSpotlight && (
						<TextControl
							label={ __( 'Badge text', 'pivora-core' ) }
							help={ __(
								'Shown on featured plans only.',
								'pivora-core'
							) }
							value={ badgeText }
							onChange={ ( value ) =>
								setAttributes( { badgeText: value } )
							}
						/>
					) }
					<TextControl
						label={ __( 'Button URL', 'pivora-core' ) }
						value={ ctaUrl }
						onChange={ ( value ) =>
							setAttributes( { ctaUrl: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				{ featured && badgeText && ! isSpotlight && (
					<p className="pivora-pricing-card__badge">{ badgeText }</p>
				) }
				<RichText
					tagName="p"
					className="pivora-price-card__tier"
					value={ tier }
					onChange={ ( value ) => setAttributes( { tier: value } ) }
					placeholder={ __( 'Plan name', 'pivora-core' ) }
				/>
				{ isSpotlight ? (
					<>
						<RichText
							tagName="p"
							className="pivora-price-card__copy"
							value={ description }
							onChange={ ( value ) =>
								setAttributes( { description: value } )
							}
							placeholder={ __( 'Plan summary…', 'pivora-core' ) }
						/>
						<PriceRow
							price={ price }
							term={ term }
							priceYearly={ priceYearly }
							termYearly={ termYearly }
							setAttributes={ setAttributes }
						/>
						<div
							className={
								ctaOutline
									? 'wp-block-button is-style-outline'
									: 'wp-block-button'
							}
						>
							<RichText
								tagName="a"
								className="wp-block-button__link wp-element-button"
								value={ ctaText }
								onChange={ ( value ) =>
									setAttributes( { ctaText: value } )
								}
								placeholder={ __(
									'Button label',
									'pivora-core'
								) }
								href={ ctaUrl || '#' }
							/>
						</div>
						<FeatureList
							included={ resolvedIncluded }
							excluded={ excludedFeatures }
							variant={ variant }
						/>
					</>
				) : (
					<>
						<PriceRow
							price={ price }
							term={ term }
							priceYearly={ priceYearly }
							termYearly={ termYearly }
							setAttributes={ setAttributes }
						/>
						<RichText
							tagName="p"
							className="pivora-price-card__copy"
							value={ description }
							onChange={ ( value ) =>
								setAttributes( { description: value } )
							}
							placeholder={ __( 'Plan summary…', 'pivora-core' ) }
						/>
						<FeatureList
							included={ resolvedIncluded }
							excluded={ excludedFeatures }
							variant={ variant }
						/>
						<div
							className={
								ctaOutline
									? 'wp-block-button is-style-outline'
									: 'wp-block-button'
							}
						>
							<RichText
								tagName="a"
								className="wp-block-button__link wp-element-button"
								value={ ctaText }
								onChange={ ( value ) =>
									setAttributes( { ctaText: value } )
								}
								placeholder={ __(
									'Button label',
									'pivora-core'
								) }
								href={ ctaUrl || '#' }
							/>
						</div>
					</>
				) }
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
