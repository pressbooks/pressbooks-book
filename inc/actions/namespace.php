<?php

namespace PressbooksBook\Actions;

use PressbooksFrontendTools\Assets;
use PressbooksFrontendTools\AssetType;
use Pressbooks\Container;
use Pressbooks\Options;

/**
 * Delete the cached Table of Contents.
 *
 * @see in/helpers/namespace.php
 */
function delete_cached_contents() {
	$transients = [ 'pb_book_subsections' ];
	foreach ( $transients as $transient ) {
		delete_transient( $transient );
	}
}

/**
 * Enqueue styles and scripts.
 *
 * @return void
 */
function enqueue_assets() {
	$assets = new Assets( 'pressbooks-book', AssetType::THEME );
	$options = get_option( 'pressbooks_theme_options_web' );
	$hypothesis_options = get_option( 'wp_hypothesis_options' );

	if ( ! defined( 'PB_GUTENBERG_TESTING' ) || ! PB_GUTENBERG_TESTING ) {
		wp_dequeue_style( 'wp-block-library' );
	}

	// Main book script (includes book.css, sharer.js, details-element-polyfill)
	$assets->enqueue( 'assets/src/scripts/book.js', 'pressbooks/book', [
		'dependencies' => [ 'jquery' ],
	] );

	wp_enqueue_style( 'book/webfonts', 'https://fonts.googleapis.com/css?family=Inconsolata|Karla:400,700|Spectral:400,700', false, null );

	if ( wp_script_is( 'hypothesis', 'enqueued' ) ) {
		$assets->enqueue( 'assets/src/scripts/pane.js', 'pressbooks/pane', [
			'in-footer' => true,
		] );
		wp_localize_script(
			'pressbooks/pane',
			'pressbooksHypothesis',
			[
				'showHighlights' => ( isset( $hypothesis_options['highlights-on-by-default'] ) ) ? true : false,
				'openSidebar' => ( isset( $hypothesis_options['sidebar-open-by-default'] ) ) ? true : false,
			]
		);
		foreach ( [ 'nohighlights', 'showhighlights', 'sidebaropen' ] as $handle ) {
			wp_dequeue_script( $handle );
		}
	}

	wp_localize_script(
		'pressbooks/book',
		'pressbooksBook',
		[
			'home_path' => ( is_subdomain_install() ) ? '/' : str_replace( network_home_url( '/' ), '/', home_url( '/' ) ),
			'comparison_loading' => __( 'Comparison loading…', 'pressbooks-book' ),
			'comparison_loaded' => __( 'Comparison loaded.', 'pressbooks-book' ),
			'chapter_not_loaded' => __( 'The original chapter could not be loaded.', 'pressbooks-book' ),
			'toggle_contents' => __( 'Toggle contents of', 'pressbooks-book' ),
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'text_diff_nonce' => wp_create_nonce( 'text_diff_nonce' ),
		]
	);

	wp_localize_script(
		'pressbooks/book',
		'pbAccessibility',
		[
			'opensNewWindow' => __( 'opens in new tab', 'pressbooks-book' ),
		]
	);

	if ( pb_is_custom_theme() ) { // Custom CSS is no longer supported.
		$styles   = Container::get( 'Styles' );
		$sass     = Container::get( 'Sass' );
		$fullpath = $sass->pathToUserGeneratedCss() . '/style.css';
		if ( ! @is_file( $fullpath ) ) { // @codingStandardsIgnoreLine
			$styles->updateWebBookStyleSheet( 'pressbooks-book' );
		}
		wp_enqueue_style( 'pressbooks/theme', $sass->urlToUserGeneratedCss() . '/style.css', false, @filemtime( $fullpath ), 'screen, print' ); // @codingStandardsIgnoreLine
	} else {
		$styles = Container::get( 'Styles' );
		if ( $styles->isCurrentThemeCompatible( 1 ) ) {
			// Supplementary webbook styles for older themes.
			$assets->enqueue( 'assets/legacy/styles/web-house-style.scss', 'pressbooks/web-house-style', [
				'css-only' => true,
			] );
		}
		if ( $styles->isCurrentThemeCompatible( 1 ) || $styles->isCurrentThemeCompatible( 2 ) ) {
			$sass = Container::get( 'Sass' );
			// Custom Styles
			if ( get_stylesheet() === 'pressbooks-book' && ! get_option( 'pressbooks_webbook_structure_version' ) ) {
				$styles->updateWebBookStyleSheet();
				update_option( 'pressbooks_webbook_structure_version', 1 );
			}
			$fullpath = $sass->pathToUserGeneratedCss() . '/style.css';
			if ( ! @is_file( $fullpath ) ) { // @codingStandardsIgnoreLine
				$styles->updateWebBookStyleSheet();
			}
			if ( $styles->isCurrentThemeCompatible( 1 ) && get_stylesheet() !== 'pressbooks-book' ) {
				wp_enqueue_style( 'pressbooks/book', get_template_directory_uri() . '/style.css', false, null, 'screen, print' );
			}
			wp_enqueue_style( 'pressbooks/theme', $sass->urlToUserGeneratedCss() . '/style.css', false, @filemtime( $fullpath ), 'screen, print' ); // @codingStandardsIgnoreLine
		} else {
			// Classic mode (does not use Sass)
			wp_enqueue_style( 'pressbooks/theme', get_stylesheet_directory_uri() . '/style.css', false, null, 'screen, print' );
		}
	}
	if ( ! is_front_page() ) {
		if ( isset( $options['collapse_sections'] ) && absint( $options['collapse_sections'] ) === 1 ) {
			$assets->enqueue( 'assets/src/scripts/collapse-sections.js', 'pressbooks/collapse-sections' );
		}

		if ( isset( $options['enable_lightbox'] ) && absint( $options['enable_lightbox'] ) === 1 ) {
			// Lightbox script includes lity.js and lity.css
			$assets->enqueue( 'assets/src/scripts/lightbox.js', 'pressbooks/lightbox', [
				'dependencies' => [ 'jquery' ],
			] );
		}
	}
}

/**
 * Update web book stylesheet.
 */
function update_webbook_stylesheet() {
	if ( false === Container::get( 'Styles' )->isCurrentThemeCompatible( 1 ) && false === Container::get( 'Styles' )->isCurrentThemeCompatible( 2 ) ) {
		return;
	}

	if ( Container::get( 'Styles' )->isCurrentThemeCompatible( 1 ) ) {
		$inputs = [
			get_stylesheet_directory() . '/_fonts-web.scss',
			get_stylesheet_directory() . '/_mixins.scss',
			get_stylesheet_directory() . '/style.scss',
		];
	} elseif ( Container::get( 'Styles' )->isCurrentThemeCompatible( 2 ) ) {
		$inputs = [
			get_stylesheet_directory() . '/assets/styles/web/_fonts.scss',
			get_stylesheet_directory() . '/assets/styles/web/style.scss',
		];
		foreach ( glob( get_stylesheet_directory() . '/assets/styles/components/*.scss' ) as $import ) {
			$inputs[] = realpath( $import );
		}
	} else {
		$inputs = [];
	}

	$output = Container::get( 'Sass' )->pathToUserGeneratedCss() . '/style.css';

	$recompile = false;

	foreach ( $inputs as $input ) {
		if ( @filemtime( $input ) > @filemtime( $output ) ) { // @codingStandardsIgnoreLine
			$recompile = true;
			break;
		}
	}

	if ( true === $recompile ) {
		Container::get( 'Styles' )->updateWebBookStyleSheet();
	}
}

/**
 * Run after_setup_theme functions.
 *
 * @since 2.3.0
 *
 * @return void
 */
function theme_setup() {
	load_theme_textdomain( 'pressbooks-book', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', [ 'caption' ] );
	remove_action( 'wp_head', 'wp_generator' );
}

/**
 * Output <style> tag with reading width variable.
 *
 * @since 2.3.0
 *
 * @return void
 */
function webbook_width() {
	$options = get_option( 'pressbooks_theme_options_web' );
	$width   = $options['webbook_width'] ?? '40em';
	printf( '<style type="text/css">:root{--reading-width:%s;}</style>', $width );
}

/**
 * Output <style> tag with custom color variables.
 *
 * @since 2.3.0
 *
 * @return void
 */
function customizer_colors() {
	echo \Pressbooks\Admin\Branding\get_customizer_colors();
}

/**
 * Add web theme option for lightbox functionality.
 *
 * @since 2.4.0
 *
 * @param string $_page The settings identifier, e.g. pressbooks_theme_options_web
 * @param string $_section The settings section identifier, e.g. web_options_section
 *
 * @return void
 */
function add_lightbox_setting( $_page, $_section ) {
	add_settings_field(
		'enable_lightbox',
		__( 'Enable Image Lightbox', 'pressbooks-book' ),
		'\PressbooksBook\Actions\render_lightbox_setting_field',
		$_page,
		$_section,
		[
			__( 'Show linked images in a lightbox', 'pressbooks-book' ),
		]
	);
}

/**
 * Render the lightbox setting field.
 *
 * @since 2.4.0
 *
 * @param array $args The arguments for the field.
 *
 * @return void
 */
function render_lightbox_setting_field( $args ) {
	unset( $args['label_for'], $args['class'] );
	$options = get_option( 'pressbooks_theme_options_web' );
	Options::renderCheckbox(
		[
			'id' => 'enable_lightbox',
			'name' => 'pressbooks_theme_options_web',
			'option' => 'enable_lightbox',
			'value' => ( isset( $options['enable_lightbox'] ) ) ? $options['enable_lightbox'] : '',
			'label' => $args[0],
		]
	);
}

/**
 * Handler for text_diff AJAX action.
 *
 * @since 2.8.0
 *
 * @return void
 */
function text_diff() {
	if ( check_ajax_referer( 'text_diff_nonce', 'security' && ! empty( $_POST['left'] ) && ! empty( $_POST['right'] ) ) ) {
		$diff = wp_text_diff(
			wp_unslash( $_POST['left'] ),
			wp_unslash( $_POST['right'] )
		);
		wp_send_json_success( wp_json_encode( $diff ) );
	}
	wp_send_json_error();
}

/**
 * Suppress Media Attachment pages. This code redirects bots, unprivileged users, away from the attachment page.
 *
 * Files used in open textbooks are openly licensed images where usage requires proper attribution. Images may receive attribution in the webbook, but this attribution does not
 * currently display on the standalone media attachment page. This can be problem.
 *
 * @since 2.8.13
 */
function redirect_attachment_page() {
	if ( is_attachment() && ! current_user_can( 'upload_files' ) ) {
		global $post;
		if ( $post && $post->post_parent ) {
			\Pressbooks\Redirect\location( esc_url( get_permalink( $post->post_parent ) ) );
		} else {
			\Pressbooks\Redirect\location( esc_url( home_url( '/' ) ) );
		}
	}
}

/**
 * Enqueue bootstrap assents for H5P listing page
 *
 * @since 2.9.2
 */
function enqueue_h5p_listing_bootstrap_files( $page = '' ) {
	$slug = 'h5p-listing';

	if ( is_page( $slug ) || $slug === $page ) {
		wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, null );
	}
}

/**
 * Register H5P listing page when the H5P plugin is activated.
 *
 * @since 2.9.2
 * @param string $plugin Path to the activated plugin.
 */
function register_h5p_listing_page_on_h5p_activation( $plugin ) {
	if ( 'h5p/h5p.php' === $plugin ) {
		register_h5p_listing_page();
	}
}

/**
 * Add H5P listing page.
 *
 * @since 2.9.2
 */
function register_h5p_listing_page() {
	if ( ! class_exists( 'H5P_Plugin' ) ) {
		return false;
	}

	$post_name = 'h5p-listing';
	$post_title = __( 'H5P listing', 'pressbooks-book' );
	$post_type = 'page';
	$user_id = 1;

	$exists = get_page_by_path( $post_name, OBJECT, $post_type );

	if ( $exists && $exists->post_status === 'publish' ) {
		return false;
	}

	$data = [
		'post_title' => $post_title,
		'post_name' => $post_name,
		'post_type' => $post_type,
		'post_status' => 'publish',
		'comment_status' => 'closed',
		'ping_status' => 'closed',
		'post_content' => '<!-- Here be dragons. -->',
		'post_author' => $user_id,
		'tags_input' => __( 'Default Data', 'pressbooks-book' ),
	];

	return wp_insert_post( $data, true );
}
