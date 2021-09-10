<div class="contributor__name__and__links">
	<?php if ( $contributor['contributor_picture'] ) : ?>
		<img class="contributor__profile__picture" alt="" title="" src="<?php echo $contributor['contributor_picture'] ?>"/>
		<?php endif; ?>
	<p class="contributor__name"><span class="screen-reader-text">name: </span><?php echo $contributor['name'] ?></p>
	<?php if ( $contributor['contributor_institution'] ) : ?>
		<p class="contributor__institution"><span class="screen-reader-text">institution: </span><?php echo $contributor['contributor_institution'] ?></p>
	<?php endif; ?>
	<?php if ( $contributor['contributor_user_url'] ) : ?>
		<p class="contributor__website"><span class="screen-reader-text">website: </span><a href="<?php echo $contributor['contributor_user_url'] ?>" target="_blank"><?php echo $contributor['contributor_user_url'] ?></a></p>
	<?php endif; ?>
	<div class="contributor__links">
		<?php if ( $contributor['contributor_twitter'] ) : ?>
			<a class="contributor__twitter" href="<?php echo $contributor['contributor_twitter'] ?>" target="_blank"><svg role="img" aria-labelledby="twitter-logo" class="contributor icon-svg"><title id="twitter-title-logo">Twitter logo</title><use href="#twitter-icon"/></svg></a>
		<?php endif; ?>
		<?php if ( $contributor['contributor_linkedin'] ) : ?>
			<a class="contributor__linkedin" href="<?php echo $contributor['contributor_linkedin'] ?>" target="_blank"><svg role="img" aria-labelledby="linkedin-logo" class="contributor icon-svg"><title id="linkedin-title-logo">LinkedIn logo</title><use href="#linkedin-icon"/></svg></a>
		<?php endif; ?>
		<?php if ( $contributor['contributor_github'] ) : ?>
			<a class="contributor__github" href="<?php echo $contributor['contributor_github'] ?>" target="_blank"><svg role="img" aria-labelledby="github-logo" class="contributor icon-svg"><title id="github-title-logo">GitHub logo</title><use href="#github-icon"/></svg></a>
			<?php endif; ?>
	</div>
</div>
<div class="contributor__bio"><?php echo wp_kses( $contributor['contributor_description'], true ) ?></div>
