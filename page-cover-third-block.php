<section class="block block-info block-toggle js-block">
	<h2 class="block__title block-info__title"><?php _e( 'Book Information', 'pressbooks-book' ); ?></h2>
	<div class="block-info__inner block-toggle__content">
		<div class="block-info__inner__content"><?php if ( ! empty( $book_information['pb_about_unlimited'] ) ) : ?>
			<div class="block-info__subsection block-info__description">
				<h3 class="block__subtitle"><?php _e( 'Book Description', 'pressbooks-book' ); ?></h3>
					<p class=""><?php
						$about_unlimited = pb_decode( $book_information['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited; ?></p>
			</div>
		<?php endif; ?></div>
		<div class="block-info__inner__content">
			<div class="block-info__subsection block-info__lead-author">
				<h3 class="block__subtitle"><?php _e( 'Author(s)', 'pressbooks-book' ); ?></h3>
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
				<?php echo pressbooks_copyright_license( false ); ?>
			</div>
			<?php if ( ! empty( $book_information['pb_primary_subject'] ) ) { ?>
			<div class="block-info__subsection block-info__subject">
				<h3 class="block__subtitle"><?php _e( 'Subject', 'pressbooks-book' ); ?></h3>
				<p><?php echo Pressbooks\Metadata\get_subject_from_thema( $book_information['pb_primary_subject'] ); ?></p>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="block-toggle__cta">
		<p class="block-toggle__cta__blurb"><?php _e( 'Click for more information', 'pressbooks-book' ) ?></p>
		<a class="block-toggle__cta__button button--circle--primary js-toggle-block"><svg><use xlink:href="#arrow-down"></svg></a>
	</div>
</section>
