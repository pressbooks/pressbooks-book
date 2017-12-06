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
		<li class="toc__<?php echo $post_type; ?> <?php echo pb_get_section_type( get_post( $section['ID'] ) ) ?>">
			<?php if($post_type != 'chapter'){?>
			<div class="inner-content">
			<?php } ?>
				<a class="toc__chapter-title" href="<?php echo get_permalink( $section['ID'] ); ?>">
					<?php $chapter_number = pb_get_chapter_number( $section['post_name'] );
					if ( $chapter_number ) {
						echo "<span>$chapter_number</span>  ";
					}
					echo pb_strip_br( $section['post_title'] );?>
				</a>
				<?php if ( $should_parse_subsections ) {
					$subsections = pb_get_subsections( $section['ID'] );
					if ( $subsections ) { ?>
						<ul class="toc__subsections">
						<?php foreach ( $subsections as $id => $name ) { ?>
							<li class="toc__subsection"><a href="<?php echo get_permalink( $section['ID'] ); ?>#<?php echo $id; ?>"><?php echo $name; ?></a></li>
						<?php } ?>
						</ul>
					<?php }
				}
			if($post_type != 'chapter'){?>
				</div>
			<?php } ?>
		</li>
	<?php }
}

function get_name_for_filetype( $filetype ) {
	$formats = [
		'print-pdf' => __( 'Print PDF', 'pressbooks-book' ),
		'pdf' => __( 'Digital PDF', 'pressbooks-book' ),
		'mpdf' => __( 'Digital PDF', 'pressbooks-book' ),
		'epub' => __( 'EPUB', 'pressbooks-book' ),
		'mobi' => __( 'MOBI', 'pressbooks-book' ),
		'epub3' => __( 'EPUB3', 'pressbooks-book' ),
		'xhtml' => __( 'XHTML', 'presbooks-book' ),
		'odf' => __( 'OpenDocument', 'pressbooks-book' ),
		'wxr' => __( 'Pressbooks XML', 'pressbooks-book' ),
		'vanillawxr' => __( 'WordPress XML', 'pressbooks' )
	];

	return $formats[ $filetype ];
}

function license_to_icons( $license ) {
	if ( ! $license ) {
		return '';
	}
	$output = '';
	if ( strpos( $license, 'cc' ) !== false ) {
		$parts = explode( '-', $license );
		foreach ( $parts as $part ) {
			if($part != 'cc'){
				$part = 'cc-'.$part;
			}
			$output .= "<span class='icon icon-$part'></span>";
		}
	} elseif ( $license === 'public-domain' ) {
		$output .= "<span class='icon icon-cc-pd'></span>";
  } elseif ( $license === 'all-rights-reserved' ) {
		return '';
	}
	return $output;
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

function share_icons( ) {
	$output = '';
	$output .= '<a class="icon icon-twitter sharer" data-sharer="twitter" data-title="'.translate( 'Check out this great book on Pressbooks.', 'pressbooks-book' ).'" data-url="'.get_the_permalink().'" data-via="pressbooks"></a>';
	$output .= '<a class="icon icon-facebook sharer" data-sharer="facebook" data-title="'.translate( 'Check out this great book on Pressbooks.', 'pressbooks-book' ).'" data-url="'.get_the_permalink().'"></a>';
	$output .= '<a class="icon icon-google-plus sharer" data-sharer="googleplus" data-title="'.translate( 'Check out this great book on Pressbooks.', 'pressbooks-book' ).'" data-url="'.get_the_permalink().'"></a>';
	return $output;
}
