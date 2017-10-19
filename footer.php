<?php if ( ! is_single() ) {?>

	</div><!-- #content -->

<?php } ?>
<?php if ( ! is_front_page() ) {?>

	<?php get_sidebar(); ?>

	</div><!-- #wrap -->
	<div class="push"></div>

	</div><!-- .wrapper for sitting footer at the bottom of the page -->
<?php } ?>


<footer class="footer">
	<div class="footer__inner">
		<?php if ( pb_is_public() ) : ?>
			<?php if ( ! is_front_page() ) : ?>
				<div class="footer__license">
					<?php echo pressbooks_copyright_license(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<section class="footer__pressbooks">
		  <a class="footer__pressbooks__icon" href="https://pressbooks.com" title="Pressbooks"><svg fill="currentColor" width="45" height="44" viewBox="0 0 45 44" xmlns="http://www.w3.org/2000/svg"><title>PB</title><path d="M44.195 41.872c0 .745-.618 1.346-1.377 1.346H1.377C.617 43.219 0 42.617 0 41.872V1.347C0 .604.618 0 1.377 0h41.44c.76 0 1.378.604 1.378 1.347v40.525zM15.282 10.643h-5.21v21.43h3.304V24h1.906c1.435 0 2.656-.5 3.665-1.504 1.008-1.004 1.513-2.213 1.513-3.626v-3.113c0-1.47-.444-2.678-1.33-3.625-.956-.993-2.24-1.489-3.848-1.489zm1.977 5.165h-.001v3.131c0 .513-.184.952-.55 1.318a1.826 1.826 0 0 1-1.338.547h-1.994v-6.86h1.995c.571 0 1.029.171 1.372.513.344.342.516.792.516 1.35zm5.84 16.265h6.118c.828 0 1.662-.25 2.502-.752a4.642 4.642 0 0 0 1.73-1.779c.526-.945.788-2.097.788-3.455 0-.545-.04-1.043-.122-1.486-.163-.868-.414-1.575-.751-2.122-.513-.81-1.137-1.352-1.871-1.625a3.325 3.325 0 0 0 1.154-.839c.78-.866 1.173-2.018 1.173-3.455 0-.876-.105-1.635-.315-2.274-.386-1.198-1.027-2.08-1.925-2.652-1.049-.672-2.225-1.008-3.531-1.008h-4.95v21.447zm3.568-12.69v-5.475h1.382c.652 0 1.184.212 1.592.634.443.456.665 1.13.665 2.018 0 .537-.065.987-.193 1.352-.35.982-1.039 1.471-2.064 1.471h-1.382zm0 9.493v-6.397h1.382c.815 0 1.433.25 1.853.751.466.549.7 1.42.7 2.617 0 .502-.075.948-.227 1.335-.432 1.13-1.208 1.694-2.326 1.694h-1.382z" /></svg></a>
		  <div class="footer__pressbooks__links">
				<h1 class="footer__pressbooks__links__title"><a href="https://pressbooks.com"><?php printf( __( 'Powered by %s', 'pressbooks-book' ), '<span class="pressbooks">Pressbooks</span>' ); ?></a></h1>
				<ul class="footer__pressbooks__links__list">
				  <li><a href="https://pressbooks.org"><?php _e( 'Open Source', 'pressbooks-book' ); ?></a></li>
				  <li><a href="https://pressbooks.com/for-academia"><?php _e( 'Open Textbooks', 'pressbooks-book' ); ?></a></li>
				  <li><a href="https://pressbooks.com"><?php _e( 'Open Book Publishing', 'pressbooks-book' ); ?></a></li>
				  <li><a href="https://pressbooks.com/about"><?php _e( 'Learn More', 'pressbooks-book' ); ?></a></li>
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
<?php // get_template_part( 'content', 'accessibility-toolbar' ); ?>
<?php wp_footer(); ?>
</body>
</html>
