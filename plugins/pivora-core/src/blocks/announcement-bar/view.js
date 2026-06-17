( function () {
	const STORAGE_PREFIX = 'pivora-announcement-dismissed-';

	function initAnnouncementBar( bar ) {
		const announcementId = bar.dataset.announcementId || 'default';
		const dismissible = bar.dataset.dismissible === 'true';
		const storageKey = STORAGE_PREFIX + announcementId;

		if ( dismissible && window.localStorage.getItem( storageKey ) ) {
			bar.hidden = true;
			return;
		}

		const dismissButton = bar.querySelector(
			'.pivora-announcement-bar__dismiss'
		);

		if ( ! dismissButton || ! dismissible ) {
			return;
		}

		dismissButton.addEventListener( 'click', function () {
			window.localStorage.setItem( storageKey, '1' );
			bar.hidden = true;
		} );
	}

	document
		.querySelectorAll( '.wp-block-pivora-announcement-bar' )
		.forEach( initAnnouncementBar );
} )();
