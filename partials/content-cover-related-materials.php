<?php
if ( ! function_exists( '\Pressbooks\Metadata\get_supplemental_materials' ) ) {
	return;
}

$related_materials = \Pressbooks\Metadata\get_supplemental_materials();

if ( empty( $related_materials ) ) {
	return;
}
?>

<section class="block block-meta block-toggle js-block">
	<div class="block-meta__content-box">
		<h2 class="block__title block-meta__title" id="block-supplemental-materials-title"><?php _e( 'Supplemental Materials', 'pressbooks-book' ); ?></h2>

		<div class="block-meta__inner block-toggle__content" id="block-supplemental-materials">
			<dl>
				<?php foreach ( $related_materials as $material ) : ?>
					<div class="block-meta__subsection">
						<dt class="block__subtitle block-meta__subtitle">
							<a href="<?php echo esc_url( $material['url'] ); ?>" target="_blank" rel="noopener noreferrer">
								<?php echo esc_html( ! empty( $material['title'] ) ? $material['title'] : $material['url'] ); ?>
							</a>
							<?php if ( $material['privacy'] === 'private' && is_user_logged_in() && current_user_can( 'edit_posts' ) ) : ?>
								<span class="private-badge"><?php _e( '(Private)', 'pressbooks-book' ); ?></span>
							<?php endif; ?>
						</dt>
						<?php if ( ! empty( $material['description'] ) ) : ?>
							<dd class="ml0"><?php echo esc_html( $material['description'] ); ?></dd>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
		<?php
		/**
		 * Append content to cover supplemental materials block.
		 *
		 * @since 2.0.0
		 */
		do_action( 'pb_book_cover_after_supplemental_materials' );
		?>
	</div>
	<div class="block-toggle__cta">
		<button
			class="block-toggle__cta__button button--circle--primary js-toggle-block"
			aria-expanded="false"
			aria-controls="block-supplemental-materials"
			aria-labelledby="block-supplemental-materials-title"
		>
			<svg><use href="#arrow-down" /></svg>
		</button>
	</div>
</section>

	<div class="block-toggle__cta">
		<button
			class="block-toggle__cta__button button--circle--primary js-toggle-block"
			aria-expanded="false"
			aria-controls="block-supplemental-materials"
			aria-labelledby="block-supplemental-materials-title"
		>
			<svg><use href="#arrow-down" /></svg>
		</button>
	</div>
</section>
