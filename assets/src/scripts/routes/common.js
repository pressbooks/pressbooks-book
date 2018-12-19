import * as Cookies from 'js-cookie';

export default {
	init() {
		// JavaScript to be fired on all pages
		jQuery( $ => {
			$( 'body' )
				.removeClass( 'no-js' )
				.addClass( 'js' );
			$( document ).ready( function () {
				// Fontsize handler
				if ( Cookies.get( 'a11y-larger-fontsize' ) === '1' ) {
					$( 'html' ).addClass( 'fontsize' );
					$( '#is_normal_fontsize' )
						.attr( 'id', 'is_large_fontsize' )
						.attr( 'aria-checked', true )
						.addClass( 'active' )
						.text( pressbooksBook.decrease_label )
						.attr( 'title', pressbooksBook.decrease_label );
				}

				$( '.toggle-fontsize' ).on( 'click', function () {
					if ( $( this ).attr( 'id' ) === 'is_normal_fontsize' ) {
						$( 'html' ).addClass( 'fontsize' );
						$( this )
							.attr( 'id', 'is_large_fontsize' )
							.attr( 'aria-checked', true )
							.addClass( 'active' )
							.text( pressbooksBook.decrease_label )
							.attr( 'title', pressbooksBook.decrease_label );
						$( '.nav-reading' ).removeAttr( 'style' );
						Cookies.set( 'a11y-larger-fontsize', '1', {
							expires: 365,
							path: pressbooksBook.home_path,
						} );
						return false;
					} else {
						$( 'html' ).removeClass( 'fontsize' );
						$( this )
							.attr( 'id', 'is_normal_fontsize' )
							.removeAttr( 'aria-checked' )
							.removeClass( 'active' )
							.text( pressbooksBook.increase_label )
							.attr( 'title', pressbooksBook.increase_label );
						$( '.nav-reading' ).removeAttr( 'style' );
						Cookies.set( 'a11y-larger-fontsize', '0', {
							expires: 365,
							path: pressbooksBook.home_path,
						} );
						return false;
					}
				} );

				// Sets a -1 tabindex to ALL sections for .focus()-ing
				let sections = document.getElementsByTagName( 'section' );
				for ( let i = 0, max = sections.length; i < max; i++ ) {
					sections[i].setAttribute( 'tabindex', -1 );
					sections[i].className += ' focusable';
				}

				// If there is a '#' in the URL (someone linking directly to a page with an anchor), go directly to that area and focus is
				// Thanks to WebAIM.org for this idea
				if ( document.location.hash && document.location.hash !== '#' ) {
					let anchorUponArrival = $( document.location.hash );
					$.scrollTo( anchorUponArrival, 1500 );
				}

				$.localScroll( {
					onBefore: ( event, el ) => {
						let hiddenParent = $( el ).closest( 'div[hidden]' );
						if ( hiddenParent ) {
							$( hiddenParent ).removeAttr( 'hidden' );
							let sectionTitle = $( hiddenParent ).prev();
							let sectionTitleButton = $( sectionTitle ).children( 'button' );
							$( sectionTitle ).attr( 'data-collapsed', false );
							$( sectionTitleButton ).attr( 'aria-expanded', true );
						}
					},
				} );
			} );
			// Header navigation
			$( '.js-header-nav-toggle' ).click( event => {
				event.preventDefault();
				$( '.header__nav' ).toggleClass( 'header__nav--active' );
			} );
		} );

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
