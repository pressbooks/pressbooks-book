<?php
/**
 * @author  Pressbooks <code@pressbooks.com>
 * @license GPLv3 (or any later version)
 */

/**
 * Ensure dependencies are loaded
 */
if ( ! class_exists( 'PressbooksMix\Assets' ) || ! function_exists( 'Sober\Intervention\intervention' ) ) {
	$composer = get_template_directory() . '/vendor/autoload.php';
	if ( ! file_exists( $composer ) ) {
		wp_die(
			sprintf(
				'<h1>%1$s</h1><p>%2$s</p>',
				__( 'Dependencies Missing', 'pressbooks-book' ),
				__( 'You must run <code>composer install</code> from the McLuhan directory.', 'pressbooks-book' )
			)
		);
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

add_action( 'init', '\PressbooksBook\Actions\register_h5p_listing_page' );
add_action( 'wp_enqueue_scripts', '\PressbooksBook\Actions\enqueue_h5p_listing_bootstrap_files' );
add_action( 'pb_cache_delete', '\PressbooksBook\Actions\delete_cached_contents' );
add_action( 'wp_enqueue_scripts', '\PressbooksBook\Actions\enqueue_assets' );
add_action( 'wp_head', '\Pressbooks\Metadata\add_json_ld_metadata' );
add_action( 'wp_head', '\Pressbooks\Metadata\add_citation_metadata' );
if ( defined( 'WP_ENV' ) && 'development' === WP_ENV ) {
	add_action( 'template_redirect', '\PressbooksBook\Actions\update_webbook_stylesheet' );
}
add_filter( 'status_header', '\PressbooksBook\Filters\status_code_adjustment', 10, 2 );
add_filter( 'excerpt_more', '\PressbooksBook\Filters\excerpt_more' );
add_filter( 'script_loader_tag', '\PressbooksBook\Filters\async_scripts', 10, 3 );
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'pb_pdf_hacks', '\PressbooksBook\Filters\pdf_hacks' );
add_filter( 'pb_epub_hacks', '\PressbooksBook\Filters\ebook_hacks' );
add_filter( 'pre_get_posts', '\PressbooksBook\Filters\filter_search' );
add_action( 'after_setup_theme', '\PressbooksBook\Actions\theme_setup' );
add_action( 'wp_head', '\PressbooksBook\Actions\customizer_colors' );
add_action( 'wp_head', '\PressbooksBook\Actions\webbook_width' );
add_filter( 'the_title', 'PressbooksBook\Filters\add_private_to_title', 10, 2 );
add_action( 'pb_theme_options_web_add_settings_fields', '\PressbooksBook\Actions\add_lightbox_setting', 10, 2 );
add_filter( 'pb_theme_options_web_booleans', '\PressbooksBook\Filters\add_lightbox_to_settings' );
add_action( 'template_redirect', '\PressbooksBook\Actions\redirect_attachment_page' );

if ( is_admin() ) {
	add_action( 'wp_ajax_text_diff', '\PressbooksBook\Actions\text_diff' );
	add_action( 'wp_ajax_nopriv_text_diff', '\PressbooksBook\Actions\text_diff' );
}
