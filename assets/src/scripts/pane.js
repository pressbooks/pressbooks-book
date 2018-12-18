window.hypothesisConfig = () => {
	return {
		openSidebar: ( pressbooksHypothesis.openSidebar === '1' ) ? true : false,
		showHighlights: ( pressbooksHypothesis.showHighlights === '1' ) ? true : false,
		onLayoutChange: layoutParams => {
			const navReading = document.querySelector( '.nav-reading' );
			if ( layoutParams.expanded === true ) {
				document.body.classList.add( 'has-annotator-pane' );
				if ( ( document.body.clientWidth - layoutParams.width ) > 400 ) {
					document.body.style.marginRight = `${layoutParams.width - 32}px`;
					if ( navReading ) {
						navReading.style.width = `${document.body.clientWidth}px`;
					}
				}
			} else {
				document.body.classList.remove( 'has-annotator-pane' );
				document.body.style.marginRight = '0';
				if ( navReading ) {
					navReading.style.width = '100vw';
				}
			}
		},
	}
};
