( function () {
	function setBillingCycle( section, cycle ) {
		if ( ! section ) {
			return;
		}

		section.setAttribute( 'data-billing-cycle', cycle );
	}

	function activateCycle( section, toggle, cycle ) {
		setBillingCycle( section, cycle );

		const buttons = toggle.querySelectorAll( '[data-billing-cycle]' );
		const legacyOptions = toggle.querySelectorAll(
			'.pivora-pricing-toggle__option'
		);

		buttons.forEach( ( button ) => {
			const isActive = button.dataset.billingCycle === cycle;

			button.classList.toggle(
				'pivora-pricing-toggle__option--active',
				isActive
			);
			button.setAttribute( 'aria-pressed', isActive ? 'true' : 'false' );
		} );

		if ( ! buttons.length && legacyOptions.length ) {
			legacyOptions.forEach( ( option, index ) => {
				const isActive =
					( cycle === 'monthly' && 0 === index ) ||
					( cycle === 'yearly' && 1 === index );

				option.classList.toggle(
					'pivora-pricing-toggle__option--active',
					isActive
				);
			} );
		}
	}

	function initPricingToggle( toggle ) {
		const section = toggle.closest( '.pivora-pricing-section' );

		if ( ! section ) {
			return;
		}

		const buttons = toggle.querySelectorAll( '[data-billing-cycle]' );
		const defaultCycle =
			toggle.dataset.defaultCycle === 'yearly' ? 'yearly' : 'monthly';

		activateCycle( section, toggle, defaultCycle );

		if ( buttons.length ) {
			buttons.forEach( ( button ) => {
				button.addEventListener( 'click', function () {
					activateCycle(
						section,
						toggle,
						button.dataset.billingCycle
					);
				} );
			} );
			return;
		}

		const legacyOptions = toggle.querySelectorAll(
			'.pivora-pricing-toggle__option'
		);

		legacyOptions.forEach( ( option, index ) => {
			option.style.cursor = 'pointer';
			option.addEventListener( 'click', function () {
				activateCycle(
					section,
					toggle,
					0 === index ? 'monthly' : 'yearly'
				);
			} );
		} );
	}

	document
		.querySelectorAll(
			'.wp-block-pivora-pricing-billing-toggle, .pivora-pricing-toggle'
		)
		.forEach( initPricingToggle );
} )();
