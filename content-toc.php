<ul class="toc__list">
	<li>
		<ul class="toc__front-matter">
			<?php \PressbooksBook\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
		</ul>
	</li>
	<?php foreach ( $book_structure['part'] as $part ) : ?>
		<li class="toc__part js-toc-part<?php if ( count( $book_structure['part'] ) == 1 ) : ?> open<?php endif; ?>">
			<?php if ( count( $book_structure['part'] ) > 1  && get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) { ?>
				<h3 class="toc__part__title">
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
								<a class="icon icon-arrow-down js-toc-part-toggle"></a><a class="icon icon-arrow-up js-toc-part-toggle"></a><?php
							}
							?></span>
				</h3>
			<?php } ?>
			<div class="inner-content">
				<ul class="toc__chapters">
					<?php \PressbooksBook\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
				</ul>
			</div>
		</li>
	<?php endforeach; ?>
	<li>
		<ul class="toc__back-matter">
			<?php \PressbooksBook\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
		</ul>
	</li>
</ul><!-- end #toc -->