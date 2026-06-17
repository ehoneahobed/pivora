import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { SurfaceStylePanel } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { postsToShow, columns } = attributes;
	const blockProps = useBlockProps( {
		className: 'pivora-team-grid',
	} );

	return (
		<>
			<SurfaceStylePanel
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<InspectorControls>
				<PanelBody title={ __( 'Query', 'pivora-core' ) }>
					<RangeControl
						label={ __( 'Team members to show', 'pivora-core' ) }
						value={ postsToShow }
						onChange={ ( value ) =>
							setAttributes( { postsToShow: value } )
						}
						min={ 1 }
						max={ 9 }
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
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<p className="pivora-team-grid__placeholder">
					{ __(
						'Team member cards render from the Team Members library on the front end.',
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
