<?php
/**
 * Class ActionsTest
 *
 * @package Pressbooks_Book
 */

use function \PressbooksBook\Actions\enqueue_assets;
use function \PressbooksBook\Actions\enqueue_h5p_listing_bootstrap_files;
use function \PressbooksBook\Actions\register_h5p_listing_page;
use function \PressbooksBook\Actions\maybe_register_h5p_listing_page;
use function \PressbooksBook\Actions\register_h5p_listing_page_on_h5p_activation;
use function \PressbooksBook\Actions\render_lightbox_setting_field;

/**
 * Actions test case.
 * @group actions
 */
class ActionsTest extends WP_UnitTestCase {
	function test_enqueue_assets() {
		enqueue_assets();
		$this->assertTrue( wp_script_is( 'pressbooks/book' ) );
	}

	function test_render_lightbox_setting_field() {
		ob_start();
		render_lightbox_setting_field( [ 'Show linked images in a lightbox' ] );
		$buffer = ob_get_clean();
		$this->assertEquals( '<input id="enable_lightbox" name="pressbooks_theme_options_web[enable_lightbox]" type="checkbox" value="1" /><label for="enable_lightbox">Show linked images in a lightbox</label>', $buffer );
	}

	function test_redirect_attachment_page() {
		global $_pb_redirect_location;
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEmpty( $_pb_redirect_location );
		$_pb_redirect_location = null;

		$parent_post_id = $this->factory()->post->create();
		$post_id = $this->factory()->post->create( [ 'post_type' => 'attachment', 'post_parent' => $parent_post_id ] );
		$this->go_to( "/?attachment_id=$post_id" );
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEquals( esc_url( get_permalink( $parent_post_id ) ), $_pb_redirect_location );
		$_pb_redirect_location = null;

		$post_id = $this->factory()->post->create( [ 'post_type' => 'attachment' ] );
		$this->go_to( "/?attachment_id=$post_id" );
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEquals( esc_url( home_url( '/' ) ), $_pb_redirect_location );
		$_pb_redirect_location = null;

		$user_id = $this->factory()->user->create( [ 'role' => 'author' ] ); // has upload_files capability
		wp_set_current_user( $user_id );
		$this->go_to( "/?attachment_id=$post_id" );
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEmpty( $_pb_redirect_location );
		$_pb_redirect_location = null;

		$user_id = $this->factory()->user->create( [ 'role' => 'contributor' ] ); // does not have upload_files capability
		wp_set_current_user( $user_id );
		$this->go_to( "/?attachment_id=$post_id" );
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEquals( esc_url( home_url( '/' ) ), $_pb_redirect_location );
		$_pb_redirect_location = null;
	}

	function test_register_h5p_listing_page() {
		$result = register_h5p_listing_page();
		if ( class_exists( 'H5P_Plugin' ) ) {
			$this->assertIsInt( $result );
			$this->assertGreaterThan( 0, $result );
			$this->assertFalse( register_h5p_listing_page() );
		} else {
			$this->assertFalse( $result );
		}
	}

	function test_register_h5p_listing_page_on_h5p_activation_skips_non_h5p() {
		$result = register_h5p_listing_page_on_h5p_activation( 'some-other-plugin/plugin.php' );
		$this->assertNull( $result );
	}

	function test_register_h5p_listing_page_on_h5p_activation_registers_page() {
		register_h5p_listing_page_on_h5p_activation( 'h5p/h5p.php' );
		if ( class_exists( 'H5P_Plugin' ) ) {
			$page = get_page_by_path( 'h5p-listing', OBJECT, 'page' );
			$this->assertNotNull( $page );
			$this->assertEquals( 'publish', $page->post_status );
		} else {
			$page = get_page_by_path( 'h5p-listing', OBJECT, 'page' );
			$this->assertNull( $page );
		}
	}

	function test_maybe_register_h5p_listing_page_skips_other_post_types() {
		$post_id = $this->factory()->post->create( [ 'post_type' => 'post' ] );
		$result = maybe_register_h5p_listing_page( $post_id );
		$this->assertNull( $result );
	}

	function test_enqueue_h5p_listing_bootstrap_files() {
		enqueue_h5p_listing_bootstrap_files( 'h5p-listing' );
		$this->assertTrue( wp_style_is( 'bootstrap-css' ) );
	}
}
