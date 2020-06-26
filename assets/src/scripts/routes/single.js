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
				let pre = $( '.block-reading-meta__compare__current' );
				alert.addClass( 'visually-hidden' );
				if ( $( event.currentTarget ).attr( 'aria-expanded' ) === 'false' ) {
					toggle.attr( 'aria-expanded', true );
					activity.removeAttr( 'hidden' );
					if ( container.hasClass( 'populated' ) ) {
						container.removeAttr( 'hidden' );
						activity.attr( 'hidden', true );
					} else {
						alert.text( pressbooksBook.comparison_loading );
						let current = pre.html();
						let endpoint = pre.attr( 'data-source-endpoint' );
						fetch( endpoint )
							.then( function ( response ) {
								if ( response.status !== 200 ) {
									alert
										.addClass( 'alert--error' )
										.removeClass( 'visually-hidden' )
										.text( pressbooksBook.chapter_not_loaded );
									activity.attr( 'hidden', true );
									return;
								}
								response.json().then( function ( data ) {
									let source = $( '<div>' + data.content.raw + '</div>' ).html();
									  $.post(pressbooksBook.ajaxurl, {
										action: 'text_diff',
										security : pressbooksBook.text_diff_nonce,
										left: source,
										right: current,
									  }, function( response ) {
										if ( true === response.success ) {
											let table = JSON.parse( response.data );
											container.append( table );
											container.children( 'table' )
											let deletions = $( '.diff del' ).length;
											let insertions = $( '.diff ins' ).length;
											stats
												.children( 'ins' )
												.children( '.num' )
												.text( insertions );
											stats
												.children( 'del ' )
												.children( '.num' )
												.text( deletions );
											activity.attr( 'hidden', true );
											alert.text( pressbooksBook.comparison_loaded );
											container.removeAttr( 'hidden' );
										}
									  });
								} );
							} )
							.catch( function ( err ) {
								alert
									.addClass( 'alert--error' )
									.removeClass( 'visually-hidden' )
									.text( pressbooksBook.chapter_not_loaded );
								activity.attr( 'hidden', true );
							} );
					}
				} else {
					toggle.attr( 'aria-expanded', false );
					container.attr( 'hidden', true );
					$( '.diff' ).remove();
				}
			} );

			$( document ).ready( function () {
				const offset = 250;
				const duration = 0;

				$( window ).scroll( function () {
					if ( $( window ).scrollTop() > offset ) {
						$( '.nav-reading__up' ).animate( { opacity: 1 }, duration );
					}
					if ( $( window ).scrollTop() < offset ) {
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

				// Set fluid width for mobile videos
				( function () {
					let $allVideos = $( 'iframe[src*=\'//player.vimeo.com\'], iframe[src*=\'//www.youtube.com\']' );

					$allVideos.each( function () {
						$( this )
							.data( 'aspectRatio', this.height / this.width )
							.removeAttr( 'height' )
							.removeAttr( 'width' );
					} );

					$( window ).resize( function () {
						$allVideos.each( function () {
							let $el = $( this );
							let newWidth = $el.parent().parent().width();
							$el
								.width( newWidth )
								.height( newWidth * $el.data( 'aspectRatio' ) );
						} );
					} ).resize();
				} )();
			} );
		} );
	},
	finalize() {
		// JavaScript to be fired on single reading view, after page specific JS is fired
	},
};
