<?php /* Template Name: H5p-listing */
get_header(); ?>
<?php if ( \PressbooksBook\Helpers\is_book_public() ) : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'h5p-listing-page' ); ?>>
			<h2 class="page-title"><?php _e( 'H5P activities list', 'pressbooks-book' ); ?></h2>
	</div><!-- end .post -->
<?php else : ?>
	<?php get_template_part( 'private' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
