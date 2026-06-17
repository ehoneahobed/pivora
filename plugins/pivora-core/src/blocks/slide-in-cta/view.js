( function () {
	const STORAGE_PREFIX = 'pivora-slide-in-dismissed-';

	function prefersReducedMotion() {
		return window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	}

	function initSlideInCta( panel ) {
		const ctaId = panel.dataset.ctaId || 'default';
		const storageKey = STORAGE_PREFIX + ctaId;

		if ( window.sessionStorage.getItem( storageKey ) ) {
			return;
		}

		const delaySeconds = parseInt( panel.dataset.delaySeconds || '4', 10 );

		function dismiss() {
			window.sessionStorage.setItem( storageKey, '1' );
			panel.hidden = true;
			panel.classList.remove( 'is-visible' );
		}

		function show() {
			panel.hidden = false;
			panel.classList.add( 'is-visible' );

			const dismissButton = panel.querySelector(
				'.pivora-slide-in-cta__dismiss'
			);

			if ( dismissButton ) {
				dismissButton.focus();
			}
		}

		const dismissButton = panel.querySelector(
			'.pivora-slide-in-cta__dismiss'
		);

		if ( dismissButton ) {
			dismissButton.addEventListener( 'click', dismiss );
		}

		panel.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' ) {
				dismiss();
			}
		} );

		const delayMs = prefersReducedMotion()
			? 0
			: Math.max( 0, delaySeconds ) * 1000;

		window.setTimeout( show, delayMs );
	}

	document
		.querySelectorAll( '.wp-block-pivora-slide-in-cta' )
		.forEach( initSlideInCta );
} )();
