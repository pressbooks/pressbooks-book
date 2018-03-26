<section class="block block-toc">
	<?php if ( pb_get_first_post_id() ) : ?>
		<h2 class="block__title block-toc__title"><?php _e( 'Contents', 'pressbooks-book' ); ?></h2><?php
		include( locate_template( 'partials/content-toc.php' ) ); ?>
		<div class="toc__toggle" aria-expanded="false">
			<button id="show" class="button"><?php _e( 'Show All Contents' ); ?></button>
			<button id="hide" class="button"><?php _e( 'Hide All Contents' ); ?></button>
		</div>
	<?php endif;
	/**
	 * Append content to cover table of contents block.
	 *
	 * @since 2.0.0
	 */
	do_action( 'pb_book_cover_after_toc' );
	?>
</section>
