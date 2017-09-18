<?php

namespace PressbooksBook\Helpers;

function toc_sections( $sections, $post_type, $can_read, $can_read_private, $permissive_private_content, $should_parse_subsections ) {
	global $blog_id;

	foreach ( $sections as $section ) {
		if ( $section['post_status'] !== 'publish' ) {
			if ( ! $can_read_private ) {
				if ( $can_read ) {
					if ( $permissive_private_content !== 1 ) {
						continue; // Skip this one.
					}
				} elseif ( ! $can_read ) {
					continue; // Skip this one.
				}
			}
		} ?>
		<li class="<?php echo $post_type; ?> <?php echo pb_get_section_type( get_post( $section['ID'] ) ) ?>">
			<a href="<?php echo get_permalink( $section['ID'] ); ?>"><?php echo pb_strip_br( $section['post_title'] );?></a>
			<?php if ( $should_parse_subsections ) {
				$subsections = pb_get_subsections( $section['ID'] );
				if ( $subsections ) { ?>
					<ul class="sections">
					<?php foreach ( $subsections as $id => $name ) { ?>
						<li class="section"><a href="<?php echo get_permalink( $section['ID'] ); ?>#<?php echo $id; ?>"><?php echo $name; ?></a></li>
					<?php } ?>
					</ul>
				<?php }
			} ?>
		</li>
	<?php }
}
