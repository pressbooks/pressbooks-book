<section class="cover-metadata">
	<h2><?php _e( 'Metadata', 'pressbooks-book' ); ?></h2>
	<dl>
		<dt><?php _e( 'Book Name', 'pressbooks-book' ); ?></dt>
		<dd><?php bloginfo( 'name' ); ?></dd>
		<?php global $metakeys;

		foreach ( $metakeys as $key => $val ) {
			if ( isset( $book_information[ $key ] ) && ! empty( $book_information[ $key ] ) ) { ?>
				<dt><?php echo $val; ?></dt>
				<dd><?php if ( 'pb_publication_date' === $key ) {
						$book_information[ $key ] = date_i18n( 'F j, Y', absint( $book_information[ $key ] ) );
					} elseif ( 'pb_hashtag' === $key ) {
						$hashtag = $book_information[ $key ];
						$book_information[ $key ] = "<a href='https://twitter.com/search?q=%23$hashtag'>#$hashtag</a>";
					} elseif ( 'pb_book_license' === $key ) {
						$book_information[ $key ] = pressbooks_copyright_license();
					}
					echo $book_information[ $key ]; ?></dd>
				<?php }
			} ?>
	</dl>
</section>
