<h2 class="entry-title"><?php
if ( $number ) {
	echo "<span>$number</span>  ";
}
if ( get_post_meta( $post->ID, 'pb_show_title', true ) || $post->post_type === 'part' ) {
	the_title();
}
?></h2>
<div id="post-<?php the_ID(); ?>" <?php post_class( pb_get_section_type( $post ) ); ?>>
<div class="entry-content">
<?php
if ( $subtitle ) :
	?>
<h2 class="chapter_subtitle"><?php echo $subtitle; ?></h2><?php endif; ?>
<?php
if ( $authors ) :
	?>
<h2 class="chapter_author"><?php echo $authors; ?></h2><?php endif; ?>
<?php
if ( get_post_type( $post->ID ) !== 'part' ) {
	if ( pb_should_parse_subsections() ) {
		$content = pb_tag_subsections( apply_filters( 'the_content', get_the_content() ), $post->ID );
		echo $content;
	} else {
		$content = apply_filters( 'the_content', get_the_content() );
		echo $content;
	}
	global $multipage;
	if ( $multipage ) {
		?>
		<div class="nav-reading--page">
			<?php
			global $page, $numpages;
			if ( $page > 1 ) {
				?>
					<div class="nav-reading--page__previous">
						<?php echo _wp_link_page( $page - 1 ); ?><svg class="icon--svg">
				<use href="#arrow-left" />
			</svg>
				<?php
						echo __( 'Previous Page', 'pressbooks-book' ) . '</a>'
				?>
					</div>
					<?php
			}

			if ( $page < $numpages ) {
				?>
					<div class="nav-reading--page__next">
						<?php echo _wp_link_page( $page + 1 ); ?>
									<?php
									echo __( 'Next Page', 'pressbooks-book' ) . '<svg class="icon--svg">
						<use href="#arrow-right" />
					</svg></a>'
									?>
					</div>
					<?php
			}
			?>
		</div>
		<?php
	}
} else {
	echo apply_filters( 'the_content', $post->post_content );
}
?>
</div><!-- .entry-content -->
</div><!-- #post-## -->
<?php edit_post_link( __( 'Edit', 'pressbooks-book' ), '<div class="edit-link">', '</div>', $post->ID, 'call-to-action' ); ?>
