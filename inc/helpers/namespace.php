<?php

namespace Pressbooks\Book\Helpers;

function toc_sections( $sections, $post_type, $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ) {
	global $blog_id;
	foreach ( $sections as $section ) {
		if ( ! in_array( $section['post_status'], [ 'publish', 'web-only' ], true ) ) {
			if ( ! $can_read_private ) {
				if ( $can_read ) {
					if ( $permissive_private_content !== 1 ) {
						continue; // Skip this one.
					}
				} elseif ( ! $can_read ) {
					continue; // Skip this one.
				}
			}
		} ?>
		<li class="toc__<?php echo $post_type; ?> <?php echo pb_get_section_type( get_post( $section['ID'] ) ) ?>">
			<?php if ( $post_type !== 'chapter' ) {?>
			<div class="inner-content">
			<?php } ?>
				<a class="toc__chapter-title" href="<?php echo get_permalink( $section['ID'] ); ?>">
					<?php $chapter_number = pb_get_chapter_number( $section['post_name'] );
					if ( $chapter_number ) {
						echo "<span>$chapter_number.&nbsp;</span>";
					}
					echo pb_strip_br( $section['post_title'] );?>
				</a>
				<?php if ( $should_parse_subsections ) {
					$subsections = pb_get_subsections( $section['ID'] );
					if ( $subsections ) { ?>
						<ol class="toc__subsections">
						<?php foreach ( $subsections as $id => $name ) { ?>
							<li class="toc__subsection"><a href="<?php echo get_permalink( $section['ID'] ); ?>#<?php echo $id; ?>"><?php echo $name; ?></a></li>
						<?php } ?>
						</ol>
					<?php }
}
if ( $post_type !== 'chapter' ) { ?>
				</div>
			<?php } ?>
		</li>
	<?php }
}

function get_name_for_filetype( $filetype ) {
	/**
	 * Add custom export file types to the array of human-readable file types.
	 * @since 2.0.0
	 */
	$formats = apply_filters( 'pb_export_filetype_names', [
		'print-pdf' => __( 'Print PDF', 'pressbooks-book' ),
		'pdf' => __( 'Digital PDF', 'pressbooks-book' ),
		'mpdf' => __( 'Digital PDF', 'pressbooks-book' ),
		'htmlbook' => __( 'HTMLBook', 'pressbooks-book' ),
		'epub' => __( 'EPUB', 'pressbooks-book' ),
		'mobi' => __( 'MOBI', 'pressbooks-book' ),
		'epub3' => __( 'EPUB3', 'pressbooks-book' ),
		'xhtml' => __( 'XHTML', 'presbooks-book' ),
		'odf' => __( 'OpenDocument', 'pressbooks-book' ),
		'wxr' => __( 'Pressbooks XML', 'pressbooks-book' ),
		'vanillawxr' => __( 'WordPress XML', 'pressbooks' ),
	] );

	return $formats[ $filetype ];
}

function license_to_icons( $license ) {
	if ( ! $license ) {
		return '';
	}
	$output = '';
	if ( strpos( $license, 'cc' ) !== false ) {
		$parts = explode( '-', $license );
		foreach ( $parts as $part ) {
			if ( $part !== 'cc' ) {
				$part = 'cc-' . $part;
			}
			$output .= sprintf( '<svg class="icon" style="fill: #000"><use xlink:href="#%s" /></svg>', $part );
		}
	} elseif ( $license === 'public-domain' ) {
		$output .= '<svg class="icon" style="fill: #000"><use xlink:href="#cc-zero" /></svg>';
	} elseif ( $license === 'all-rights-reserved' ) {
		return '';
	}
	return $output;
}

function license_to_text( $license ) {
	switch ( $license ) {
		case 'public-domain':
			return __( 'Public Domain', 'pressbooks-book' );
			break;
		case 'cc-by':
			return __( 'Creative Commons Attribution', 'pressbooks-book' );
			break;
		case 'cc-by-sa':
			return __( 'Creative Commons Attribution ShareAlike', 'pressbooks-book' );
			break;
		case 'cc-by-nd':
			return __( 'Creative Commons Attribution NoDerivatives', 'pressbooks-book' );
			break;
		case 'cc-by-nc':
			return __( 'Creative Commons Attribution NonCommercial', 'pressbooks-book' );
			break;
		case 'cc-by-nc-sa':
			return __( 'Creative Commons Attribution NonCommercial ShareAlike', 'pressbooks-book' );
			break;
		case 'cc-by-nc-nd':
			return __( 'Creative Commons Attribution NonCommercial NoDerivatives', 'pressbooks-book' );
			break;
		case 'all-rights-reserved':
		default:
			return __( 'All Rights Reserved', 'pressbooks-book' );
	}
}

function share_icons() {
	$output = '';
	$output .= '<a class="sharer" data-sharer="twitter" data-title="' . __( 'Check out this great book on Pressbooks.', 'pressbooks-book' ) . '" data-url="' . get_the_permalink() . '" data-via="pressbooks"><svg class="icon--svg"><use xlink:href="#twitter" /></svg></a>';
	$output .= '<a class="sharer" data-sharer="facebook" data-title="' . __( 'Check out this great book on Pressbooks.', 'pressbooks-book' ) . '" data-url="' . get_the_permalink() . '"><svg class="icon--svg"><use xlink:href="#facebook" /></svg></a>';
	return $output;
}

function display_menu() {
	$items = sprintf(
		'<li><a href="%1$s">%2$s</a></li>',
		( is_front_page() ) ? '#main' : get_home_url(),
		__( 'Home', 'pressbooks-book' )
	);
	$items .= sprintf(
		'<li><a href="%1$s">%2$s</a></li>',
		( get_permalink() === pb_get_first() ) ? '#main' : pb_get_first(),
		__( 'Read', 'pressbooks-book' )
	);
	if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) {
		$items .= sprintf(
			'<li><a href="%1$s">%2$s</a></li>',
			( get_page_link() === home_url( '/buy/' ) ) ? '#main' : home_url( '/buy/' ),
			__( 'Buy', 'pressbooks-book' )
		);
	}
	if ( ! is_user_logged_in() ) {
		$items .= sprintf(
			'<li><a href="%1$s">%2$s</a></li>',
			wp_login_url( get_permalink() ),
			__( 'Sign in', 'pressbooks-book' )
		);
	} else {
		if ( is_super_admin() || is_user_member_of_blog() ) {
			$items .= sprintf(
				'<li><a href="%1$s">%2$s</a></li>',
				admin_url(),
				__( 'Admin', 'pressbooks-book' )
			);
		}
		$items .= sprintf(
			'<li><a href="%1$s">%2$s</a></li>',
			wp_logout_url( get_permalink() ),
			__( 'Sign out', 'pressbooks-book' )
		);
	}
	$items .= sprintf(
		'<li class="header__search js-search"><div class="header__search__form">%s</div></li>',
		get_search_form( false )
	);

	return $items;
}

/**
 * Get the original source of a cloned book.
 *
 * @since 2.0.0
 *
 * @param string $book_url The URL of the book to trace.
 * @param array $checked An array of book URLs which have already been checked.
 *
 * @return string The URL of the original book.
 */
function get_source_book( $book_url, $checked = [] ) {
	$output = $book_url;
	$args = [];
	if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
		$args['sslverify'] = false;
	}
	$response = wp_remote_get( untrailingslashit( $book_url ) . '/wp-json/pressbooks/v2/metadata/', $args );
	$result = json_decode( $response['body'], true );
	if ( isset( $result['isBasedOn'] ) && ! in_array( $result['isBasedOn'], $checked, true ) ) {
		$checked[] = $result['isBasedOn'];
		$output = get_source_book( $result['isBasedOn'], $checked );
	}
	return $output;
}
