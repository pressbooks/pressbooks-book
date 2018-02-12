<?php $output = get_transient( 'pb_book_contents' );
if ( $output !== false ) {
	echo $output;
} else {
	ob_start();
	$options = get_option( 'pressbooks_theme_options_global' );
	$part_numbers = $options['chapter_numbers'] ?? false; ?>
	<ol class="toc toc__list">
		<li class="dropdown">
			<h3 class="toc__front-matter__title"><?php _e( 'Front Matter', 'pressbooks' ); ?></h3>
			<ol class="toc__front-matter-list">
				<?php \Pressbooks\Book\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
			</ol>
		</li>
		<?php
		$n = 0;
		foreach ( $book_structure['part'] as $key => $part ) :
			if ( ! empty( $part['chapters'] ) || $part['has_post_content'] ) { ?>
			<li class="toc__part<?php if ( ! empty( $part['chapters'] ) ) { ?> dropdown<?php } ?>"><?php
			if ( count( $book_structure['part'] ) > 1 && get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) {
					$n++; ?>
					<h3 class="toc__part__title">
						<span class="inner-content"><?php
						if ( $part['has_post_content'] ) { ?><a href="<?php echo get_permalink( $part['ID'] ); ?>"><?php }
						if ( $part_numbers ) { ?><span><?php echo \Pressbooks\L10n\romanize( $n ); ?>. </span><?php }
						echo $part['post_title'];
						if ( $part['has_post_content'] ) { ?></a><?php }
						?></span>
					</h3><?php }
			if ( ! empty( $part['chapters'] ) ) { ?>
				<div class="inner-content">
					<ol class="toc__chapters">
						<?php \Pressbooks\Book\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
					</ol>
				</div>
				<?php } ?></li><?php }
		endforeach; ?>
		<li class="dropdown">
			<h3 class="toc__back-matter__title"><?php _e( 'Back Matter', 'pressbooks' ); ?></h3>
			<ol class="toc__back-matter-list">
				<?php \Pressbooks\Book\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
			</ol>
		</li>
	</ol><!-- end #toc -->

	<?php $output = ob_get_clean();
	echo $output;
	set_transient( 'pb_book_contents', $output );
}

