import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { question, answer, openByDefault } = attributes;
	const blockProps = useBlockProps.save( {
		className: 'pivora-faq-item',
	} );

	return (
		<details { ...blockProps } open={ openByDefault || undefined }>
			<summary>
				<RichText.Content tagName="span" value={ question } />
			</summary>
			<RichText.Content tagName="p" value={ answer } />
		</details>
	);
}
