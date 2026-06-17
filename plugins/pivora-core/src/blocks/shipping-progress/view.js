( function () {
	function formatCurrency( amount ) {
		return new Intl.NumberFormat( undefined, {
			style: 'currency',
			currency: 'USD',
		} ).format( amount );
	}

	function updateProgress( root ) {
		const goal = parseFloat( root.dataset.goalAmount || '0' );

		if ( ! goal ) {
			return;
		}

		const message = root.dataset.message || '';
		const success = root.dataset.success || '';
		const subtotalNode = document.querySelector(
			'.woocommerce-Price-amount.amount'
		);
		let subtotal = 0;

		if ( subtotalNode ) {
			subtotal = parseFloat(
				subtotalNode.textContent.replace( /[^0-9.]/g, '' )
			);
		}

		const remaining = Math.max( 0, goal - subtotal );
		const progress = Math.min( 100, ( subtotal / goal ) * 100 );
		const isComplete = remaining <= 0.00001;
		const messageNode = root.querySelector(
			'.pivora-shipping-progress__message'
		);
		const fillNode = root.querySelector(
			'.pivora-shipping-progress__fill'
		);
		const barNode = root.querySelector( '.pivora-shipping-progress__bar' );

		if ( messageNode ) {
			messageNode.textContent = isComplete
				? success
				: message.replace( '{amount}', formatCurrency( remaining ) );
		}

		if ( fillNode ) {
			fillNode.style.width = progress + '%';
		}

		if ( barNode ) {
			barNode.setAttribute(
				'aria-valuenow',
				String( Math.round( progress ) )
			);
		}

		root.classList.toggle( 'is-complete', isComplete );
	}

	document
		.querySelectorAll( '.wp-block-pivora-shipping-progress' )
		.forEach( function ( root ) {
			updateProgress( root );

			if ( window.jQuery ) {
				window
					.jQuery( document.body )
					.on(
						'added_to_cart removed_from_cart updated_wc_div',
						function () {
							updateProgress( root );
						}
					);
			}
		} );
} )();
