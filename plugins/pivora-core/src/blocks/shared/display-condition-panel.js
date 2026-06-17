import { PanelBody, SelectControl, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const CONDITION_OPTIONS = [
	{
		label: __( 'Always show', 'pivora-core' ),
		value: 'always',
	},
	{
		label: __( 'Logged-in users only', 'pivora-core' ),
		value: 'logged_in',
	},
	{
		label: __( 'Logged-out visitors only', 'pivora-core' ),
		value: 'logged_out',
	},
	{
		label: __( 'URL contains', 'pivora-core' ),
		value: 'url_contains',
	},
	{
		label: __( 'First visit only', 'pivora-core' ),
		value: 'first_visit',
	},
];

export function DisplayConditionPanel( { attributes, setAttributes } ) {
	const { displayCondition, displayConditionValue } = attributes;

	return (
		<PanelBody
			title={ __( 'Display conditions', 'pivora-core' ) }
			initialOpen={ false }
		>
			<SelectControl
				label={ __( 'Show this block when', 'pivora-core' ) }
				value={ displayCondition || 'always' }
				options={ CONDITION_OPTIONS }
				onChange={ ( value ) =>
					setAttributes( { displayCondition: value } )
				}
			/>
			{ 'url_contains' === displayCondition && (
				<TextControl
					label={ __( 'URL substring', 'pivora-core' ) }
					help={ __(
						'Matches the current page path, for example /pricing or ?utm=.',
						'pivora-core'
					) }
					value={ displayConditionValue || '' }
					onChange={ ( value ) =>
						setAttributes( { displayConditionValue: value } )
					}
				/>
			) }
		</PanelBody>
	);
}
