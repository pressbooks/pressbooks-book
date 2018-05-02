<?php get_header(); ?>
	<h1><?php esc_html_e( 'Oops! That content can&rsquo;t be found.', 'pressbooks-book' ); ?></h1>
	<p><?php esc_html_e( 'It looks like nothing was found at this location. Try a search?', 'pressbooks-book' ); ?></p>
	<?php get_search_form(); ?>
<?php
get_footer();
