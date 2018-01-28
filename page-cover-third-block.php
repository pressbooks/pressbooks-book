<section class="block block-info block-toggle js-block">
	<h2 class="block__title block-info__title"><?php _e( 'Book Information', 'pressbooks-book' ); ?></h2>
	<div class="block-info__inner block-toggle__content">
		<div class="block-info__inner__content">
			<?php $source_url = \Pressbooks\Book\Helpers\get_source_book( home_url() );
			if ( $source_url !== home_url() ) { ?>
				<p class="source-book">
				<?php
				$args = [];
				if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
					$args['sslverify'] = false;
				}
				$source_book = json_decode( wp_remote_get( untrailingslashit( $source_url ) . '/wp-json/pressbooks/v2/metadata/', $args )['body'], true );
				$authors = [];
				foreach ( $source_book['author'] as $author ) {
					$authors[] = $author['name'];
				};
				printf(
					__( 'This book is a cloned version of %1$s by %2$s, published using Pressbooks%3$s under a %4$s license. It may differ from the original.', 'pressbooks-book' ),
					sprintf( '<a href="%1$s">%2$s</a>', $source_url, $source_book['name'] ),
					\Pressbooks\Utility\oxford_comma( $authors ),
					( isset( $source_book['publisher'] ) ) ? $source_book['publisher']['name'] : '',
					sprintf( '<a href="%1$s">%2$s</a>', $source_book['license']['url'], $source_book['license']['name'] )
				); ?>
				</p>
			<?php } ?>
			<div class="block-info__subsection block-info__description">
				<h3 class="block__subtitle"><?php _e( 'Book Description', 'pressbooks-book' ); ?></h3>
					<?php if ( ! empty( $book_information['pb_about_unlimited'] ) ) : ?>
					<p class=""><?php
						$about_unlimited = pb_decode( $book_information['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited; ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="block-info__inner__content">
			<div class="block-info__subsection block-info__lead-author">
				<h3 class="block__subtitle"><?php _e( 'Author(s)', 'pressbooks-book' ); ?></h3>
				<?php if ( ! empty( $book_information['pb_author'] ) ) { ?>
					<div class="block-info__lead-author__authors">
						<?php
						//TODO add author photo
						if ( 0 ) { ?>
							<div class="block-info__lead-author__photo"><img src=""></div><?php
						}?>
						<span class="block-info__lead-author__name"><?php echo $book_information['pb_author']; ?></span>
					</div>
				<?php } ?>
			</div>
			<?php if ( ! empty( $book_information['pb_contributing_authors'] ) ) { ?>
			<div class="block-info__subsection block-info__contributing-authors">
				<h3 class="block__subtitle"><?php _e( 'Contributing Authors', 'pressbooks-book' ); ?></h3>
				<p><?php echo $book_information['pb_contributing_authors']; ?></p>
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
		<a class="block-toggle__cta__button button--circle--primary icon icon-arrow-up-down js-toggle-block"></a>
	</div>
</section>
