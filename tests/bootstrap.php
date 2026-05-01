<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Pressbooks_Book
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	throw new Exception( "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" );
}

// Define WP_CONTENT_DIR so frontend-tools Assets class can find manifest
// Assets class uses: WP_CONTENT_DIR . '/themes/{slug}' to locate theme assets
// We need to set this so the path resolves correctly for both local and CI environments
$theme_dir = dirname( __DIR__ );
$theme_slug = basename( $theme_dir );
$themes_dir = dirname( $theme_dir );

// Check if we're already in a proper 'themes' directory structure
if ( basename( $themes_dir ) === 'themes' ) {
	// Standard structure: /path/to/themes/pressbooks-book
	define( 'WP_CONTENT_DIR', dirname( $themes_dir ) );
} else {
	// CI structure: Theme not in a 'themes' folder - create symlink
	$fake_themes_dir = dirname( $themes_dir ) . '/themes';
	if ( ! is_dir( $fake_themes_dir ) ) {
		mkdir( $fake_themes_dir, 0755, true );
	}
	$symlink_path = $fake_themes_dir . '/' . $theme_slug;
	if ( ! file_exists( $symlink_path ) ) {
		symlink( $theme_dir, $symlink_path );
	}
	define( 'WP_CONTENT_DIR', dirname( $fake_themes_dir ) );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	$_pressbooks = '/tmp/wordpress/wp-content/plugins/pressbooks/pressbooks.php';
	if ( file_exists( $_pressbooks ) ) {
		require_once( $_pressbooks );
	} else {
		require_once( __DIR__ . '/../../../plugins/pressbooks/pressbooks.php' );
	}
}

function _register_theme() {

	$theme_dir = dirname( __DIR__ );
	$current_theme = basename( $theme_dir );
	$theme_root = dirname( $theme_dir );

	add_filter( 'theme_root', function() use ( $theme_root ) {
		return $theme_root;
	} );

	register_theme_directory( $theme_root );

	add_filter( 'pre_option_template', function() use ( $current_theme ) {
		return $current_theme;
	});
	add_filter( 'pre_option_stylesheet', function() use ( $current_theme ) {
		return $current_theme;
	});
}
function _add_ci_token_to_http_requests( $args ) {
	$token = getenv( 'X_PB_CI_TOKEN' );
	if ( ! $token ) {
		return $args;
	}
	if ( ! isset( $args['headers'] ) || ! is_array( $args['headers'] ) ) {
		$args['headers'] = [];
	}
	$args['headers']['x-pb-ci-token'] = $token;
	return $args;
}
tests_add_filter( 'http_request_args', '_add_ci_token_to_http_requests' );

tests_add_filter( 'muplugins_loaded', '_register_theme' );
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );


// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
