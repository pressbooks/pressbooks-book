export default {
	init() {
		// Javascript to be fired on single reading view
		jQuery( $ => {
			$( document ).ready( function () {
				let offset = 250;
				let duration = 300;
				$( window ).scroll( function () {
					if ( $( this ).scrollTop() > offset ) {
						$( '.nav-reading__up' ).animate( { opacity: 1 }, duration );
					} else {
						$( '.nav-reading__up' ).animate( { opacity: 0 }, duration );
					}
				} );

				$( '.nav-reading__up' ).click( function ( event ) {
					event.preventDefault();
					$( '.nav-reading__up' )
						.blur()
						.animate( { opacity: 0 }, duration );
					$( 'html, body' ).animate( { scrollTop: 0 }, duration );
					return false;
				} );

				$( document ).keydown( function ( e ) {
					let url = false;
					if ( e.which === 37 ) {  // Left arrow key code
						url = $( '.nav-previous a, .js-nav-previous a' ).attr( 'href' );
					} else if ( e.which === 39 ) {  // Right arrow key code
						url = $( '.nav-next a, .js-nav-next a' ).attr( 'href' );
					}
					if ( url && ( ! $( 'textarea, input' ).is( ':focus' ) ) ) {
						window.location = url;
					}
				} );
			} );
		} );
	},
	finalize() {
		// JavaScript to be fired on single reading view, after page specific JS is fired
	},
};
