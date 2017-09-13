<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]> <html <?php language_attributes(); ?> class="no-js"> <![endif]-->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="https://html5shim.googlecode.com/svn/trunk/html5.js">
	  </script>
	<![endif]-->
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
<?php }
if ( is_front_page() ) : ?>
	<section class="banner">
		<div class="container">
			<a class="toggle" href="#navigation"><?php _e( 'Toggle Menu', 'pressbooks-book' ); ?><span class="toggle__icon"></span></a>
			<a class="banner__brand" href="<?php echo network_home_url(); ?>"><span class="clip"><?php switch_to_blog( 1 );
			echo get_bloginfo( 'name', 'display' );
			restore_current_blog(); ?></span><?php // TODO ?></a>
			<nav class="banner__navigation" id="navigation">
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
		</div>
	</section>
<?php else : ?>
	<div class="nav-container">
		<nav>
			<!-- Book Title -->
			<h1 class="book-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="sub-nav-left">
				<!-- Logo -->
				<h2 class="pressbooks-logo"><a href="<?php echo esc_url( network_home_url() ); ?>"><?php echo get_site_option( 'site_name' ); ?></a></h2>
			</div> <!-- end .sub-nav-left -->
			<div class="sub-nav-right">
				<?php if ( array_filter( get_option( 'pressbooks_ecommerce_links', [] ) ) ) : ?>
				<!-- Buy -->
				<div class="buy">
					<a href="<?php echo get_option( 'home' ); ?>/buy" class="button-red"><?php _e( 'Buy', 'pressbooks-book' ); ?></a>
				</div>
				<?php endif; ?>
			</div> <!-- end .sub-nav-right -->
		</nav>
		<div class="sub-nav">
			<?php get_search_form(); ?>
			<!-- Author Name -->
			<div class="author-wrap">
				<?php $metadata = pb_get_book_information(); ?>
				<?php if ( ! empty( $metadata['pb_author'] ) ) : ?>
				<h3><?php echo $metadata['pb_author']; ?></h3>
				<?php endif; ?>
			</div> <!-- end .author-name -->
		</div><!-- end .sub-nav -->
	</div> <!-- end .nav-container -->

	<div class="wrapper"> <!-- for sitting footer at the bottom of the page -->
		<div id="wrap">
			<div id="content">
<?php endif;
