import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	TextControl,
	ToggleControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { postsToShow, columns, showPrice, buttonText } = attributes;
	const blockProps = useBlockProps( { className: 'pivora-product-grid' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Product grid', 'pivora-core' ) }>
					<RangeControl
						label={ __( 'Products to show', 'pivora-core' ) }
						value={ postsToShow }
						onChange={ ( value ) =>
							setAttributes( { postsToShow: value } )
						}
						min={ 1 }
						max={ 6 }
					/>
					<RangeControl
						label={ __( 'Columns', 'pivora-core' ) }
						value={ columns }
						onChange={ ( value ) =>
							setAttributes( { columns: value } )
						}
						min={ 1 }
						max={ 4 }
					/>
					<ToggleControl
						label={ __( 'Show price', 'pivora-core' ) }
						checked={ showPrice }
						onChange={ ( value ) =>
							setAttributes( { showPrice: value } )
						}
					/>
					<TextControl
						label={ __( 'Button text', 'pivora-core' ) }
						value={ buttonText }
						onChange={ ( value ) =>
							setAttributes( { buttonText: value } )
						}
					/>
					<p className="components-base-control__help">
						{ __(
							'Shows latest products when no hand-picked IDs are configured.',
							'pivora-core'
						) }
					</p>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p>
					{ __(
						'Product grid preview — WooCommerce products render on the front end.',
						'pivora-core'
					) }
				</p>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
