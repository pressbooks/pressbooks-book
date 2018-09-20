<?php

use function \Pressbooks\Image\attachment_id_from_url;

?>

<section class="book-header">
	<div class="book-header__inner">
		<?php \Pressbooks\Book\Helpers\get_links( false ); ?>
		<h1 class="section__title book-header__title">
			<span class="screen-reader-text"><?php _e( 'Book Title', 'pressbooks-book' ); ?>: </span><?php bloginfo( 'name' ); ?>
		</h1>
		<?php if ( ! empty( $book_information['pb_subtitle'] ) ) : ?>
			<p class="book-header__subtitle"><span class="screen-reader-text"><?php _e( 'Subtitle', 'pressbooks-book' ); ?>: </span><?php echo $book_information['pb_subtitle']; ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $book_information['pb_credit_override'] ) ) { ?>
			<p class="book-header__author"><span class="screen-reader-text"><?php echo _e( 'Attribution', 'pressbooks-book' ); ?>: </span><?php echo $book_information['pb_credit_override']; ?></p>
		<?php } elseif ( ! empty( $book_information['pb_authors'] ) ) { ?>
			<p class="book-header__author"><span class="screen-reader-text"><?php echo translate_nooped_plural( _n_noop( 'Author', 'Authors', 'pressbooks-book' ), \Pressbooks\Book\Helpers\count_authors( $book_information['pb_authors'] ), 'pressbooks-book' ); ?>: </span><?php echo $book_information['pb_authors']; ?></p>
		<?php } ?>
		<div class="book-header__cover">
			<?php if ( ! empty( $book_information['pb_cover_image'] ) ) { ?>
				<div class="book-header__cover__image">
					<?php
					$cover_id = attachment_id_from_url( $book_information['pb_cover_image'] );
					if ( $cover_id ) {
						/* translators: %s: title of book */
						echo wp_get_attachment_image( $cover_id, [ 333, 500 ], false, [ 'alt' => sprintf( __( 'Cover image for %s', 'pressbooks-book' ), get_bloginfo( 'name' ) ) ] );
					} else {
						echo sprintf(
							'<img src="%1$s" alt="%2$s" />',
							$book_information['pb_cover_image'],
							/* translators: %s: title of book */
							sprintf( __( 'Cover image for %s', 'pressbooks-book' ), get_bloginfo( 'name' ) )
						);
					}
					?>
				</div>
				<?php
}

			/**
			 * @author Brad Payne <brad@bradpayne.ca>
			 * @copyright 2014 Brad Payne
			 * @since 1.6.0
			 */

			$files = \Pressbooks\Utility\latest_exports();

			$site_option = get_site_option( 'pressbooks_sharingandprivacy_options', [ 'allow_redistribution' => 0 ] );
			$option      = get_option( 'pbt_redistribute_settings', [ 'latest_files_public' => 0 ] );
if ( ! empty( $files ) && ( ! empty( $site_option['allow_redistribution'] ) ) && ( ! empty( $option['latest_files_public'] ) ) ) {
	?>
				<div class="book-header__cover__downloads dropdown">

					<p><?php _e( 'Download this book', 'pressbooks-book' ); ?></p>
					<ul>
					<?php
					foreach ( $files as $filetype => $filename ) :
						$filename = preg_replace( '/(-\d{10})(.*)/ui', '$1', $filename );

						// Rewrite rule
						$url = home_url( "/open/download?type={$filetype}" );

						// Tracking event defaults to Google Analytics (Universal). @codingStandardsIgnoreStart
						// Filter like so (for Piwik):
						// add_filter('pressbooks_download_tracking_code', function( $tracking, $filetype ) {
						//  return "_paq.push(['trackEvent','exportFiles','Downloads','{$filetype}']);";
						// }, 10, 2);
						// Or for Google Analytics (Classic):
						// add_filter('pressbooks_download_tracking_code', function( $tracking, $filetype ) {
						//  return "_gaq.push(['_trackEvent','exportFiles','Downloads','{$file_class}']);";
						// }, 10, 2); @codingStandardsIgnoreEnd
						$tracking = apply_filters( 'pressbooks_download_tracking_code', "ga('send','event','exportFiles','Downloads','{$filetype}');", $filetype );
						?>
					<li class="dropdown-item">
						<a rel="nofollow" onclick="<?php echo $tracking; ?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer" href="<?php echo $url; ?>">
							<?php echo \Pressbooks\Book\Helpers\get_name_for_filetype( $filetype ); ?>
							<meta itemprop="price" content="$0.00">
							<link itemprop="bookFormat" href="http://schema.org/EBook">
							<link itemprop="availability" href="http://schema.org/InStock">
						</a>
					</li>
					<?php endforeach; ?>
					<ul>
				</div>
			<?php } ?>
				<?php if ( \Pressbooks\Book\Helpers\social_media_enabled() ) { ?>
				<div class="book-header__share book-header__cover__share">
					<?php echo \Pressbooks\Book\Helpers\share_icons(); ?>
				</div>
				<?php } ?>
			</div>

			<?php

			if ( ! empty( $book_information['pb_about_50'] ) ) {
				?>
				<p class="book-header__description"><span class="screen-reader-text"><?php _e( 'Book Description', 'pressbooks-book' ); ?>: </span><?php echo pb_decode( $book_information['pb_about_50'] ); ?></p>
			<?php } ?>
		<?php global $first_chapter; ?>
		<div class="book-header__license">
			<span class="screen-reader-text"><?php _e( 'License', 'pressbooks-book' ); ?>: </span>
			<?php $license = ( isset( $book_information['pb_book_license'] ) ) ? $book_information['pb_book_license'] : 'all-rights-reserved'; ?>
			<div class="book-header__license__icons license-icons"><?php echo \Pressbooks\Book\Helpers\license_to_icons( $license ); ?></div>
			<span class="book-header__license__text license-text"><?php echo \Pressbooks\Book\Helpers\license_to_text( $license ); ?></span>
		</div>
		<div class="book-header__cta">
			<?php if ( pb_get_first_post_id() ) { ?>
			<a class="call-to-action" href="<?php echo $first_chapter; ?>">
				<?php _e( 'Read Book', 'pressbooks-book' ); ?>
			</a>
				<?php
}
if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) {
	?>
	<a class="call-to-action" href="<?php echo home_url( '/buy' ); ?>">
	<?php _e( 'Buy Book', 'pressbooks-book' ); ?>
	</a>
	<?php
}
?>
		</div> <!-- end .call-to-action -->
		<?php if ( \Pressbooks\Book\Helpers\social_media_enabled() ) { ?>
		<div class="book-header__share">
			<?php echo \Pressbooks\Book\Helpers\share_icons(); ?>
		</div>
		<?php } ?>
		<?php
		/** Append content to cover book header block.
		 * @since 2.0.0
		 */
		do_action( 'pb_book_cover_after_book_header' );
		?>
	</div>
</section>
