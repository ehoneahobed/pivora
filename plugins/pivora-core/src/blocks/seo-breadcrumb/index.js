import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

function Edit() {
	const blockProps = useBlockProps( {
		className: 'pivora-seo-breadcrumb',
	} );

	return (
		<nav { ...blockProps } aria-label={ __( 'Breadcrumb', 'pivora-core' ) }>
			<p className="pivora-page-header__breadcrumb">
				{ __( 'Home', 'pivora-core' ) }
				<span aria-hidden="true"> / </span>
				{ __( 'Current page', 'pivora-core' ) }
			</p>
		</nav>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
