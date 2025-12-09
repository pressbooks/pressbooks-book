<?php
if ( ! function_exists( '\Pressbooks\Metadata\get_supplemental_materials' ) ) {
	return;
}

$related_materials = \Pressbooks\Metadata\get_supplemental_materials();

if ( empty( $related_materials ) ) {
	return;
}
?>

<section class="block block-related-materials block-toggle js-block">
	<h2 class="block__title block-related-materials__title" id="block-related-materials-title"><?php _e( 'Supplemental Materials', 'pressbooks-book' ); ?></h2>
	<div class="block-related-materials__inner block-toggle__content" id="block-related-materials">
		<div class="block-related-materials__inner__content">
			<ul class="block-related-materials__list">
				<?php foreach ( $related_materials as $material ) : ?>
					<li class="block-related-materials__item">
						<a href="<?php echo esc_url( $material['url'] ); ?>" target="_blank" rel="noopener noreferrer">
							<svg class="icon--svg" role="none" aria-hidden="true" focusable="false">
								<use href="#icon-link" />
							</svg>
							<?php echo esc_html( ! empty( $material['title'] ) ? $material['title'] : $material['url'] ); ?>
						</a>
						<?php if ( ! empty( $material['description'] ) ) : ?>
							<span class="block-related-materials__description"><?php echo esc_html( $material['description'] ); ?></span>
						<?php endif; ?>
						<?php if ( $material['privacy'] === 'private' && is_user_logged_in() && current_user_can( 'edit_posts' ) ) : ?>
							<span class="block-related-materials__badge block-related-materials__badge--private"><?php _e( '(Private)', 'pressbooks-book' ); ?></span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
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
			aria-controls="block-related-materials"
			aria-labelledby="block-related-materials-title"
		>
			<svg><use href="#arrow-down" /></svg>
		</button>
	</div>
</section>
