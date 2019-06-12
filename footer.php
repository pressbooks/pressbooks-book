<?php if ( ! is_single() ) { ?>
	</div><!-- #content -->
<?php } ?>
</main>
<?php
global $multipage;
?>


<footer class="footer
<?php
if ( is_front_page() ) :
	echo ' footer--home';
elseif ( is_single() ) :
	echo ' footer--reading';
else :
	echo ' footer--page';
endif;
echo $multipage ? ' footer--multipage' : '';

/**
 * Add checks to determine what contact link returns
 */
$pb_network_contact_form = get_blog_option( get_main_site_id(), 'pb_network_contact_form' );
$pb_network_contact_link = get_blog_option( get_main_site_id(), 'pb_network_contact_link' );

if ( $pb_network_contact_form ) {
	$contact_link = network_home_url( '/#contact' );
} else {
	if ( ! empty( $pb_network_contact_link ) ) {
		$contact_link = $pb_network_contact_link;
	} else {
		$contact_link = '';
	}
}
/**
 * Filter the "Contact" link.
 *
 * @since 5.6.0
 */
$contact_link = apply_filters( 'pb_contact_link', $contact_link );
if ( $contact_link ) {
	$contact_link_href = sprintf(
		'&bull; <a href="%1$s">%2$s</a>',
		$contact_link,
		__( 'Contact', 'pressbooks' )
	);
} else {
	$contact_link_href = '';
}

?>
">
	<div class="footer__inner">
		<section class="footer__pressbooks">
			<a class="footer__pressbooks__icon" href="https://pressbooks.com" title="Pressbooks">
				<?php // TODO ?>
				<svg class="icon--svg">
					<use xlink:href="#icon-pressbooks" />
				</svg>
			</a>
			<div class="footer__pressbooks__links">
				<?php /* translators: %s: Pressbooks */ ?>
				<p class="footer__pressbooks__links__title"><a href="https://pressbooks.com"><?php printf( __( 'Powered by %s', 'pressbooks-book' ), '<span class="pressbooks">Pressbooks</span>' ); ?></a></p>
				<ul class="footer__pressbooks__links__list">
					<li><a href="https://pressbooks.com/help-and-support/"><?php _e( 'Guides and Tutorials', 'pressbooks-book' ); ?></a></li>
					<?php if ( $contact_link ) : ?>
						<li>|<a href="<?php echo $contact_link; ?>"><?php _e( 'Contact', 'pressbooks-aldine' ); ?></a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="footer__pressbooks__social">
				<a href="https://www.youtube.com/user/pressbooks" title="<?php _e( 'Pressbooks on YouTube', 'pressbooks-book' ); ?>">
					<img class="youtube-link" src="<?php bloginfo( 'template_directory' ); ?>/assets/images/yt_icon_mono_dark.png" alt="YouTube">
					<span class="screen-reader-text"><?php _e( 'Pressbooks on YouTube', 'pressbooks-book' ); ?></span>
				</a>
				<a class="twitter" href="https://twitter.com/intent/follow?screen_name=pressbooks" title="<?php _e( 'Pressbooks on Twitter', 'pressbooks-book' ); ?>">
					<svg class="icon--svg">
						<use xlink:href="#twitter" />
					</svg>
				<span class="screen-reader-text"><?php _e( 'Pressbooks on Twitter', 'pressbooks-book' ); ?></span></a>
			</div>

		</section>
	</div><!-- .container -->
</footer><!-- .footer -->
<?php wp_footer(); ?>
</div>
</body>
</html>
