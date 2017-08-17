<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
<?php get_header(); ?>
<?php if ( pb_is_public() ) : ?>

				<?php edit_post_link( __( 'Edit', 'pressbooks-book' ), '<span class="edit-link">', '</span>' ); ?>
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

					<?php if ( get_post_type( $post->ID ) !== 'part' ) {
						if ( pb_should_parse_subsections() ) {
							$content = pb_tag_subsections( apply_filters( 'the_content', get_the_content() ), $post->ID );
							echo $content;
						} else {
							$content = apply_filters( 'the_content', get_the_content() );
							echo $content;
						}
						global $multipage;
						if ( $multipage ) {
							$args = [ 'before' => '<p class="pb-nextpage">' . __( 'Continue reading:', 'pressbooks' ) ];
							wp_link_pages( $args );
						}
} else {
	echo apply_filters( 'the_content', $post->post_content );
} ?>

					</div><!-- .entry-content -->
				</div><!-- #post-## -->


				</div><!-- #content -->

				<?php
				if ( pb_social_media_enabled() ) {
					get_template_part( 'content', 'social-footer' );
				} ?>

				<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;
};?>
