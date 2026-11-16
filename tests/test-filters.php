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

	/**
	 * Creates an image attachment on the current blog and sets it as the site icon.
	 *
	 * @param string $filename
	 *
	 * @return string The 32px site icon URL for the current blog.
	 */
	private function set_site_icon( $filename ) {
		$attachment_id = self::factory()->attachment->create_object(
			[
				'file' => $filename,
				'post_mime_type' => 'image/png',
			]
		);
		update_option( 'site_icon', $attachment_id );

		return wp_get_attachment_image_url( $attachment_id, [ 32, 32 ] );
	}

	/**
	 * @see https://github.com/pressbooks/pressbooks-book/issues/1486
	 */
	function test_embed_site_title_uses_network_site_icon_when_book_has_none() {
		$book_id = self::factory()->blog->create();
		$network_icon_url = $this->set_site_icon( 'network-icon.png' );

		switch_to_blog( $book_id );
		ob_start();
		the_embed_site_title();
		$html = ob_get_clean();
		restore_current_blog();

		$this->assertStringContainsString( esc_url( $network_icon_url ), $html );
		$this->assertStringNotContainsString( 'w-logo', $html );
	}

	function test_site_icon_url_keeps_book_icon_when_book_has_one() {
		$book_id = self::factory()->blog->create();
		$this->set_site_icon( 'network-icon.png' );

		switch_to_blog( $book_id );
		$book_icon_url = $this->set_site_icon( 'book-icon.png' );
		$result = get_site_icon_url( 32 );
		restore_current_blog();

		$this->assertSame( $book_icon_url, $result );
	}
}
