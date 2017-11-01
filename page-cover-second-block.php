<section class="section section-toc">
		<h2 class="section__title section-toc__title"><?php _e( 'Table of Contents', 'pressbooks-book' ); ?></h2>
		<?php include(locate_template('content-toc.php')); ?>
	<?php if ( count( $book_structure['part'] ) > 1 ) { ?>
	<div class="section-toc__toggle-all">
		<button class="button button--primary section-toc__toggle-all__show js-toc-toggle-all-show"><?php _e( 'View complete table of contents', 'pressbooks-book' ); ?></button>
		<button class="button button--secondary section-toc__toggle-all__hide js-toc-toggle-all-hide"><?php _e( 'View less', 'pressbooks-book' ); ?></button>
	</div>
<?php } ?>
</section>
