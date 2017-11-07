<section class="section section-info section-toggle js-section">
	<h2 class="section__title section-info__title"><?php _e( 'Book Information', 'pressbooks-book' ); ?></h2>
	<div class="section-info__inner section-toggle__content">
		<div class="section-info__inner__content">
			<div class="section-info__subsection section-info__description">
				<h3 class="section__subtitle"><?php _e( 'Book Description', 'pressbooks-book' ); ?></h3>
					<?php if ( ! empty( $book_information['pb_about_unlimited'] ) ) : ?>
					<p class=""><?php
						$about_unlimited = pb_decode( $book_information['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited; ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="section-info__inner__content">
			<div class="section-info__subsection section-info__lead-author">
				<h3 class="section__subtitle"><?php _e( 'Lead Author', 'pressbooks-book' ); ?></h3>
				<?php if ( ! empty( $book_information['pb_author'] ) ) { ?>
					<div class="section-info__lead-author__authors">
						<?php
						//TODO add author photo
						if ( 0 ) { ?>
							<div class="section-info__lead-author__photo"><img src=""></div><?php
						}?>
						<span class="section-info__lead-author__name"><?php echo $book_information['pb_author']; ?></span>
					</div>
				<?php } ?>
			</div>
			<?php if ( ! empty( $book_information['pb_contributing_authors'] ) ) { ?>
			<div class="section-info__subsection section-info__contributing-authors">
				<h3 class="section__subtitle"><?php _e( 'Contributing Authors', 'pressbooks-book' ); ?></h3>
				<p><?php echo $book_information['pb_contributing_authors']; ?></p>
			</div>
			<?php } ?>
			<div class="section-info__subsection section-info__license">
				<h3 class="section__subtitle"><?php _e( 'License', 'pressbooks-book' ); ?></h3>
				<?php echo pressbooks_copyright_license(); // TODO ?>
			</div>
			<?php if ( ! empty( $book_information['pb_keywords_tags'] ) ) { ?>
			<div class="section-info__subsection section-info__subject">
				<h3 class="section__subtitle"><?php _e( 'Subject', 'pressbooks-book' ); ?></h3>
				<p><?php echo $book_information['pb_keywords_tags']; ?></p>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="section-toggle__cta">
		<p class="section-toggle__cta__blurb"><?php _e( 'Click for more information', 'pressbooks-book' ) ?></p>
		<a class="section-toggle__cta__button button--circle--primary icon icon-arrow-up-down js-toggle-section"></a>
	</div>
</section>
