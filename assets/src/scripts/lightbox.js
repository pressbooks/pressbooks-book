document.addEventListener( 'DOMContentLoaded', function () {
	const imageLinks = document.querySelectorAll(
		'#content a[href$=".gif"], #content a[href$=".jpg"], #content a[href$=".png"]'
	);
	Array.prototype.forEach.call( imageLinks, imageLink => {
		imageLink.setAttribute( 'data-lity', 'true' );
	} );
} );
