let tocSelector = '#toc',
	tocUl = document.querySelector( tocSelector + ' ul' ),
	chapterTitleSelector = '.toc-chapter-title';

if ( getComputedStyle( tocUl )['text-align'] === 'left' ) {
	let head = document.head || document.getElementsByTagName( 'head' )[0],
		style = document.createElement( 'style' ),
		chapters = document.querySelectorAll( tocSelector + ' .chapter a' ),
		others = document.querySelectorAll(
			tocSelector +
				' .front-matter, ' +
				tocSelector +
				' .part, ' +
				tocSelector +
				' .back-matter'
		),
		maxWidth = 0,
		css;

	chapters.forEach( function ( el, index ) {
		let title = el.querySelector( chapterTitleSelector );
		let numberWidth = el.offsetWidth - title.offsetWidth;
		if ( numberWidth > maxWidth ) {
			maxWidth = numberWidth;
		}
	} );

	style.type = 'text/css';
	css =
		tocSelector +
		' li.chapter a::before{ width: ' +
		maxWidth +
		'px !important; }';

	if ( style.styleSheet ) {
		style.styleSheet.cssText = css;
	} else {
		style.appendChild( document.createTextNode( css ) );
	}
	head.appendChild( style );

	others.forEach( function ( el, index ) {
		el.style.marginLeft = maxWidth + 'px';
	} );
}
