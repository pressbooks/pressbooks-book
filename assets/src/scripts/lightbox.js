// Import lity lightbox and its styles
import 'lity';
import 'lity/dist/lity.css';

document.addEventListener( 'DOMContentLoaded', function () {
	const imageLinks = document.querySelectorAll(
		'#content a[href$=".gif"], #content a[href$=".jpg"], #content a[href$=".png"]'
	);
	Array.prototype.forEach.call( imageLinks, imageLink => {
		imageLink.setAttribute( 'data-lity', 'true' );
	} );
} );
