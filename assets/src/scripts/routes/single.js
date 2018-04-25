import { diffWords } from 'diff';

export default {
	init() {
		// Javascript to be fired on single reading view
		jQuery( $ => {
			$( '#compare' ).click( () => {
				let container = $( '#diff' );
				let current = container.html();
				let endpoint = container.attr( 'data-source-endpoint' );
				fetch( endpoint )
					.then( function ( response ) {
						if ( response.status !== 200 ) {
							// TODO
							return;
						}

						response.json().then( function ( data ) {
							let source = data.content.raw;
							let diff = diffWords( source, current );
							let fragment = document.createDocumentFragment();
							diff.forEach( function ( part ) {
								let color = part.added
									? 'green'
									: part.removed ? 'red' : 'grey';
								let span = document.createElement( 'span' );
								span.style.color = color;
								span.appendChild( document.createTextNode( part.value ) );
								fragment.appendChild( span );
							} );
							container.html( fragment );
							container.removeAttr( 'hidden' );
							$( '#compare' ).text( 'Hide Comparison' );
						} );
					} )
					.catch( function ( err ) {
						// TODO
					} );
			} );

			$( document ).ready( function () {
				const offset = 250;
				const duration = 300;
				const nav = $( '.nav-reading' );
				const readingMeta = $( '.block-reading-meta' );
				// const comments = $( '.section-comments' );
				// const footer = $( '.footer--reading' );
				const fontsize = $( 'html' ).hasClass( 'fontsize' );
				if ( fontsize === false ) {
					if ( $( window ).width() > 1330 ) {
						if (
							nav.offset().top + nav.height() >=
							readingMeta.offset().top - 18
						) {
							nav.addClass( 'absolute' );
							nav.css( 'top', readingMeta.offset().top - 36 );
						}
						if (
							$( document ).scrollTop() <
							readingMeta.offset().top - window.innerHeight * 0.58
						) {
							nav.removeClass( 'absolute' );
							nav.css( 'top', '58%' );
						}
					}
				}

				$( window ).scroll( function () {
					const fontsize = $( 'html' ).hasClass( 'fontsize' );
					if ( $( window ).scrollTop() > offset ) {
						$( '.nav-reading__up' ).animate( { opacity: 1 }, duration );
					}
					if ( $( window ).scrollTop() < offset ) {
						$( '.nav-reading__up' ).animate( { opacity: 0 }, duration );
					}

					if ( fontsize === false ) {
						if ( $( window ).width() > 1330 ) {
							if (
								nav.offset().top + nav.height() >=
								readingMeta.offset().top - 18
							) {
								nav.addClass( 'absolute' );
								nav.css( 'top', readingMeta.offset().top - 36 );
							}
							if (
								$( document ).scrollTop() <
								readingMeta.offset().top - window.innerHeight * 0.58
							) {
								nav.removeClass( 'absolute' );
								nav.css( 'top', '58%' );
							}
						}
					}
				} );

				$( window ).resize( function () {
					const fontsize = $( 'html' ).hasClass( 'fontsize' );
					if ( fontsize === false ) {
						if ( $( window ).width() > 1330 ) {
							if (
								nav.offset().top + nav.height() >=
								readingMeta.offset().top - 18
							) {
								nav.addClass( 'absolute' );
								nav.css( 'top', readingMeta.offset().top - 36 );
							}
							if (
								$( document ).scrollTop() <
								readingMeta.offset().top - window.innerHeight * 0.58
							) {
								nav.removeClass( 'absolute' );
								nav.css( 'top', '58%' );
							}
						}
						if ( $( window ).width() < 1330 ) {
							nav.removeClass( 'absolute' );
							nav.removeAttr( 'style' );
						}
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
					if ( e.which === 37 ) {
						// Left arrow key code
						url = $( '.nav-previous a, .js-nav-previous a' ).attr( 'href' );
					} else if ( e.which === 39 ) {
						// Right arrow key code
						url = $( '.nav-next a, .js-nav-next a' ).attr( 'href' );
					}
					if ( url && ! $( 'textarea, input' ).is( ':focus' ) ) {
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
