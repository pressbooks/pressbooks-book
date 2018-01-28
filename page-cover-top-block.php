<section class="book-header">
	<div class="book-header__inner">
		<?php pb_get_links( false ); ?>
		<h1 class="section__title book-header__title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php if ( ! empty( $book_information['pb_subtitle'] ) ) : ?>
			<p class="book-header__subtitle"><?php echo $book_information['pb_subtitle']; ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $book_information['pb_author'] ) ) { ?>
			<p class="book-header__author">
				<span class="fn"><?php echo $book_information['pb_author']; ?></span>
			</p>
		<?php } ?>
		<div class="book-header__cover">
			<?php if ( ! empty( $book_information['pb_cover_image'] ) ) { ?>
				<div class="book-header__cover__image">
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
				<div class="book-header__cover__downloads dropdown">

					<span class="dropdown-toggle dropdown-toggle-block" data-toggle="dropdown"><?php _e( 'Download this book', 'pressbooks-book' ); ?></span>
					<ul class="dropdown-menu dropdown-menu-block" >
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
			<?php }?>
				<div class="book-header__share book-header__cover__share">
					<?php if ( pb_social_media_enabled() ) {
						echo \Pressbooks\Book\Helpers\share_icons();
}
					?>
				</div>
			</div>


		<?php global $first_chapter; ?>
		<div class="book-header__license">
			<?php $license = ( isset( $book_information['pb_book_license'] ) ) ? $book_information['pb_book_license'] : 'all-rights-reserved'; ?>
			<div class="book-header__license__icons license-icons"><?php echo \Pressbooks\Book\Helpers\license_to_icons( $license ); ?></div>
			<span class="book-header__license__text license-text"><?php echo \Pressbooks\Book\Helpers\license_to_text( $license ); ?></span>
		</div>
		<div class="book-header__cta">
			<a class="button button--primary button--header" href="<?php echo $first_chapter; ?>">
				<?php _e( 'Read Book', 'pressbooks-book' ); ?>
			</a><?php
			if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) {
				?><a class="button button--secondary button--header" href="<?php echo home_url( '/buy' ); ?>">
					<?php _e( 'Buy Book', 'pressbooks-book' ); ?>
				</a><?php
			} ?>
		</div> <!-- end .call-to-action -->
		<div class="book-header__share">
			<?php if ( pb_social_media_enabled() ) {
				echo \Pressbooks\Book\Helpers\share_icons();
}
			?>
		</div>
	</div>
	<?php

	if ( ! empty( $book_information['pb_about_50'] ) ) { ?>
				<p class="book-header__description"><?php echo pb_decode( $book_information['pb_about_50'] ); ?></p>
			<?php } ?>
</section>
