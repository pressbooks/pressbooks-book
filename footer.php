<?php if ( ! is_single() ) {?>

	</div><!-- #content -->

<?php } ?>
<?php if ( ! is_front_page() ) {?>

	</div><!-- #wrap -->
	<div class="push"></div>

	</div><!-- .wrapper for sitting footer at the bottom of the page -->
<?php }

global $multipage;
?>


<footer class="footer<?php echo is_front_page() ? ' footer--home' : ' footer--reading' ?><?php echo $multipage ? ' footer--multipage' : '' ?>">
	<div class="footer__inner">
		<section class="footer__pressbooks">
			<a class="footer__pressbooks__icon" href="https://pressbooks.com" title="Pressbooks">
				<?php // TODO ?>
				<svg class="icon--svg">
					<use xlink:href="#icon-pressbooks" />
				</svg>
			</a>
			<div class="footer__pressbooks__links">
				<p class="footer__pressbooks__links__title"><a href="https://pressbooks.com"><?php printf( __( 'Powered by %s', 'pressbooks-book' ), '<span class="pressbooks">Pressbooks</span>' ); ?></a></p>
				<ul class="footer__pressbooks__links__list">
					<li><a href="https://pressbooks.org"><?php _e( 'Open Source', 'pressbooks-book' ); ?></a> |</li>
					<li><a href="https://pressbooks.com/for-academia"><?php _e( 'Open Textbooks', 'pressbooks-book' ); ?></a> |</li>
					<li><a href="https://pressbooks.com"><?php _e( 'Open Book Publishing', 'pressbooks-book' ); ?></a> |</li>
					<li><a href="https://pressbooks.com/about"><?php _e( 'Learn More', 'pressbooks-book' ); ?></a> </li>
				</ul>
			</div>
			<div class="footer__pressbooks__social">
				<a class="facebook" href="https://facebook.com/pressbooks2" title="<?php _e( 'Pressbooks on Facebook', 'pressbooks-book' ); ?>">
					<svg class="icon--svg">
						<use xlink:href="#facebook" />
					</svg>
					<span class="screen-reader-text"><?php _e( 'Pressbooks on Facebook', 'pressbooks-book' ); ?></span>
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
<?php get_template_part( 'partials/content', 'accessibility-toolbar' ); ?>
<?php wp_footer(); ?>
</body>
</html>
