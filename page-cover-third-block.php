<?php $metadata = pb_get_book_information();?>
<section class="third-block-wrap">
	<div class="third-block clearfix">
			<h2><?php _e( 'Information on this Book', 'pressbooks-book' ); ?></h2>
		<div class="description-book-info">
			<h3><?php _e( 'Book Description', 'pressbooks-book' ); ?></h3>
				<?php if ( ! empty( $metadata['pb_about_unlimited'] ) ) : ?>
					<p><?php
						$about_unlimited = pb_decode( $metadata['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited; ?></p>
				<?php endif; ?>

		</div>
		<div>
			<h3><?php _e( 'Lead Author', 'pressbooks-book' ); ?></h3>
			<?php if ( ! empty( $metadata['pb_author'] ) ) { ?>
				<p class="book-author vcard author">
					<span class="fn"><?php echo $metadata['pb_author']; ?></span>
				</p>
			<?php } ?>
		</div>
		<div>
			<h3><?php _e( 'Contributing Authors', 'pressbooks-book' ); ?></h3>
			<?php if ( ! empty( $metadata['pb_contributing_authors'] ) ) { ?>
				<?php echo $metadata['pb_contributing_authors']; ?>
			<?php } ?>
		</div>

		<div>
			<h3><?php _e( 'Licenses', 'pressbooks-book' ); ?></h3>
			<?php if ( ! empty( $metadata['pb_book_license'] ) ) { ?>
				<?php echo $metadata['pb_book_license']; ?>
			<?php } ?>
		</div>
		<div>
			<h3><?php _e( 'Subject', 'pressbooks-book' ); ?></h3>
			<?php if ( ! empty( $metadata['pb_keywords_tags'] ) ) {
				echo $metadata['pb_keywords_tags'];
} ?>
		</div>


	</div><!-- end .third-block -->
</section> <!-- end .third-block -->
