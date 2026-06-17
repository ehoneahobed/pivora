import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import { SurfaceStylePanel, getModifierClassName } from '../shared/style-panel';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { steps, layout } = attributes;
	const blockProps = useBlockProps( {
		className: getModifierClassName( 'pivora-process-steps', attributes, {
			layout: 'layout',
			surfaceStyle: 'surface',
		} ),
	} );

	const updateStep = ( index, field, value ) => {
		setAttributes( {
			steps: steps.map( ( step, stepIndex ) =>
				stepIndex === index ? { ...step, [ field ]: value } : step
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
				<PanelBody title={ __( 'Steps layout', 'pivora-core' ) }>
					<SelectControl
						label={ __( 'Layout', 'pivora-core' ) }
						value={ layout }
						options={ [
							{
								label: __( 'Vertical', 'pivora-core' ),
								value: 'vertical',
							},
							{
								label: __( 'Horizontal', 'pivora-core' ),
								value: 'horizontal',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { layout: value } )
						}
					/>
					<Button
						variant="primary"
						onClick={ () =>
							setAttributes( {
								steps: [
									...steps,
									{
										number: String(
											steps.length + 1
										).padStart( 2, '0' ),
										title: __( 'New step', 'pivora-core' ),
										description: '',
									},
								],
							} )
						}
					>
						{ __( 'Add step', 'pivora-core' ) }
					</Button>
				</PanelBody>
			</InspectorControls>
			<ol { ...blockProps }>
				{ steps.map( ( step, index ) => (
					<li
						key={ `step-${ index }` }
						className="pivora-process-steps__item"
					>
						<RichText
							tagName="span"
							className="pivora-process-steps__number"
							value={ step.number }
							onChange={ ( value ) =>
								updateStep( index, 'number', value )
							}
							placeholder={ __( '01', 'pivora-core' ) }
						/>
						<div className="pivora-process-steps__content">
							<RichText
								tagName="h3"
								className="pivora-process-steps__title"
								value={ step.title }
								onChange={ ( value ) =>
									updateStep( index, 'title', value )
								}
								placeholder={ __(
									'Step title',
									'pivora-core'
								) }
							/>
							<RichText
								tagName="p"
								className="pivora-process-steps__description"
								value={ step.description }
								onChange={ ( value ) =>
									updateStep( index, 'description', value )
								}
								placeholder={ __(
									'Step description…',
									'pivora-core'
								) }
							/>
						</div>
					</li>
				) ) }
			</ol>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
