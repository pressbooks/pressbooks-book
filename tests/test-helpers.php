<?php
/**
 * Class HelpersTest
 *
 * @package Pressbooks_Book
 */

use function \PressbooksBook\Helpers\count_items;
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
use function \PressbooksBook\Helpers\should_cta_banner_be_displayed;

/**
 * Helpers test case.
 *
 * @group helpers
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
		$this->assertIsString( $result );
		$this->assertStringContainsString(
			sprintf(
				'<li class="nav--primary-item nav--primary-item-home"><a href="%1$s">Home</a></li>',
				get_home_url()
			),
			$result
		);
	}

	function test_get_source_book() {
		$output = get_source_book( 'https://pressbooks.pub/book' );
		$this->assertEquals( 'https://pressbooks.pub/book', $output );
	}

	function test_get_source_book_url() {
		$output = get_source_book_url( 'https://pressbooks.pub/book' );
		$this->assertEquals( 'https://pressbooks.pub/book', $output );
	}

	function test_get_source_book_meta() {
		$output = get_source_book_toc( 'garbage/' );
		$this->assertFalse( $output );

		$output = get_source_book_meta( 'https://pressbooks.pub/book' );
		$this->assertArrayHasKey( 'name', $output );
		$this->assertEquals( "Book: A Futurist's Manifesto", $output['name'] );
	}

	function test_get_source_book_toc() {
		$results = get_source_book_toc( 'garbage/' );
		$this->assertFalse( $results );

		$results = get_source_book_toc( 'https://pressbooks.pub/book/' );
		$this->assertTrue( is_array( $results ) );
		$this->assertNotEmpty( $results );
	}

	function test_get_book_authors() {
		$output = get_book_authors( [] );
		$this->assertEquals( '', $output );
		$output = get_book_authors(
			[
				'author' => [
					'@type' => 'Person',
					'name' => 'Some Author',
				],
			]
		);
		$this->assertEquals( 'Some Author', $output );
		$output = get_book_authors(
			[
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
			]
		);
		$this->assertEquals( 'Thing One and Thing Two', $output );
		$output = get_book_authors(
			[
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
			]
		);
		$this->assertEquals( 'First, Second, and Third', $output );
	}

	function test_get_metakeys() {
		$output = get_metakeys();
		$this->assertIsArray( $output );
	}

	function test_social_media_enabled() {
		$result = social_media_enabled();
		$this->assertTrue( $result );
	}

	function test_is_book_public() {
		$result = is_book_public();
		$this->assertTrue( $result );
	}

	function test_count_items() {
		$result = count_items( 'Author One, Author Two, and Author Three' );
		$this->assertEquals( 3, $result );
		$result = count_items( 'Author One and Author Two' );
		$this->assertEquals( 2, $result );
		$result = count_items( 'Author One' );
		$this->assertEquals( 1, $result );
		$result = count_items( '' );
		$this->assertEquals( 0, $result );
		$this->assertEquals( 3, count_items( ['Item one', 'Item two', 'Item 3'] ) );
		$this->assertEquals( 1, count_items( ['Item one'] ) );
		$this->assertEquals( 0, count_items( [] ) );
	}

	function test_do_license() {
		$this->_setupGlobalPost();
		$license = \PressbooksBook\Helpers\do_license( [] );
		$this->assertStringContainsString( '<div class="license-attribution">', $license );
	}

	function test_get_h5p_activities() {

		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta(
			"CREATE TABLE {$wpdb->prefix}h5p_contents (
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      title VARCHAR(255) NOT NULL,
      library_id INT UNSIGNED NOT NULL,
      PRIMARY KEY  (id)
    )"
		);

		dbDelta(
			"CREATE TABLE {$wpdb->prefix}h5p_libraries (
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      title VARCHAR(255) NOT NULL,
      PRIMARY KEY  (id)
    )"
		);

		dbDelta(
			[
				"INSERT INTO {$wpdb->prefix}h5p_libraries (title) VALUES ('Activity 1');",
				"INSERT INTO {$wpdb->prefix}h5p_libraries (title) VALUES ('Activity 2');",
				"INSERT INTO {$wpdb->prefix}h5p_libraries (title) VALUES ('Activity 3');",
				"INSERT INTO {$wpdb->prefix}h5p_contents (title,library_id) VALUES ('Assigned 1',1);",
				"INSERT INTO {$wpdb->prefix}h5p_contents (title,library_id) VALUES ('Assigned 2',2);",
				"INSERT INTO {$wpdb->prefix}h5p_contents (title,library_id) VALUES ('Assigned 3',3);",
			]
		);

		$data = \PressbooksBook\Helpers\get_h5p_activities( 1 );

		$this->assertEquals( '3', $data['total'] );
		$this->assertEquals( 1, count( $data['activities'] ) );
		$this->assertTrue( str_contains( $data['pagination'], 'page=2"' ) );
		$this->assertTrue( str_contains( $data['pagination'], 'page=3"' ) );

		$_GET['h5p_id'] = $data['activities'][0]['ID'];
		$data = \PressbooksBook\Helpers\get_h5p_activities();
		$this->assertEquals( '1', $data['total'] );
		$this->assertEquals( 1, count( $data['activities'] ) );
		$this->assertEquals( $_GET['h5p_id'], $data['activities'][0]['ID'] );
	}

	/**
	 * @test
	 */
	public function it_test_should_cta_banner_be_displayed_method(): void {
		update_site_option( 'pressbooks_display_cta_banner', '1' );
		$this->assertTrue( should_cta_banner_be_displayed() );

		update_site_option( 'pressbooks_display_cta_banner', '0' );
		$this->assertFalse( should_cta_banner_be_displayed() );
	}
}
