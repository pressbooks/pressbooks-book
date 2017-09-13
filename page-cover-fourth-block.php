			<section class="fourth-block-wrap">
				<div class="fourth-block clearfix">
						<h2><?php _e( 'Metadata', 'pressbooks-book' ); ?></h2>
								<?php if ( is_page() || is_home() ) : ?>

			<dl>
				<dt><?php _e( 'Book Name', 'pressbooks-book' ); ?></dt>
				<dd><?php bloginfo( 'name' ); ?></dd>
				<?php global $metakeys;
				$metadata = pb_get_book_information();
				foreach ( $metakeys as $key => $val ) :
					if ( isset( $metadata[ $key ] ) && ! empty( $metadata[ $key ] ) ) : ?>
						<dt><?php echo $val; ?></dt>
						<dd><?php if ( 'pb_publication_date' === $key ) {
							$metadata[ $key ] = date_i18n( 'F j, Y', absint( $metadata[ $key ] ) );
} elseif ( 'pb_hashtag' === $key ) {
	$hashtag = $metadata[ $key ];
	$metadata[ $key ] = "<a href='https://twitter.com/search?q=%23$hashtag'>#$hashtag</a>";
} elseif ( 'pb_book_license' === $key ) {
	$metadata[ $key ] = pressbooks_copyright_license();
}
						echo $metadata[ $key ]; ?></dd>
				<?php endif;
				endforeach; ?>
			</dl>
			<?php endif; ?>

					</div><!-- end .fourthary-block -->
				</section> <!-- end .fourthary-block -->
