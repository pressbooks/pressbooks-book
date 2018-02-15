<?php

namespace Pressbooks\Book\Actions;

/**
 * Delete the cached Table of Contents.
 */
function delete_cached_contents() {
	global $wpdb;
	$results = $wpdb->get_results( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE ('_transient_pb_book_contents%')" );
	foreach ( $results as $val ) {
		$transient = str_replace( '_transient_', '', $val->option_name );
		delete_transient( $transient );
	}
}
