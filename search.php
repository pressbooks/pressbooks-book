<?php get_header();
if ( pb_is_public() ) :
	if ( have_posts() ) : ?>
			<div>
				<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'pressbooks' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				<ul class="search-results">
				<?php while ( have_posts() ) : the_post();
					get_template_part( 'content', 'search' );
					endwhile; ?>
					</ul>
						<?php the_posts_navigation(); ?>
						</div>
						<?php else :
					get_template_part( 'content', 'none' );
				endif; ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
