import * as Cookies from 'js-cookie';

export default {
	init() {
		// JavaScript to be fired on all pages
		document.body.classList.remove( 'no-js' );
		document.body.classList.add( 'js' );

		// Font Size handler
		( function () {
			const fontSizeButton = document.querySelector( '.a11y-fontsize' );

			if ( Cookies.get( 'a11y-larger-fontsize' ) === '1' ) {
				document.documentElement.classList.add( 'fontsize' );
				fontSizeButton.setAttribute( 'aria-pressed', true );
				fontSizeButton.textContent = pressbooksBook.decrease_label;
			}

			fontSizeButton.onclick = () => {
				// Cast the state as a boolean
				let pressed = fontSizeButton.getAttribute( 'aria-pressed' ) === 'true' || false;

				// Switch the state
				fontSizeButton.setAttribute( 'aria-pressed', ! pressed );

				if ( ! pressed ) {
					document.documentElement.classList.add( 'fontsize' );
					fontSizeButton.setAttribute( 'title', pressbooksBook.decrease_label );
					fontSizeButton.textContent = pressbooksBook.decrease_label;
					document.querySelector( '.nav-reading' ).setAttribute( 'style', '' );
					Cookies.set( 'a11y-larger-fontsize', '1', {
						expires: 365,
						path: pressbooksBook.home_path,
					} );
					return false;
				} else {
					document.documentElement.classList.remove( 'fontsize' );
					fontSizeButton.setAttribute( 'title', pressbooksBook.increase_label );
					fontSizeButton.textContent = pressbooksBook.increase_label;
					document.querySelector( '.nav-reading' ).setAttribute( 'style', '' );
					Cookies.set( 'a11y-larger-fontsize', '0', {
						expires: 365,
						path: pressbooksBook.home_path,
					} );
					return false;
				}
			};
		} )();

		( function () {
			// document.addEventListener( 'DOMContentLoaded', function () {
			// Sets a -1 tabindex to ALL sections for .focus()-ing
			let sections = document.getElementsByTagName( 'section' );
			for ( let i = 0, max = sections.length; i < max; i++ ) {
				sections[i].setAttribute( 'tabindex', -1 );
				sections[i].className += ' focusable';
			}
		} )();

		// Smooth scroll to anchor, expand parent if present.
		jQuery( $ => {
			$.localScroll.hash( { duration: 0 } );

			$.localScroll( {
				hash: true,
				duration: 0,
				onBefore: ( event, el ) => {
					let hiddenParent = el.closest( 'div[hidden]' );
					if ( hiddenParent ) {
						hiddenParent.hidden = false;
						let sectionTitle = hiddenParent.previousElementSibling;
						let sectionTitleButton = sectionTitle.querySelector( 'button' );
						sectionTitle.setAttribute( 'data-collapsed', false );
						sectionTitleButton.setAttribute( 'aria-expanded', true );
					}
				},
			} );
		} );

		// Header navigation
		( function () {
			const navToggle = document.querySelector( '.js-header-nav-toggle' );
			navToggle.addEventListener( 'click', function ( event ) {
				event.preventDefault();
				document.querySelector( '.header__nav' ).classList.toggle( 'header__nav--active' );
			} );
		} )();

		( function () {
			// Get all the <h3> headings
			const headings = document.querySelectorAll(
				'.dropdown > p, .dropdown > h3'
			);

			Array.prototype.forEach.call( headings, heading => {
				// Give each <h3> a toggle button child
				heading.innerHTML = `
				<button type="button" aria-expanded="false">
					${heading.innerHTML}
					<svg role="img" class="arrow" width="13" height="8" viewBox="0 0 13 8" xmlns="http://www.w3.org/2000/svg"><path d="M6.255 8L0 0h12.51z" fill="currentColor" fill-rule="evenodd"></path></svg>
				</button>
			  `;

				// Collapse (hide) the content following the heading
				let content = heading.nextElementSibling;
				content.hidden = true;

				// Assign the button
				let btn = heading.querySelector( 'button' );

				btn.onclick = () => {
					// Cast the state as a boolean
					let expanded = btn.getAttribute( 'aria-expanded' ) === 'true' || false;

					// Switch the state
					btn.setAttribute( 'aria-expanded', ! expanded );
					// Switch the content's visibility
					content.hidden = expanded;
				};
			} );
		} )();

		( function () {
			// Get all the part titles
			const entityTitles = document.querySelectorAll(
				'.toc__part--full > .toc__title, .toc__chapter--full > .toc__title, .toc__front-matter--full > .toc__title, .toc__back-matter--full > .toc__title'
			);

			// Determine whether or not we are on the home page
			const isHome = document.body.classList.contains( 'home' );

			Array.prototype.forEach.call( entityTitles, entityTitle => {

				// Give each part title a toggle button child
				let ariaExpanded = ( ( isHome && entityTitle.parentNode.classList.contains( 'toc__part' ) ) || ( ! isHome && entityTitle.parentNode.classList.contains( 'toc__parent' ) ) ) ? true : false;
				let ariaLabel = `${pressbooksBook.toggle_contents} '${entityTitle.innerText}'`;
				entityTitle.innerHTML = `
				<span>${entityTitle.innerHTML}</span>
				<button type="button" aria-expanded="${ariaExpanded}" aria-label="${ariaLabel}">
					<svg viewBox="0 0 9 9" aria-hidden="true" focusable="false">
						<rect class="vert" height="7" width="1" y="1" x="4" />
						<rect height="1" width="7" y="4" x="1" />
					</svg>
				</button>
				`;

				// Collapse (hide) the content following the heading
				let content = entityTitle.nextElementSibling;
				if ( ariaExpanded === false || ( ! isHome && ! entityTitle.parentNode.classList.contains( 'toc__parent' ) ) ) {
					content.hidden = true;
				} else if ( isHome && entityTitle.parentNode.classList.contains( 'toc__parent' ) ) {
					content.hidden = false;
				}

				// Assign the button
				let btn = entityTitle.querySelector( 'button' );

				btn.onclick = () => {
					// Cast the state as a boolean
					let expanded = btn.getAttribute( 'aria-expanded' ) === 'true' || false;

					// Switch the state
					btn.setAttribute( 'aria-expanded', ! expanded );
					// Switch the content's visibility
					content.hidden = expanded;
				};
			} );
		} )();
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};
