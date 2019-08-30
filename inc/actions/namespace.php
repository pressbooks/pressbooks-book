<?php

namespace PressbooksBook\Actions;

use function \PressbooksBook\Helpers\social_media_enabled;
use PressbooksMix\Assets;
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
 * @return null
 */
function enqueue_assets() {
	$assets = new Assets( 'pressbooks-book', 'theme' );
	$assets->setSrcDirectory( 'assets' )->setDistDirectory( 'dist' );
	$options = get_option( 'pressbooks_theme_options_web' );
	$hypothesis_options = get_option( 'wp_hypothesis_options' );

	if ( ! defined( 'PB_GUTENBERG_TESTING' ) || ! PB_GUTENBERG_TESTING ) {
		wp_dequeue_style( 'wp-block-library' );
	}
	wp_enqueue_style( 'book/book', $assets->getPath( 'styles/book.css' ), false, null );
	wp_enqueue_style( 'book/webfonts', 'https://fonts.googleapis.com/css?family=Inconsolata|Karla:400,700|Spectral:400,700', false, null );
	if ( social_media_enabled() ) {
		wp_enqueue_script( 'sharer', $assets->getPath( 'scripts/sharer.js' ) );
	}
	wp_enqueue_script( 'jquery-scrollto', $assets->getPath( 'scripts/jquery.scrollTo.js' ), [ 'jquery' ], null, true );
	wp_enqueue_script( 'jquery-localscroll', $assets->getPath( 'scripts/jquery.localScroll.js' ), [ 'jquery', 'jquery-scrollto' ], null, true );
	wp_enqueue_script( 'pressbooks/book', $assets->getPath( 'scripts/book.js' ), [ 'jquery', 'jquery-scrollto' ], null );
	if ( wp_script_is( 'hypothesis', 'enqueued' ) ) {
		wp_enqueue_script( 'pressbooks/pane', $assets->getPath( 'scripts/pane.js' ), false, null, true );
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
	// <details> tag needs polyfill for MS Edge
	wp_enqueue_script( 'details-element-polyfill', $assets->getPath( 'scripts/details-element-polyfill.js' ), [], '2.4.0', true );

	wp_localize_script(
		'pressbooks/book',
		'pressbooksBook',
		[
			'increase_label' => __( 'Increase Font Size', 'pressbooks-book' ),
			'decrease_label' => __( 'Decrease Font Size', 'pressbooks-book' ),
			'home_path' => ( is_subdomain_install() ) ? '/' : str_replace( network_home_url( '/' ), '/', home_url( '/' ) ),
			'comparison_loading' => __( 'Comparison loading…', 'pressbooks-book' ),
			'comparison_loaded' => __( 'Comparison loaded.', 'pressbooks-book' ),
			'chapter_not_loaded' => __( 'The original chapter could not be loaded.', 'pressbooks-book' ),
			'toggle_contents' => __( 'Toggle contents of', 'pressbooks-book' ),
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'text_diff_nonce' => wp_create_nonce( 'text_diff_nonce' ),
		]
	);

	if ( ! is_front_page() ) {
		if ( isset( $options['collapse_sections'] ) && absint( $options['collapse_sections'] ) === 1 ) {
			wp_enqueue_script( 'pressbooks/collapse-sections', $assets->getPath( 'scripts/collapse-sections.js' ), false, null );
		}

		if ( isset( $options['enable_lightbox'] ) && absint( $options['enable_lightbox'] ) === 1 ) {
			wp_enqueue_script( 'lity', $assets->getPath( 'scripts/lity.js' ), [ 'jquery' ], null );
			wp_enqueue_style( 'lity', $assets->getPath( 'styles/lity.css' ), false, null );
			wp_enqueue_script( 'pressbooks/lightbox', $assets->getPath( 'scripts/lightbox.js' ), false, null );
		}

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
				wp_enqueue_style( 'pressbooks/web-house-style', $assets->getPath( 'styles/web-house-style.css' ), false, null );
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
 * @return null
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
 * @return null
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
 * @return null
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
 * @return null
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
 * @return null
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
 * @return null
 */
function text_diff() {
	if ( check_ajax_referer( 'text_diff_nonce', 'security' ) ) {
		$diff = wp_text_diff(
			$_POST['left'],
			$_POST['right']
		);
		wp_send_json_success( wp_json_encode( $diff ) );
	}
	wp_send_json_error();
}
