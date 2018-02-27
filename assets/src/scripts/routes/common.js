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
						$( '.nav-reading' ).removeAttr( 'style' );
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
						$( '.nav-reading' ).removeAttr( 'style' );
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

		( function () {
			// Get all the <h3> headings
			const headings = document.querySelectorAll(
				'.dropdown > h3, .dropdown > p'
			);

			Array.prototype.forEach.call( headings, heading => {
				// Give each <h3> a toggle button child
				heading.innerHTML = `
				<button type="button" aria-expanded="false">
					${heading.innerHTML}
					<svg class="arrow" width="13" height="8" viewBox="0 0 13 8" xmlns="http://www.w3.org/2000/svg"><path d="M6.255 8L0 0h12.51z" fill="currentColor" fill-rule="evenodd"></path></svg>
				</button>
			  `;

				// Collapse (hide) the content following the heading
				let content = heading.nextElementSibling;
				content.hidden = true;

				// Assign the button
				let btn = heading.querySelector( 'button' );

				btn.onclick = () => {
					// Cast the state as a boolean
					let expanded = btn.getAttribute( 'aria-expanded' ) === 'true' || false;

					// Switch the state
					btn.setAttribute( 'aria-expanded', ! expanded );
					// Switch the content's visibility
					content.hidden = expanded;
				};
			} );
		} )();
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};
