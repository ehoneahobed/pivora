import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
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
	const blockProps = useBlockProps.save( {
		className: `pivora-pricing-card pivora-price-card${
			featured ? ' pivora-price-card--featured' : ''
		}`,
	} );
	const featureItems = features
		.split( '\n' )
		.map( ( feature ) => feature.trim() )
		.filter( Boolean );

	return (
		<div { ...blockProps }>
			{ featured && badgeText && (
				<p className="pivora-pricing-card__badge">{ badgeText }</p>
			) }
			<RichText.Content
				tagName="p"
				className="pivora-price-card__tier"
				value={ tier }
			/>
			<h3 className="pivora-pricing-card__price">
				<RichText.Content tagName="span" value={ price } />
				<RichText.Content
					tagName="span"
					className="pivora-price-card__term"
					value={ term }
				/>
			</h3>
			<RichText.Content
				tagName="p"
				className="pivora-price-card__copy"
				value={ description }
			/>
			{ featureItems.length > 0 && (
				<ul className="pivora-price-card__features">
					{ featureItems.map( ( feature ) => (
						<li key={ feature }>{ feature }</li>
					) ) }
				</ul>
			) }
			<div
				className={
					ctaOutline
						? 'wp-block-button is-style-outline'
						: 'wp-block-button'
				}
			>
				<RichText.Content
					tagName="a"
					className="wp-block-button__link wp-element-button"
					value={ ctaText }
					href={ ctaUrl || undefined }
				/>
			</div>
		</div>
	);
}
