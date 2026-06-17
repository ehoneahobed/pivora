( function () {
	function initMiniCart( root ) {
		const toggle = root.querySelector( '.pivora-mini-cart__toggle' );
		const panel = root.querySelector( '.pivora-mini-cart__panel' );

		if ( ! toggle || ! panel ) {
			return;
		}

		function closePanel() {
			panel.hidden = true;
			toggle.setAttribute( 'aria-expanded', 'false' );
		}

		function openPanel() {
			panel.hidden = false;
			toggle.setAttribute( 'aria-expanded', 'true' );
		}

		toggle.addEventListener( 'click', function () {
			if ( panel.hidden ) {
				openPanel();
			} else {
				closePanel();
			}
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( ! root.contains( event.target ) ) {
				closePanel();
			}
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' ) {
				closePanel();
			}
		} );

		if ( window.jQuery ) {
			window
				.jQuery( document.body )
				.on( 'added_to_cart removed_from_cart', function () {
					const countNode = root.querySelector(
						'.pivora-mini-cart__count'
					);

					if ( countNode && window.wc_cart_fragments_params ) {
						window.jQuery.get(
							window.wc_cart_fragments_params.wc_ajax_url
								.toString()
								.replace(
									'%%endpoint%%',
									'get_refreshed_fragments'
								),
							function ( data ) {
								if ( data && data.fragments ) {
									Object.keys( data.fragments ).forEach(
										function ( selector ) {
											const target =
												document.querySelector(
													selector
												);

											if ( target ) {
												target.innerHTML =
													data.fragments[ selector ];
											}
										}
									);
								}
							}
						);
					}
				} );
		}
	}

	document
		.querySelectorAll( '.wp-block-pivora-mini-cart' )
		.forEach( initMiniCart );
} )();
