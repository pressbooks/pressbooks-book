export default {
	init() {
		jQuery( $ => {
			$( document.body ).on( 'click', '.js-toggle-block', function ( e ) {
				let $target = $( this );
				$target.parents( '.js-block' ).toggleClass( 'block-toggle--visible' );
				$target.toggleClass( '--visible' );
			} );

			$( document.body ).on( 'click', '.toc__toggle #show', function ( e ) {
				let $target = $( this );
				let $dropdowns = $( '.toc [class*="--full"]' );
				$dropdowns.each( function ( el ) {
					$( this )
						.find( 'button' )
						.attr( 'data-expanded', 'true' );
					$( this )
						.find(
							'ol'
						)
						.prop( 'hidden', false );
				} );
				$target.parents( '.toc__toggle' ).attr( 'data-expanded', 'true' );
			} );

			$( document.body ).on( 'click', '.toc__toggle #hide', function ( e ) {
				let $target = $( this );
				let $dropdowns = $( '.toc [class*="--full"]' );
				$dropdowns.each( function ( el ) {
					$( this )
						.find( 'button' )
						.attr( 'data-expanded', 'false' );
					$( this )
						.find(
							'ol'
						)
						.attr( 'hidden', 'true' );
				} );
				$target.parents( '.toc__toggle' ).attr( 'data-expanded', 'false' );
			} );
		} );
	},
	finalize() {
		// JavaScript to be fired on home page, after page specific JS is fired
	},
};
