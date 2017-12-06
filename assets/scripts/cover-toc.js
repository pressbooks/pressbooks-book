jQuery(
	function ( $ ){
		$( document.body ).on( 'click', '.js-toc-part-toggle', function ( e ){
			let $target = $( this );
			let $dropdown = $target.parents( '.js-toc-part' );
			$dropdown.toggleClass( 'open' );
		} );

		$( document.body ).on( 'click', '.js-toc-toggle-all-show', function ( e ){
			let $target = $( this );
			$target.hide();
			$( '.js-toc-toggle-all-hide' ).show();
			$( '.js-toc-part' ).addClass( 'open' );
		} );

		$( document.body ).on( 'click', '.js-toc-toggle-all-hide', function ( e ){
			let $target = $( this );
			$target.hide();
			$( '.js-toc-toggle-all-show' ).show();
			$( '.js-toc-part' ).removeClass( 'open' );
		} );

		$( document.body ).on( 'click', '.js-toc-toggle', function ( e ){
			let $target = $( this );
			$target.toggleClass( '--visible' );
			$target.parents( '.js-toc-toggle-con' ).toggleClass( '--visible' );
			$( '.js-toc' ).toggleClass( '--visible' );
		} );

		//toggle sections for mobile & tablet
		$( document.body ).on( 'click', '.js-toggle-section', function ( e ){
			let $target = $( this );
			$target.parents( '.js-section' ).toggleClass( 'section-toggle--visible' );
			$target.toggleClass( '--visible' );
		} );

		//toggle search form
		$( document.body ).on( 'click', '.js-toggle-search', function ( e ){
			let $target = $( this );
			$target.parents( '.js-search' ).toggleClass( 'search--visible' );
			$target.toggleClass( '--visible' );
			$( '#s' ).focus();
		} );
	}
);
