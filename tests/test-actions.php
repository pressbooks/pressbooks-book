<?php
/**
 * Class ActionsTest
 *
 * @package Pressbooks_Book
 */

use function \Pressbooks\Book\Actions\render_lightbox_setting_field;
use function \Pressbooks\Book\Actions\theme_setup;

/**
 * Helpers test case.
 */
class ActionsTest extends WP_UnitTestCase {
	function test_render_lightbox_setting_field() {
		ob_start();
		render_lightbox_setting_field( [ 'Show linked images in a lightbox' ] );
		$buffer = ob_get_clean();
		$this->assertEquals( '<input id="enable_lightbox" name="pressbooks_theme_options_web[enable_lightbox]" type="checkbox" value="1" /><label for="enable_lightbox">Show linked images in a lightbox</label>', $buffer );
	}

	function test_theme_setup() {
		theme_setup();
		$this->assertEquals( [ 'caption' ], get_theme_support( 'html5' ) )
	}
}
