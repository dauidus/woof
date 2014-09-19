<?php

function dauid_customize_social_register( $wp_customize ) {

	/* ==========================================================================
    Social Icons
    ========================================================================== */

	$wp_customize->add_panel( 'dauid_social_panel', array(
	    'priority'       => 18,
	    'capability'     => 'edit_pages',
	    'theme_supports' => '',
	    'title'          => 'Social Icons',
	    'description'    => 'Still working on auto reloading the check marks when the text field returns true or false... need Jesch!',
	) );
	
	// social_icons list
	require get_template_directory() . '/includes/customizer/social-icons/social-icons-list.php';
	

	
	$social_icons_priority = 2;
	
	foreach ($social_icons as $key => $value) {
	
		if ( get_theme_mod( 'dauid_social_' . $key ) != "" ) {
			$alert_check = '&#10004; &nbsp; ';
		} else {
			$alert_check = '&nbsp; &nbsp; &nbsp; &nbsp;';
		}
		
		$wp_customize->add_section( 
			'dauid_social_' . $key, 
			array(
		        'title'     => $alert_check . $value,
		        'priority'  => $social_icons_priority++,
		        'panel'  => 'dauid_social_panel',
		    )
		);
	
			$wp_customize->add_setting(
				'dauid_social_' . $key, 
				array(
					'transport' => 'postMessage', 
					'sanitize_callback' => 'dauid_sanitize_uri'
				)
			);
			$wp_customize->add_control(
				'dauid_social_' . $key, 
				array(
					'section' => 'dauid_social_' . $key, 
					'type' => 'text'
				)
			);
	
	}
}
add_action( 'customize_register', 'dauid_customize_social_register' );
	
function dauid_customizer_social_head() { ?>

   	<style type="text/css">
        <?php if(get_theme_mod( 'dauid_icon_color' )){ ?>
			header.site-header a.dauid_social { color: <?php echo get_theme_mod( 'dauid_icon_color' ); ?>; }
		<?php } ?>
		<?php if(get_theme_mod( 'dauid_icon_hover_color' )){ ?>
			header.site-header a.dauid_social:hover { color: <?php echo get_theme_mod( 'dauid_icon_hover_color' ); ?>; }
		<?php } ?>
    </style>
    <?php
}
add_action( 'wp_head', 'dauid_customizer_social_head' );

?>