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
						.attr( 'aria-expanded', 'true' );
					$( this )
						.find(
							'ol'
						)
						.removeAttr( 'hidden' );
				} );
				$target.parents( '.toc__toggle' ).attr( 'aria-expanded', 'true' );
			} );

			$( document.body ).on( 'click', '.toc__toggle #hide', function ( e ) {
				let $target = $( this );
				let $dropdowns = $( '.toc [class*="--full"]' );
				$dropdowns.each( function ( el ) {
					$( this )
						.find( 'button' )
						.attr( 'aria-expanded', 'false' );
					$( this )
						.find(
							'ol'
						)
						.attr( 'hidden', 'true' );
				} );
				$target.parents( '.toc__toggle' ).attr( 'aria-expanded', 'false' );
			} );
		} );
	},
	finalize() {
		// JavaScript to be fired on home page, after page specific JS is fired
	},
};
