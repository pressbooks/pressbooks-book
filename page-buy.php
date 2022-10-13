<?php /* Template Name: Buy */
get_header(); ?>
<?php if ( \PressbooksBook\Helpers\is_book_public() ) : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'buy-page' ); ?>>
			<h2 class="page-title"><?php _e( 'Buy the Book', 'pressbooks-book' ); ?></h2>

						<?php $urls = get_option( 'pressbooks_ecommerce_links' ); ?>

						<?php if ( empty( $urls ) ) : ?>
				<p><?php _e( 'It\'s coming!', 'pressbooks-book' ); ?></p>
				<?php else : ?>
					<?php foreach ( $urls as $key => $url ) : ?>
						<?php if ( empty( $url ) ) : ?>
							<?php unset( $urls[ $key ] ); ?>
					<?php endif; ?>
					<?php endforeach; ?>
					<?php if ( empty( $urls ) ) : ?>
					<p><?php _e( 'It\'s coming!', 'pressbooks-book' ); ?></p>
					<?php else : ?>
						<?php /* translators: %1$s: url to book, %2$s: title of book */ ?>
					<p><?php printf( __( 'You can buy <a href="%1$s">%2$s</a> by following any of the links below:', 'pressbooks-book' ), get_bloginfo( 'url' ), get_bloginfo( 'name' ) ); ?></p>
					<ul class="buy-book">
						<?php if ( isset( $urls['amazon'] ) && $urls['amazon'] ) : ?>
							<?php /* translators: %1$s: url to purchase */ ?>
						<li class="buy-amazon"><a href="<?php print $urls['amazon']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/images/amazon.png" width="100" height="20" alt="
							<?php
							/* translators: %s: name of organization */
							printf( __( 'Logo for %s', 'pressbooks-book' ), 'Amazon' );
							?>
						" /><?php printf( __( 'Purchase on %s', 'pressbooks-book' ), 'amazon.com' ); ?></a></li>
						<?php endif; ?>

						<?php if ( isset( $urls['oreilly'] ) && $urls['oreilly'] ) : ?>
							<?php /* translators: %1$s: url to purchase */ ?>
						<li class="buy-oreilly"><a href="<?php print $urls['oreilly']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/images/oreilly.png" width="100" height="18" alt="
							<?php
							/* translators: %s: name of organization */
							printf( __( 'Logo for %s', 'pressbooks-book' ), 'O’Reilly' );
							?>
						" title="Oreilly"/><?php printf( __( 'Purchase on %s', 'pressbooks-book' ), 'oreilly.com' ); ?></a></li>
					<?php endif; ?>

						<?php if ( isset( $urls['barnesandnoble'] ) && $urls['barnesandnoble'] ) : ?>
							<?php /* translators: %1$s: url to purchase */ ?>
						<li class="buy-barnes-and-noble"><a href="<?php print $urls['barnesandnoble']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/images/barnes-and-noble.png" width="100" height="16" alt="
							<?php
							/* translators: %s: name of organization */
							printf( __( 'Logo for %s', 'pressbooks-book' ), 'Barnes &amp; Noble' );
							?>
						" /><?php printf( __( 'Purchase on %s', 'pressbooks-book' ), 'barnesandnoble.com' ); ?></a></li>
					<?php endif; ?>

						<?php if ( isset( $urls['kobo'] ) && $urls['kobo'] ) : ?>
							<?php /* translators: %1$s: url to purchase */ ?>
						<li class="buy-kobo"><a href="<?php print $urls['kobo']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/images/kobo.png" width="54" height="29" alt="
							<?php
							/* translators: %s: name of organization */
							printf( __( 'Logo for %s', 'pressbooks-book' ), 'Kobo' );
							?>
						" /><?php printf( __( 'Purchase on %s', 'pressbooks-book' ), 'kobobooks.com' ); ?></a></li>
					<?php endif; ?>

						<?php if ( isset( $urls['applebooks'] ) && $urls['applebooks'] ) : ?>
							<?php /* translators: %1$s: url to purchase */ ?>
						<li class="buy-applebooks"><a href="<?php print $urls['applebooks']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/images/ibooks.png" width="34" height="34" alt="
							<?php
							/* translators: %s: name of organization */
							printf( __( 'Logo for %s', 'pressbooks-book' ), 'iBooks' );
							?>
						" /><?php printf( __( 'Purchase on %s', 'pressbooks-book' ), 'apple.com' ); ?></a></li>
					<?php endif; ?>
						<?php if ( isset( $urls['otherservice'] ) && $urls['otherservice'] ) : ?>
							<?php /* translators: %1$s: url to purchase */ ?>
						<li class="buy-other"><?php _e( 'Purchase here:', 'pressbooks-book' ); ?> <a href="<?php print $urls['otherservice']; ?>"><?php print $urls['otherservice']; ?></a></li>
						<?php endif; ?>
						</ul>
				<?php endif; ?>
			<?php endif; ?>
	</div><!-- end .post -->
<?php else : ?>
	<?php get_template_part( 'private' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
