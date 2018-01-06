export default {
	init() {
		jQuery( $ => {
			$( document.body ).on( 'click', function ( e ) {
				let $target = $( e.target );
				if ( $target.is( '[data-toggle=dropdown]' ) ) {
					return;
				}

				$( '.dropdown-menu.show' ).each( function () {
					let $dropdown = $( this );
					$dropdown.removeClass( 'show' );
				} );
			} );

			$( document.body ).on( 'click', '[data-toggle=dropdown]', function ( e ) {
				let $target = $( this );
				let $dropdown = $target.parent( '.dropdown' ).find( '.dropdown-menu' );
				$dropdown.toggleClass( 'show' );
			} );
		} );
	},
	finalize() {
		// JavaScript to be fired on home page, after page specific JS is fired
	},
};
