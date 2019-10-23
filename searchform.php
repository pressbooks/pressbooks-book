<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _ex( 'Search in book:', 'label', 'pressbooks-book' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search in book &hellip;', 'placeholder', 'pressbooks-book' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit">
		<svg class="icon--svg"><use href="#search" /></svg>
		<span class="screen-reader-text" ><?php _e( 'Search', 'pressbooks-book' ); ?></span>
	</button>
</form>
