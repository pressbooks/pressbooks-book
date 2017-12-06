<?php /* Template Name: Cover */

global $blog_id;
$can_read = current_user_can_for_blog( $blog_id, 'read' );
$can_read_private = current_user_can_for_blog( $blog_id, 'read_private_posts' );
$book_structure = pb_get_book_structure();
$book_information = pb_get_book_information();
$permissive_private_content = (int) get_option( 'permissive_private_content', 0 );
$should_parse_subsections = pb_should_parse_subsections();

get_header();

if ( pb_is_public() ) {
	if ( have_posts() ) {
		the_post();
	}

	include( locate_template( 'page-cover-top-block.php' ) );
	include( locate_template( 'page-cover-second-block.php' ) );
	include( locate_template( 'page-cover-third-block.php' ) );
	include( locate_template( 'page-cover-fourth-block.php' ) );
} else {
	include( locate_template( 'page-cover-private-block.php' ) );
}

get_footer();
