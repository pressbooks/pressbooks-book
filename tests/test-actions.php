<?php
/**
 * Class ActionsTest
 *
 * @package Pressbooks_Book
 */

use function \PressbooksBook\Actions\enqueue_assets;
use function \PressbooksBook\Actions\render_lightbox_setting_field;

/**
 * Actions test case.
 */
class ActionsTest extends WP_UnitTestCase {
	function test_enqueue_assets() {
		enqueue_assets();
		$this->assertTrue( wp_script_is( 'pressbooks/book' ) );
		$this->assertTrue( wp_script_is( 'jquery-scrollto' ) );
		$this->assertTrue( wp_script_is( 'jquery-localscroll' ) );
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

		$parent_post_id = $this->factory()->post->create();
		$post_id = $this->factory()->post->create( [ 'post_type' => 'attachment', 'post_parent' => $parent_post_id ] );
		$this->go_to( "/?attachment_id=$post_id" );
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEquals( esc_url( get_permalink( $parent_post_id ) ), $_pb_redirect_location );

		$post_id = $this->factory()->post->create( [ 'post_type' => 'attachment' ] );
		$this->go_to( "/?attachment_id=$post_id" );
		\PressbooksBook\Actions\redirect_attachment_page();
		$this->assertEquals( esc_url( home_url( '/' ) ), $_pb_redirect_location );

		$_pb_redirect_location = null;
	}
}
