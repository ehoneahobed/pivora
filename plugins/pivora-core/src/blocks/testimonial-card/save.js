import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { quote, initials, name, role } = attributes;
	const blockProps = useBlockProps.save( {
		className: 'pivora-testimonial-card',
	} );

	return (
		<div { ...blockProps }>
			<blockquote className="pivora-testimonial-card__quote">
				<RichText.Content tagName="p" value={ quote } />
			</blockquote>
			<div className="pivora-testimonial-card__author">
				<p className="pivora-testimonial-card__avatar">{ initials }</p>
				<div className="pivora-testimonial-card__meta">
					<RichText.Content
						tagName="p"
						className="pivora-testimonial-card__name"
						value={ name }
					/>
					<RichText.Content
						tagName="p"
						className="pivora-testimonial-card__role"
						value={ role }
					/>
				</div>
			</div>
		</div>
	);
}
