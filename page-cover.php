<?php
	get_header();
	$metadata = pb_get_book_information();
if ( pb_is_public() ) :
	if ( have_posts() ) { the_post();
	}
?>


<?php get_template_part( 'page-cover', 'top-block' ); ?>
<?php get_template_part( 'page-cover', 'second-block' ); ?>
<?php get_template_part( 'page-cover', 'third-block' ); ?>




<?php else : ?>

	<?php get_template_part( 'page-cover', 'private-block' ); ?>


<?php endif; ?>

<?php get_footer();
