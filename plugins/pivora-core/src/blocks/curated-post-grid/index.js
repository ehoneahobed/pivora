import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	Spinner,
	ToggleControl,
	TextControl,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const {
		postsToShow,
		orderBy,
		order,
		showFeaturedImage,
		showDate,
		excerptLength,
		readMoreText,
	} = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-curated-post-grid pivora-latest-posts',
	} );

	const posts = useSelect(
		( select ) => {
			const { getEntityRecords } = select( 'core' );

			return getEntityRecords( 'postType', 'post', {
				per_page: postsToShow,
				orderby: orderBy,
				order,
				_embed: true,
			} );
		},
		[ postsToShow, orderBy, order ]
	);

	const isLoading = posts === null;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Query settings', 'pivora-core' ) }>
					<RangeControl
						label={ __( 'Posts to show', 'pivora-core' ) }
						value={ postsToShow }
						onChange={ ( value ) =>
							setAttributes( { postsToShow: value } )
						}
						min={ 1 }
						max={ 6 }
					/>
					<SelectControl
						label={ __( 'Order by', 'pivora-core' ) }
						value={ orderBy }
						options={ [
							{
								label: __( 'Date', 'pivora-core' ),
								value: 'date',
							},
							{
								label: __( 'Title', 'pivora-core' ),
								value: 'title',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { orderBy: value } )
						}
					/>
					<SelectControl
						label={ __( 'Order', 'pivora-core' ) }
						value={ order }
						options={ [
							{
								label: __( 'Newest first', 'pivora-core' ),
								value: 'desc',
							},
							{
								label: __( 'Oldest first', 'pivora-core' ),
								value: 'asc',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { order: value } )
						}
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Card display', 'pivora-core' ) }
					initialOpen={ false }
				>
					<ToggleControl
						label={ __( 'Show featured image', 'pivora-core' ) }
						checked={ showFeaturedImage }
						onChange={ ( value ) =>
							setAttributes( { showFeaturedImage: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Show date', 'pivora-core' ) }
						checked={ showDate }
						onChange={ ( value ) =>
							setAttributes( { showDate: value } )
						}
					/>
					<RangeControl
						label={ __( 'Excerpt length', 'pivora-core' ) }
						value={ excerptLength }
						onChange={ ( value ) =>
							setAttributes( { excerptLength: value } )
						}
						min={ 10 }
						max={ 60 }
					/>
					<TextControl
						label={ __( 'Read more label', 'pivora-core' ) }
						value={ readMoreText }
						onChange={ ( value ) =>
							setAttributes( { readMoreText: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				{ isLoading && <Spinner /> }
				{ ! isLoading && ( ! posts || posts.length === 0 ) && (
					<p className="pivora-posts-section__empty">
						{ __(
							'Publish your first post to populate this section.',
							'pivora-core'
						) }
					</p>
				) }
				{ ! isLoading && posts && posts.length > 0 && (
					<ul className="pivora-curated-post-grid__list">
						{ posts.map( ( post ) => {
							const featured =
								post._embedded?.[ 'wp:featuredmedia' ]?.[ 0 ];
							const excerpt = post.excerpt?.rendered
								?.replace( /<[^>]+>/g, '' )
								.trim();

							return (
								<li
									key={ post.id }
									className="pivora-curated-post-card pivora-post-card"
								>
									{ showFeaturedImage && (
										<div className="pivora-curated-post-card__media">
											{ featured?.source_url ? (
												<img
													className="pivora-curated-post-card__image"
													src={ featured.source_url }
													alt={
														featured.alt_text ||
														post.title?.rendered ||
														''
													}
												/>
											) : (
												<span className="pivora-curated-post-card__placeholder-image" />
											) }
										</div>
									) }
									<h3 className="pivora-curated-post-card__title">
										{ post.title?.rendered ||
											__( '(No title)', 'pivora-core' ) }
									</h3>
									{ excerpt && (
										<p className="pivora-curated-post-card__excerpt">
											{ excerpt }
											{ readMoreText && (
												<span className="pivora-curated-post-card__more">
													{ readMoreText }
												</span>
											) }
										</p>
									) }
									{ showDate && post.date && (
										<time className="pivora-curated-post-card__date">
											{ new Date(
												post.date
											).toLocaleDateString() }
										</time>
									) }
								</li>
							);
						} ) }
					</ul>
				) }
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
