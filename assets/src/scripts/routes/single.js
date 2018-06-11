import { diffWords } from 'diff';

export default {
	init() {
		// Javascript to be fired on single reading view
		jQuery( $ => {
			let toggle = $( '.block-reading-meta__compare__toggle' );
			toggle.click( event => {
				let activity = $( '.block-reading-meta__compare__activity' );
				let alert = $( '.alert' );
				let container = $( '.block-reading-meta__compare__comparison' );
				let stats = $( '.block-reading-meta__compare__stats' );
				let pre = $( '.block-reading-meta__compare__diff' );
				alert.addClass( 'visually-hidden' );
				if ( $( event.currentTarget ).attr( 'aria-expanded' ) === 'false' ) {
					toggle.attr( 'aria-expanded', true );
					activity.removeAttr( 'hidden' );
					if ( pre.hasClass( 'populated' ) ) {
						container.removeAttr( 'hidden ' );
						activity.attr( 'hidden', true );
					} else {
						alert.text( PB_A11y.comparison_loading );
						let current = pre.html();
						let endpoint = pre.attr( 'data-source-endpoint' );
						fetch( endpoint )
							.then( function ( response ) {
								if ( response.status !== 200 ) {
									alert
										.addClass( 'alert--error' )
										.removeClass( 'visually-hidden' )
										.text( PB_A11y.chapter_not_loaded );
									activity.attr( 'hidden', true );
									return;
								}

								response.json().then( function ( data ) {
									let source = data.content.raw;
									let diff = diffWords( source, current );
									let fragment = document.createDocumentFragment();
									diff.forEach( function ( part ) {
										let element = part.added
											? 'ins'
											: part.removed ? 'del' : 'span';
										let el = document.createElement( element );
										el.appendChild( document.createTextNode( part.value ) );
										fragment.appendChild( el );
									} );
									pre.html( fragment );
									pre.addClass( 'populated' );
									let deletions = pre.children( 'del' ).length;
									let insertions = pre.children( 'ins' ).length;
									stats
										.children( 'ins' )
										.children( '.num' )
										.text( insertions );
									stats
										.children( 'del ' )
										.children( '.num' )
										.text( deletions );
									activity.attr( 'hidden', true );
									alert.text( PB_A11y.comparison_loaded );
									container.removeAttr( 'hidden' );
								} );
							} )
							.catch( function ( err ) {
								alert
									.addClass( 'alert--error' )
									.removeClass( 'visually-hidden' )
									.text( PB_A11y.chapter_not_loaded );
								activity.attr( 'hidden', true );
							} );
					}
				} else {
					toggle.attr( 'aria-expanded', false );
					container.attr( 'hidden', true );
				}
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
					if ( $( 'body' ).hasClass( 'no-navigation' ) ) {
						return;
					}
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
