<?php

namespace Pressbooks\Book\Actions;

use Pressbooks\Container;
use PressbooksMix\Assets;

use function Pressbooks\Book\Helpers\social_media_enabled;

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

/**
 * Enqueue styles and scripts.
 *
 * @return null
 */
function enqueue_assets() {
	$assets = new Assets( 'pressbooks-book', 'theme' );
	$assets->setSrcDirectory( 'assets' )->setDistDirectory( 'dist' );
	$options = get_option( 'pressbooks_theme_options_web' );

	wp_enqueue_style( 'book/book', $assets->getPath( 'styles/book.css' ), false, null );
	wp_enqueue_style( 'book/webfonts', 'https://fonts.googleapis.com/css?family=Inconsolata|Karla:400,700|Spectral:400,700', false, null );
	if ( social_media_enabled() ) {
		wp_enqueue_script( 'sharer', $assets->getPath( 'scripts/sharer.js' ) );
	}
	wp_enqueue_script( 'pressbooks/book', $assets->getPath( 'scripts/book.js' ), [ 'jquery' ], null );
	wp_localize_script(
		'pressbooks/book',
		'PB_A11y',
		[
			'increase_label' => __( 'Increase Font Size', 'pressbooks-book' ),
			'decrease_label' => __( 'Decrease Font Size', 'pressbooks-book' ),
			'home_path' => ( is_subdomain_install() ) ? '/' : str_replace( network_home_url( '/' ), '/', home_url( '/' ) ),
			'comparison_loading' => __( 'Comparison loading…', 'pressbooks-book' ),
			'comparison_loaded' => __( 'Comparison loaded.', 'pressbooks-book' ),
			'chapter_not_loaded' => __( 'The original chapter could not be loaded.', 'pressbooks-book' ),
		]
	);

	if ( ! is_front_page() ) {
		if ( isset( $options['collapse_sections'] ) && absint( $options['collapse_sections'] ) === 1 ) {
			wp_enqueue_script( 'pressbooks/collapse-sections', $assets->getPath( 'scripts/collapse-sections.js' ), false, null );
		}

		if ( pb_is_custom_theme() ) { // Custom CSS is no longer supported.
			$styles = Container::get( 'Styles' );
			$sass = Container::get( 'Sass' );
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
		if ( WP_DEBUG ) {
			error_log( 'Updating web book stylesheet.' );
		}
		Container::get( 'Sass' )->updateWebBookStyleSheet();
	} else {
		if ( WP_DEBUG ) {
			error_log( 'No web book stylesheet update needed.' );
		}
	}
}


/**
 * Add metadata to head.
 *
 * @since 2.3.0
 *
 * @return null
 */
function add_metadata() {
	if ( is_front_page() ) {
		echo pb_get_seo_meta_elements();
		echo pb_get_microdata_elements();
	} else {
		echo pb_get_microdata_elements();
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
	add_theme_support( 'title-tag' );
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
	$width = $options['webbook_width'] ?? '40em';
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
