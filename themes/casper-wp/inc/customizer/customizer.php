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
	
	// social_icons list
	require get_template_directory() . '/inc/customizer/social-icons/social-icons.php';
	
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
	
	// Header Panel
	$wp_customize->add_panel( 'dauid_header_panel' , array(
	    'title'       => __( 'Header Settings', 'dauid' ),
	    'priority'    => 10,
	    'description' => 'Options that apply to header of page.',
	) );
	
	// Logo Controls
	$wp_customize->add_section( 'dauid_logo_section' , array(
	    'title'       => __( 'Logo', 'dauid' ),
	    'priority'    => 30,
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
	// Custom Controls
	$wp_customize->add_section(
	    'dauid_custom',
	    array(
	        'title'     => 'Header Options',
	        'priority'  => 10
	    )
	);
	// Theme header bg color
	$wp_customize->add_setting( 'dauid_header_color' , array(
	    'default'     => '#303538',
	    'transport'   => 'postMessage'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'header_color',
	        array(
	            'label'      => __( 'Header Color', 'dauid' ),
	            'section'    => 'colors',
	            'settings'   => 'dauid_header_color'
	        )
	    )
	);
	// Home head text color
	$wp_customize->add_setting( 'dauid_header_textcolor' , array(
	    'default'     => '#50585D',
	    'transport'   => 'postMessage'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'dauid_header_textcolor',
	        array(
	            'label'      => __( 'Page Header Text Color', 'dauid' ),
	            'section'    => 'colors',
	            'settings'   => 'dauid_header_textcolor',
	        )
	    )
	);
	// Theme link color
	$wp_customize->add_setting( 'dauid_link_color' , array(
	    'default'     => '#4a4a4a',
	    'transport'   => 'refresh'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'link_color',
	        array(
	            'label'      => __( 'Link Color', 'dauid' ),
	            'section'    => 'colors',
	            'settings'   => 'dauid_link_color'
	        )
	    )
	);
	// Theme hover color
	$wp_customize->add_setting( 'dauid_hover_color' , array(
	    'default'     => '#57A3E8',
	    'transport'   => 'refresh'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'hover_color',
	        array(
	            'label'      => __( 'Hover Color', 'dauid' ),
	            'section'    => 'colors',
	            'settings'   => 'dauid_hover_color'
	        )
	    )
	);
	// Home Menu color
	$wp_customize->add_setting( 'dauid_home_menu_color' , array(
	    'default'     => '#ffffff',
	    'transport'   => 'refresh'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'home_menu_color',
	        array(
	            'label'      => __( 'Home Menu Color', 'dauid' ),
	            'section'    => 'colors',
	            'settings'   => 'dauid_home_menu_color'
	        )
	    )
	);
	// Menu color
	$wp_customize->add_setting( 'dauid_menu_color' , array(
	    'default'     => '#50585D',
	    'transport'   => 'refresh'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'menu_color',
	        array(
	            'label'      => __( 'Menu Color', 'dauid' ),
	            'section'    => 'colors',
	            'settings'   => 'dauid_menu_color'
	        )
	    )
	);

	// Display header bg on all pages (vs home only)
	$wp_customize->add_setting(
	    'dauid_display_header',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh'
	    )
	);
	$wp_customize->add_control(
	    'dauid_display_header',
	    array(
	    	'priority'	=> 1,
	        'section'   => 'dauid_custom',
	        'label'     => 'Only display header background on home page',
	        'type'      => 'checkbox'
	    )
	);
	// Display header on all pages (vs home only)
	$wp_customize->add_setting(
	    'dauid_display_header_all',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh'
	    )
	);
	$wp_customize->add_control(
	    'dauid_display_header_all',
	    array(
	    	'priority'	=> 2,
	        'section'   => 'dauid_custom',
	        'label'     => 'Only display header on home page',
	        'type'      => 'checkbox'
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
	// dauid hide page header dot
	$wp_customize->add_setting(
	    'dauid_hide_page_header_dot',
	    array(
	        'default'    =>  false,
	        'transport'  =>  'refresh'
	    )
	);
	$wp_customize->add_control(
	    'dauid_hide_page_header_dot',
	    array(
	    	'priority'	=> 5,
	        'section'   => 'dauid_custom',
	        'label'     => 'Hide header \'dot\' on pages',
	        'type'      => 'checkbox'
	    )
	);
	// Custom meta
	$wp_customize->add_setting( 'dauid_custom_meta' , array( 'sanitize_callback' => 'dauid_sanitize_meta' ));

	$wp_customize->add_control(
	    new dauid_textarea_control(
	        $wp_customize,
	        'dauid_custom_meta',
	        array(
	            'label' => 'Custom meta tags',
	            'section' => 'dauid_custom',
	            'settings' => 'dauid_custom_meta'
	        )
	    )
	);
	// Custom footer
	$wp_customize->add_setting( 'dauid_custom_footer' , array( 'sanitize_callback' => 'dauid_sanitize_footer' ));

	$wp_customize->add_control(
	    new dauid_textarea_control(
	        $wp_customize,
	        'dauid_custom_footer',
	        array(
	            'label' => 'Custom footer',
	            'section' => 'dauid_custom',
	            'settings' => 'dauid_custom_footer'
	        )
	    )
	);
	
}
add_action( 'customize_register', 'dauid_customize_register' );


function dauid_customizer_head() { ?>

   	<style type="text/css">
		<?php if(get_header_textcolor()){ ?>
			.blog-title a, .blog-description, .social-icons a { color: #<?php header_textcolor(); ?>; }
		<?php } ?>

		<?php if('blank' === get_header_textcolor()) { ?>
			.blog-description { display: none; }
		<?php } ?>
		<?php if(false != get_theme_mod( 'dauid_header_textcolor' ) && false != get_theme_mod( 'dauid_display_header' )){ ?>
        	body:not(.home) .blog-title a, body:not(.home) .blog-description, body:not(.home) .social-icons a {
        		color: <?php echo get_theme_mod( 'dauid_header_textcolor' ); ?>;
        	}
        <?php } ?>
		<?php if(get_theme_mod('dauid_header_color')){ ?>
		    .site-head { background-color: <?php echo get_theme_mod( 'dauid_header_color' ); ?>; }
		<?php } ?>
        <?php if(false != get_theme_mod( 'dauid_display_header' )) { ?>
        	body:not(.home) #masthead{ background: none; }
        <?php } ?>
        <?php if(false != get_theme_mod( 'dauid_display_header_all' )) { ?>
        	body:not(.home) .site-head:after { display: none; }
        	body:not(.home) #masthead{ height: auto; border: none; }
        	body:not(.home) .blog-title, body:not(.home) .blog-description { display: none; }
        	body:not(.home) .inner { padding-top: 1em; }
        	body:not(.home) .main-navigation { position: relative; }
        <?php } ?>

		<?php if( get_theme_mod( 'dauid_link_color' )) { ?>
			#content a { color: <?php echo get_theme_mod( 'dauid_link_color' ); ?>; }
		<?php } ?>

		<?php if(get_theme_mod( 'dauid_hover_color' )) { ?>
			#content a:hover { color: <?php echo get_theme_mod( 'dauid_hover_color' ); ?>; }
		<?php } ?>

        <?php if(get_theme_mod( 'dauid_menu_color' )){ ?>
        	.main-navigation a { color: <?php echo get_theme_mod( 'dauid_menu_color' ); ?>; }
        <?php } ?>
        <?php if(get_theme_mod( 'dauid_home_menu_color' )){ ?>
        	.home .main-navigation a { color: <?php echo get_theme_mod( 'dauid_home_menu_color' ); ?>; }
        	 <?php if(!get_theme_mod( 'dauid_display_header' )){ ?>
        	 	.main-navigation a { color: <?php echo get_theme_mod( 'dauid_home_menu_color' ); ?>; }
        	 <?php } ?>
        <?php } ?>
        <?php if( false != get_theme_mod( 'dauid_logo_circle' ) ) { ?>
			.blog-logo img {
				-webkit-border-radius: 50%;
			    -moz-border-radius: 50%;
			    border-radius: 50%;
			}
        <?php } ?>
        <?php if( false != get_theme_mod( 'dauid_logo_frame' ) ) { ?>
			.blog-logo img {
			    border: 3px solid white;
			    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			    box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			}
        <?php } ?>
        <?php if( false != get_theme_mod( 'dauid_hide_page_header_dot' ) ) { ?>
			.site-head:after {
			    display: none;
			}
        <?php } ?>
    </style>
    <?php
}
add_action( 'wp_head', 'dauid_customizer_head' );


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