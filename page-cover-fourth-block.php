<?php
								$authors = get_posts([
									'post_type' => 'back-matter',
														   'suppress_filters' => false,
														 'orderby' => 'menu_order',
														 'order' => 'ASC',
														   'tax_query' => [ // @codingStandardsIgnoreLine
															 [
																 'taxonomy' => 'back-matter-type',
																 'field' => 'slug',
																 'terms' => 'about-the-author',
															 ],
														   ],
								]);

									?>


			<section class="fourth-block-wrap">
				<div class="fourth-block clearfix">
						<h2> <?php _e( 'Other books', 'pressbooks-book' ); ?> <?php $autor ?></h2>

					</div><!-- end .fourthary-block -->
				</section> <!-- end .fourthary-block -->
