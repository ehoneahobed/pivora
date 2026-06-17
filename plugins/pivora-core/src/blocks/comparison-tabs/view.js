( function () {
	function activateTab( root, index ) {
		const tabs = root.querySelectorAll( '.pivora-comparison-tabs__tab' );
		const panels = root.querySelectorAll(
			'.pivora-comparison-tabs__panel'
		);

		tabs.forEach( ( tab, tabIndex ) => {
			const isActive = tabIndex === index;
			tab.classList.toggle( 'is-active', isActive );
			tab.setAttribute( 'aria-selected', isActive ? 'true' : 'false' );
		} );

		panels.forEach( ( panel, panelIndex ) => {
			const isActive = panelIndex === index;
			panel.classList.toggle( 'is-active', isActive );

			if ( isActive ) {
				panel.removeAttribute( 'hidden' );
			} else {
				panel.setAttribute( 'hidden', 'hidden' );
			}
		} );
	}

	function initComparisonTabs( root ) {
		const tabs = root.querySelectorAll( '.pivora-comparison-tabs__tab' );

		tabs.forEach( ( tab, index ) => {
			tab.addEventListener( 'click', function () {
				activateTab( root, index );
			} );
		} );
	}

	document
		.querySelectorAll( '.wp-block-pivora-comparison-tabs' )
		.forEach( initComparisonTabs );
} )();
