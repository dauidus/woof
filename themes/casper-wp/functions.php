<?php
/**
 * dauid functions and definitions
 *
 * @package dauid
 */

if ( ! function_exists( 'dauid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
	add_theme_support('soil-clean-up');
	add_theme_support('soil-relative-urls');
	add_theme_support('soil-nice-search');
	add_theme_support('soil-disable-trackbacks');
 
function dauid_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on dauid, use a find and replace
	 * to change 'dauid' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'dauid', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dauid' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );


	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dauid_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	// Enable automatic theme updates
	add_filter( 'auto_update_theme', '__return_true' );
	
}
endif; // dauid_setup
add_action( 'after_setup_theme', 'dauid_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function dauid_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Bar', 'dauid' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'dauid_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dauid_scripts() {
	wp_enqueue_style('dauid-google-fonts', '//fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic|Open+Sans:700,400');
	wp_enqueue_style( 'dauid-style', get_stylesheet_uri() );
	wp_enqueue_script( 'dauid-index', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dauid_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions and inline styles.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/google-fonts/gwfc.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Editor Styles
 */
function dauid_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'init', 'dauid_add_editor_styles' );

/**
 * Customizer hook
 */




?>