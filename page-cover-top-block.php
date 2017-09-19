<section class="cover-top">
	<?php pb_get_links( false ); ?>
	<div class="book-info">
		<h1 class="entry-title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php if ( ! empty( $book_information['pb_subtitle'] ) ) : ?>
			<p class="subtitle"><?php echo $book_information['pb_subtitle']; ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $book_information['pb_author'] ) ) { ?>
			<p class="book-author vcard author">
				<span class="fn"><?php echo $book_information['pb_author']; ?></span>
			</p>
		<?php } ?>
		<?php if ( ! empty( $book_information['pb_cover_image'] ) ) { ?>
			<div class="book-cover">
				<img src="<?php echo $book_information['pb_cover_image']; ?>" alt="book-cover" title="<?php bloginfo( 'name' ); ?> book cover" />
			</div>
		<?php }

		 /**
		  * @author Brad Payne <brad@bradpayne.ca>
		  * @copyright 2014 Brad Payne
		  * @since 1.6.0
		  */

		$files = \Pressbooks\Utility\latest_exports();
		$site_option = get_site_option( 'pressbooks_sharingandprivacy_options', [ 'allow_redistribution' => 0 ] );
		$option = get_option( 'pbt_redistribute_settings', [ 'latest_files_public' => 0 ] );
		if ( ! empty( $files ) && ( ! empty( $site_option['allow_redistribution'] ) ) && ( ! empty( $option['latest_files_public'] ) ) ) { ?>
			<div class="downloads">
				<h3><?php _e( 'Download this book', 'pressbooks-book' ); ?></h3>
				<ul>
				<?php foreach ( $files as $filetype => $filename ) :
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
				<li>
					<a rel="nofollow" onclick="<?php echo $tracking; ?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer" href="<?php echo $url; ?>">
						<?php echo \PressbooksBook\Helpers\get_name_for_filetype( $filetype ); ?>
						<meta itemprop="price" content="$0.00">
						<link itemprop="bookFormat" href="http://schema.org/EBook">
						<link itemprop="availability" href="http://schema.org/InStock">
					</a>
				</li>
				<?php endforeach; ?>
				<ul>
			</div>
		<?php }

		if ( ! empty( $book_information['pb_about_50'] ) ) { ?>
			<p class="description"><?php echo pb_decode( $book_information['pb_about_50'] ); ?></p>
		<?php } ?>
	</div> <!-- end .book-info -->

	<?php global $first_chapter; ?>
	<div class="license">
		<?php echo \PressbooksBook\Helpers\license_to_icons( $book_information['pb_book_license'] ); // TODO ?>
		<p class="tc fw6"><?php echo \PressbooksBook\Helpers\license_to_text( $book_information['pb_book_license'] ); // TODO ?></p>
	</div>
	<div class="call-to-action">
		<a class="button button--monochrome-outline" href="<?php echo $first_chapter; ?>">
			<?php _e( 'Read the Book', 'pressbooks-book' ); ?>
		</a>
		<?php if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) { ?>
			<a class="button button--monochrome" href="<?php echo home_url( '/buy' ); ?>">
				<?php _e( 'Buy the Book', 'pressbooks-book' ); ?>
			</a>
		<?php } ?>
	</div> <!-- end .call-to-action -->
	<div id="share">
		<?php if ( pb_social_media_enabled() ) { ?>
			<button id="twitter" class="sharer btn" data-sharer="twitter" data-title="<?php _e( 'Check out this great book on Pressbooks.', 'pressbooks-book' ); ?>" data-url="<?php the_permalink(); ?>" data-via="pressbooks"><?php _e( 'Tweet', 'pressbooks-book' ); ?></button>
			<button id="facebook" class="sharer btn" data-sharer="facebook" data-title="<?php _e( 'Check out this great book on Pressbooks.', 'pressbooks-book' ); ?>" data-url="<?php the_permalink(); ?>"><?php _e( 'Like', 'pressbooks-book' ); ?></button>
			<button id="googleplus" class="sharer btn" data-sharer="googleplus" data-title="<?php _e( 'Check out this great book on Pressbooks.', 'pressbooks-book' ); ?>" data-url="<?php the_permalink(); ?>"><?php _e( '+1', 'pressbooks-book' ); ?></button>
		<?php } ?>
	</div>

</section>
