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

function get_name_for_filetype( $filetype ) {
	$formats = [
		'print-pdf' => __( 'Print-Ready PDF', 'pressbooks-book' ),
		'pdf' => __( 'PDF', 'pressbooks-book' ),
		'mpdf' => __( 'PDF', 'pressbooks-book' ),
		'epub' => __( 'EPUB', 'pressbooks-book' ),
		'mobi' => __( 'MOBI', 'pressbooks-book' ),
		'epub3' => __( 'EPUB3', 'pressbooks-book' ),
		'xhtml' => __( 'XHTML', 'presbooks-book' ),
		'odt' => __( 'OpenDocument', 'pressbooks-book' ),
		'wxr' => __( 'Pressbooks XML', 'pressbooks-book' ),
		'vanillawxr' => __( 'WordPress XML', 'pressbooks' )
	];

	return $formats[ $filetype ];
}

function license_to_icons( $license ) {
	$output = '';
	if ( strpos( $license, 'cc' ) !== false ) {
		$parts = explode( '-', $license );
		foreach ( $parts as $part ) {
			$output .= "<span class='cc-icon cc-icon__$part'></span>";
		}
	} elseif ( $license === 'public-domain' ) {
		$output .= "<span class='cc-icon cc-icon__publicdomain'></span>";
  } elseif ( $license === 'all-rights-reserved' ) {
		return '';
	}
	return sprintf('<div class="icons">%s</div>', $output);
}

function license_to_text( $license ) {
	switch( $license ) {
		case 'public-domain':
			return __( 'Public Domain', 'pressbooks-book' );
			break;
		case 'cc-by':
			return __( 'Creative Commons Attribution', 'pressbooks-book' );
			break;
		case 'cc-by-sa':
			return __( 'Creative Commons Attribution ShareAlike', 'pressbooks-book' );
			break;
		case 'cc-by-nd':
			return __( 'Creative Commons Attribution NoDerivatives', 'pressbooks-book' );
			break;
		case 'cc-by-nc':
			return __( 'Creative Commons Attribution NonCommercial', 'pressbooks-book' );
			break;
		case 'cc-by-nc-sa':
			return __( 'Creative Commons Attribution NonCommercial ShareAlike', 'pressbooks-book' );
			break;
		case 'cc-by-nc-nd':
			return __( 'Creative Commons Attribution NonCommercial NoDerivatives', 'pressbooks-book' );
			break;
		case 'all-rights-reserved':
		default:
			return __( 'All Rights Reserved', 'pressbooks-book' );
	}
}
