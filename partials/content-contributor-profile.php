<?php
$contributor = [
		'profile_picture' => 'https://steelwagstaff.info/wordpress/wp-content/uploads/2019/08/steel_headshot.jpg',
		'name' => 'Steel Wagstaff',
		'institution' => 'Pressbooks',
		'website' => 'https://steelwagstaff.info',
		'twitter' => 'https://twitter.com/steelwagstaff',
		'linkedin' => 'https://www.linkedin.com/in/steel-wagstaff/',
		'github' => 'https://github.com/SteelWagstaff',
		'bio' => "<p>I have spent much of my adulthood teaching or supporting others who teach at universities, though I've worked outside the academy as a land surveyor, prison educator, and mentor/tutor for elementary school-aged kids.</p><p>I earned <a href='https://steelwagstaff.info/wordpress/wp-content/uploads/2018/11/steel_wagstaff_dissertation.pdf'>a Ph.D. in English</a> and a master's degree in Library and Information Studies from the University of Wisconsin-Madison.</p><p>I enjoy being a father and partner and friend, poetry (with special affection for <a href='https://theobjectivists.org'>the '<em>Objectivists</em>'</a>), music, libraries, pickup soccer, & vegetarian food.</p>"
];
?>
<section class="contributors">
    <?php // TODO: add for each statement to parse all desired contributors ?>
	<div class="contributor_name_and_links">
		<?php if ( $contributor['profile_picture'] ): ?>
			<img class="contributor_profile_picture" alt="" title="" src="<?php echo $contributor['profile_picture'] ?>"/>
			<?php endif; ?>
		<span class="contributor_name"><?php echo $contributor['name'] ?></span>
		<?php if ( $contributor['institution'] ) : ?>
			<span class="contributor_institution"><?php echo $contributor['institution'] ?></span>
		<?php endif; ?>
		<?php if ( $contributor['website'] ) : ?>
			<span class="contributor_website"><a href="<?php echo $contributor['website'] ?>" target="_blank"><?php echo $contributor['website'] ?></a></span>
		<?php endif; ?>
		<div class="contributor_links">
			<?php if ( $contributor['twitter'] ) : ?>
				<a class="contributor_twitter" href="<?php echo $contributor['twitter'] ?>" target="_blank"><svg role="img" aria-labelledby="twitter-logo" class="contributor icon-svg"><title id="twitter-title-logo">Twitter logo</title><use href="#twitter-icon"/></svg></a>
			<?php endif; ?>
			<?php if ( $contributor['linkedin'] ) : ?>
				<a class="contributor_linkedin" href="<?php echo $contributor['linkedin'] ?>" target="_blank"><svg role="img" aria-labelledby="linkedin-logo" class="contributor icon-svg"><title id="linkedin-title-logo">LinkedIn logo</title><use href="#linkedin-icon"/></svg></a>
			<?php endif; ?>
			<?php if ( $contributor['github'] ) : ?>
				<a class="contributor_github" href="<?php echo $contributor['github'] ?>" target="_blank"><svg role="img" aria-labelledby="github-logo" class="contributor icon-svg"><title id="github-title-logo">GitHub logo</title><use href="#github-icon"/></svg></a>
				<?php endif; ?>
		</div>
	</div>
	<div class="contributor_bio"><?php echo wp_kses($contributor['bio'], true)?></div>
</section>
