<?php
/*********************
Enqueue the proper CSS
if you use Sass.
*********************/
if( ! function_exists( 'woof_enqueue_style' ) ) {
	function woof_enqueue_style()
	{
		// foundation stylesheet
		wp_register_style( 'woof-foundation-stylesheet', get_stylesheet_directory_uri() . '/css/app.css', array(), '' );

		// Register the main style
		wp_register_style( 'woof-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), '', 'all' );
		
		wp_enqueue_style( 'woof-foundation-stylesheet' );
		wp_enqueue_style( 'woof-stylesheet' );
		
	}
}
add_action( 'wp_enqueue_scripts', 'woof_enqueue_style' );
?>
