<?php get_header();
if ( \PressbooksBook\Helpers\is_book_public() ) :
	if ( have_posts() ) : ?>
			<div>
				<?php /* translators: search string */ ?>
				<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'pressbooks-book' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				<ul class="search-results">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'partials/content', 'search' );
					endwhile;
				?>
					</ul>
						<?php
						the_posts_navigation(
							[
								'prev_text' => '<svg class="icon--svg"><use xlink:href="#arrow-left" /></svg>' . __( 'Previous page', 'pressbooks-book' ),
								'next_text' => __( 'Next page', 'pressbooks-book' ) . '<svg class="icon--svg"><use xlink:href="#arrow-right" /></svg>',
								'screen_reader_text' => __( 'Paged navigation', 'pressbooks-book' ),
							]
						);
						?>
						</div>
						<?php
						else :
							get_template_part( 'partials/content', 'none' );
				endif;
						?>
<?php else : ?>
	<?php get_template_part( 'private' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
