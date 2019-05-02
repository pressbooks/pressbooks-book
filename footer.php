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
					<li><a href="https://pressbooks.com/help-and-support/"><?php _e( 'Guides and Tutorials', 'pressbooks-book' ); ?></a> |</li>
					<li><a href="<?php echo network_home_url( '/#contact' ); ?>"><?php _e( 'Contact', 'pressbooks-book' ); ?></a> </li>
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
