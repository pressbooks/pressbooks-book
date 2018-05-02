<?php
/**
 * Class HelpersTest
 *
 * @package Pressbooks_Book
 */

use function \Pressbooks\Book\Helpers\get_name_for_filetype;
use function \Pressbooks\Book\Helpers\license_to_icons;
use function \Pressbooks\Book\Helpers\license_to_text;
use function \Pressbooks\Book\Helpers\share_icons;

/**
 * Helpers test case.
 */
class HelpersTest extends WP_UnitTestCase {
	function test_get_name_for_filetype() {
		$output = get_name_for_filetype( 'pdf' );
		$this->assertEquals( 'Digital PDF', $output );
	}
	function test_license_to_icons() {
		$output = license_to_icons( 'cc-by' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc" /></svg><svg class="icon" style="fill: currentColor"><use xlink:href="#cc-by" /></svg>', $output );
		$output = license_to_icons( 'public-domain' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc-pd" /></svg>', $output );
		$output = license_to_icons( 'all-rights-reserved' );
		$this->assertEquals( '', $output );
		$output = license_to_icons( 'foo' );
		$this->assertEquals( '', $output );
	}
	function test_license_to_text() {
		$output = license_to_text( 'cc-by' );
		$this->assertEquals( 'Creative Commons Attribution', $output );
		$output = license_to_text( 'foo' );
		$this->assertEquals( 'All Rights Reserved', $output );
	}
	function test_share_icons() {
		$this->assertStringStartsWith( '<a class="sharer" data-sharer="twitter" data-title="Check out this great book on Pressbooks."', share_icons() );
	}
}
