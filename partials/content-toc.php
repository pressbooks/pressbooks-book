<?php
// Setup global variables that may be missing (/table-of-contents/ page can be accessed without a parent template)
if ( ! isset( $book_structure ) ) {
	$book_structure = pb_get_book_structure();
}

if ( ! isset( $book_subsections ) ) {
	$book_subsections = pb_get_all_subsections( $book_structure );
}

// Setup TOC specific variables
global $blog_id;
$can_read = current_user_can_for_blog( $blog_id, 'read' );
$can_read_private = current_user_can_for_blog( $blog_id, 'read_private_posts' );
$permissive_private_content = (int) get_option( 'permissive_private_content', 0 );
$options = get_option( 'pressbooks_theme_options_global' );
$part_numbers = $options['chapter_numbers'] ?? false; ?>
<ol class="toc">
	<?php echo \PressbooksBook\Helpers\toc_sections( $book_structure['front-matter'], 'front-matter', $can_read, $can_read_private, $permissive_private_content, $book_subsections ); ?>
	<?php
	$n = 0;
	$multiple_parts = count( $book_structure['part'] ) > 1;
	foreach ( $book_structure['part'] as $key => $part ) {
		$part_has_chapters = false;
		if ( ! empty( $part['chapters'] ) ) {
			foreach ( $part['chapters'] as $chapter ) {
				if ( in_array( $chapter['post_status'], [ 'publish', 'web-only' ], true ) ) {
					$part_has_chapters = true;
					break;
				}
			}
		}
		$part_has_content = $part['has_post_content'] ?? false;
		$part_is_visible = get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on';
		$part_class = ( $part_has_chapters ) ? 'toc__part toc__part--full' : 'toc__part toc__part--empty';
		if ( $part_has_chapters || $part_has_content ) {
			$n++;
			$part_number = \Pressbooks\L10n\romanize( $n );
			$part_title = ( $part_numbers ) ? "<span class='toc__title__number'>$part_number</span>. {$part['post_title']}" : $part['post_title'];
			$part_class = 'toc__part';
			$part_class .= ( $part_has_chapters ) ? ' toc__part--full' : ' toc__part--empty';
			if ( isset( $post ) ) {
				$part_class .= ( $post->post_parent === $part['ID'] ) ? ' toc__parent' : '';
			}
			printf(
				'<li id="%1$s" class="%2$s">%3$s%4$s</li>',
				"toc-part-{$part['ID']}",
				$part_class,
				( $part_is_visible ) ?
					sprintf(
						'<p class="toc__title">%s</p>',
						( $part_has_content ) ? "<a href='" . get_permalink( $part['ID'] ) . "'>$part_title</a>" : $part_title
					)
					: '',
				( $part_has_chapters ) ? '<ol class="toc__chapters">' . \PressbooksBook\Helpers\toc_sections( $part['chapters'], 'chapter', $can_read, $can_read_private, $permissive_private_content, $book_subsections ) . '</ol>' : ''
			);
		}
	}
	?>
	<?php echo \PressbooksBook\Helpers\toc_sections( $book_structure['back-matter'], 'back-matter', $can_read, $can_read_private, $permissive_private_content, $book_subsections ); ?>
</ol> <!-- end #toc -->
