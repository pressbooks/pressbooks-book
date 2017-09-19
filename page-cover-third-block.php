<section class="cover-information">
	<h2 class="tc ttu primary"><?php _e( 'Information on this Book', 'pressbooks-book' ); ?></h2>
	<div class="cover-information__description bb b--light-gray">
		<h3 class="ttu primary"><?php _e( 'Book Description', 'pressbooks-book' ); ?></h3>
				<?php if ( ! empty( $book_information['pb_about_unlimited'] ) ) : ?>
					<p class=""><?php
						$about_unlimited = pb_decode( $book_information['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited; ?></p>
				<?php endif; ?>

		</div>
		<div class="cover-information__lead-author bb b--light-gray">
			<h3 class="ttu primary"><?php _e( 'Lead Author', 'pressbooks-book' ); ?></h3>
			<?php if ( ! empty( $book_information['pb_author'] ) ) { ?>
				<p class="book-author vcard author">
					<span class="fn"><?php echo $book_information['pb_author']; ?></span>
				</p>
			<?php } ?>
		</div>
		<?php if ( ! empty( $book_information['pb_contributing_authors'] ) ) { ?>
		<div class="cover-information__contributing-authors bb b--light-gray">
			<h3 class="ttu primary"><?php _e( 'Contributing Authors', 'pressbooks-book' ); ?></h3>
				<p><?php echo $book_information['pb_contributing_authors']; ?></p>
		</div>
		<?php } ?>
		<div class="cover-information__license bb b--light-gray">
			<h3 class="ttu primary"><?php _e( 'License', 'pressbooks-book' ); ?></h3>
			<?php echo pressbooks_copyright_license(); // TODO ?>
		</div>
		<?php if ( ! empty( $book_information['pb_keywords_tags'] ) ) { ?>
		<div class="cover-information__subject bb b--light-gray">
			<h3 class="ttu primary"><?php _e( 'Subject', 'pressbooks-book' ); ?></h3>
			<p><?php echo $book_information['pb_keywords_tags']; ?></p>
		</div>
		<?php } ?>
</section>
