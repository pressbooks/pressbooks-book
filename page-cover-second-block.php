<section class="cover-toc">
		<h2 class="ttu tc"><?php _e( 'Table of Contents', 'pressbooks-book' ); ?></h2>
		<ul class="toc list pl0">
			<li>
				<ul class="front-matter list pl0">
					<?php \PressbooksBook\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
				</ul>
			</li>
			<?php foreach ( $book_structure['part'] as $part ) : ?>
				<li class="part">
					<?php if ( count( $book_structure['part'] ) > 1  && get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) { ?>
						<h4><?php if ( $part['has_post_content'] ) { ?>
						<a href="<?php echo get_permalink( $part['ID'] ); ?>"><?php } ?>
							<?php echo $part['post_title']; ?>
						<?php if ( $part['has_post_content'] ) { ?></a><?php } ?></h4>
					<?php } ?>
					<ul class="chapters list pl0">
					<?php \PressbooksBook\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
					</ul>
				</li>
			<?php endforeach; ?>
			<li>
				<ul class="back-matter list pl0">
					<?php \PressbooksBook\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
				</ul>
			</li>
		</ul><!-- end #toc -->
</section>
