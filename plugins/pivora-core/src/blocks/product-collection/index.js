import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	TextControl,
	ToggleControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { source, categoryId, postsToShow, columns, showPrice, buttonText } =
		attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-product-collection',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Collection', 'pivora-core' ) }>
					<SelectControl
						label={ __( 'Source', 'pivora-core' ) }
						value={ source }
						options={ [
							{
								label: __( 'Latest products', 'pivora-core' ),
								value: 'latest',
							},
							{
								label: __( 'Product category', 'pivora-core' ),
								value: 'category',
							},
							{
								label: __( 'Hand-picked IDs', 'pivora-core' ),
								value: 'products',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { source: value } )
						}
					/>
					{ 'category' === source && (
						<RangeControl
							label={ __( 'Category ID', 'pivora-core' ) }
							value={ categoryId }
							onChange={ ( value ) =>
								setAttributes( { categoryId: value } )
							}
							min={ 0 }
							max={ 999 }
						/>
					) }
					{ 'products' === source && (
						<TextControl
							label={ __( 'Product IDs', 'pivora-core' ) }
							help={ __(
								'Comma-separated product post IDs.',
								'pivora-core'
							) }
							value={ ( attributes.productIds || [] ).join(
								', '
							) }
							onChange={ ( value ) =>
								setAttributes( {
									productIds: value
										.split( ',' )
										.map( ( id ) =>
											parseInt( id.trim(), 10 )
										)
										.filter( Boolean ),
								} )
							}
						/>
					) }
					<RangeControl
						label={ __( 'Products to show', 'pivora-core' ) }
						value={ postsToShow }
						onChange={ ( value ) =>
							setAttributes( { postsToShow: value } )
						}
						min={ 1 }
						max={ 12 }
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
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p>
					{ __(
						'Product collection preview — WooCommerce products render on the front end.',
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
