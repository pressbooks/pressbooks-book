<?php

namespace Pressbooks\Book\Actions;

/**
 * Delete the cached Table of Contents.
 *
 * @see partials/content-toc.php
 */
function delete_cached_contents() {
	$bits = 3;
	$max = ( 1 << $bits );
	$transients = [];
	for ( $i = 0; $i < $max; $i++ ) {
		$t = str_pad( decbin( $i ), $bits, '0', STR_PAD_LEFT );
		$t = str_replace( [ 1, 0 ], [ 'x', 'o' ], $t );
		$transients[] = "pb_book_contents_{$t}";
	}
	foreach ( $transients as $transient ) {
		delete_transient( $transient );
	}
}
