( function ( wp ) {
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editPost;
	const { ToggleControl } = wp.components;
	const { useSelect } = wp.data;
	const { useEntityProp } = wp.coreData;
	const { createElement: el } = wp.element;
	const { __ } = wp.i18n;

	registerPlugin( 'pivora-page-settings', {
		render: function PivoraPageSettingsPanel() {
			const postType = useSelect(
				( select ) => select( 'core/editor' ).getCurrentPostType(),
				[]
			);
			const [ meta, setMeta ] = useEntityProp(
				'postType',
				'page',
				'meta'
			);

			if ( 'page' !== postType ) {
				return null;
			}

			const hideTitle = true === meta?.pivora_hide_page_title;

			return el(
				PluginDocumentSettingPanel,
				{
					name: 'pivora-page-display',
					title: __( 'Page display', 'pivora' ),
					className: 'pivora-page-display-panel',
				},
				el( ToggleControl, {
					label: __( 'Hide page title', 'pivora' ),
					help: __(
						'Hides the title block from the published page. You can still edit the title above for admin and SEO.',
						'pivora'
					),
					checked: hideTitle,
					onChange: ( value ) =>
						setMeta( {
							...meta,
							pivora_hide_page_title: value,
						} ),
				} ),
				el(
					'p',
					{
						className: 'pivora-page-display-panel__hint',
					},
					__(
						'Select the Title or Cover block to change size, color, and position. Template blocks only expose style controls when the theme enables them.',
						'pivora'
					)
				)
			);
		},
	} );
} )( window.wp );
