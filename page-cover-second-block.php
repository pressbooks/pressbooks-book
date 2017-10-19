<section class="section section-toc">
		<h2 class="section__title"><?php _e( 'Table of Contents', 'pressbooks-book' ); ?></h2>
		<ul class="section-toc__list">
			<li>
				<ul class="section-toc__front-matter">
					<?php \PressbooksBook\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
				</ul>
			</li>
			<?php foreach ( $book_structure['part'] as $part ) : ?>
				<li class="section-toc__part<?php if ( count( $book_structure['part'] ) == 1 ) : ?> open<?php endif; ?>">
					<?php if ( count( $book_structure['part'] ) > 1  && get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) { ?>
						<h3 class="section-toc__part__title">
							<span class="inner-content"><?php
							if ( $part['has_post_content'] ) { ?>
								<a href="<?php echo get_permalink( $part['ID'] ); ?>"><?php
							}

							echo $part['post_title'];

							if ( $part['has_post_content'] ) {
								?></a><?php
							}

							if( ! empty($part['chapters'] )){
								?>
								<a class="icon icon-arrow-down"></a><a class="icon icon-arrow-up"></a><?php
							}
							?></span>
						</h3>
					<?php } ?>
					<div class="inner-content">
						<ul class="section-toc__chapters">
						<?php \PressbooksBook\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
						</ul>
					</div>
				</li>
			<?php endforeach; ?>
			<li>
				<ul class="section-toc__back-matter">
					<?php \PressbooksBook\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
				</ul>
			</li>
		</ul><!-- end #toc -->
	<div class="section-toc__toggle-all">
		<button class="button button--primary section-toc__toggle-all__show"><?php _e( 'View complete table of contents', 'pressbooks-book' ); ?></button>
		<button class="button button--secondary section-toc__toggle-all__hide"><?php _e( 'View less', 'pressbooks-book' ); ?></button>
	</div>
</section>
