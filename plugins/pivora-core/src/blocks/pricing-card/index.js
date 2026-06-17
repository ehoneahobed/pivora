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
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const {
		tier,
		price,
		term,
		description,
		features,
		ctaText,
		ctaUrl,
		featured,
		badgeText,
		ctaOutline,
	} = attributes;
	const blockProps = useBlockProps( {
		className: `pivora-pricing-card pivora-price-card${
			featured ? ' pivora-price-card--featured' : ''
		}`,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Plan settings', 'pivora-core' ) }>
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
					<TextareaControl
						label={ __( 'Features', 'pivora-core' ) }
						help={ __( 'One feature per line.', 'pivora-core' ) }
						value={ features }
						onChange={ ( value ) =>
							setAttributes( { features: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Outline button', 'pivora-core' ) }
						checked={ ctaOutline }
						onChange={ ( value ) =>
							setAttributes( { ctaOutline: value } )
						}
					/>
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
				{ featured && badgeText && (
					<p className="pivora-pricing-card__badge">{ badgeText }</p>
				) }
				<RichText
					tagName="p"
					className="pivora-price-card__tier"
					value={ tier }
					onChange={ ( value ) => setAttributes( { tier: value } ) }
					placeholder={ __( 'Plan name', 'pivora-core' ) }
				/>
				<h3 className="pivora-pricing-card__price">
					<RichText
						tagName="span"
						value={ price }
						onChange={ ( value ) =>
							setAttributes( { price: value } )
						}
						withoutInteractiveFormatting
					/>
					<RichText
						tagName="span"
						className="pivora-price-card__term"
						value={ term }
						onChange={ ( value ) =>
							setAttributes( { term: value } )
						}
						withoutInteractiveFormatting
					/>
				</h3>
				<RichText
					tagName="p"
					className="pivora-price-card__copy"
					value={ description }
					onChange={ ( value ) =>
						setAttributes( { description: value } )
					}
					placeholder={ __( 'Plan summary…', 'pivora-core' ) }
				/>
				<ul className="pivora-price-card__features">
					{ features
						.split( '\n' )
						.map( ( feature ) => feature.trim() )
						.filter( Boolean )
						.map( ( feature ) => (
							<li key={ feature }>{ feature }</li>
						) ) }
				</ul>
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
						placeholder={ __( 'Button label', 'pivora-core' ) }
						href={ ctaUrl || '#' }
					/>
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
