<?php
/**
 * Archive Banner Template
 *
 * @var string|null $args['formatted_date'] The formatted archive date, or null if not set
 */

$formatted_date = $args['formatted_date'] ?? null;
?>
<div class="pb-archive-banner" role="alert" aria-live="polite">
	<p>
		<?php if ( $formatted_date ) : ?>
			<?php
			printf(
				/* translators: %s: The date when the book was archived */
				esc_html__( 'This book was archived by its publisher on %s. It is no longer being updated.', 'pressbooks-book' ),
				'<strong>' . esc_html( $formatted_date ) . '</strong>'
			);
			?>
		<?php else : ?>
			<?php esc_html_e( 'This book was archived by its publisher. It is no longer being updated.', 'pressbooks-book' ); ?>
		<?php endif; ?>
	</p>
</div>
