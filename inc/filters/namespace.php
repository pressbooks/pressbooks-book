<?php

namespace PressbooksBook\Filters;

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

/**
 * Asynchronous loading to improve speed of page load.
 *
 * @see https://core.trac.wordpress.org/ticket/12009
 *
 * @since 1.7.0
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 *
 * @return string
 */

function async_scripts( $tag, $handle, $src ) {
	$async = [
		'pressbooks/book',
		'sharer',
	];

	if ( in_array( $handle, $async, true ) ) {
		return "<script async type='text/javascript' src='{$src}'></script>" . "\n";
	}

	return $tag;
}

/**
 * Return 401 for private chapters, discourages "phone numbers in titles" spam. We don't want those indexed by Google.
 *
 * Hooked into `status_header`
 *
 * @since 2.4.1
 *
 * @param string $status_header
 * @param int $code
 *
 * @return string
 */
function status_code_adjustment( $status_header, $code ) {
	if ( is_admin() ) {
		// Ignore admin requests
		return $status_header;
	}
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST === true ) {
		// Ignore rest requests
		return $status_header;
	}
	if (
		200 === absint( $code ) &&
		\PressbooksBook\Helpers\is_book_public() === false &&
		array_key_exists( 'format', $GLOBALS['wp_query']->query_vars ) === false
	) {
		$code          = 401;
		$protocol      = wp_get_server_protocol();
		$msg           = get_status_header_desc( $code );
		$status_header = "{$protocol} {$code} {$msg}";
	}
	return $status_header;
}

/**
 * Replace the excerpt more tag with a custom link.
 *
 * @since 2.3.0
 *
 * @param string $more The default more tag.
 *
 * @return string
 */

function excerpt_more( $more ) {
	global $post;
	return '<a class="more-tag" href="' . get_permalink( $post->ID ) . '"> Read more &raquo;</a>';
}

/**
 * Filter PDF hacks.
 *
 * @since 2.3.0
 *
 * @param array $hacks
 *
 * @return array
 */
function pdf_hacks( $hacks ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	$hacks['pdf_footnotes_style'] = $options['pdf_footnotes_style'];

	return $hacks;
}

/**
 * Filter Ebook hacks.
 *
 * @since 2.3.0
 *
 * @param array $hacks
 *
 * @return array
 */
function ebook_hacks( $hacks ) {

	// --------------------------------------------------------------------
	// Global Options

	$options = get_option( 'pressbooks_theme_options_global' );

	// Display chapter numbers?
	if ( $options['chapter_numbers'] ) {
		$hacks['chapter_numbers'] = true;
	}

	// --------------------------------------------------------------------
	// Ebook Options

	$options = get_option( 'pressbooks_theme_options_ebook' );

	// Compress images
	if ( $options['ebook_compress_images'] ) {
		$hacks['ebook_compress_images'] = true;
	}

	return $hacks;
}

/**
 * Restrict search to post types we support on the front end.
 *
 * @param \WP_Query $query
 * @return \WP_Query
 */
function filter_search( $query ) {
	if ( $query->is_search && ! is_admin() ) {
		$query->set( 'post_type', [ 'front-matter', 'back-matter', 'chapter', 'part' ] );
	}

	return $query;
}

/**
 * Add lightbox setting to sanitization hook.
 *
 * @since 2.4.0
 *
 * @param array $settings
 */
function add_lightbox_to_settings( $settings ) {
	$settings[] = 'enable_lightbox';
	return $settings;
}
