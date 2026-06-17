import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	ToggleControl,
	SelectControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const {
		showName,
		showMessage,
		layout,
		buttonText,
		successMessage,
		nameLabel,
		emailLabel,
		messageLabel,
		recipientEmail,
		webhookUrl,
	} = attributes;

	const blockProps = useBlockProps( {
		className: `pivora-lead-capture pivora-lead-capture--${ layout }`,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Form fields', 'pivora-core' ) }>
					<ToggleControl
						label={ __( 'Show name field', 'pivora-core' ) }
						checked={ showName }
						onChange={ ( value ) =>
							setAttributes( { showName: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Show message field', 'pivora-core' ) }
						checked={ showMessage }
						onChange={ ( value ) =>
							setAttributes( { showMessage: value } )
						}
					/>
					<SelectControl
						label={ __( 'Layout', 'pivora-core' ) }
						value={ layout }
						options={ [
							{
								label: __( 'Stacked', 'pivora-core' ),
								value: 'stacked',
							},
							{
								label: __( 'Inline', 'pivora-core' ),
								value: 'inline',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { layout: value } )
						}
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Delivery', 'pivora-core' ) }
					initialOpen={ false }
				>
					<TextControl
						label={ __( 'Recipient email', 'pivora-core' ) }
						help={ __(
							'Leave empty to use the site admin email.',
							'pivora-core'
						) }
						value={ recipientEmail }
						onChange={ ( value ) =>
							setAttributes( { recipientEmail: value } )
						}
					/>
					<TextControl
						label={ __( 'Webhook URL', 'pivora-core' ) }
						help={ __(
							'Optional JSON POST when a lead is submitted.',
							'pivora-core'
						) }
						value={ webhookUrl }
						onChange={ ( value ) =>
							setAttributes( { webhookUrl: value } )
						}
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Labels', 'pivora-core' ) }
					initialOpen={ false }
				>
					<TextControl
						label={ __( 'Button text', 'pivora-core' ) }
						value={ buttonText }
						onChange={ ( value ) =>
							setAttributes( { buttonText: value } )
						}
					/>
					<TextControl
						label={ __( 'Success message', 'pivora-core' ) }
						value={ successMessage }
						onChange={ ( value ) =>
							setAttributes( { successMessage: value } )
						}
					/>
					{ showName && (
						<TextControl
							label={ __( 'Name label', 'pivora-core' ) }
							value={ nameLabel }
							onChange={ ( value ) =>
								setAttributes( { nameLabel: value } )
							}
						/>
					) }
					<TextControl
						label={ __( 'Email label', 'pivora-core' ) }
						value={ emailLabel }
						onChange={ ( value ) =>
							setAttributes( { emailLabel: value } )
						}
					/>
					{ showMessage && (
						<TextControl
							label={ __( 'Message label', 'pivora-core' ) }
							value={ messageLabel }
							onChange={ ( value ) =>
								setAttributes( { messageLabel: value } )
							}
						/>
					) }
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<form
					className="pivora-lead-capture__form"
					onSubmit={ ( e ) => e.preventDefault() }
				>
					{ showName && (
						<div className="pivora-lead-capture__field">
							<span className="pivora-lead-capture__label">
								{ nameLabel }
							</span>
							<input type="text" disabled />
						</div>
					) }
					<div className="pivora-lead-capture__field">
						<span className="pivora-lead-capture__label">
							{ emailLabel }
						</span>
						<input type="email" disabled />
					</div>
					{ showMessage && (
						<div className="pivora-lead-capture__field">
							<span className="pivora-lead-capture__label">
								{ messageLabel }
							</span>
							<textarea rows="4" disabled />
						</div>
					) }
					<button
						type="button"
						className="pivora-lead-capture__submit wp-element-button"
					>
						{ buttonText }
					</button>
				</form>
				<p className="pivora-lead-capture__success">
					{ successMessage }
				</p>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
