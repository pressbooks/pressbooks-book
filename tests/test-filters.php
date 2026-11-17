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

	function test_embed_site_title_uses_pressbooks_icon_when_no_site_icon_exists() {
		$book_id = self::factory()->blog->create();

		switch_to_blog( $book_id );
		ob_start();
		the_embed_site_title();
		$html = ob_get_clean();
		restore_current_blog();

		$this->assertStringContainsString( get_template_directory_uri() . '/dist/images/favicon-32x32.png', $html );
		$this->assertStringNotContainsString( 'w-logo', $html );
	}

	function test_embed_site_title_uses_pressbooks_icon_when_network_icon_attachment_is_missing() {
		$book_id = self::factory()->blog->create();
		update_option( 'site_icon', PHP_INT_MAX );

		switch_to_blog( $book_id );
		ob_start();
		the_embed_site_title();
		$html = ob_get_clean();
		restore_current_blog();

		$this->assertStringContainsString( get_template_directory_uri() . '/dist/images/favicon-32x32.png', $html );
		$this->assertStringNotContainsString( 'w-logo', $html );
	}

	function test_main_site_without_icon_keeps_core_fallback() {
		$this->assertSame( 'core-fallback', get_site_icon_url( 32, 'core-fallback' ) );
	}

	function test_pressbooks_icon_fallback_matches_requested_size() {
		$book_id = self::factory()->blog->create();
		$images = get_template_directory_uri() . '/dist/images';

		switch_to_blog( $book_id );
		$small = get_site_icon_url( 16 );
		$medium = get_site_icon_url( 64 );
		$large = get_site_icon_url( 512 );
		restore_current_blog();

		$this->assertSame( "$images/favicon-32x32.png", $small );
		$this->assertSame( "$images/android-chrome-192x192.png", $medium );
		$this->assertSame( "$images/android-chrome-512x512.png", $large );
	}

	function test_admin_bar_has_no_site_icon_for_book_without_one() {
		$book_id = self::factory()->blog->create();
		$user_id = self::factory()->user->create( [ 'role' => 'administrator' ] );
		grant_super_admin( $user_id );
		wp_set_current_user( $user_id );
		require_once ABSPATH . WPINC . '/class-wp-admin-bar.php';

		switch_to_blog( $book_id );
		set_current_screen( 'dashboard' );
		$admin_bar = new \WP_Admin_Bar();
		$admin_bar->initialize();
		$admin_bar->add_menus();
		do_action_ref_array( 'admin_bar_menu', [ &$admin_bar ] );
		$title = $admin_bar->get_node( 'site-name' )->title;
		set_current_screen( 'front' );
		restore_current_blog();

		$this->assertStringNotContainsString( 'site-icon', $title );
	}
}
