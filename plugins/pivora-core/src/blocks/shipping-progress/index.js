import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { goalAmount, message, successMessage } = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-shipping-progress',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Shipping goal', 'pivora-core' ) }>
					<RangeControl
						label={ __( 'Free shipping goal', 'pivora-core' ) }
						help={ __(
							'Set to 0 to auto-detect from WooCommerce free shipping methods.',
							'pivora-core'
						) }
						value={ goalAmount }
						onChange={ ( value ) =>
							setAttributes( { goalAmount: value } )
						}
						min={ 0 }
						max={ 500 }
					/>
					<TextControl
						label={ __( 'Progress message', 'pivora-core' ) }
						help={ __(
							'Use {amount} for the remaining balance.',
							'pivora-core'
						) }
						value={ message }
						onChange={ ( value ) =>
							setAttributes( { message: value } )
						}
					/>
					<TextControl
						label={ __( 'Success message', 'pivora-core' ) }
						value={ successMessage }
						onChange={ ( value ) =>
							setAttributes( { successMessage: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p>{ message.replace( '{amount}', '$25' ) }</p>
				<div
					className="pivora-shipping-progress__bar"
					aria-hidden="true"
				>
					<span style={ { width: '45%' } } />
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
