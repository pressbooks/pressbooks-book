<!DOCTYPE html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>
<?php if ( is_front_page() ) {
	$schema = 'itemscope itemtype="http://schema.org/Book" itemref="about alternativeHeadline author copyrightHolder copyrightYear datePublished description editor image inLanguage keywords publisher" ';
} else {
	$schema = 'itemscope itemtype="http://schema.org/WebPage" itemref="about copyrightHolder copyrightYear inLanguage publisher" ';
} ?>
<body <?php body_class();
if ( wp_title( '', false ) !== '' ) { print ' id="' . str_replace( ' ', '', strtolower( wp_title( '', false ) ) ) . '"'; } ?> <?php echo $schema; ?>>
<?php if ( pb_social_media_enabled() ) { ?>
	<!-- Facebook share JS SDK -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));</script>
<?php } ?>

	<section class="header <?php echo is_front_page() ? 'header--home' : '' ?>">
		<div class="header__inner">
			<div class="header__start-container">
				<?php if( ! is_front_page() ){?>
					<a class="header__home" href="<?php echo home_url( '/' ); ?>">Home</a>
<?php
				}?>
				<div class="header__search">
					<a class="icon icon-search"></a>
					<div class="header__search__form">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
			<h2 class="header__brand"><a class="header__logo" href="<?php echo network_home_url(); ?>"><span class="clip"><?php switch_to_blog( 1 );
			echo get_bloginfo( 'name', 'display' );
			restore_current_blog(); ?></span><?php // TODO ?></a></h2>
			<div class="header__end-container">
				<nav class="header__nav js-header-nav" id="navigation">
						<?php if ( ! is_user_logged_in() ) { ?>
							<a href="<?php echo wp_login_url( get_permalink() ) ?>"><?php _e( 'Sign in', 'pressbooks-book' ) ?></a>
						<?php } else { ?>
							<?php if ( is_super_admin() || is_user_member_of_blog() ) { ?>
							<a href="<?php echo admin_url(); ?>"><?php _e( 'Admin', 'pressbooks-book' ); ?></a>
							<span class="sep">/</span>
							<?php } ?>
							<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e( 'Sign out', 'pressbooks-book' ); ?></a>
						<?php } ?>
				</nav>
				<a class="header__menu-icon js-header-menu-toggle" href="#navigation"><?php _e( 'Toggle Menu', 'pressbooks-book' ); ?><span class="header__menu-icon__icon"></span></a>
			</div>
		</div>
	</section>
<?php
//book reading navigation bar
if ( ! is_front_page() ) { ?>

	<div class="reading-header">
		<nav class="reading-header__inner">
			<div class="reading-header__toc js-toc-toggle-con">
				<span class="reading-header__toc__title">Table of contents</span>
				<a class="icon icon-arrow-up-down js-toc-toggle"></a>
			</div>

			<h1 class="reading-header__title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<div class="reading-header__end-container">
				<?php if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) : ?>
				<!-- Buy -->
				<a class="button button--primary button--header" href="<?php echo get_option( 'home' ); ?>/buy"><?php _e( 'Buy', 'pressbooks-book' ); ?></a>
				<?php endif; ?>
			</div>
		</nav>
	</div>
<?php
global $blog_id;
$can_read = current_user_can_for_blog( $blog_id, 'read' );
$can_read_private = current_user_can_for_blog( $blog_id, 'read_private_posts' );
$book_structure = pb_get_book_structure();
$book_information = pb_get_book_information();
$permissive_private_content = (int) get_option( 'permissive_private_content', 0 );
$should_parse_subsections = pb_should_parse_subsections();?>
<section class="section-reading-toc js-toc">
<?php include(locate_template('content-toc.php')); ?>
</section>


	<div class="wrapper"> <!-- for sitting footer at the bottom of the page -->
		<div id="wrap">
			<div id="content">
<?php }
