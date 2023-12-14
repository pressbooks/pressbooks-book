<?php
edit_post_link( __( 'Edit', 'pressbooks-book' ), '<div class="edit-link">', '</div>', $post->ID, 'call-to-action' );
?>
<section data-type="<?php echo $datatype; ?>" <?php post_class( pb_get_section_type( $post ) ); ?>>
	<?php if ( $number || get_post_meta( $post->ID, 'pb_show_title', true ) || $post->post_type === 'part' || $subtitle || $authors ) { ?>
	<header>
		<?php if ( $number || get_post_meta( $post->ID, 'pb_show_title', true ) || $post->post_type === 'part' ) { ?>
		<h1 class="entry-title">
			<?php
			if ( $number ) {
				echo "<span>$number</span> ";
			}
			if ( get_post_meta( $post->ID, 'pb_show_title', true ) || $post->post_type === 'part' ) {
				the_title();
			}
			?>
		</h1>
		<?php } ?>
		<?php if ( $subtitle ) { ?>
			<p data-type="subtitle"><?php echo $subtitle; ?></p>
			<?php } ?>
			<?php if ( $authors ) { ?>
				<p data-type="author"><?php echo $authors; ?></p>
				<?php } ?>
			</header>
	<?php } ?>
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
	if ( $display_about_the_author && $authors ) {
		?>
		<hr class="before-contributors clear">
		<section class="contributors chapter-authors">
			<h2 class="about-authors"><?php echo _n( 'About the author', 'About the authors', count( $chapter_contributors ), 'pressbooks-book' ); ?></h2>
			<?php
			foreach ( $chapter_contributors as $contributor ) {
				echo $blade_engine->render(
					'posttypes.contributor',
					[
						'contributor' => $contributor,
						'key' => str_random(),
					]
				);
			}
			?>
		</section>
		<?php
	}
	?>
</section>
