( function () {
	const form = document.querySelector( '.pivora-demo-import-form' );

	if ( ! form ) {
		return;
	}

	const cards = form.querySelectorAll( '.pivora-demo-kit-card' );
	const previewFrame = form.querySelector( '.pivora-demo-import__preview-frame' );
	const previewTitle = form.querySelector( '.pivora-demo-import__preview-title' );
	const radios = form.querySelectorAll( 'input[name="demo_kit"]' );
	const scopeLabels = form.querySelectorAll( '.pivora-demo-import__scope' );

	function getSelectedRadio() {
		return form.querySelector( 'input[name="demo_kit"]:checked' );
	}

	function getSelectedCard() {
		const selected = getSelectedRadio();

		if ( ! selected ) {
			return null;
		}

		return form.querySelector( '.pivora-demo-kit-card[data-kit="' + selected.value + '"]' );
	}

	function updateScopeAvailability() {
		const card = getSelectedCard();
		const submitButton = form.querySelector( '.pivora-demo-import__submit' );
		const wooNotice = form.querySelector( '.pivora-demo-import__woo-notice' );
		const wooActive = form.dataset.wooActive === '1';

		if ( ! card ) {
			return;
		}

		const hasSeedPosts = card.dataset.seedPosts === '1';
		const hasWoo = card.dataset.woocommerce === '1';
		const wooBlocked = hasWoo && ! wooActive;

		scopeLabels.forEach( ( label ) => {
			const scope = label.dataset.scope;
			const input = label.querySelector( 'input[type="checkbox"]' );
			let disabled = false;

			if ( scope === 'blog_seed' && ! hasSeedPosts ) {
				disabled = true;
			}

			if ( scope === 'woocommerce' && ! hasWoo ) {
				disabled = true;
			}

			label.classList.toggle( 'is-disabled', disabled );

			if ( input ) {
				input.disabled = disabled;

				if ( disabled ) {
					input.checked = false;
				}
			}
		} );

		if ( submitButton ) {
			submitButton.disabled = wooBlocked;
		}

		if ( wooNotice ) {
			wooNotice.hidden = ! wooBlocked;
		}
	}

	function updateSelection() {
		const selected = getSelectedRadio();

		if ( ! selected ) {
			return;
		}

		cards.forEach( ( card ) => {
			card.classList.toggle(
				'is-selected',
				card.dataset.kit === selected.value
			);
		} );

		if ( previewFrame && selected.dataset.previewUrl ) {
			previewFrame.src = selected.dataset.previewUrl;
		}

		if ( previewTitle && selected.dataset.previewLabel ) {
			previewTitle.textContent = selected.dataset.previewLabel;
		}

		updateScopeAvailability();
	}

	radios.forEach( ( radio ) => {
		radio.addEventListener( 'change', updateSelection );
	} );

	cards.forEach( ( card ) => {
		card.addEventListener( 'click', ( event ) => {
			if ( event.target.closest( 'a, button, input' ) ) {
				return;
			}

			const radio = card.querySelector( 'input[type="radio"]' );

			if ( radio ) {
				radio.checked = true;
				updateSelection();
			}
		} );
	} );

	updateSelection();
} )();
