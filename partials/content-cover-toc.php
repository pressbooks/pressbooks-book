<section class="block block-toc">
	<?php if ( pb_get_first_post_id() ) : ?>
		<h2 class="block__title block-toc__title"><?php _e( 'Contents', 'pressbooks-book' ); ?></h2><?php
		include( locate_template( 'partials/content-toc.php' ) );
	endif;
	/**
	 * Append content to cover table of contents block.
	 *
	 * @since 2.0.0
	 */
	do_action( 'pb_book_cover_after_toc' );
	?>
</section>
