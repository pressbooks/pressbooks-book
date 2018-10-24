<?php
/**
 * Class HelpersTest
 *
 * @package Pressbooks_Book
 */

use function \Pressbooks\Book\Helpers\get_book_authors;
use function \Pressbooks\Book\Helpers\get_metakeys;
use function \Pressbooks\Book\Helpers\get_name_for_filetype;
use function \Pressbooks\Book\Helpers\get_source_book;
use function \Pressbooks\Book\Helpers\get_source_book_url;
use function \Pressbooks\Book\Helpers\get_source_book_meta;
use function \Pressbooks\Book\Helpers\get_source_book_toc;
use function \Pressbooks\Book\Helpers\license_to_icons;
use function \Pressbooks\Book\Helpers\license_to_text;
use function \Pressbooks\Book\Helpers\share_icons;

/**
 * Helpers test case.
 */
class HelpersTest extends WP_UnitTestCase {
	function test_get_metakeys() {
		$output = get_metakeys();
		$this->assertInternalType( 'array', $output );
	}

	function test_get_name_for_filetype() {
		$output = get_name_for_filetype( 'pdf' );
		$this->assertEquals( 'Digital PDF', $output );
	}
	function test_license_to_icons() {
		$output = license_to_icons( 'cc-by' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc" /></svg><svg class="icon" style="fill: currentColor"><use xlink:href="#cc-by" /></svg>', $output );
		$output = license_to_icons( 'public-domain' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc-pd" /></svg>', $output );
		$output = license_to_icons( 'cc-zero' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use xlink:href="#cc-zero" /></svg>', $output );
		$output = license_to_icons( 'all-rights-reserved' );
		$this->assertEquals( '', $output );
		$output = license_to_icons( 'foo' );
		$this->assertEquals( '', $output );
	}
	function test_license_to_text() {
		$output = license_to_text( 'cc-by' );
		$this->assertEquals( 'Creative Commons Attribution', $output );
		$output = license_to_text( 'cc-zero' );
		$this->assertEquals( 'Public Domain', $output );
		$output = license_to_text( 'foo' );
		$this->assertEquals( 'All Rights Reserved', $output );
	}
	function test_share_icons() {
		$this->assertStringStartsWith( '<a class="sharer" data-sharer="twitter" data-title="Check out this great book on Pressbooks."', share_icons() );
	}
	function test_get_source_book() {
		$output = get_source_book( 'https://book.pressbooks.com' );
		$this->assertEquals( 'https://book.pressbooks.com', $output );
	}
	function test_get_source_book_url() {
		$output = get_source_book_url( 'https://book.pressbooks.com' );
		$this->assertEquals( 'https://book.pressbooks.com', $output );
	}
	function test_get_source_book_meta() {
		$output = get_source_book_toc( 'garbage/' );
		$this->assertFalse( $output );

		$output = get_source_book_meta( 'https://book.pressbooks.com' );
		$this->assertArrayHasKey( 'name', $output );
		$this->assertEquals( "Book: A Futurist's Manifesto", $output['name'] );
	}

	function test_get_book_authors() {
		$output = get_book_authors( [] );
		$this->assertEquals( '', $output );
		$output = get_book_authors( [
			'author' => [
				'@type' => 'Person',
				'name' => 'Some Author',
			],
		] );
		$this->assertEquals( 'Some Author', $output );
		$output = get_book_authors( [
			'author' => [
				[
					'@type' => 'Person',
					'name' => 'Thing One',
				],
				[
					'@type' => 'Person',
					'name' => 'Thing Two',
				],
			],
		] );
		$this->assertEquals( 'Thing One and Thing Two', $output );
		$output = get_book_authors( [
			'author' => [
				[
					'@type' => 'Person',
					'name' => 'First',
				],
				[
					'@type' => 'Person',
					'name' => 'Second',
				],
				[
					'@type' => 'Person',
					'name' => 'Third',
				],
			],
		] );
		$this->assertEquals( 'First, Second, and Third', $output );
	}

	function test_get_source_book_toc() {
		$results = get_source_book_toc( 'garbage/' );
		$this->assertFalse( $results );

		$results = get_source_book_toc( 'https://book.pressbooks.com/' );
		$this->assertTrue( is_array( $results ) );
		$this->assertNotEmpty( $results );
	}
}
