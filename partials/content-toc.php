<?php
// Setup global variables that may be missing (/table-of-contents/ page can be accessed without a parent template)
if ( ! isset( $book_structure ) ) {
	$book_structure = pb_get_book_structure();
}

// Setup TOC specific variables
global $blog_id;
$can_read                   = current_user_can_for_blog( $blog_id, 'read' );
$can_read_private           = current_user_can_for_blog( $blog_id, 'read_private_posts' );
$permissive_private_content = (int) get_option( 'permissive_private_content', 0 );
$toc_chmod                  = ( $can_read ? 'x' : 'o' ) . ( $can_read_private ? 'x' : 'o' ) . ( $permissive_private_content ? 'x' : 'o' );
$toc_transient              = 'pb_book_contents_' . $toc_chmod;
$toc_output                 = false; // get_transient( $toc_transient );

if ( ! $toc_output ) {
	ob_start();
	$options      = get_option( 'pressbooks_theme_options_global' );
	$part_numbers = $options['chapter_numbers'] ?? false; ?>
	<ol class="toc">
		<?php echo \Pressbooks\Book\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content ); ?>
		<?php
		$n = 0;
		$multiple_parts = count( $book_structure['part'] ) > 1;
		foreach ( $book_structure['part'] as $key => $part ) :
			$part_has_chapters = ( empty( $part['chapters'] ) ) ? false : true;
			$part_has_content = $part['has_post_content'] ?? false;
			$part_is_visible = get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on';
			$part_class = ( $part_has_chapters ) ? 'toc__part toc__part--full' : 'toc__part toc__part--empty';
			if ( $part_has_chapters || $part_has_content ) {
				printf(
					'<li id="%1$s" class="%2$s">%3$s%4$s</li>',
					"toc-part-{$part['ID']}",
					( $part_has_chapters ) ? 'toc__part toc__part--full' : 'toc__part toc__part--empty',
					"<p class='toc__part__title'>{$part['post_title']}</p>",
					'<div class="inner-content"><ol class="toc__chapters">' . \Pressbooks\Book\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content ) . '</ol></div>'
				);
				/* ?>
			<li id="<?php echo "toc-part-{$part['ID']}"; ?>" class="<?php echo $part_class; ?>">
				<?php
				if ( $multiple_parts && $part_is_visible ) {
					$n++;
					?>
					<p class="toc__part__title">
						<span class="inner-content">
						<?php
						if ( $part_has_content ) {
							?>
							<a href="<?php echo get_permalink( $part['ID'] ); ?>">
							<?php
						}
						if ( $part_numbers ) {
							?>
							<span><?php echo \Pressbooks\L10n\romanize( $n ); ?>. </span>
							<?php
						}
						echo $part['post_title'];
						if ( $part_has_content ) {
							?>
							</a>
							<?php
						}
						?>
						</span>
					</p>
					<?php
				}
				if ( $part_has_chapters ) {
					?>
					<div class="inner-content">
						<ol class="toc__chapters"><?php \Pressbooks\Book\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content ); ?></ol>
					</div>
				<?php } ?>
			</li>
				<?php */
			}
		endforeach;
		?>
		<?php echo \Pressbooks\Book\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content ); ?>
	</ol> <!-- end #toc -->

	<?php
	$toc_output = ob_get_clean();
	set_transient( $toc_transient, $toc_output );
}

// Search for [ id="toc-chapter-123" class=" ] and replace (once!) with [ id="toc-chapter-123" class="toc__selected  ]
// where chapter is any post type (front-matter, part, chapter, back-matter, ...)
if ( isset( $post ) ) {
	$toc_search  = "id=\"toc-{$post->post_type}-{$post->ID}\" class=\"";
	$toc_replace = "{$toc_search}toc__selected ";
	$toc_output  = \Pressbooks\Utility\str_lreplace( $toc_search, $toc_replace, $toc_output );
	// There are no parent selectors in CSS, not even in CSS3
	if ( $post->post_type === 'chapter' ) {
		$toc_search  = "id=\"toc-part-{$post->post_parent}\" class=\"";
		$toc_replace = "{$toc_search}toc__parent ";
		$toc_output  = \Pressbooks\Utility\str_lreplace( $toc_search, $toc_replace, $toc_output );
	}
	if ( in_array( $post->post_type, [ 'front-matter', 'back-matter' ], true ) ) {
		$toc_search  = "id=\"toc-{$post->post_type}\" class=\"";
		$toc_replace = "{$toc_search}toc__parent ";
		$toc_output  = \Pressbooks\Utility\str_lreplace( $toc_search, $toc_replace, $toc_output );
	}
}
echo $toc_output;
