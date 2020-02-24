import * as Cookies from 'js-cookie';

export default {
	init() {
		// JavaScript to be fired on all pages
		document.body.classList.remove( 'no-js' );
		document.body.classList.add( 'js' );

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
			// Get all the div.reading-header__toc__title elements
			const headings = document.querySelectorAll(
				'.dropdown > p, .dropdown > div.reading-header__toc__title'
			);

			Array.prototype.forEach.call( headings, heading => {
				// Give each div.reading-header__toc__title a toggle button child
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
				let svg = heading.querySelector( 'button > .arrow' );

				let links = content.querySelectorAll( 'a' );

				// Handle list items and events
				Array.prototype.forEach.call( links, link => {
					// Collapse the content menu if user tabs out.
					link.onblur = e => {
						if ( link === links[links.length - 1] && e.relatedTarget.parentNode.nodeName !== 'LI' ) {
							btn.setAttribute( 'aria-expanded', false );
							content.hidden = true;
						}
					};
				} );

				let $svgArrow = jQuery( 'button[aria-expanded] > svg' );
				let $toggleButton = jQuery( 'button[aria-expanded]' );

				jQuery( $toggleButton, $svgArrow ).click( function ( e ) {
					// Cast the state as a boolean
					let expanded = btn.getAttribute( 'aria-expanded' ) === 'true' || false;

					if ( btn === e.target || svg === e.target ) {
						// Switch the state
						btn.setAttribute( 'aria-expanded', ! expanded );
						// Switch the content's visibility
						content.hidden = expanded;
					} else {
						btn.setAttribute( 'aria-expanded', false );
						content.hidden = true;
					}
				} );

				document.onclick = e => {
					const downloadClass = 'book-header__cover__downloads';
					const $target = jQuery( e.target );
					const $downloadButton = jQuery( `.${downloadClass}` ).find( 'button' );

					if ( $downloadButton.length === 0
						|| $target.closest( 'div' ).hasClass( downloadClass )
						|| $target.hasClass( 'dropdown-item' ) ) {
						return;
					}

					if ( $downloadButton.attr( 'aria-expanded' ) === 'true' ) {
						btn.setAttribute( 'aria-expanded', false );
						content.hidden = true;
					}
				};

				document.onkeydown = e => {
					// Hide the content when 'Esc' key is pressed (and content is showing)
					if ( e.which === 27 && ! content.hidden ) {
						btn.setAttribute( 'aria-expanded', false );
						content.hidden = true;
					}
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

		jQuery( $ => {
			const $h5pActivities = $( '.h5p-row-item' );
			const $activityContainer = $( '.h5p-activity-container' );
			$activityContainer.hide();
			$( '#h5p-show-hide' ).text( $( '#h5p-show-hide' ).attr( 'show-all-text' ) );
			$( '.h5p-row-item' ).text( $( '.h5p-row-item' ).attr( 'show-activity-text' ) );

			$h5pActivities.click( function () {
				if ( $( this ).text() === $( this ).attr( 'show-activity-text' ) ) {
					$activityContainer.hide();
					$( this ).closest( 'tr' ).next( this ).show( 'slow' );
					$( this ).text( $( this ).attr( 'hide-activity-text' ) );
					window.dispatchEvent( new Event( 'resize' ) );
				} else {
					$( this ).closest( 'tr' ).next( this ).hide();
					$( this ).text( $( this ).attr( 'show-activity-text' ) );
				}
			} );

			$( '#h5p-show-hide' ).click( function () {
				if ( $( this ).text() === $( this ).attr( 'show-all-text' ) ) {
					$activityContainer.show();
					$( this ).text( $( this ).attr( 'hide-all-text' ) );
					$( '.h5p-row-item' ).text( $( '.h5p-row-item' ).attr( 'hide-activity-text' ) );
					window.dispatchEvent( new Event( 'resize' ) );
				} else {
					$activityContainer.hide();
					$( this ).text( $( this ).attr( 'show-all-text' ) );
					$( '.h5p-row-item' ).text( $( '.h5p-row-item' ).attr( 'show-activity-text' ) );
				}
			} );

		} );

	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};
