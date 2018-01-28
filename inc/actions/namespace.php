<?php

namespace Pressbooks\Book\Actions;

/**
 * Delete the cached Table of Contents.
 */
function delete_cached_contents() {
	delete_transient( 'pb_book_contents' );
}
