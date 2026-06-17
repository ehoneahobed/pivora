import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { initials, name, role, bio } = attributes;
	const blockProps = useBlockProps.save( {
		className: 'pivora-team-member',
	} );

	return (
		<div { ...blockProps }>
			<p className="pivora-team-member__avatar">{ initials }</p>
			<RichText.Content
				tagName="h3"
				className="pivora-team-member__name"
				value={ name }
			/>
			<RichText.Content
				tagName="p"
				className="pivora-team-member__role"
				value={ role }
			/>
			<RichText.Content
				tagName="p"
				className="pivora-team-member__bio"
				value={ bio }
			/>
		</div>
	);
}
