import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	Button,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { SurfaceStylePanel, getModifierClassName } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { stats, columns, variant } = attributes;
	const blockProps = useBlockProps( {
		className: `${ getModifierClassName(
			'pivora-stats-grid pivora-metrics',
			attributes,
			{
				surfaceStyle: 'surface',
			}
		) }${
			variant && variant !== 'default'
				? ` pivora-metrics--${ variant }`
				: ''
		}`,
		style: { '--pivora-stats-columns': columns },
	} );

	const updateStat = ( index, field, value ) => {
		setAttributes( {
			stats: stats.map( ( stat, statIndex ) =>
				statIndex === index ? { ...stat, [ field ]: value } : stat
			),
		} );
	};

	return (
		<>
			<SurfaceStylePanel
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<InspectorControls>
				<PanelBody title={ __( 'Stats layout', 'pivora-core' ) }>
					<RangeControl
						label={ __( 'Columns', 'pivora-core' ) }
						value={ columns }
						onChange={ ( value ) =>
							setAttributes( { columns: value } )
						}
						min={ 1 }
						max={ 4 }
					/>
					<SelectControl
						label={ __( 'Band style', 'pivora-core' ) }
						value={ variant }
						options={ [
							{
								label: __( 'Default', 'pivora-core' ),
								value: 'default',
							},
							{
								label: __( 'Premium overlap', 'pivora-core' ),
								value: 'premium',
							},
							{
								label: __( 'Light band', 'pivora-core' ),
								value: 'light',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { variant: value } )
						}
					/>
				</PanelBody>
				<PanelBody title={ __( 'Stats', 'pivora-core' ) }>
					{ stats.map( ( stat, index ) => (
						<div
							key={ `stat-${ index }` }
							style={ { marginBottom: '1rem' } }
						>
							<RichText
								tagName="p"
								className="pivora-metric__label"
								value={ stat.label }
								onChange={ ( value ) =>
									updateStat( index, 'label', value )
								}
								placeholder={ __( 'Label', 'pivora-core' ) }
							/>
							<RichText
								tagName="p"
								className="pivora-stats-grid__value"
								value={ stat.value }
								onChange={ ( value ) =>
									updateStat( index, 'value', value )
								}
								placeholder={ __( '90+', 'pivora-core' ) }
							/>
							<RichText
								tagName="p"
								className="pivora-metric__copy"
								value={ stat.description }
								onChange={ ( value ) =>
									updateStat( index, 'description', value )
								}
								placeholder={ __(
									'Supporting copy…',
									'pivora-core'
								) }
							/>
							<Button
								variant="secondary"
								isDestructive
								onClick={ () =>
									setAttributes( {
										stats: stats.filter(
											( _, statIndex ) =>
												statIndex !== index
										),
									} )
								}
							>
								{ __( 'Remove stat', 'pivora-core' ) }
							</Button>
						</div>
					) ) }
					<Button
						variant="primary"
						onClick={ () =>
							setAttributes( {
								stats: [
									...stats,
									{
										value: __( '12k', 'pivora-core' ),
										label: __(
											'New metric',
											'pivora-core'
										),
										description: '',
									},
								],
							} )
						}
					>
						{ __( 'Add stat', 'pivora-core' ) }
					</Button>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ul className="pivora-stats-grid__list">
					{ stats.map( ( stat, index ) => (
						<li
							key={ `stat-preview-${ index }` }
							className="pivora-stats-grid__item pivora-metric"
						>
							<p className="pivora-metric__label">
								{ stat.label }
							</p>
							<p className="pivora-stats-grid__value">
								{ stat.value }
							</p>
							<p className="pivora-metric__copy">
								{ stat.description }
							</p>
						</li>
					) ) }
				</ul>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
