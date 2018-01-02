<section class="block block-meta block-toggle js-block">
	<div class="block-meta__content-box">
		<h2 class="block__title block-meta__title"><?php _e( 'Metadata', 'pressbooks-book' ); ?></h2>

		<div class="block-meta__inner block-toggle__content">
			<dl class="block-meta__list">
				<div class="block-meta__subsection block-meta__pb_title">
					<dt class="block__subtitle block-meta__subtitle"><?php _e( 'Title', 'pressbooks-book' ); ?></dt>
					<dd class="ml0"><?php bloginfo( 'name' ); ?></dd>
				</div>
				<?php global $metakeys;

				foreach ( $metakeys as $key => $val ) {
					if ( isset( $book_information[ $key ] ) && ! empty( $book_information[ $key ] ) ) { ?>
						<div class="block-meta__subsection meta--<?php echo $key; ?>">
							<dt class="block__subtitle block-meta__subtitle"><?php echo $val; ?></dt>
							<dd class=""><?php if ( 'pb_publication_date' === $key ) {
									$book_information[ $key ] = date_i18n( 'F j, Y', $book_information[ $key ] );
} elseif ( 'pb_hashtag' === $key ) {
	$hashtag = $book_information[ $key ];
	$book_information[ $key ] = "<a href='https://twitter.com/search?q=%23$hashtag'>#$hashtag</a>";
} elseif ( 'pb_book_license' === $key ) {
	$book_information[ $key ] = pressbooks_copyright_license();
} elseif ( 'pb_primary_subject' === $key ) {
	$book_information[ $key ] = \Pressbooks\Metadata\get_subject_from_thema( $book_information[ $key ] );
} elseif ( 'pb_additional_subjects' === $key ) {
	$tmp = explode( ', ', $book_information[ $key ] );
	$output = [];
	foreach ( $tmp as $code ) {
		$output[] = \Pressbooks\Metadata\get_subject_from_thema( $code );
	}
	$book_information[ $key ] = implode( ', ', $output );
}
								echo $book_information[ $key ]; ?></dd>
							</div>
						<?php }
				} ?>
			</dl>
		</div>
	</div>
	<div class="block-toggle__cta">
		<p class="block-toggle__cta__blurb"><?php _e( 'Click for more information', 'pressbooks-book' ) ?></p>
		<a class="block-toggle__cta__button button--circle--primary icon icon-arrow-up-down js-toggle-block"></a>
	</div>
</section>
