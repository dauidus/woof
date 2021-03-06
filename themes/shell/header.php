<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#">

<head>

	<meta charset="<?php bloginfo( 'charset' ); // lets you change the charset from within wp, defaults to UTF8 ?>" />

	<!--Forces latest IE rendering engine & chrome frame-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!-- title & meta handled by the yoast plugin, don't add your own here just activate the plugin -->

	<title><?php wp_title(''); ?></title>

	<!-- favicon & other link Tags -->
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<!--link rel="apple-touch-icon" href="/images/custom_icon.png"/--><!-- 114x114 icon for iphones and ipads -->
	<link rel="copyright" href="#copyright" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--ADD GOOGLE FONTS HERE-->

	<!-- CSS -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css?v1.00" media="screen" />

	<!-- BEGIN: IE Specific Hacks -->
	<!--[if IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/ie9.css" media="screen" /><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/ie8.css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/ie7.css" media="screen" /><![endif]-->
	<!--END: IE Specific Hacks-->

	<!--REMOVE this viewport code if you are making a site that is NOT responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
 	<!--REMOVE this viewport code if you are making a site that is NOT responsive-->

	<?php wp_head(); // wp_head hook for Plugins ~ always keep this just before the /head tag ?>

</head>

<body <?php body_class(); // we add to the body classes with a function in functions.php ?>>

<!--[if lt IE 8]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

	<!--SITE HEADER ~ for SEO ~ hidden with CSS-->
	<header class="site-header" role="banner">
		
		<?php if ( get_theme_mod( 'woof_logo' ) ) : ?>
            <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'>
            	<img src='<?php echo esc_url( get_theme_mod( 'woof_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
            </a>
        <?php endif; ?>
		
        <?php    	
    	// social_icons list
		require get_template_directory() . '/includes/customizer/social-icons/social-icons-list.php';
		
		foreach ($social_icons as $key => $value) {
				
			if ( false != get_theme_mod( 'woof_social_' . $key)) { ?>
                <a class="woof_social icon icon-<?php echo $key ?>" href="<?php echo esc_url( get_theme_mod( 'woof_social_' . $key) ); ?>" title="<?php echo $value ?>" target="_blank">
                    <span class="hidden"><?php _e( $value, 'woof' ); ?></span>
                </a>
			<?php 
			}
			
		} ?>
		
			<!--MAIN NAV: Activate the menu system by going into wpadmin / appearance / menus / and adding a menu named mainNav-->
	<!--To make the menu vertical instead of horizontal remove the menu_class of horiz-list-->
		<nav class="nav-menu" role="navigation">
			<!--<h1 class="access-hide">Main Navigation</h1>-->
			<?php wp_nav_menu(array('menu' => 'mainNav', 'menu_class' => 'horiz-list')); // create the mainNav menu inside Appearance menus and go to town -- for more on menus see: http://templatic.com/news/wordpress-3-0-menu-management ?>
		</nav>
		
		<h1 class="blog-title"><a href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="blog-description"><?php bloginfo( 'description' ); ?></h2>
		
	</header>
