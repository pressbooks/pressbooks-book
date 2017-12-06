jQuery( $ => {
	$( '.js-header-menu-toggle' ).click( event => {
		event.preventDefault();
		$( event.currentTarget ).toggleClass( '--active' );
		$( '.js-header-nav' ).toggleClass( '--visible' );
	} );
} );

// let navReading, readingMeta, readingFooter, footerHeight;
// navReading = document.querySelectorAll('.nav-reading')[0];
// readingMeta = document.querySelectorAll('.section-reading-meta')[0];
// readingFooter = document.querySelectorAll('.footer--reading')[0];
// footerHeight = readingMeta.offsetHeight + readingFooter.offsetHeight;
