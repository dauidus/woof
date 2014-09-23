<?php
/**
 * Plugin Name: Add a Media Library tab to the WP_Customize_Image_Control
 * Plugin URI: http://www.wpquestions.com/question/showChronoLoggedIn/id/9288
 * Version: 0.4
 */

// Based on 
// a) http://shibashake.com/wordpress-theme/how-to-add-the-media-manager-menu-to-the-theme-preview-interface
// b) https://gist.github.com/eduardozulian/4739075

/**
 * Add an extended controller to the customizer
 */
function wpq_theme_customizer( $wp_customize ) {    

	/* Extend the Image Control */
	class My_Customize_Image_Media_Library_Control extends WP_Customize_Image_Control
	{
		public function __construct( $manager, $id, $args = array() )
		{
			parent::__construct( $manager, $id, $args );
			$this->remove_tab('uploaded');
			$this->add_tab( 'medialibrary',   __('Media Library'),   array( $this, 'tab_medialibrary' ) );
		}
	
		public function tab_medialibrary()
		{
		?>	
			<div class="medialibrary-target"></div>
							
			<a class="choose-from-library-link button" data-controller = "<?php echo $this->id;?>">
				<?php _e( 'Open Library' ); ?>
			</a>     
		<?php	
		}
	}
    
	// Logo Controls
	$wp_customize->add_section( 'woof_logo_section' , array(
	    'title'       => 'Logo',
	    'priority'    => 10,
	    'description' => 'Upload a logo to display above the site title on each page',
	) );
	
		$wp_customize->add_setting( 'woof_logo' , array(
		    'transport'   => 'refresh'
		) );
			$wp_customize->add_control( 
				new My_Customize_Image_Media_Library_Control( 
					$wp_customize, 'woof_logo', array(
					    'label'    => 'Logo',
					    'section'  => 'woof_logo_section',
					    'settings' => 'woof_logo',
					    //'context'  => 'my-custom-logo'
					) 
				) 
			);
	
}

add_action( 'customize_register', 'wpq_theme_customizer', 99 );


/**
 * Add javascript to the customizer
 * See http://pastebin.com/aTyNnfk7 for wpq.js
 */
function wpq_add_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script('wpq-media-manager', get_template_directory_uri().'/includes/customizer/extras/customizer-image-library/js/wpq.js', array( 'jquery' ), '1.0', true);
}

add_action( 'customize_controls_print_styles', 'wpq_add_scripts', 50 );


/**
 * Add CSS to the customizer
 */
function wpq_customize_styles()
{ 
?>
    <style>
    .wp-full-overlay {
        z-index: 150000 !important;
    }
    </style>
<?php }

add_action( 'customize_controls_print_styles', 'wpq_customize_styles', 50 );