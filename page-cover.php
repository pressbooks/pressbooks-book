<?php /* Template Name: Cover */

$book_structure   = pb_get_book_structure();
$book_information = pb_get_book_information();

get_header();

if ( \PressbooksBook\Helpers\is_book_public() ) {
	include( locate_template( 'partials/content-cover-book-header.php' ) );
	include( locate_template( 'partials/content-cover-toc.php' ) );
	include( locate_template( 'partials/content-cover-book-info.php' ) );
	include( locate_template( 'partials/content-cover-metadata.php' ) );
} else { ?>
	<section class="block private-block">
		<?php get_template_part( 'private' ); ?>
	</section>
	<?php
}
/** Insert content before cover footer.
 * @since 2.0.0
 */
do_action( 'pb_book_cover_before_footer' );
get_footer();
