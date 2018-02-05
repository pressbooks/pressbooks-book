<?php if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();
		get_header();
		if ( pb_is_public() ) :
			$web_options = get_option( 'pressbooks_theme_options_web' );
			$number = ( $post->post_type === 'chapter' ) ? pb_get_chapter_number( $post->post_name ) : false;
			$subtitle = get_post_meta( $post->ID, 'pb_subtitle', true );
			$author = get_post_meta( $post->ID, 'pb_section_author', true );
			if ( isset( $web_options['part_title'] ) && absint( $web_options['part_title'] ) === 1 ) {
				if ( $post->post_type === 'chapter' ) {
					echo "<div class='part-title'><p><small>" . get_the_title( $post->post_parent ) . '</small></p></div>';
				}
			} ?>
		<section data-type="<?php echo pb_get_section_type( $post ) ?>" <?php post_class( pb_get_section_type( $post ) ); ?>>
			<header>
				<h1 class="entry-title">
					<?php if ( $number ) { echo "<span>$number</span> "; }
					the_title(); ?>
				</h1>
				<?php if ( $subtitle ) { ?>
				<p data-type="subtitle"><?php echo $subtitle; ?></p>
				<?php } ?>
				<?php if ( $author ) { ?>
				<p data-type="author"><?php echo $author; ?></p>
				<?php } ?>
			</header>
				<?php if ( get_post_type( $post->ID ) !== 'part' ) {
					if ( pb_should_parse_subsections() ) {
						$content = pb_tag_subsections( apply_filters( 'the_content', get_the_content() ), $post->ID );
						echo $content;
					} else {
						$content = apply_filters( 'the_content', get_the_content() );
						echo $content;
					}
					global $multipage;
					if ( $multipage ) { ?>
						<div class="nav-reading--page">
							<?php global $page, $numpages;
							if ( $page > 1 ) { ?>
									<div class="nav-reading--page__previous">
										<?php echo _wp_link_page( $page -1 );?><svg class="icon--svg">
								<use xlink:href="#arrow-left" />
							</svg><?php
										echo __( 'Previous Page', 'pressbooks-book' ) . '</a>' ?>
									</div><?php
							}

							if ( $page < $numpages ) {?>
									<div class="nav-reading--page__next">
										<?php echo _wp_link_page( $page + 1 );?><?php
										echo __( 'Next Page', 'pressbooks-book' ) . '<svg class="icon--svg">
										<use xlink:href="#arrow-right" />
									</svg></a>' ?>
									</div><?php
							}	?>
						</div>
					<?php }
} else {
	echo apply_filters( 'the_content', $post->post_content );
} ?>
			</section>
			<?php pb_get_links(); ?>
			<?php edit_post_link( __( 'Edit', 'pressbooks-book' ), '<div class="edit-link">', '</div>', $post->ID, 'button button--primary' ); ?>

		</div><!-- #content -->

				<?php
				if ( pb_social_media_enabled() ) {	?>
					<section class="block block-reading-meta">
						<div class="block-reading-meta__inner">
							<div class="block-reading-meta__subsection">
								<h2 class="section__subtitle block-reading-meta__subtitle"><?php _e( 'Licenses','pressbooks-book' ); ?></h2>
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
					</section><?php
				} ?>

				<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;
};?>
