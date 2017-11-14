<?php if ( ! is_single() ) {?>

	</div><!-- #content -->

<?php } ?>
<?php if ( ! is_front_page() ) {?>

	<?php //get_sidebar(); ?>

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
				<svg class="icon--svg">
					<use xlink:href="#icon-pressbooks" />
				</svg>
			</a>
		  <div class="footer__pressbooks__links">
				<h1 class="footer__pressbooks__links__title"><a href="https://pressbooks.com"><?php printf( __( 'Powered by %s', 'pressbooks-book' ), '<span class="pressbooks">Pressbooks</span>' ); ?></a></h1>
				<ul class="footer__pressbooks__links__list">
				  <li><a href="https://pressbooks.org"><?php _e( 'Open Source', 'pressbooks-book' ); ?></a> |</li>
				  <li><a href="https://pressbooks.com/for-academia"><?php _e( 'Open Textbooks', 'pressbooks-book' ); ?></a> |</li>
				  <li><a href="https://pressbooks.com"><?php _e( 'Open Book Publishing', 'pressbooks-book' ); ?></a> |</li>
				  <li><a href="https://pressbooks.com/about"><?php _e( 'Learn More', 'pressbooks-book' ); ?></a> </li>
				</ul>
		  </div>
		  <div class="footer__pressbooks__social">
				<a class="icon icon-facebook" href="https://facebook.com/pressbooks2" title="<?php _e( 'Pressbooks on Facebook', 'pressbooks-book' ); ?>">	</a>
				<a class="icon icon-twitter" href="https://twitter.com/intent/follow?screen_name=pressbooks" title="<?php _e( 'Pressbooks on Twitter', 'pressbooks-book' ); ?>"> </a>
			</div>

				<?php /*<a class="icon icon-facebook" href="https://facebook.com/pressbooks2" title="<?php _e( 'Pressbooks on Facebook', 'pressbooks-book' ); ?>"><?php /*
				  <svg fill="currentColor" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.476-1.195 1.176v1.54h2.39l-.31 2.416h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0" fill-rule="nonzero"/></svg>
				</a>
				<a class="icon icon-twitter" href="https://twitter.com/intent/follow?screen_name=pressbooks" title="<?php _e( 'Pressbooks on Twitter', 'pressbooks-book' ); ?>"><?php /*
					<svg fill="currentColor" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M16 3.038c-.59.26-1.22.437-1.885.517.677-.407 1.198-1.05 1.443-1.816-.634.375-1.337.648-2.085.795-.598-.638-1.45-1.036-2.396-1.036-1.812 0-3.282 1.468-3.282 3.28 0 .258.03.51.085.75C5.152 5.39 2.733 4.084 1.114 2.1.83 2.583.67 3.147.67 3.75c0 1.14.58 2.143 1.46 2.732-.538-.017-1.045-.165-1.487-.41v.04c0 1.59 1.13 2.918 2.633 3.22-.276.074-.566.114-.865.114-.21 0-.416-.02-.617-.058.418 1.304 1.63 2.253 3.067 2.28-1.124.88-2.54 1.404-4.077 1.404-.265 0-.526-.015-.783-.045 1.453.93 3.178 1.474 5.032 1.474 6.038 0 9.34-5 9.34-9.338 0-.143-.004-.284-.01-.425.64-.463 1.198-1.04 1.638-1.7z" fill-rule="nonzero"/></svg>
					</a>*/ ?>

		</section>
	</div><!-- .container -->
</footer><!-- .footer -->
<?php get_template_part( 'content', 'accessibility-toolbar' ); ?>
<?php wp_footer(); ?>
</body>
</html>
