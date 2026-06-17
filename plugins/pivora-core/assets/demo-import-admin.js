( function () {
	const form = document.querySelector( '.pivora-demo-import-form' );

	if ( ! form ) {
		return;
	}

	const cards = form.querySelectorAll( '.pivora-demo-kit-card' );
	const previewFrame = form.querySelector( '.pivora-demo-import__preview-frame' );
	const previewTitle = form.querySelector( '.pivora-demo-import__preview-title' );
	const radios = form.querySelectorAll( 'input[name="demo_kit"]' );

	function getSelectedRadio() {
		return form.querySelector( 'input[name="demo_kit"]:checked' );
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
