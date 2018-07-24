<section class="block block-info block-toggle js-block">
	<h2 class="block__title block-info__title"><?php _e( 'Book Information', 'pressbooks-book' ); ?></h2>
	<div class="block-info__inner block-toggle__content">
		<div class="block-info__inner__content"><?php if ( ! empty( $book_information['pb_about_unlimited'] ) ) : ?>
			<div class="block-info__subsection block-info__description">
				<h3 class="block__subtitle"><?php _e( 'Book Description', 'pressbooks-book' ); ?></h3>
					<p class="">
					<?php
						$about_unlimited = pb_decode( $book_information['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited;
					?>
						</p>
			</div>
			<?php
		endif;
if ( isset( $book_information['pb_is_based_on'] ) ) {
	$source_url  = \Pressbooks\Book\Helpers\get_source_book_url( $book_information['pb_is_based_on'] );
	$source_meta = \Pressbooks\Book\Helpers\get_source_book_meta( $source_url );
	?>

	<div class="block-info__subsection block-info__source">
		<h3 class="block__subtitle"><?php _e( 'Book Source', 'pressbooks-book' ); ?></h3>
		<p>
			<?php
			printf(
				/* translators: %$1s: title of book, linked to book, %2$s: author of book, %3$s: publisher of book, %4$s: license for book */
				__( 'This book is a cloned version of %1$s by %2$s, published using Pressbooks by %3$s under a %4$s license. It may differ from the original.', 'pressbooks-book' ),
				sprintf( '<a href="%1$s">%2$s</a>', $source_url, $source_meta['name'] ),
				\Pressbooks\Book\Helpers\get_book_authors( $source_meta ),
				( isset( $source_meta['publisher'] ) ) ? $source_meta['publisher']['name'] : '',
				sprintf( '<a href="%1$s">%2$s</a>', $source_meta['license']['url'], $source_meta['license']['name'] )
			);
			?>
		</p>
	</div>
<?php } ?>
</div>
		<div class="block-info__inner__content">
			<div class="block-info__subsection block-info__lead-author">
				<h3 class="block__subtitle"><?php echo _n( 'Author', 'Authors', \Pressbooks\Book\Helpers\count_authors( $book_information['pb_authors'] ), 'pressbooks-book' ); ?></h3>
				<?php if ( ! empty( $book_information['pb_authors'] ) ) { ?>
					<div class="block-info__authors">
						<?php // TODO add author photo ?>
						<span class="block-info__author__names"><?php echo $book_information['pb_authors']; ?></span>
					</div>
				<?php } ?>
			</div>
			<?php if ( ! empty( $book_information['pb_contributing_authors'] ) ) { ?>
			<div class="block-info__subsection block-info__contributing-authors">
				<h3 class="block__subtitle"><?php _e( 'Contributors', 'pressbooks-book' ); ?></h3>
				<p><?php echo $book_information['pb_contributors']; ?></p>
			</div>
			<?php } ?>
			<div class="block-info__subsection block-info__license">
				<h3 class="block__subtitle"><?php _e( 'License', 'pressbooks-book' ); ?></h3>
				<?php echo \Pressbooks\Book\Helpers\copyright_license( false ); ?>
			</div>
			<?php if ( ! empty( $book_information['pb_primary_subject'] ) ) { ?>
			<div class="block-info__subsection block-info__subject">
				<h3 class="block__subtitle"><?php _e( 'Subject', 'pressbooks-book' ); ?></h3>
				<p><?php echo Pressbooks\Metadata\get_subject_from_thema( $book_information['pb_primary_subject'] ); ?></p>
			</div>
			<?php } ?>
		</div>
		<?php
		/** Append content to cover book info block.
		 * @since 2.0.0
		 */
		do_action( 'pb_book_cover_after_book_info' );
		?>
	</div>

	<div class="block-toggle__cta">
		<a class="block-toggle__cta__button button--circle--primary js-toggle-block"><svg><use xlink:href="#arrow-down"></svg><span class="screen-reader-text"><?php _e( 'Click for more information', 'pressbooks-book' ) ?></span></a>
	</div>
</section>
