<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<?php if ( pb_is_public() ) : ?>
	<section class="block block-toc">
		<?php
		if ( pb_get_first_post_id() ) :
			?><h2 class="block__title block-toc__title"><?php _e( 'Contents', 'pressbooks-book' ); ?></h2><?php
			include( locate_template( 'partials/content-toc.php' ) );
		else :
			echo apply_filters( 'the_content', __( 'This book does not contain any public content.', 'pressbooks-book' ) );
		endif;
		?>
	</section>
<?php else : ?>
	<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
