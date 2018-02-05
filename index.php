<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<?php if ( pb_is_public() ) : ?>
	<?php get_template_part( 'partials/content-toc.php' ); ?>
<?php else : ?>
	<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
