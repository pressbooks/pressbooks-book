<?php get_header();
if ( \PressbooksBook\Helpers\is_book_public() ) :
	if ( have_posts() ) {
		the_post();
	} ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( is_front_page() ) : ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php else : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php endif; ?>
				<div class="entry-content">
					<?php edit_post_link( __( 'Edit', 'pressbooks-book' ), '<span class="edit-link">', '</span>' ); ?>
					<?php the_content(); ?>
					<?php
					wp_link_pages(
						[
							'before' => '<div class="page-link">' . __( 'Pages:', 'pressbooks-book' ),
							'after' => '</div>',
						]
					);
					?>
				</div><!-- .entry-content -->
			</div><!-- #post-## -->
<?php else : ?>
	<?php get_template_part( 'private' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
