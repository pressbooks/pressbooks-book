<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
<?php get_header(); ?>
<?php if ( pb_is_public() ) : ?>

				<?php edit_post_link( __( 'Edit', 'pressbooks-book' ), '<span class="edit-link">', '</span>', $post->ID, 'button button--primary' ); ?>
				<?php
				// add part title to chapters
				$web_options = get_option( 'pressbooks_theme_options_web' );
				if ( isset( $web_options['part_title'] ) && absint( $web_options['part_title'] ) === 1 ) {
					if ( 'chapter' === get_post_type( $post->ID ) ) {
						$part_title = get_post_field( 'post_title', $post->post_parent );
						if ( ! is_wp_error( $part_title ) ) {
							echo "<div class='part-title'><small>" . $part_title . '</small></div>';
						}
					}
				}
				?>
			<h2 class="entry-title"><?php
			$chapter_number = pb_get_chapter_number( $post->post_name );
			if ( $chapter_number ) {
				echo "<span>$chapter_number</span>  ";
			}
				the_title();
				?></h2>
					<?php pb_get_links(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( pb_get_section_type( $post ) ); ?>>

					<div class="entry-content">
						<?php $subtitle = get_post_meta( $post->ID, 'pb_subtitle', true );
						if ( $subtitle ) : ?>
						<h2 class="chapter_subtitle"><?php echo $subtitle; ?></h2>
					<?php endif;?>
					<?php $chap_author = get_post_meta( $post->ID, 'pb_section_author', true );
					if ( $chap_author ) : ?>
					   <h2 class="chapter_author"><?php echo $chap_author; ?></h2>
					<?php endif; ?>

					<?php
					if ( get_post_type( $post->ID ) !== 'part' ) {
						if ( pb_should_parse_subsections() ) {
							$content = pb_tag_subsections( apply_filters( 'the_content', get_the_content() ), $post->ID );
							echo $content;
						} else {
							$content = apply_filters( 'the_content', get_the_content() );
							echo $content;
						}
						global $multipage;
						if ( $multipage ) {
//							$args = [
//								'before' => '<nav class="nav-reading--page">',
//								'after' => '</nav>',
//								'next_or_number' => 'next',
//							];
//							wp_link_pages( $args );

							?>
							<div class="nav-reading--page"><?php

								global $page, $numpages;
								if( $page > 1 ){?>
									<div class="nav-reading--page__previous">
										<?php echo _wp_link_page($page-1);?><span class="icon icon-arrow-left"></span><?php
										echo __( 'Previous Page', 'pressbooks-book' ).'</a>' ?>
									</div><?php
								}

								if ( $page < $numpages ) {?>
									<div class="nav-reading--page__next">
										<?php echo _wp_link_page($page+1);?><?php
										echo __( 'Next Page', 'pressbooks-book' ).'<span class="icon icon-arrow-right"></span></a>' ?>
									</div><?php
								}	?>

							</div><?php
						}
					} else {
						echo apply_filters( 'the_content', $post->post_content );
					} ?>

					</div><!-- .entry-content -->
				</div><!-- #post-## -->


				</div><!-- #content -->

				<?php
				if ( pb_social_media_enabled() ) {	?>
					<section class="section section-reading-meta">
						<div class="section-reading-meta__inner">
							<div class="section-reading-meta__subsection">
								<h2 class="section__subtitle section-reading-meta__subtitle"><?php _e('Licenses','pressbooks-book'); ?></h2>
								<?php if ( pb_is_public() ) { ?>
									<div class="">
										<?php echo pressbooks_copyright_license(); ?>
									</div>
								<?php } ?>
							</div>
							<div class="section-reading-meta__subsection">
								<h2 class="section__subtitle section-reading-meta__subtitle"><?php _e('Share This Book','pressbooks-book'); ?></h2>
								<div class="section-reading-meta__share">
									<?php
										echo \PressbooksBook\Helpers\share_icons();
									?>
								</div>
							</div>
						</div>
					</section><?php
				} ?>

				<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;
};?>
