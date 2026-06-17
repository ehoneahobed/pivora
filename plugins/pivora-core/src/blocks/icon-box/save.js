import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { icon, title, content } = attributes;
	const blockProps = useBlockProps.save( {
		className: 'pivora-icon-box',
	} );

	return (
		<div { ...blockProps }>
			<p className="pivora-icon-box__icon">{ icon }</p>
			<RichText.Content
				tagName="h3"
				className="pivora-icon-box__title"
				value={ title }
			/>
			<RichText.Content
				tagName="p"
				className="pivora-icon-box__copy"
				value={ content }
			/>
		</div>
	);
}
