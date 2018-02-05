<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<?php if ( pb_is_public() ) : ?>
	<section class="block block-toc">
		<h2 class="block__title block-toc__title"><?php _e( 'Contents', 'pressbooks-book' ); ?></h2>
		<?php include( locate_template( 'partials/content-toc.php' ) ); ?>
	</section>
<?php else : ?>
	<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
