<?php $bloginfourl = get_bloginfo( 'url' ); ?>

	<div <?php post_class(); ?>>
		<h2 class="entry-title denied-title"><?php _e( 'Access Denied', 'pressbooks-book' ); ?></h2>
		<div class="entry-content denied-text">
			<p>
			<?php
			printf(
				__( 'This book is private, and accessible only to registered users. To access the content, either sign in to your account or request access to this book.', 'pressbooks-book' ),
				
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
