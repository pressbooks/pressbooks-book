<?php if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();
		get_header();
		if ( pb_is_public() ) :
			$web_options = get_option( 'pressbooks_theme_options_web' );
			$number = ( $post->post_type === 'chapter' ) ? pb_get_chapter_number( $post->post_name ) : false;
			$subtitle = get_post_meta( $post->ID, 'pb_subtitle', true );
			$contributors = new \Pressbooks\Contributors();
			$authors = $contributors->get( $post->ID, 'authors' );
			$datatype = ( in_array( $post->post_type, [ 'front-matter', 'back-matter' ], true ) ) ? pb_get_section_type( $post ) : $post->post_type;
			if ( isset( $web_options['part_title'] ) && absint( $web_options['part_title'] ) === 1 ) {
				if ( $post->post_type === 'chapter' ) {
					echo "<div class='part-title'><p><small>" . get_the_title( $post->post_parent ) . '</small></p></div>';
				}
			} ?>
<?php if ( pb_use_htmlbook() || pb_is_custom_theme() ) {
	include( locate_template( 'partials/content-single.php' ) );
} else {
	include( locate_template( 'partials/content-single-legacy.php' ) );
} ?>
</div><!-- #content -->
<?php pb_get_links(); ?>

				<?php
				if ( pb_social_media_enabled() ) {	?>
					<div class="block block-reading-meta">
						<div class="block-reading-meta__inner">
							<div class="block-reading-meta__subsection">
								<h2 class="section__subtitle block-reading-meta__subtitle"><?php _e( 'License','pressbooks-book' ); ?></h2>
								<?php if ( pb_is_public() ) { ?>
									<div class="">
										<?php echo pressbooks_copyright_license( false ); ?>
									</div>
								<?php } ?>
							</div>
							<div class="block-reading-meta__subsection">
								<h2 class="section__subtitle block-reading-meta__subtitle"><?php _e( 'Share This Book','pressbooks-book' ); ?></h2>
								<div class="block-reading-meta__share">
									<?php
										echo \Pressbooks\Book\Helpers\share_icons();
									?>
								</div>
							</div>
						</div>
								</div><?php
				} ?>

				<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php
/**	Insert content before content footer.
 * @since 2.0.0
 */
do_action( 'pb_book_content_before_footer' );
get_footer(); ?>
<?php endwhile;
};?>
