window.hypothesisConfig = () => {
	return {
	  onLayoutChange: ( ...args ) => {
			if ( args[0].expanded === true ) {
				document.body.classList.add( 'has-annotator-pane' );
			} else {
				document.body.classList.remove( 'has-annotator-pane' );
			}
	  },
	};
};
