<?php
/**
 * Archive Banner
 *
 * Displays a banner on archived books to inform readers that the content
 * is read-only and no longer actively maintained by the publisher.
 *
 * @author  Pressbooks <code@pressbooks.com>
 * @license GPLv3 (or any later version)
 */

namespace PressbooksBook\ArchiveBanner;

use Pressbooks\DataCollector\Book;

/**
 * Display the archive banner
 *
 * Called directly from header.php
 * Styles are in assets/src/styles/layouts/_header.scss
 */
function display() {
	if ( is_admin() ) {
		return;
	}

	$site_details = get_blog_details();

	if ( empty( $site_details->archived ) || '1' !== $site_details->archived ) {
		return;
	}

	$archived_date = get_site_meta( get_current_blog_id(), Book::ARCHIVED_DATE, true );
	$formatted_date = $archived_date ? date_i18n( get_option( 'date_format' ), strtotime( $archived_date ) ) : null;

	get_template_part( 'partials/archive-banner', null, [
		'formatted_date' => $formatted_date,
	] );
}
