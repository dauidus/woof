<?php
/**
 * woof Theme Customizer
 *
 * @package woof
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function woof_customize_register( $wp_customize ) {
	
	/**
	 * Adds textarea support to the theme customizer
	 */
	class woof_textarea_control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
	
	
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
					new WP_Customize_Image_Control( 
						$wp_customize, 'woof_logo', array(
						    'label'    => 'Logo',
						    'section'  => 'woof_logo_section',
						    'settings' => 'woof_logo',
						) 
					) 
				);
		
		// header options
		$wp_customize->add_section( 'woof_custom', array(
	        'title'     => 'Header Options',
	        'priority'  => 18
	    ) );
	    
			// Circle logo
			$wp_customize->add_setting( 'woof_logo_circle', array(
		        'default'    =>  false,
		        'transport'  =>  'postMessage'
		    ) );
				$wp_customize->add_control( 'woof_logo_circle', array(
			    	'priority'	=> 3,
			        'section'   => 'woof_custom',
			        'label'     => 'Make logo circular',
			        'type'      => 'checkbox'
				) );
			// Frame logo
			$wp_customize->add_setting( 'woof_logo_frame', array(
		        'default'    =>  false,
		        'transport'  =>  'postMessage'
		    ) );
				$wp_customize->add_control( 'woof_logo_frame', array(
			    	'priority'	=> 4,
			        'section'   => 'woof_custom',
			        'label'     => 'Frame logo image',
			        'type'      => 'checkbox'
			    ) );
			// Custom footer
			$wp_customize->add_setting( 'woof_custom_footer' , array( 
				'sanitize_callback' => 'woof_sanitize_footer' 
			));		
				$wp_customize->add_control(
				    new woof_textarea_control(
				        $wp_customize, 'woof_custom_footer', array(
				            'label' => 'Custom footer - plain text only',
				            'section' => 'woof_custom',
				            'settings' => 'woof_custom_footer'
				        )
				    )
				);
		
		
		
	// Colors Panel
	$wp_customize->add_panel( 'woof_colors_panel' , array(
	    'title'       => 'Colors',
	    'priority'    => 10,
	    'description' => 'Make a note of any settings we might add here.',
	) );
		// Colors header section
		$wp_customize->add_section( 'woof_colors_header_section', array(
		        'title'     => 'Header',
		        'priority'  => 1,
		        'panel'  => 'woof_colors_panel',
		    )
		);
		
			// header bg color
			$wp_customize->add_setting( 'woof_header_color' , array(
			    'default'     => '#303538',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_header_color', array(
				            'label'      => 'Header Background Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_header_color',
				            'priority'    => 1,
				        )
				    )
				);
			// header Menu color
			$wp_customize->add_setting( 'woof_menu_color' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_menu_color', array(
				            'label'      => 'Nav Menu Link Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_menu_color',
				            'priority'    => 2,
				        )
				    )
				);
			// header Menu hover color
			$wp_customize->add_setting( 'woof_menu_hover_color' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_menu_hover_color', array(
				            'label'      => 'Nav Menu Link Hover Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_menu_hover_color',
				            'priority'    => 3,
				        )
				    )
				);
			// header Menu active color
			$wp_customize->add_setting( 'woof_menu_active_color' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_menu_active_color', array(
				            'label'      => 'Nav Menu Link Active Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_menu_active_color',
				            'priority'    => 4,
				        )
				    )
				);
			// header text color
			$wp_customize->add_setting( 'woof_header_textcolor' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_header_textcolor', array(
				            'label'      => 'Blog Description Text Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_header_textcolor',
				            'priority'    => 8,
				        )
				    )
				);
			// social icon color
			$wp_customize->add_setting( 'woof_icon_color' , array(
			    'default'     => '#303538',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_icon_color', array(
				            'label'      => 'Social Icon Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_icon_color',
				            'priority'    => 10,
				        )
				    )
				);
			// social icon hover color
			$wp_customize->add_setting( 'woof_icon_hover_color' , array(
			    'default'     => '#303538',
			    'transport'   => 'postMessage'
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_icon_hover_color', array(
				            'label'      => 'Social Icon Hover Color',
				            'section'    => 'woof_colors_header_section',
				            'settings'   => 'woof_icon_hover_color',
				            'priority'   => 11,
				        )
				    )
				);
		
		
		// Colors body section
		$wp_customize->add_section( 'woof_colors_body_section', array(
		        'title'     => 'Body',
		        'priority'  => 2,
		        'panel'  => 'woof_colors_panel',
		    )
		);
			// Theme link color
			$wp_customize->add_setting( 'woof_link_norm_color' , array(
			    'default'     => '#dd3333',
			    'transport'   => 'postMessage',
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control(
				        $wp_customize, 'woof_link_norm_color', array(
				            'label'      => 'Link Color',
				            'section'    => 'woof_colors_body_section',
				            'settings'   => 'woof_link_norm_color',
				            'priority'   => 1,
				        )
				    )
				);
			// Theme link hover color
			$wp_customize->add_setting( 'woof_link_hover_color' , array(
			    'default'     => '#57A3E8',
			    'transport'   => 'refresh',
			) );
				$wp_customize->add_control(
				    new WP_Customize_Color_Control( 
				    	$wp_customize, 'woof_link_hover_color', array(
				            'label'      => 'Link Hover Color',
				            'section'    => 'woof_colors_body_section',
				            'settings'   => 'woof_link_hover_color',
				            'priority'   => 2,
				        )
				    )
				);
	
}
add_action( 'customize_register', 'woof_customize_register' );

function woof_customizer_head() { ?>

   	<style type="text/css">

		<?php if( get_theme_mod( 'woof_link_norm_color' )) { ?>
			.container a { color: <?php echo get_theme_mod( 'woof_link_norm_color' ); ?>; }
		<?php } ?>

		<?php if(get_theme_mod( 'woof_link_hover_color' )) { ?>
			.container a:hover { color: <?php echo get_theme_mod( 'woof_link_hover_color' ); ?>; }
		<?php } ?>
		
		
		
		<?php if(get_theme_mod('woof_header_color')){ ?>
		    header.site-header { background-color: <?php echo get_theme_mod( 'woof_header_color' ); ?>; }
		<?php } ?>
		<?php if(get_theme_mod( 'woof_menu_color' )){ ?>
        	nav.nav-menu a { color: <?php echo get_theme_mod( 'woof_menu_color' ); ?>; }
        <?php } ?>
        <?php if(get_theme_mod( 'woof_menu_hover_color' )){ ?>
        	nav.nav-menu a:hover { color: <?php echo get_theme_mod( 'woof_menu_hover_color' ); ?>; }
        <?php } ?>
        <?php if(get_theme_mod( 'woof_menu_active_color' )){ ?>
        	nav.nav-menu li.current-menu-item a { color: <?php echo get_theme_mod( 'woof_menu_active_color' ); ?>; }
        <?php } ?>
		<?php if(get_theme_mod( 'woof_header_textcolor' )){ ?>
        	.blog-description { color: <?php echo get_theme_mod( 'woof_header_textcolor' ); ?>;
        <?php } ?>
		
		

        <?php if( false != get_theme_mod( 'woof_logo_circle' ) ) { ?>
			.blog-logo {
				-webkit-border-radius: 50%;
			    -moz-border-radius: 50%;
			    border-radius: 50%;
			}
        <?php } ?>
        <?php if( false != get_theme_mod( 'woof_logo_frame' ) ) { ?>
			.blog-logo {
			    border: 3px solid white;
			    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			    box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			}
        <?php } ?>
       
    </style>
    <?php
}
add_action( 'wp_head', 'woof_customizer_head' );

// social icons
require_once get_template_directory() . '/includes/customizer/social-icons/social-icons.php';

// google fonts
require_once get_template_directory() . '/includes/customizer/google-fonts/gwfc.php';



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function woof_customize_preview_js() {
	wp_enqueue_script( 'woof_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'woof_customize_preview_js' );

/**
 * Sanitize URIs
 */
function woof_sanitize_uri($uri){
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);
}

/**
 * Sanitize email/uri
 */
function woof_sanitize_email($uri){
	if('' === $uri){
		return '';
	}
	if (substr( $uri, 0, 4 ) != 'http' && strpos($uri, '@') === false) {
		$uri = 'mailto:' . $uri;
	}
	return sanitize_email($uri);
}

/**
 * Sanitize meta
 */
function woof_sanitize_meta($content){
	$allowed = array('meta' => array());
	if('' === $content){
		return '';
	}
	return wp_kses($content, $allowed);
}

/**
 * Sanitize footer
 */
function woof_sanitize_footer($content){
	if('' === $content){
		return '';
	}
	return wp_kses($content, wp_kses_allowed_html('post'));
}