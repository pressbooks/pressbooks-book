<?php
$contributor['contributor_profile_picture'] = 'https://steelwagstaff.info/wordpress/wp-content/uploads/2019/08/steel_headshot.jpg';
?>

<div class="contributor_name_and_links">
	<?php if ( $contributor['contributor_profile_picture'] ): ?>
		<img class="contributor_profile_picture" alt="" title="" src="<?php echo $contributor['contributor_profile_picture'] ?>"/>
		<?php endif; ?>
	<span class="contributor_name"><?php echo $contributor['name'] ?></span>
	<?php if ( $contributor['contributor_institution'] ) : ?>
		<span class="contributor_institution"><?php echo $contributor['contributor_institution'] ?></span>
	<?php endif; ?>
	<?php if ( $contributor['contributor_url'] ) : ?>
		<span class="contributor_website"><a href="<?php echo $contributor['contributor_url'] ?>" target="_blank"><?php echo $contributor['contributor_url'] ?></a></span>
	<?php endif; ?>
	<div class="contributor_links">
		<?php if ( $contributor['contributor_twitter'] ) : ?>
			<a class="contributor_twitter" href="<?php echo $contributor['contributor_twitter'] ?>" target="_blank"><svg role="img" aria-labelledby="twitter-logo" class="contributor icon-svg"><title id="twitter-title-logo">Twitter logo</title><use href="#twitter-icon"/></svg></a>
		<?php endif; ?>
		<?php if ( $contributor['contributor_linkedin'] ) : ?>
			<a class="contributor_linkedin" href="<?php echo $contributor['contributor_linkedin'] ?>" target="_blank"><svg role="img" aria-labelledby="linkedin-logo" class="contributor icon-svg"><title id="linkedin-title-logo">LinkedIn logo</title><use href="#linkedin-icon"/></svg></a>
		<?php endif; ?>
		<?php if ( $contributor['contributor_github'] ) : ?>
			<a class="contributor_github" href="<?php echo $contributor['contributor_github'] ?>" target="_blank"><svg role="img" aria-labelledby="github-logo" class="contributor icon-svg"><title id="github-title-logo">GitHub logo</title><use href="#github-icon"/></svg></a>
			<?php endif; ?>
	</div>
</div>
<div class="contributor_bio"><?php echo wp_kses($contributor['contributor_description'], true)?></div>
