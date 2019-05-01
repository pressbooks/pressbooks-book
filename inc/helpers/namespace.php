<?php

namespace PressbooksBook\Helpers;

use Pressbooks\Container;

/**
 * Output HTML for a group of TOC elements.
 *
 * @since 2.0.0
 *
 * @param array $sections
 * @param string $post_type
 * @param bool $can_read
 * @param bool $can_read_private
 * @param int $permissive_private_content
 * @param array $book_subsections
 *
 * @return string The HTML blob for this TOC section group.
 */

function toc_sections( $sections, $post_type, $can_read, $can_read_private, $permissive_private_content, $book_subsections ) {
	global $post;
	$output = '';
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
		}
		$chapter_number = pb_get_chapter_number( $section['ID'] );
		$subsection_output = '';
		$subsections = false;
		if ( pb_should_parse_subsections() ) {
			$ptype = ( $post_type === 'chapter' ) ? 'chapters' : $post_type;
			$subsections = $book_subsections[ $ptype ][ $section['ID'] ] ?? false;
			if ( $subsections ) {
				$subsection_output .= '<ol class="toc__subsections">';
				foreach ( $subsections as $id => $name ) {
					$subsection_output .= sprintf(
						'<li class="toc__subsection"><a href="%1$s#%2$s">%3$s</a></li>',
						get_permalink( $section['ID'] ),
						$id,
						$name
					);
				}
				$subsection_output .= '</ol>';
			}
		}
		$section_class = "toc__{$post_type} ";
		$section_class .= pb_get_section_type( get_post( $section['ID'] ) );
		$section_class .= ( $subsections ) ? " toc__{$post_type}--full" : " toc__{$post_type}--empty";
		if ( $post ) {
			$section_class .= ( $post->ID === $section['ID'] ) ? ' toc__selected' : '';
		}
		$output .= sprintf(
			'<li id="%1$s" class="%2$s"><p class="toc__title"><a href="%3$s">%4$s%5$s%6$s</a>%7$s</li>',
			"toc-{$post_type}-{$section['ID']}",
			$section_class,
			get_permalink( $section['ID'] ),
			( $chapter_number ) ? "<span>$chapter_number.&nbsp;</span>" : '',
			pb_strip_br( $section['post_title'] ),
			( ! in_array( $section['post_status'], [ 'publish', 'web-only' ], true ) ) ? ' <svg class="icon--private" viewBox="0 0 36 36"><path fill="currentColor" d="M29 15v-3c0-6.1-4.9-11-11-11S7 5.9 7 12v3H3v16h30V15h-4zm-10 7.7V26h-2v-3.3c-.6-.3-1-1-1-1.7 0-1.1.9-2 2-2s2 .9 2 2c0 .7-.4 1.4-1 1.7zM18 15h-7v-3c0-3.9 3.1-7 7-7s7 3.1 7 7v3h-7z"/></svg>' : '',
			$subsection_output
		);
	}
	return $output;
}

/**
 * Return a human-readable filetype for a given filetype slug.
 *
 * @deprecated 2.8.0
 * @deprecated Use \Pressbooks\Modules\Export\get_name_from_filetype_slug() instead.
 *
 * @since 2.0.0
 *
 * @param string $filetype The filetype slug.
 *
 * @return string A human-readable filetype.
 */
function get_name_for_filetype( $filetype ) {
	if ( function_exists( '\Pressbooks\Modules\Export\get_name_from_filetype_slug' ) ) {
		return \Pressbooks\Modules\Export\get_name_from_filetype_slug( $filetype );
	}
	return ucfirst( $filetype );
}

/**
 * Return an SVG icon for a given license slug.
 *
 * @since 2.0.0
 *
 * @param string $license The license slug.
 *
 * @return string An SVG blob.
 */
function license_to_icons( $license ) {
	if ( ! $license ) {
		return '';
	}
	$output = '';
	if ( strpos( $license, 'cc' ) !== false && $license !== 'cc-zero' ) {
		$parts = explode( '-', $license );
		foreach ( $parts as $part ) {
			if ( $part !== 'cc' ) {
				$part = 'cc-' . $part;
			}
			$output .= sprintf( '<svg class="icon" style="fill: currentColor"><use xlink:href="#%s" /></svg>', $part );
		}
	} elseif ( $license === 'cc-zero' ) {
		$output .= '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc-zero" /></svg>';
	} elseif ( $license === 'public-domain' ) {
		$output .= '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc-pd" /></svg>';
	} elseif ( $license === 'all-rights-reserved' ) {
		return '';
	}
	return $output;
}

/**
 * Return a human-readable license name for a given license slug.
 *
 * @since 2.0.0
 *
 * @param string $license The license slug.
 *
 * @return string A human-readable license name.
 */
function license_to_text( $license ) {
	switch ( $license ) {
		case 'cc-zero':
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

/**
 * Return an HTML blob for the social media share widget.
 *
 * @since 2.0.0
 *
 * @return string The share widget.
 */
function share_icons() {
	return sprintf(
		'<a class="sharer" data-sharer="twitter" data-title="%1$s" data-url="%2$s" data-via="%3$s"><svg class="icon--svg"><use xlink:href="#twitter" /></svg></a>',
		__( 'Check out this great book on Pressbooks.', 'pressbooks-book' ),
		get_the_permalink(),
		'pressbooks'
	);
}

/**
 * Return an HTML blob for the primary menu contents.
 *
 * @since 2.0.0
 *
 * @return string The primary menu contents.
 */
function display_menu() {
	$items = sprintf(
		'<li><a href="%1$s">%2$s</a></li>',
		( is_front_page() ) ? '#main' : get_home_url(),
		__( 'Home', 'pressbooks-book' )
	);
	if ( pb_get_first_post_id() ) {
		$items .= sprintf(
			'<li><a href="%1$s">%2$s</a></li>',
			pb_get_first(),
			__( 'Read', 'pressbooks-book' )
		);
	}
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
	if ( ! is_wp_error( $response ) && $response['response']['code'] === 200 ) {
		$result = json_decode( $response['body'], true );
		if ( isset( $result['isBasedOn'] ) && ! in_array( $result['isBasedOn'], $checked, true ) ) {
			$checked[] = $result['isBasedOn'];
			$output    = get_source_book( $result['isBasedOn'], $checked );
		}
	}
	return $output;
}

/**
 * Get the (possibly cached) URL for the original source of a cloned book.
 *
 * @since 2.3.0
 *
 * @param string $book_url The URL of the book to trace.
 *
 * @return string The URL of the book's original source.
 */
function get_source_book_url( $book_url ) {
	$source_url = get_transient( 'pb_book_source_url' );
	if ( $source_url === false ) {
		$source_url = \PressbooksBook\Helpers\get_source_book( $book_url );
		set_transient( 'pb_book_source_url', $source_url );
	}
	return $source_url;
}

/**
 * Get the metadata from the original source of a cloned book.
 *
 * @since 2.3.0
 *
 * @param string $source_url The URL of the original book.
 *
 * @return array|false The metadata array, or false if no metadata was found.
 */
function get_source_book_meta( $source_url ) {
	$source_meta = get_transient( 'pb_book_source_metadata' );
	if ( $source_meta === false ) {
		$response = wp_remote_get( untrailingslashit( $source_url ) . '/wp-json/pressbooks/v2/metadata/' );
		if ( ! is_wp_error( $response ) && $response['response']['code'] === 200 ) {
			$source_meta = json_decode( $response['body'], true );
		} else {
			$source_meta = false;
		}
		set_transient( 'pb_book_source_metadata', $source_meta );
	}
	return $source_meta;
}

/**
 * Get the metadata from the original source of a cloned book.
 *
 * @since 2.3.0
 *
 * @param string $source_url The URL of the original book.
 *
 * @return array|false The metadata array, or false if no metadata was found.
 */
function get_source_book_toc( $source_url ) {
	$source_toc = get_transient( 'pb_book_source_toc' );
	if ( $source_toc === false ) {
		$response = wp_remote_get( untrailingslashit( $source_url ) . '/wp-json/pressbooks/v2/toc/' );
		if ( ! is_wp_error( $response ) && $response['response']['code'] === 200 ) {
			$source_toc = json_decode( $response['body'], true );
		} else {
			$source_toc = false;
		}
		set_transient( 'pb_book_source_toc', $source_toc );
	}
	return $source_toc;
}

/**
 * Lists a book's authors from API metadata.
 *
 * @since 2.3.0
 *
 * @param array $metadata The book metadata.
 * @return string The list of authors or an empty string if none exist.
 */

function get_book_authors( $metadata ) {
	if ( isset( $metadata['author'] ) ) {
		$authors = [];
		if ( array_key_exists( 'name', $metadata['author'] ) ) {
			$authors[] = $metadata['author']['name'];
		} else {
			foreach ( $metadata['author'] as $author ) {
				$authors[] = $author['name'];
			}
		};
		return \Pressbooks\Utility\oxford_comma( $authors );
	}
	return '';
}

/**
 * Get the original section for a cloned section.
 *
 * @since 2.3.0
 *
 * @param string $needle The URL of the cloned section.
 * @param array $haystack The TOC array for the source book.
 *
 * @return array|false  The section array from the source book TOC, or false if none was found.
 */

function get_original_section( $needle, $haystack ) {
	$parts     = explode( '/', untrailingslashit( $needle ) );
	$post_type = $parts[ count( $parts ) - 2 ];
	$slug      = $parts[ count( $parts ) - 1 ];

	if ( in_array( $post_type, [ 'front-matter', 'back-matter' ], true ) ) {
		foreach ( $haystack[ $post_type ] as $key => $value ) {
			if ( \Pressbooks\Utility\str_ends_with( $value['link'], trailingslashit( implode( '/', [ $post_type, $slug ] ) ) ) ) {
				return $value;
			}
		}
	}

	if ( $post_type === 'part' ) {
		foreach ( $haystack['parts'] as $key => $value ) {
			if ( \Pressbooks\Utility\str_ends_with( $value['link'], trailingslashit( implode( '/', [ $post_type, $slug ] ) ) ) ) {
				return $value;
			}
		}
	}

	if ( $post_type === 'chapter' ) {
		foreach ( $haystack['parts'] as $part ) {
			foreach ( $part['chapters'] as $key => $value ) {
				if ( \Pressbooks\Utility\str_ends_with( $value['link'], trailingslashit( implode( '/', [ $post_type, $slug ] ) ) ) ) {
					return $value;
				}
			}
		}
	}

	return false;
}

/**
 * Get an array of metadata keys for display in the metadata block.
 *
 * @since 2.3.0
 *
 * @return array
 */
function get_metakeys() {
	return [
		'pb_authors' => _n_noop( 'Author', 'Authors', 'pressbooks-book' ),
		'pb_editors' => _n_noop( 'Editor', 'Editors', 'pressbooks-book' ),
		'pb_translators' => _n_noop( 'Translator', 'Translators', 'pressbooks-book' ),
		'pb_reviewers' => _n_noop( 'Reviewer', 'Reviewers', 'pressbooks-book' ),
		'pb_illustrators' => _n_noop( 'Illustrator', 'Illustrators', 'pressbooks-book' ),
		'pb_contributors' => _n_noop( 'Contributor', 'Contributors', 'pressbooks-book' ),
		'pb_book_license' => __( 'License', 'pressbooks-book' ),
		'pb_primary_subject' => __( 'Primary Subject', 'pressbooks-book' ),
		'pb_additional_subjects' => __( 'Additional Subject(s)', 'pressbooks-book' ),
		'pb_publisher' => __( 'Publisher', 'pressbooks-book' ),
		'pb_publication_date' => __( 'Publication Date', 'pressbooks-book' ),
		'pb_book_doi' => __( 'Digital Object Identifier (DOI)', 'pressbooks-book' ),
		'pb_ebook_isbn' => __( 'Ebook ISBN', 'pressbooks-book' ),
		'pb_print_isbn' => __( 'Print ISBN', 'pressbooks-book' ),
		'pb_hashtag' => __( 'Hashtag', 'pressbooks-book' ),
	];
}

/**
 * Render Previous and next buttons
 *
 * @since 2.3.0
 *
 * @param bool $echo
 *
 * @return string|null
 */
function get_links( $echo = true ) {
	global $first_chapter, $prev_chapter, $next_chapter, $multipage;
	$first_chapter = pb_get_first();
	$prev_chapter = pb_get_prev();
	$prev_chapter_id = pb_get_prev_post_id();
	$prev_title = wp_strip_all_tags( html_entity_decode( get_the_title( $prev_chapter_id ) ) );
	$prev_short_title = get_post_meta( $prev_chapter_id, 'pb_short_title', true );
	$prev_label = ( $prev_short_title ) ? $prev_short_title : $prev_title;

	$next_chapter = pb_get_next();
	$next_chapter_id = pb_get_next_post_id();
	$next_title = wp_strip_all_tags( html_entity_decode( get_the_title( $next_chapter_id ) ) );
	$next_short_title = get_post_meta( $next_chapter_id, 'pb_short_title', true );
	$next_label = ( $next_short_title ) ? $next_short_title : $next_title;

	if ( $echo ) :
		?>
		<nav class="nav-reading <?php echo $multipage ? 'nav-reading--multipage' : '' ?>" role="navigation">
		<div class="nav-reading__previous js-nav-previous">
			<?php if ( $prev_chapter !== '/' ) { ?>
				<?php /* translators: %s: post title */ ?>
				<a href="<?php echo $prev_chapter; ?>" title="<?php printf( __( 'Previous: %s', 'pressbooks-book' ), $prev_title ); ?>">
					<svg class="icon--svg"><use xlink:href="#arrow-left" /></svg>
					<?php /* translators: %s: post short title or title */ ?>
					<?php printf( __( 'Previous: %s', 'pressbooks-book' ), $prev_label ); ?>
				</a>
			<?php } ?>
		</div>
		<div class="nav-reading__next js-nav-next">
			<?php if ( $next_chapter !== '/' ) : ?>
				<?php /* translators: %s: post title, */ ?>
				<a href="<?php echo $next_chapter ?>" title="<?php printf( __( 'Next: %s', 'pressbooks-book' ), $next_title ); ?>">
					<?php /* translators: %s: post short title or title */ ?>
					<?php printf( __( 'Next: %s', 'pressbooks-book' ), $next_label ); ?>
					<svg class="icon--svg"><use xlink:href="#arrow-right" /></svg>
				</a>
			<?php endif; ?>
		</div>
		<button class="nav-reading__up" >
			<svg class="icon--svg"><use xlink:href="#arrow-up" /></svg>
			<span class="screen-reader-text"><?php _e( 'Back to top', 'pressbooks' ); ?></span>
		</button>
		</nav>
		<?php
	endif;
}

/**
 * Determine if social media elements should be displayed.
 *
 * @since 2.3.0
 *
 * @return bool
 */
function social_media_enabled() {
	$options = get_option( 'pressbooks_theme_options_web' );
	if ( ! isset( $options['social_media'] ) ) {
		return true;
	} elseif ( isset( $options['social_media'] ) && absint( $options['social_media'] ) === 1 ) {
		return true;
	}
	return false;
}

/**
 * Determine if the book is private or public.
 *
 * @since 2.3.0
 *
 * @return bool
 */
function is_book_public() {
	global $blog_id;
	$blog_public = absint( get_option( 'blog_public' ) );
	if ( $blog_public === 1 || $blog_public === 0 && current_user_can_for_blog( $blog_id, 'read' ) ) {
		return true;
	}
	return false;
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own pressbooks_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 2.3.0
 *
 * @param \WP_Comment $comment
 * @param array $args
 * @param int $depth
 */
function comments_template( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case '':
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php /* translators: %s: name of commenter, %1$s: date of comment, %2$s: time of comment */ ?>
					<?php printf( __( '%s on', 'pressbooks-book' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> <?php printf( __( '%1$s at %2$s', 'pressbooks-book' ), get_comment_date(), get_comment_time() ); ?> <span class="says">says:</span><?php edit_comment_link( __( '(Edit)', 'pressbooks-book' ), ' ' ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( empty( $comment->comment_approved ) ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'pressbooks-book' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-body"><?php comment_text(); ?></div>

				<div class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args, [
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
							]
						)
					);
					?>
				</div><!-- .reply -->
			</div><!-- #comment-##  -->

			<?php
			break;
		case 'pingback':
		case 'trackback':
			?>
			<li class="post pingback">
			<p><?php _e( 'Pingback:', 'pressbooks-book' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'pressbooks-book' ), ' ' ); ?></p>
			<?php
			break;
	}
}

/**
 * Count authors in an oxford comma delimited string
 *
 * @since 2.3.0
 *
 * @param string $var
 *
 * @return int
 */
function count_authors( $var ) {
	return count( \Pressbooks\Utility\oxford_comma_explode( $var ) );
}

/**
 * Retrieve copyright HTML blob.
 *
 * @since 2.3.0
 *
 * @param bool $show_custom_copyright (optional, default is true)
 *
 * @return string
 */
function copyright_license( $show_custom_copyright = true ) {
	$metadata = \Pressbooks\Book::getBookInformation();

	if ( empty( $metadata['pb_book_license'] ) ) {
		$all_rights_reserved = true;
	} elseif ( $metadata['pb_book_license'] === 'all-rights-reserved' ) {
		$all_rights_reserved = true;
	} else {
		$all_rights_reserved = false;
	}
	if ( ! empty( $metadata['pb_custom_copyright'] ) && $show_custom_copyright ) {
		$has_custom_copyright = true;
	} else {
		$has_custom_copyright = false;
	}

	// Custom Copyright must override All Rights Reserved
	$html = '';
	if ( ! $has_custom_copyright || ( $has_custom_copyright && ! $all_rights_reserved ) ) {
		$html .= \PressbooksBook\Helpers\do_license( $metadata );
	}
	if ( $has_custom_copyright ) {
		$html .= '<div class="license-attribution">' . $metadata['pb_custom_copyright'] . '</div>';
	}

	return $html;
}

/**
 * Output the license.
 *
 * @since 2.3.0
 *
 * @param array $metadata
 *
 * @return string
 */
function do_license( $metadata ) {
	global $post;
	$id = $post->ID;
	try {
		$licensing = new \Pressbooks\Licensing();
		return $licensing->doLicense( $metadata, $id );
	} catch ( \Exception $e ) {
		error_log( $e->getMessage() ); // @codingStandardsIgnoreLine
	}
	return '';
}


/**
 * Determine if the book is using a modern version of Buckram.
 *
 * @since 2.3.0
 *
 * @return bool
 */
function is_buckram() {
	if ( Container::get( 'Styles' )->isCurrentThemeCompatible( 2 ) && version_compare( Container::get( 'Styles' )->getBuckramVersion(), '0.3.0' ) >= 0 ) {
		return true;
	}
	return false;
}
