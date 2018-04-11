/**
 * @see https://inclusive-components.design/collapsible-sections/
 */

document.addEventListener( 'DOMContentLoaded', function () {
	// Get all the headings
	const sectionHeadingEl = 'h1';
	const headings = document.querySelectorAll(
		`#content section > ${sectionHeadingEl}`
	);

	Array.prototype.forEach.call( headings, heading => {
		// Give each <h1> a toggle button child
		// with the SVG plus/minus icon
		heading.innerHTML = `
		<button aria-expanded="false" class="button--text">
		  ${heading.textContent}
		  <svg aria-hidden="true" focusable="false" viewBox="0 0 10 10">
			<rect class="vert" height="8" width="2" y="1" x="4"/>
			<rect height="2" width="8" y="4" x="1"/>
		  </svg>
		</button>`;
		heading.setAttribute( 'data-collapsed', 'true' );

		// Function to create a node list
		// of the content between this <h2> and the next
		const getContent = elem => {
			let elems = [];
			while (
				elem.nextElementSibling &&
				elem.nextElementSibling.tagName !== 'H1'
			) {
				elems.push( elem.nextElementSibling );
				elem = elem.nextElementSibling;
			}

			// Delete the old versions of the content nodes
			elems.forEach( node => {
				node.parentNode.removeChild( node );
			} );

			return elems;
		};

		// Assign the contents to be expanded/collapsed (array)
		let contents = getContent( heading );

		// Create a wrapper element for `contents` and hide it
		let wrapper = document.createElement( 'div' );
		wrapper.hidden = true;

		// Add each element of `contents` to `wrapper`
		contents.forEach( node => {
			wrapper.appendChild( node );
		} );

		// Add the wrapped content back into the DOM
		// after the heading
		heading.parentNode.insertBefore( wrapper, heading.nextElementSibling );

		// Assign the button
		let btn = heading.querySelector( 'button' );

		btn.onclick = () => {
			// Cast the state as a boolean
			let expanded = btn.getAttribute( 'aria-expanded' ) === 'true' || false;

			// Switch the state
			btn.setAttribute( 'aria-expanded', ! expanded );
			heading.setAttribute( 'data-collapsed', expanded );
			// Switch the content's visibility
			wrapper.hidden = expanded;
		};
	} );
} );
