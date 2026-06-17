import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { cartLabel, showCount, checkoutText } = attributes;
	const blockProps = useBlockProps( { className: 'pivora-mini-cart' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Mini cart', 'pivora-core' ) }>
					<TextControl
						label={ __( 'Cart label', 'pivora-core' ) }
						value={ cartLabel }
						onChange={ ( value ) =>
							setAttributes( { cartLabel: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Show item count', 'pivora-core' ) }
						checked={ showCount }
						onChange={ ( value ) =>
							setAttributes( { showCount: value } )
						}
					/>
					<TextControl
						label={ __( 'Checkout button text', 'pivora-core' ) }
						value={ checkoutText }
						onChange={ ( value ) =>
							setAttributes( { checkoutText: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<button
					type="button"
					className="pivora-mini-cart__toggle"
					disabled
				>
					{ cartLabel }
					{ showCount && (
						<span className="pivora-mini-cart__count">0</span>
					) }
				</button>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
