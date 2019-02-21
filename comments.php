<section class="section section-comments" id="comments">
	<h2 class="section__title section-comments__title"><?php _e( 'Feedback/Errata', 'pressbooks-book' ); ?></h2>
<div class="section-comments__inner">

<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'pressbooks-book' ); ?></p>
			<div><!-- #comments -->
		</section>
	<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title">
			<?php
			printf( // WPCS: XSS OK.
				esc_html(
					/* translators: %1$d: number of responses, %2$s: title of section */
					_nx(
						'%1$d Response to %2$s',
						'%1$d Responses to %2$s',
						get_comments_number(),
						'comments title',
						'pressbooks'
					)
				),
				number_format_i18n( get_comments_number() ),
				'<em>' . get_the_title() . '</em>'
			);
			?>
			</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'pressbooks-book' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'pressbooks-book' ) ); ?></div>
			</div> <!-- .navigation -->
	<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php wp_list_comments( [ 'callback' => '\PressbooksBook\Helpers\comments_template' ] ); ?>
			</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'pressbooks-book' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'pressbooks-book' ) ); ?></div>
			</div><!-- .navigation -->
	<?php endif; // check for comment navigation ?>

	<?php
else : // or, if we don't have comments:
	if ( ! comments_open() ) :
		?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'pressbooks-book' ); ?></p>
<?php endif; ?>

<?php endif; ?>

<?php
/* Comment form submit text*/
$comments_args = [
	'label_submit' => __( 'Submit', 'pressbooks-book' ),
	'class_form' => 'section-comments__form comment-form clearfix',
	'class_submit' => 'button button--primary button--header button--submit',
	'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
];

comment_form( $comments_args );
?>

</div>
</section><!-- #comments -->
