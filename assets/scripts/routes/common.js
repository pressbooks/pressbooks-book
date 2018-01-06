import * as Cookies from 'js-cookie';

export default {
	init() {
		// JavaScript to be fired on all pages
		jQuery( $ => {
			$( 'body' )
				.removeClass( 'no-js' )
				.addClass( 'js' );
			$( document ).ready( function () {
				// Fontsize handler
				if ( Cookies.get( 'a11y-larger-fontsize' ) === '1' ) {
					$( 'html' ).addClass( 'fontsize' );
					$( '#is_normal_fontsize' )
						.attr( 'id', 'is_large_fontsize' )
						.attr( 'aria-checked', true )
						.addClass( 'active' )
						.text( PB_A11y.decrease_label )
						.attr( 'title', PB_A11y.decrease_label );
				}

				$( '.toggle-fontsize' ).on( 'click', function () {
					if ( $( this ).attr( 'id' ) === 'is_normal_fontsize' ) {
						$( 'html' ).addClass( 'fontsize' );
						$( this )
							.attr( 'id', 'is_large_fontsize' )
							.attr( 'aria-checked', true )
							.addClass( 'active' )
							.text( PB_A11y.decrease_label )
							.attr( 'title', PB_A11y.decrease_label );
						Cookies.set( 'a11y-larger-fontsize', '1', {
							expires: 365,
							path:    '',
						} );
						return false;
					} else {
						$( 'html' ).removeClass( 'fontsize' );
						$( this )
							.attr( 'id', 'is_normal_fontsize' )
							.removeAttr( 'aria-checked' )
							.removeClass( 'active' )
							.text( PB_A11y.increase_label )
							.attr( 'title', PB_A11y.increase_label );
						Cookies.set( 'a11y-larger-fontsize', '0', {
							expires: 365,
							path:    '',
						} );
						return false;
					}
				} );

				// Sets a -1 tabindex to ALL sections for .focus()-ing
				let sections = document.getElementsByTagName( 'section' );
				for ( let i = 0, max = sections.length; i < max; i++ ) {
					sections[i].setAttribute( 'tabindex', -1 );
					sections[i].className += ' focusable';
				}

				// If there is a '#' in the URL (someone linking directly to a page with an anchor), go directly to that area and focus is
				// Thanks to WebAIM.org for this idea
				if ( document.location.hash && document.location.hash !== '#' ) {
					let anchorUponArrival = document.location.hash;
					setTimeout( function () {
						$( anchorUponArrival ).scrollTo( { duration: 1500 } );
						$( anchorUponArrival ).focus();
					}, 100 );
				}
			} );
			// Header navigation
			$( '.js-header-nav-toggle' ).click( event => {
				event.preventDefault();
				$( '.header__nav' ).toggleClass( 'header__nav--active' );
			} );
		} );
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};
