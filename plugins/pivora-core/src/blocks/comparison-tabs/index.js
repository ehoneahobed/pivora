import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { tabs } = attributes;
	const activeTab = tabs[ 0 ] || { label: '', columns: [], rows: [] };
	const blockProps = useBlockProps( { className: 'pivora-comparison-tabs' } );

	const updateTabField = ( field, value ) => {
		const nextTabs = [ ...tabs ];
		nextTabs[ 0 ] = { ...nextTabs[ 0 ], [ field ]: value };
		setAttributes( { tabs: nextTabs } );
	};

	const updateColumn = ( index, value ) => {
		const columns = [ ...( activeTab.columns || [] ) ];
		columns[ index ] = value;
		updateTabField( 'columns', columns );
	};

	const updateRow = ( rowIndex, field, value ) => {
		const rows = ( activeTab.rows || [] ).map( ( row, index ) =>
			index === rowIndex ? { ...row, [ field ]: value } : row
		);
		updateTabField( 'rows', rows );
	};

	const updateRowValue = ( rowIndex, valueIndex, value ) => {
		const rows = ( activeTab.rows || [] ).map( ( row, index ) => {
			if ( index !== rowIndex ) {
				return row;
			}

			const values = [ ...( row.values || [] ) ];
			values[ valueIndex ] = value;
			return { ...row, values };
		} );
		updateTabField( 'rows', rows );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Comparison table', 'pivora-core' ) }>
					<TextControl
						label={ __( 'Tab label', 'pivora-core' ) }
						value={ activeTab.label || '' }
						onChange={ ( value ) =>
							updateTabField( 'label', value )
						}
					/>
					{ ( activeTab.columns || [] ).map( ( column, index ) => (
						<TextControl
							key={ `column-${ index }` }
							label={
								__( 'Plan column', 'pivora-core' ) +
								` ${ index + 1 }`
							}
							value={ column }
							onChange={ ( value ) =>
								updateColumn( index, value )
							}
						/>
					) ) }
					<Button
						variant="secondary"
						onClick={ () =>
							updateTabField( 'columns', [
								...( activeTab.columns || [] ),
								__( 'Plan', 'pivora-core' ),
							] )
						}
					>
						{ __( 'Add column', 'pivora-core' ) }
					</Button>
					{ ( activeTab.rows || [] ).map( ( row, rowIndex ) => (
						<div
							key={ `row-${ rowIndex }` }
							style={ { marginTop: '1rem' } }
						>
							<TextControl
								label={ __( 'Feature', 'pivora-core' ) }
								value={ row.feature || '' }
								onChange={ ( value ) =>
									updateRow( rowIndex, 'feature', value )
								}
							/>
							{ ( activeTab.columns || [] ).map(
								( column, columnIndex ) => (
									<TextControl
										key={ `row-${ rowIndex }-col-${ columnIndex }` }
										label={
											column ||
											__( 'Value', 'pivora-core' )
										}
										value={
											( row.values || [] )[
												columnIndex
											] || ''
										}
										onChange={ ( value ) =>
											updateRowValue(
												rowIndex,
												columnIndex,
												value
											)
										}
									/>
								)
							) }
						</div>
					) ) }
					<Button
						variant="primary"
						onClick={ () =>
							updateTabField( 'rows', [
								...( activeTab.rows || [] ),
								{
									feature: __( 'New feature', 'pivora-core' ),
									values: ( activeTab.columns || [] ).map(
										() => '—'
									),
								},
							] )
						}
					>
						{ __( 'Add row', 'pivora-core' ) }
					</Button>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div className="pivora-comparison-tabs__tablist" role="tablist">
					<button
						type="button"
						className="pivora-comparison-tabs__tab is-active"
					>
						{ activeTab.label }
					</button>
				</div>
				<div className="pivora-comparison-tabs__panel is-active">
					<table className="pivora-comparison-tabs__table pivora-comparison-table">
						<thead>
							<tr>
								<th>{ __( 'Feature', 'pivora-core' ) }</th>
								{ ( activeTab.columns || [] ).map(
									( column, index ) => (
										<th key={ `preview-col-${ index }` }>
											{ column }
										</th>
									)
								) }
							</tr>
						</thead>
						<tbody>
							{ ( activeTab.rows || [] ).map(
								( row, rowIndex ) => (
									<tr key={ `preview-row-${ rowIndex }` }>
										<th>{ row.feature }</th>
										{ ( activeTab.columns || [] ).map(
											( column, columnIndex ) => (
												<td
													key={ `preview-cell-${ rowIndex }-${ columnIndex }` }
												>
													{
														( row.values || [] )[
															columnIndex
														]
													}
												</td>
											)
										) }
									</tr>
								)
							) }
						</tbody>
					</table>
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
