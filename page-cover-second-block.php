			<section class="second-block-wrap">
				<div class="second-block clearfix">
						<div class="description-book-info">
							<?php $metadata = pb_get_book_information();?>
							<h2><?php _e( 'Book Description', 'pressbooks-book' ); ?></h2>
								<?php if ( ! empty( $metadata['pb_about_unlimited'] ) ) : ?>
									<p><?php
										$about_unlimited = pb_decode( $metadata['pb_about_unlimited'] );
										$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
										echo $about_unlimited; ?></p>
								<?php endif; ?>

									<div id="share">
										<?php if ( pb_social_media_enabled() ) { ?>
											<button id="twitter" class="sharer btn" data-sharer="twitter" data-title="<?php _e( 'Check out this great book on Pressbooks.', 'pressbooks-book' ); ?>" data-url="<?php the_permalink(); ?>" data-via="pressbooks"><?php _e( 'Tweet', 'pressbooks-book' ); ?></button>
											<button id="facebook" class="sharer btn" data-sharer="facebook" data-title="<?php _e( 'Check out this great book on Pressbooks.', 'pressbooks-book' ); ?>" data-url="<?php the_permalink(); ?>"><?php _e( 'Like', 'pressbooks-book' ); ?></button>
											<button id="googleplus" class="sharer btn" data-sharer="googleplus" data-title="<?php _e( 'Check out this great book on Pressbooks.', 'pressbooks-book' ); ?>" data-url="<?php the_permalink(); ?>"><?php _e( '+1', 'pressbooks-book' ); ?></button>
										<?php } ?>
									</div>
						</div>

								<?php	$args = [
											'post_type' => 'back-matter',
											'tax_query' => [ // @codingStandardsIgnoreLine
												[
													'taxonomy' => 'back-matter-type',
													'field' => 'slug',
													'terms' => 'about-the-author',
												],
											],
										]; ?>


								<div class="author-book-info">

										<?php $loop = new WP_Query( $args );
										while ( $loop->have_posts() ) : $loop->the_post(); ?>
												<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
												<?php  echo '<div class="entry-content">';
												the_excerpt();
												echo '</div>';
											endwhile; ?>
								</div>
					</div><!-- end .secondary-block -->
				</section> <!-- end .secondary-block -->
