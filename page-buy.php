<?php /* Template Name: Buy */
$urls = get_option( 'pressbooks_ecommerce_links' );

// If there are no ecommerce links configured, display the 404 template.
if ( empty( $urls ) ) {
	status_header( 404 );
	nocache_headers();
	global $wp_query;
	if ( isset( $wp_query ) ) {
		$wp_query->set_404();
	}
	include locate_template( '404.php' );
	exit;
}

get_header();

// Filter out empty entries
$urls = array_filter( $urls );

if ( \PressbooksBook\Helpers\is_book_public() ) { ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'buy-page' ); ?>>
		<h2 class="page-title"><?php _e( 'Buy the Book', 'pressbooks-book' ); ?></h2>
		<p>
			<?php
			/* translators: %1$s: url to book, %2$s: title of book */
			printf(
				__( 'You can buy <a href="%1$s">%2$s</a> by following any of the links below:', 'pressbooks-book' ),
				esc_url( get_bloginfo( 'url' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>

		<ul class="buy-book">
			<?php
			$stores = [
				'amazon'         => [ 'Amazon' ],
				'barnesandnoble' => [ 'Barnes and Noble' ],
				'kobo'           => [ 'Rakuten Kobo' ],
				'applebooks'     => [ 'Apple Books' ],
			];

			foreach ( $stores as $key => [ $name ] ) {
				if ( empty( $urls[ $key ] ) ) {
					continue;
				}
				?>
				<li class="buy-<?= esc_attr( $key ); ?>">
					<a href="<?= esc_url( $urls[ $key ] ); ?>" class="bookstore-logo-link logo">
						<?= sprintf( __( 'Purchase from %s', 'pressbooks-book' ), esc_html( $name ) ); ?>
					</a>
				</li>
				<?php
			}
			if ( ! empty( $urls['otherservice'] ) ) {
				?>
				<li class="buy-other">
					<?php _e( 'Purchase here:', 'pressbooks-book' ); ?>
					<a href="<?= esc_url( $urls['otherservice'] ); ?>">
						<?= esc_url( $urls['otherservice'] ); ?>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div><!-- end .post -->
	<?php
} else {
	get_template_part( 'private' );
}
get_footer();
