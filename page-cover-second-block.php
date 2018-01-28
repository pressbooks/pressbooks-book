<section class="block block-toc">
		<h2 class="block__title block-toc__title"><?php _e( 'Contents', 'pressbooks-book' ); ?></h2>
		<?php if ( count( $book_structure['part'] ) > 1 ) { ?>
		<div class="block-toc__toggle-all">
			<button class="button button--primary block-toc__toggle-all__show js-toc-toggle-all-show"><?php _e( 'View complete table of contents', 'pressbooks-book' ); ?></button>
			<button class="button button--secondary block-toc__toggle-all__hide js-toc-toggle-all-hide"><?php _e( 'View less', 'pressbooks-book' ); ?></button>
		</div>
		<?php } ?>
		<?php include( locate_template( 'partials/content-toc.php' ) ); ?>
</section>
