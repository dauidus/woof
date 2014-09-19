<?php
/**
 * dauid Theme Customizer
 *
 * @package dauid
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dauid_customize_register( $wp_customize ) {
	
	/**
	 * Adds textarea support to the theme customizer
	 */
	class dauid_textarea_control extends WP_Customize_Control {
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
		$wp_customize->add_section( 'dauid_logo_section' , array(
		    'title'       => __( 'Logo', 'dauid' ),
		    'priority'    => 10,
		    'description' => 'Upload a logo to display above the site title on each page',
		) );
			$wp_customize->add_setting( 'dauid_logo'  , array(
			    'transport'   => 'refresh'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dauid_logo', array(
			    'label'    => __( 'Logo', 'dauid' ),
			    'section'  => 'dauid_logo_section',
			    'settings' => 'dauid_logo',
			) ) );
		
		// header options
		$wp_customize->add_section(
		    'dauid_custom',
		    array(
		        'title'     => 'Header Options',
		        'priority'  => 18
		    )
		);
			// Circle logo
			$wp_customize->add_setting(
			    'dauid_logo_circle',
			    array(
			        'default'    =>  false,
			        'transport'  =>  'postMessage'
			    )
			);
			$wp_customize->add_control(
			    'dauid_logo_circle',
			    array(
			    	'priority'	=> 3,
			        'section'   => 'dauid_custom',
			        'label'     => 'Make logo circular',
			        'type'      => 'checkbox'
			    )
			);
			// Frame logo
			$wp_customize->add_setting(
			    'dauid_logo_frame',
			    array(
			        'default'    =>  false,
			        'transport'  =>  'postMessage'
			    )
			);
			$wp_customize->add_control(
			    'dauid_logo_frame',
			    array(
			    	'priority'	=> 4,
			        'section'   => 'dauid_custom',
			        'label'     => 'Frame logo image',
			        'type'      => 'checkbox'
			    )
			);
			// Custom footer
			$wp_customize->add_setting( 'dauid_custom_footer' , array( 'sanitize_callback' => 'dauid_sanitize_footer' ));
		
			$wp_customize->add_control(
			    new dauid_textarea_control(
			        $wp_customize,
			        'dauid_custom_footer',
			        array(
			            'label' => 'Custom footer (plain text only)',
			            'section' => 'dauid_custom',
			            'settings' => 'dauid_custom_footer'
			        )
			    )
			);
		
		
		
	// Colors Panel
	$wp_customize->add_panel( 'dauid_colors_panel' , array(
	    'title'       => __( 'Colors', 'dauid' ),
	    'priority'    => 10,
	    'description' => 'Make a note of any settings we might add here.',
	) );
		// Colors header section
		$wp_customize->add_section( 'dauid_colors_header_section', array(
		        'title'     => 'Header',
		        'priority'  => 1,
		        'panel'  => 'dauid_colors_panel',
		    )
		);
		
			// header bg color
			$wp_customize->add_setting( 'dauid_header_color' , array(
			    'default'     => '#303538',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'header_color',
			        array(
			            'label'      => __( 'Header Background Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_header_color',
			            'priority'    => 1,
			        )
			    )
			);
			// header Menu color
			$wp_customize->add_setting( 'dauid_menu_color' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'menu_color',
			        array(
			            'label'      => __( 'Nav Menu Link Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_menu_color',
			            'priority'    => 2,
			        )
			    )
			);
			// header Menu hover color
			$wp_customize->add_setting( 'dauid_menu_hover_color' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'menu_hover_color',
			        array(
			            'label'      => __( 'Nav Menu Link Hover Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_menu_hover_color',
			            'priority'    => 3,
			        )
			    )
			);
			// header Menu active color
			$wp_customize->add_setting( 'dauid_menu_active_color' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'menu_active_color',
			        array(
			            'label'      => __( 'Nav Menu Link Active Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_menu_active_color',
			            'priority'    => 4,
			        )
			    )
			);
			// header text color
			$wp_customize->add_setting( 'dauid_header_textcolor' , array(
			    'default'     => '#50585D',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'header_textcolor',
			        array(
			            'label'      => __( 'Blog Description Text Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_header_textcolor',
			            'priority'    => 8,
			        )
			    )
			);
			// social icon color
			$wp_customize->add_setting( 'dauid_icon_color' , array(
			    'default'     => '#303538',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'dauid_icon_color',
			        array(
			            'label'      => __( 'Social Icon Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_icon_color',
			            'priority'    => 10,
			        )
			    )
			);
			// social icon hover color
			$wp_customize->add_setting( 'dauid_icon_hover_color' , array(
			    'default'     => '#303538',
			    'transport'   => 'refresh'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'dauid_icon_hover_color',
			        array(
			            'label'      => __( 'Social Icon Hover Color', 'dauid' ),
			            'section'    => 'dauid_colors_header_section',
			            'settings'   => 'dauid_icon_hover_color',
			            'priority'    => 11,
			        )
			    )
			);
		
		
		// Colors body section
		$wp_customize->add_section( 'dauid_colors_body_section', array(
		        'title'     => 'Body',
		        'priority'  => 2,
		        'panel'  => 'dauid_colors_panel',
		    )
		);
			// Theme link color
			$wp_customize->add_setting( 'dauid_link_color' , array(
			    'default'     => '#4a4a4a',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'dauid_link_color',
			        array(
			            'label'      => __( 'Link Color', 'dauid' ),
			            'section'    => 'dauid_colors_body_section',
			            'settings'   => 'dauid_link_color',
			            'priority'  => 1,
			        )
			    )
			);
			// Theme link hover color
			$wp_customize->add_setting( 'dauid_link_hover_color' , array(
			    'default'     => '#57A3E8',
			    'transport'   => 'postMessage'
			) );
			$wp_customize->add_control(
			    new WP_Customize_Color_Control(
			        $wp_customize,
			        'dauid_link_hover_color',
			        array(
			            'label'      => __( 'Link Hover Color', 'dauid' ),
			            'section'    => 'dauid_colors_body_section',
			            'settings'   => 'dauid_link_hover_color',
			            'priority'  => 2,
			        )
			    )
			);
	
}
add_action( 'customize_register', 'dauid_customize_register' );

function dauid_customizer_head() { ?>

   	<style type="text/css">

		<?php if( get_theme_mod( 'dauid_link_color' )) { ?>
			.white-section a { color: <?php echo get_theme_mod( 'dauid_link_color' ); ?>; }
		<?php } ?>

		<?php if(get_theme_mod( 'dauid_link_hover_color' )) { ?>
			.white-section a:hover { color: <?php echo get_theme_mod( 'dauid_link_hover_color' ); ?>; }
		<?php } ?>
		
		
		
		<?php if(get_theme_mod('dauid_header_color')){ ?>
		    header.site-header { background-color: <?php echo get_theme_mod( 'dauid_header_color' ); ?>; }
		<?php } ?>
		<?php if(get_theme_mod( 'dauid_menu_color' )){ ?>
        	nav.nav-menu a { color: <?php echo get_theme_mod( 'dauid_menu_color' ); ?>; }
        <?php } ?>
        <?php if(get_theme_mod( 'dauid_menu_hover_color' )){ ?>
        	nav.nav-menu a:hover { color: <?php echo get_theme_mod( 'dauid_menu_hover_color' ); ?>; }
        <?php } ?>
        <?php if(get_theme_mod( 'dauid_menu_active_color' )){ ?>
        	nav.nav-menu li.current-menu-item a { color: <?php echo get_theme_mod( 'dauid_menu_active_color' ); ?>; }
        <?php } ?>
		<?php if(get_theme_mod( 'dauid_header_textcolor' )){ ?>
        	.blog-description { color: <?php echo get_theme_mod( 'dauid_header_textcolor' ); ?>;
        <?php } ?>
		
		

        <?php if( false != get_theme_mod( 'dauid_logo_circle' ) ) { ?>
			.blog-logo {
				-webkit-border-radius: 50%;
			    -moz-border-radius: 50%;
			    border-radius: 50%;
			}
        <?php } ?>
        <?php if( false != get_theme_mod( 'dauid_logo_frame' ) ) { ?>
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
add_action( 'wp_head', 'dauid_customizer_head' );

// social icons
require_once get_template_directory() . '/includes/customizer/social-icons/social-icons.php';

// google fonts
require_once get_template_directory() . '/includes/customizer/google-fonts/gwfc.php';



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dauid_customize_preview_js() {
	wp_enqueue_script( 'dauid_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'dauid_customize_preview_js' );

/**
 * Sanitize URIs
 */
function dauid_sanitize_uri($uri){
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);
}

/**
 * Sanitize email/uri
 */
function dauid_sanitize_email($uri){
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
function dauid_sanitize_meta($content){
	$allowed = array('meta' => array());
	if('' === $content){
		return '';
	}
	return wp_kses($content, $allowed);
}

/**
 * Sanitize footer
 */
function dauid_sanitize_footer($content){
	if('' === $content){
		return '';
	}
	return wp_kses($content, wp_kses_allowed_html('post'));
}