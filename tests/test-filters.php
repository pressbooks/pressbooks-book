<?php
/**
 * Class FiltersTest
 *
 * @package Pressbooks_Book
 */

/**
 * Helpers test case.
 */
class FiltersTest extends WP_UnitTestCase {
	function test_add_lightbox_to_settings() {
		$this->assertContains( 'enable_lightbox', \Pressbooks\Modules\ThemeOptions\WebOptions::getBooleanOptions() );
	}
}
