<?php $bloginfourl = get_bloginfo( 'url' ); ?>

	<div <?php post_class(); ?>>
		<h2 class="entry-title denied-title"><?php _e( 'Access Denied', 'pressbooks-book' ); ?></h2>
		<div class="entry-content denied-text">
			<p>
			<?php
			printf(
				/* translators: link to sign in */
				__( 'This book is private, and accessible only to registered users. If you have an account you can %s.', 'pressbooks-book' ),
				sprintf(
					'<a href="%1$s">%2$s</a>',
					wp_login_url(),
					__( 'sign in here', 'pressbooks-book' )
				)
			);
			?>
			</p>
			<p>
			<?php
			printf(
				/* translators: link to Pressbooks.pub */
				__( 'You can also set up your own Pressbooks book at %s.', 'pressbooks-book' ),
				sprintf(
					'<a href="%1$s">%2$s</a>',
					apply_filters( 'pb_signup_url', 'https://pressbooks.pub/auth' ),
					apply_filters( 'pb_signup_title', 'Pressbooks.pub' )
				)
			);
			?>
			</p>
		</div>
	</div><!-- #post-## -->
