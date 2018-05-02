<?php
/**
 * Class HelpersTest
 *
 * @package Pressbooks_Book
 */

use function \Pressbooks\Book\Helpers\get_name_for_filetype;

/**
 * Sample test case.
 */
class HelpersTest extends WP_UnitTestCase {
	function test_get_name_for_filetype() {
		$output = get_name_for_filetype( 'pdf' );
		$this->assertEquals( 'Digital PDF', $output );
	}
}
