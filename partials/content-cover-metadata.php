<section class="block block-meta block-toggle js-block">
	<div class="block-meta__content-box">
		<h2 class="block__title block-meta__title"><?php _e( 'Metadata', 'pressbooks-book' ); ?></h2>

		<div class="block-meta__inner block-toggle__content">
			<dl class="block-meta__list">
				<div class="block-meta__subsection block-meta__pb_title">
					<dt class="block__subtitle block-meta__subtitle"><?php _e( 'Title', 'pressbooks-book' ); ?></dt>
					<dd class="ml0"><?php bloginfo( 'name' ); ?></dd>
				</div>
				<?php
				$metakeys = \PressbooksBook\Helpers\get_metakeys();
				foreach ( $metakeys as $key => $val ) {
					if ( isset( $book_information[ $key ] ) && ! empty( $book_information[ $key ] ) ) {
						?>
						<div class="block-meta__subsection meta--<?php echo $key; ?>">
							<dt class="block__subtitle block-meta__subtitle"><?php echo is_array( $val ) ? translate_nooped_plural( $val, \PressbooksBook\Helpers\count_authors( $book_information[ $key ] ), 'pressbooks-book' ) : $val; ?></dt>
							<dd class="">
							<?php
							if ( 'pb_publication_date' === $key ) {
									$book_information[ $key ] = date_i18n( 'F j, Y', (int) $book_information[ $key ] );
							} elseif ( 'pb_hashtag' === $key ) {
								$hashtag = $book_information[ $key ];
								$book_information[ $key ] = "<a href='https://twitter.com/search?q=%23$hashtag'>#$hashtag</a>";
							} elseif ( 'pb_book_license' === $key ) {
								$book_information[ $key ] = \PressbooksBook\Helpers\copyright_license();
							} elseif ( 'pb_primary_subject' === $key ) {
								$book_information[ $key ] = \Pressbooks\Metadata\get_subject_from_thema( $book_information[ $key ] );
							} elseif ( 'pb_additional_subjects' === $key ) {
								$tmp    = explode( ', ', $book_information[ $key ] );
								$output = [];
								foreach ( $tmp as $code ) {
									$output[] = \Pressbooks\Metadata\get_subject_from_thema( $code );
								}
								$book_information[ $key ] = implode( ', ', $output );
							} elseif ( 'pb_book_doi' === $key ) {
								/**
								 * Filter the DOI resolver service URL (default: https://dx.doi.org).
								 *
								 * @since Pressbooks @ 5.6.0
								 */
								$doi_resolver = apply_filters( 'pb_doi_resolver', 'https://dx.doi.org' );
								$book_information[ $key ] = sprintf( '<a itemprop="sameAs" href="%1$s">%1$s</a>', trailingslashit( $doi_resolver ) . $book_information[ $key ] );
							}
								echo $book_information[ $key ];
							?>
								</dd>
							</div>
						<?php
					}
				}
				?>
			</dl>
		</div>
		<?php
		/** Append content to cover metadata block.
		 * @since 2.0.0
		 */
		do_action( 'pb_book_cover_after_metadata' );
		?>
	</div>
	<div class="block-toggle__cta">
		<a class="block-toggle__cta__button button--circle--primary js-toggle-block"><svg><use href="#arrow-down"></svg><span class="screen-reader-text"><?php _e( 'Click for more information', 'pressbooks-book' ) ?></span></a>
	</div>
</section>
