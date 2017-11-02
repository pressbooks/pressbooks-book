<section class="section section-meta section-toggle js-section">
	<div class="section-meta__content-box">
		<h2 class="section__title section-meta__title"><?php _e( 'Metadata', 'pressbooks-book' ); ?></h2>

		<div class="section-meta__inner section-toggle__content">
			<dl class="section-meta__list">
				<div class="section-meta__subsection section-meta__pb_title">
					<dt class="section__subtitle section-meta__subtitle"><?php _e( 'Book Name', 'pressbooks-book' ); ?></dt>
					<dd class="ml0"><?php bloginfo( 'name' ); ?></dd>
				</div>
				<?php global $metakeys;

				foreach ( $metakeys as $key => $val ) {
					if ( isset( $book_information[ $key ] ) && ! empty( $book_information[ $key ] ) ) { ?>
						<div class="section-meta__subsection meta--<?php echo $key; ?>">
							<dt class="section__subtitle section-meta__subtitle"><?php echo $val; ?></dt>
							<dd class=""><?php if ( 'pb_publication_date' === $key ) {
									$book_information[ $key ] = date_i18n( 'F j, Y', $book_information[ $key ] );
								} elseif ( 'pb_hashtag' === $key ) {
									$hashtag = $book_information[ $key ];
									$book_information[ $key ] = "<a href='https://twitter.com/search?q=%23$hashtag'>#$hashtag</a>";
								} elseif ( 'pb_book_license' === $key ) {
									$book_information[ $key ] = pressbooks_copyright_license();
								}
								echo $book_information[ $key ]; ?></dd>
							</div>
						<?php }
					} ?>
			</dl>
		</div>
	</div>
	<div class="section-toggle__cta">
		<p class="section-toggle__cta__blurb"><?php _e('Click for more information', 'pressbooks-book') ?></p>
		<a class="section-toggle__cta__button button--circle--primary icon icon-arrow-up-down js-toggle-section"></a>
	</div>
</section>
