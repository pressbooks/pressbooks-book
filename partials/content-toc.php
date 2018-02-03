<?php $output = get_transient( 'pb_book_contents' );

if ( $output !== false ) {
	echo $output;
} else {
	ob_start(); ?>

	<ol class="toc toc__list">
		<li class="dropdown">
			<h3><?php _e( 'Front Matter', 'pressbooks' ); ?></h3>
			<ol class="toc__front-matter">

				<?php \Pressbooks\Book\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
			</ol>
		</li>
		<?php $n = 1;
		foreach ( $book_structure['part'] as $key => $part ) :
			?>
			<li class="js-toc-part<?php if ( ! empty( $part['chapters'] ) ) { ?> dropdown<?php } ?>">
				<?php if ( count( $book_structure['part'] ) > 1  && get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) { ?>
					<h3 class="toc__part__title js-toc-part-toggle">
						<span class="inner-content"><?php
						if ( $part['has_post_content'] ) {
							?>
							<a href="<?php echo get_permalink( $part['ID'] ); ?>"><?php
						} ?>
							<span><?php echo \Pressbooks\L10n\romanize( $n ); ?>.&nbsp;</span>

							<?php echo $part['post_title'];

							if ( $part['has_post_content'] ) {
								?></a><?php
							}

							if ( ! empty( $part['chapters'] ) ) {?>
								<a class="icon icon-arrow-up-down" href="javascript:void()"></a><?php
							}
						?></span>
					</h3>
				<?php } ?>
				<div class="inner-content">
					<ul class="toc__chapters">
						<?php \Pressbooks\Book\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
					</ul>
				</div>
			</li>
		<?php if ( ! empty( $part['chapters'] ) || $part['has_post_content'] ) { $n++;
} endforeach; ?>
		<li class="dropdown">
		<h3><?php _e( 'Back Matter', 'pressbooks' ); ?></h3>
		<ol class="toc__back-matter">
				<?php \Pressbooks\Book\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ); ?>
			</ol>
		</li>
	</ol><!-- end #toc -->

	<?php $output = ob_get_clean();
	echo $output;
	set_transient( 'pb_book_contents', $output );
}

