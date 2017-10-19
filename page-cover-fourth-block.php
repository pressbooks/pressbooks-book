<section class="section section-meta">
	<h2 class="section__title section-meta__title"><?php _e( 'Metadata', 'pressbooks-book' ); ?></h2>
	<div class="section-meta__inner">
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
</section>
