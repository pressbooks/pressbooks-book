<?php
/**
 * @author  Pressbooks <code@pressbooks.com>
 * @license GPLv2 (or any later version)
 */

/**
 * Ensure dependencies are loaded
 */
if ( ! class_exists( 'PressbooksMix\Assets' ) || ! function_exists( 'Sober\Intervention\intervention' ) ) {
	$composer = get_template_directory() . '/vendor/autoload.php';
	if ( ! file_exists( $composer ) ) {
		wp_die( sprintf(
			'<h1>%1$s</h1><p>%2$s</p>',
			__( 'Dependencies Missing', 'pressbooks-book' ),
			__( 'You must run <code>composer install</code> from the McLuhan directory.', 'pressbooks-book' )
		) );
	}
	require_once $composer;
}

/**
 * Ensure Pressbooks is working
 */
if ( ! function_exists( 'pb_meets_minimum_requirements' ) && ! @include_once( WP_PLUGIN_DIR . '/pressbooks/compatibility.php' ) ) { // @codingStandardsIgnoreLine
	wp_die( __( 'Cannot find Pressbooks install.', 'pressbooks-book' ) );
}
if ( ! pb_meets_minimum_requirements() ) {
	ob_start();
	do_action( 'admin_notices' );
	$buffer = ob_get_clean();
	wp_die( $buffer );
}

/* ------------------------------------------------------------------------ *
 * Pressbooks Book
 * ------------------------------------------------------------------------ */

$includes = [
	'actions',
	'filters',
	'helpers',
];

foreach ( $includes as $include ) {
	require get_template_directory() . "/inc/$include/namespace.php";
}
require get_template_directory() . '/inc/intervention.php';

add_action( 'pb_cache_delete', '\Pressbooks\Book\Actions\delete_cached_contents' );
add_action( 'wp_enqueue_scripts', '\Pressbooks\Book\Actions\enqueue_assets' );
add_action( 'wp_head', '\Pressbooks\Book\Actions\add_metadata' );
if ( defined( 'WP_ENV' ) && 'development' === WP_ENV ) {
	add_action( 'template_redirect', '\Pressbooks\Book\Actions\update_webbook_stylesheet' );
}
add_filter( 'excerpt_more', '\Pressbooks\Book\Filters\excerpt_more' );
add_filter( 'script_loader_tag', '\Pressbooks\Book\Filters\async_scripts', 10, 3 );
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'pb_pdf_hacks', '\Pressbooks\Book\Filters\pdf_hacks' );
add_filter( 'pb_epub_hacks', '\Pressbooks\Book\Filters\ebook_hacks' );
add_filter( 'pre_get_posts', '\Pressbooks\Book\Filters\filter_search' );
add_action( 'after_setup_theme', '\Pressbooks\Book\Actions\setup' );
add_action( 'wp_head', '\Pressbooks\Book\Actions\customizer_colors' );
add_action( 'wp_head', '\Pressbooks\Book\Actions\webbook_width' );
add_filter( 'the_title', 'Pressbooks\Book\Filters\add_private_to_title', 10, 2 );
