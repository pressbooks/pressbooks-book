<?php

namespace Pressbooks\Book\Filters;

/**
 * Prepends "Private: " to the titles of draft posts.
 *
 * @since 2.0.0
 *
 * @param string $title
 * @param null|int $id
 *
 * @return string
 */
function add_private_to_title( $title, $id = null ) {
	if ( get_post_status( $id ) === 'draft' ) {
		return sprintf(
			'%1$s: %2$s',
			__( 'Private', 'pressbooks-book' ),
			$title
		);
	}

	return $title;
}
