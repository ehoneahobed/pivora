import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { label, links } = attributes;
	const blockProps = useBlockProps.save( {
		className: 'pivora-social-links-bar',
	} );

	return (
		<div { ...blockProps }>
			<RichText.Content
				tagName="span"
				className="pivora-social-links-bar__label"
				value={ label }
			/>
			<ul className="pivora-social-links-bar__list">
				{ links.map( ( link, index ) => (
					<li key={ `social-link-${ index }` }>
						<a href={ link.url || undefined }>{ link.label }</a>
					</li>
				) ) }
			</ul>
		</div>
	);
}
