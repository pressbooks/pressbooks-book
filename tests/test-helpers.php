<?php
/**
 * Class HelpersTest
 *
 * @package Pressbooks_Book
 */

use function \PressbooksBook\Helpers\count_authors;
use function \PressbooksBook\Helpers\display_menu;
use function \PressbooksBook\Helpers\get_book_authors;
use function \PressbooksBook\Helpers\get_metakeys;
use function \PressbooksBook\Helpers\get_name_for_filetype;
use function \PressbooksBook\Helpers\get_source_book;
use function \PressbooksBook\Helpers\get_source_book_meta;
use function \PressbooksBook\Helpers\get_source_book_toc;
use function \PressbooksBook\Helpers\get_source_book_url;
use function \PressbooksBook\Helpers\is_book_public;
use function \PressbooksBook\Helpers\license_to_icons;
use function \PressbooksBook\Helpers\license_to_text;
use function \PressbooksBook\Helpers\share_icons;
use function \PressbooksBook\Helpers\social_media_enabled;

/**
 * Helpers test case.
 */
class HelpersTest extends WP_UnitTestCase {

	private function _setupGlobalPost() {
		$new_post = [
			'post_title' => 'Test Chapter',
			'post_type' => 'chapter',
			'post_status' => 'publish',
			'post_content' => 'My test chapter.',
		];
		$post_id = $this->factory()->post->create_object( $new_post );
		global $post;
		$post = get_post( $post_id );
	}

	function test_get_name_for_filetype() {
		$output = get_name_for_filetype( 'word' );
		$this->assertEquals( 'Word', $output );
	}

	function test_license_to_icons() {
		$output = license_to_icons( 'cc-by' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use href="#cc" /></svg><svg class="icon" style="fill: currentColor"><use href="#cc-by" /></svg>', $output );
		$output = license_to_icons( 'public-domain' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use href="#cc-pd" /></svg>', $output );
		$output = license_to_icons( 'cc-zero' );
		$this->assertEquals( '<svg class="icon" style="fill: currentColor"><use href="#cc-zero" /></svg>', $output );
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

	function test_display_menu() {
		$result = display_menu();
		$this->assertInternalType( 'string', $result );
		$this->assertContains( sprintf( '<li><a href="%1$s">Home</a></li>', get_home_url() ), $result );
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

	function test_get_source_book_toc() {
		$results = get_source_book_toc( 'garbage/' );
		$this->assertFalse( $results );

		$results = get_source_book_toc( 'https://book.pressbooks.com/' );
		$this->assertTrue( is_array( $results ) );
		$this->assertNotEmpty( $results );
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

	function test_get_metakeys() {
		$output = get_metakeys();
		$this->assertInternalType( 'array', $output );
	}

	function test_social_media_enabled() {
		$result = social_media_enabled();
		$this->assertTrue( $result );
	}

	function test_is_book_public() {
		$result = is_book_public();
		$this->assertTrue( $result );
	}

	function test_count_authors() {
		$result = count_authors( 'Author One, Author Two, and Author Three' );
		$this->assertEquals( 3, $result );
		$result = count_authors( 'Author One and Author Two' );
		$this->assertEquals( 2, $result );
		$result = count_authors( 'Author One' );
		$this->assertEquals( 1, $result );
		$result = count_authors( '' );
		$this->assertEquals( 0, $result );
	}

	function test_do_license() {
		$this->_setupGlobalPost();
		$license = \PressbooksBook\Helpers\do_license( [] );
		$this->assertContains( '<div class="license-attribution">', $license );
	}
}
