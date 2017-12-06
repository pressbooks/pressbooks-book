jQuery( document ).ready( function ( $ ){
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
