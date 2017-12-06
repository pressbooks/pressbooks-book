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
<svg  style="position: absolute; width: 0; height: 0;" width="0" height="0" xmlns="http://www.w3.org/2000/svg"><defs>
		<symbol id="icon-pressbooks"  fill="currentColor" viewBox="0 0 45 44"><path d="M44.195 41.872c0 .745-.618 1.346-1.377 1.346H1.377C.617 43.219 0 42.617 0 41.872V1.347C0 .604.618 0 1.377 0h41.44c.76 0 1.378.604 1.378 1.347v40.525zM15.282 10.643h-5.21v21.43h3.304V24h1.906c1.435 0 2.656-.5 3.665-1.504 1.008-1.004 1.513-2.213 1.513-3.626v-3.113c0-1.47-.444-2.678-1.33-3.625-.956-.993-2.24-1.489-3.848-1.489zm1.977 5.165h-.001v3.131c0 .513-.184.952-.55 1.318a1.826 1.826 0 0 1-1.338.547h-1.994v-6.86h1.995c.571 0 1.029.171 1.372.513.344.342.516.792.516 1.35zm5.84 16.265h6.118c.828 0 1.662-.25 2.502-.752a4.642 4.642 0 0 0 1.73-1.779c.526-.945.788-2.097.788-3.455 0-.545-.04-1.043-.122-1.486-.163-.868-.414-1.575-.751-2.122-.513-.81-1.137-1.352-1.871-1.625a3.325 3.325 0 0 0 1.154-.839c.78-.866 1.173-2.018 1.173-3.455 0-.876-.105-1.635-.315-2.274-.386-1.198-1.027-2.08-1.925-2.652-1.049-.672-2.225-1.008-3.531-1.008h-4.95v21.447zm3.568-12.69v-5.475h1.382c.652 0 1.184.212 1.592.634.443.456.665 1.13.665 2.018 0 .537-.065.987-.193 1.352-.35.982-1.039 1.471-2.064 1.471h-1.382zm0 9.493v-6.397h1.382c.815 0 1.433.25 1.853.751.466.549.7 1.42.7 2.617 0 .502-.075.948-.227 1.335-.432 1.13-1.208 1.694-2.326 1.694h-1.382z" /></symbol>
	</defs></svg>


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

	<section class="header <?php echo is_front_page() ? 'header--home' : 'header--reading' ?>">
		<div class="header__inner">
			<div class="header__start-container">
				<?php if ( ! is_front_page() ) {?>
					<a class="header__home" href="<?php echo home_url( '/' ); ?>">Home</a>
<?php
}?>
				<div class="header__search js-search">
					<a class="icon icon-search js-toggle-search"></a>
					<div class="header__search__form">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
			<h2 class="header__brand"><a class="header__logo" href="<?php echo network_home_url(); ?>"><svg class="icon--svg">
						<use xlink:href="#icon-pressbooks" />
					</svg><span class="clip"><?php switch_to_blog( 1 );
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
				<a class="js-toc-toggle" href="javascript:void()">
					<span class="reading-header__toc__title">Table of contents</span>
					<span class="icon icon-arrow-up-down" ></span>
				</a>
				<?php
				global $blog_id;
				$can_read = current_user_can_for_blog( $blog_id, 'read' );
				$can_read_private = current_user_can_for_blog( $blog_id, 'read_private_posts' );
				$book_structure = pb_get_book_structure();
				$book_information = pb_get_book_information();
				$permissive_private_content = (int) get_option( 'permissive_private_content', 0 );
				$should_parse_subsections = pb_should_parse_subsections();?>
				<section class="section-reading-toc js-toc">
					<?php include( locate_template( 'content-toc.php' ) ); ?>
				</section>
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



	<div class="wrapper"> <!-- for sitting footer at the bottom of the page -->
		<div id="wrap">
			<div id="content">
<?php }
