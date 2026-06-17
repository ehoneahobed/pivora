import { useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

export default function save( { attributes } ) {
	const { announcementId, message, linkText, linkUrl, dismissible } =
		attributes;
	const blockProps = useBlockProps.save( {
		className: 'pivora-announcement-bar',
		'data-announcement-id': announcementId,
		'data-dismissible': dismissible ? 'true' : 'false',
	} );

	return (
		<div { ...blockProps }>
			<div className="pivora-announcement-bar__inner">
				<RichText.Content
					tagName="p"
					className="pivora-announcement-bar__message"
					value={ message }
				/>
				{ linkText && (
					<RichText.Content
						tagName="a"
						className="pivora-announcement-bar__link"
						value={ linkText }
						href={ linkUrl || undefined }
					/>
				) }
			</div>
			{ dismissible && (
				<button
					type="button"
					className="pivora-announcement-bar__dismiss"
					aria-label={ __( 'Dismiss announcement', 'pivora-core' ) }
				>
					×
				</button>
			) }
		</div>
	);
}
