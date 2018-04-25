<?php if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();
		get_header();
		if ( pb_is_public() ) :
			$web_options = get_option( 'pressbooks_theme_options_web' );
			$number = ( $post->post_type === 'chapter' ) ? pb_get_chapter_number( $post->ID ) : false;
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

					<div class="block block-reading-meta">
						<div class="block-reading-meta__inner">

							<?php $meta = new \Pressbooks\Metadata();
							$pb_book_is_based_on = get_post_meta( $meta->getMetaPost()->ID, 'pb_is_based_on', true );
							$pb_section_is_based_on = get_post_meta( $post->ID, 'pb_is_based_on', true );
							if ( $pb_book_is_based_on ) {
								$source_url = \Pressbooks\Book\Helpers\get_source_book_url( $pb_book_is_based_on );
								$source_meta = \Pressbooks\Book\Helpers\get_source_book_meta( $source_url );
								$source_toc = \Pressbooks\Book\Helpers\get_source_book_toc( $source_url );
								$original = \Pressbooks\Book\Helpers\get_original_section( $pb_section_is_based_on, $source_toc );
								if ( $original ) {
									$source_endpoint = implode( '/', [
										$source_url,
										'wp-json/pressbooks/v2',
										( in_array( $post->post_type, [ 'part', 'chapter' ], true ) ) ? $post->post_type . 's' : $post->post_type,
										$original['id'],
									] );
									?>
									<div class="block-reading-meta__compare">
<p><?php printf(
	__( 'This chapter is adapted from %1$s in %2$s by %3$s.', 'pressbooks-book' ),
	sprintf( '<a href="%1$s">%2$s</a>', $original['link'], $original['title'] ),
	sprintf( '<a href="%1$s">%2$s</a>', $source_url, $source_meta['name'] ),
\Pressbooks\Book\Helpers\get_book_authors( $source_meta ) );
?>
									</p>
									<button id="compare"><?php _e( 'Compare with Original', 'pressbooks' ); ?></button>
									<pre
										id="diff"
										data-source-endpoint="<?php echo $source_endpoint ?>" hidden><?php echo get_post_field( 'post_content', $post, 'raw' ); ?></pre>
								</div>
								<?php }
							} ?>
							<div class="block-reading-meta__subsection">
								<h2 class="section__subtitle block-reading-meta__subtitle"><?php _e( 'License','pressbooks-book' ); ?></h2>
								<?php if ( pb_is_public() ) { ?>
									<div class="">
										<?php echo pressbooks_copyright_license( false ); ?>
									</div>
								<?php } ?>
							</div>
							<?php if ( pb_social_media_enabled() ) { ?>
							<div class="block-reading-meta__subsection">
								<h2 class="section__subtitle block-reading-meta__subtitle"><?php _e( 'Share This Book','pressbooks-book' ); ?></h2>
								<div class="block-reading-meta__share">
									<?php
										echo \Pressbooks\Book\Helpers\share_icons();
									?>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
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
