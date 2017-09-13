<?php /* Template Name: Cover */

get_header();

if ( pb_is_public() ) {
	if ( have_posts() ) {
		the_post();
	}
	get_template_part( 'page-cover', 'top-block' );
	get_template_part( 'page-cover', 'second-block' );
	get_template_part( 'page-cover', 'third-block' );
	get_template_part( 'page-cover', 'fourth-block' );
} else {
	get_template_part( 'page-cover', 'private-block' );
}

get_footer();
