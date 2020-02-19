<?php /* Template Name: H5p-listing */
get_header(); ?>
<?php if ( \PressbooksBook\Helpers\is_book_public() ) : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'h5p-listing-page' ); ?>>
			<h2 class="page-title"><?php echo __( 'H5P activities list', 'pressbooks-book' ); ?></h2>

			<div class="float-right">
					<?php echo sprintf( '<button type="button" id="h5p-show-hide" class="btn btn-secondary btn-sm" show-all-text="%s" hide-all-text="%s" ></button>', __( 'Show all', 'pressbooks-book' ), __( 'Hide all', 'pressbooks-book' ) ); ?>
			</div>

			<br /><br />

			<table class="table table-borderless">
				<thead>
				<tr>
					<th><?php echo __( 'ID', 'pressbooks-book' ); ?></th>
					<th><?php echo __( 'Title', 'pressbooks-book' ); ?></th>
					<th><?php echo __( 'Activity type', 'pressbooks-book' ); ?></th>
					<th><?php echo __( 'View', 'pressbooks-book' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php
				$activities = \PressbooksBook\Helpers\get_h5p_activities();

				foreach ( $activities as $activity ) {
					$short_code = sprintf( '[h5p id="%s"]', $activity['ID'] );
					echo '<tr>';
					echo sprintf( '<td>%s</td>', $activity['ID'] );
					echo sprintf( '<td>%s</td>', $activity['title'] );
					echo sprintf( '<td>%s</td>', $activity['activity_type'] );
					echo sprintf( '<td><button h5p-id="%s" type="button" show-activity-text="%s" hide-activity-text="%s" class="btn btn-secondary btn-sm h5p-row-item"></button></td>', $activity['ID'], __( 'View activity', 'pressbooks-book' ), __( 'Hide activity', 'pressbooks-book' ) );
					echo '</tr>';
					echo sprintf( '<tr class="h5p-activity-container"><td colspan="4">%s</td></tr>', do_shortcode( $short_code ) );
				}
				?>
				</tbody>
			</table>
	</div>
<?php else : ?>
	<?php get_template_part( 'private' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
