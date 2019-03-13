<?php

// Check if all is well

$meta = new \Pressbooks\Metadata();
$pb_book_is_based_on = get_post_meta( $meta->getMetaPost()->ID, 'pb_is_based_on', true );
if ( ! $pb_book_is_based_on ) {
	return;
}
$pb_section_is_based_on = get_post_meta( $post->ID, 'pb_is_based_on', true );
if ( ! $pb_section_is_based_on ) {
	return;
}
$options = get_option( 'pressbooks_theme_options_web' );
$option = $options['enable_source_comparison'] ?? false;
if ( ! $option ) {
	return;
}
$source_url = \PressbooksBook\Helpers\get_source_book_url( $pb_book_is_based_on );
if ( ! $source_url ) {
	return;
}
$source_meta = \PressbooksBook\Helpers\get_source_book_meta( $source_url );
if ( ! $source_meta ) {
	return;
}
$source_toc = \PressbooksBook\Helpers\get_source_book_toc( $source_url );
if ( ! $source_toc ) {
	return;
}
$original = \PressbooksBook\Helpers\get_original_section( $pb_section_is_based_on, $source_toc );
if ( ! $original ) {
	return;
}

// Ok then!

$source_endpoint = implode(
	'/', [
		$source_url,
		'wp-json/pressbooks/v2',
		( in_array( $post->post_type, [ 'part', 'chapter' ], true ) ) ? $post->post_type . 's' : $post->post_type,
		$original['id'],
	]
);
?>
<div class="block-reading-meta__compare">
	<p>
		<?php
		printf(
			/* translators: %1$s: chapter title, %2$s: book title, %3$s: book author(s) */
			__( 'This chapter is adapted from %1$s in %2$s by %3$s.', 'pressbooks-book' ),
			sprintf( '<a href="%1$s">%2$s</a>', $original['link'], $original['title'] ),
			sprintf( '<a href="%1$s">%2$s</a>', $source_url, $source_meta['name'] ),
			\PressbooksBook\Helpers\get_book_authors( $source_meta )
		);
		?>
	</p>
	<p><button class="block-reading-meta__compare__toggle" aria-expanded="false"><?php _e( 'Show Comparison with Original', 'pressbooks' ); ?></button></p>
	<p aria-live="assertive" role="alert" class="alert visually-hidden"></p>
	<div class="block-reading-meta__compare__activity sk-double-bounce" hidden>
		<div class="sk-child sk-double-bounce1"></div>
		<div class="sk-child sk-double-bounce2"></div>
	</div>
	<div class="block-reading-meta__compare__comparison" hidden>
		<p><?php _e( 'Note: The comparison below is between this text and the <strong>current version</strong> of the text from which it was adapted.', 'pressbooks-book' ); ?></p>
		<p class="block-reading-meta__compare__stats"><ins><span class="num"></span> <?php _e( 'additions', 'pressbooks-book' ); ?></ins> / <del><span class="num"></span> <?php _e( 'deletions', 'pressbooks-book' ); ?></del></p>
		<pre class="block-reading-meta__compare__current" data-source-endpoint="<?php echo $source_endpoint ?>" hidden><?php echo get_post_field( 'post_content', $post, 'raw' ); ?></pre>
	</div>
</div>
