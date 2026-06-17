import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	SelectControl,
	RangeControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { SurfaceStylePanel, getModifierClassName } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { heading, logos, source, postsToShow } = attributes;
	const blockProps = useBlockProps( {
		className: getModifierClassName( 'pivora-logo-grid', attributes, {
			surfaceStyle: 'surface',
		} ),
	} );

	const updateLogo = ( index, field, value ) => {
		const nextLogos = logos.map( ( logo, logoIndex ) => {
			if ( logoIndex !== index ) {
				return logo;
			}

			return {
				...logo,
				[ field ]: value,
			};
		} );

		setAttributes( { logos: nextLogos } );
	};

	const addLogo = () => {
		setAttributes( {
			logos: [
				...logos,
				{
					name: __( 'New logo', 'pivora-core' ),
					url: '',
					imageId: 0,
					imageUrl: '',
				},
			],
		} );
	};

	const removeLogo = ( index ) => {
		setAttributes( {
			logos: logos.filter( ( _, logoIndex ) => logoIndex !== index ),
		} );
	};

	return (
		<>
			<SurfaceStylePanel
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<InspectorControls>
				<PanelBody title={ __( 'Logo source', 'pivora-core' ) }>
					<SelectControl
						label={ __( 'Source', 'pivora-core' ) }
						value={ source }
						options={ [
							{
								label: __( 'Manual logos', 'pivora-core' ),
								value: 'manual',
							},
							{
								label: __( 'Client logos CPT', 'pivora-core' ),
								value: 'cpt',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { source: value } )
						}
					/>
					{ 'cpt' === source && (
						<RangeControl
							label={ __( 'Logos to show', 'pivora-core' ) }
							value={ postsToShow }
							onChange={ ( value ) =>
								setAttributes( { postsToShow: value } )
							}
							min={ 1 }
							max={ 12 }
						/>
					) }
				</PanelBody>
				{ 'manual' === source && (
					<PanelBody title={ __( 'Logos', 'pivora-core' ) }>
						{ logos.map( ( logo, index ) => (
							<div
								key={ `logo-${ index }` }
								style={ { marginBottom: '1rem' } }
							>
								<TextControl
									label={ __( 'Name', 'pivora-core' ) }
									value={ logo.name }
									onChange={ ( value ) =>
										updateLogo( index, 'name', value )
									}
								/>
								<TextControl
									label={ __( 'Link URL', 'pivora-core' ) }
									value={ logo.url }
									onChange={ ( value ) =>
										updateLogo( index, 'url', value )
									}
								/>
								<MediaUploadCheck>
									<MediaUpload
										onSelect={ ( media ) => {
											updateLogo(
												index,
												'imageId',
												media.id || 0
											);
											updateLogo(
												index,
												'imageUrl',
												media.url || ''
											);
										} }
										allowedTypes={ [ 'image' ] }
										value={ logo.imageId }
										render={ ( { open } ) => (
											<Button
												variant="secondary"
												onClick={ open }
											>
												{ logo.imageUrl
													? __(
															'Replace image',
															'pivora-core'
													  )
													: __(
															'Add image',
															'pivora-core'
													  ) }
											</Button>
										) }
									/>
								</MediaUploadCheck>
								<Button
									variant="secondary"
									isDestructive
									onClick={ () => removeLogo( index ) }
								>
									{ __( 'Remove logo', 'pivora-core' ) }
								</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ addLogo }>
							{ __( 'Add logo', 'pivora-core' ) }
						</Button>
					</PanelBody>
				) }
			</InspectorControls>
			<section { ...blockProps }>
				<RichText
					tagName="p"
					className="pivora-logo-grid__heading"
					value={ heading }
					onChange={ ( value ) =>
						setAttributes( { heading: value } )
					}
					placeholder={ __(
						'Trusted by product teams…',
						'pivora-core'
					) }
				/>
				<ul className="pivora-logo-grid__list">
					{ 'cpt' === source ? (
						<li className="pivora-logo-grid__item">
							<span className="pivora-logo-grid__label">
								{ __(
									'Client logos from CPT render on the front end.',
									'pivora-core'
								) }
							</span>
						</li>
					) : (
						logos.map( ( logo, index ) => (
							<li
								className="pivora-logo-grid__item"
								key={ `logo-preview-${ index }` }
							>
								{ logo.imageUrl ? (
									<img
										className="pivora-logo-grid__image"
										src={ logo.imageUrl }
										alt={ logo.name }
									/>
								) : (
									<span className="pivora-logo-grid__label">
										{ logo.name }
									</span>
								) }
							</li>
						) )
					) }
				</ul>
			</section>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
