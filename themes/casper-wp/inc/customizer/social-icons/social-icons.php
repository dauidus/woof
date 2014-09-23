<?php

function woof_customize_social_register( $wp_customize ) {

	/* ==========================================================================
    Social Icons
    ========================================================================== */

	$wp_customize->add_panel( 'woof_social_panel', array(
	    'priority'       => 18,
	    'capability'     => 'edit_pages',
	    'theme_supports' => '',
	    'title'          => 'Social Icons',
	    'description'    => 'Still working on auto reloading the check marks when the text field returns true or false... need Jesch!',
	) );
	
	// social_icons list
	require get_template_directory() . '/inc/customizer/social-icons/social-icons-list.php';
	

	
	$social_icons_priority = 2;
	
	foreach ($social_icons as $key => $value) {
	
		if ( get_theme_mod( 'woof_social_' . $key ) != "" ) {
			$alert_check = '&#10004; &nbsp; ';
		} else {
			$alert_check = '&nbsp; &nbsp; &nbsp; &nbsp;';
		}
		
		$wp_customize->add_section( 
			'woof_social_' . $key, 
			array(
		        'title'     => $alert_check . $value,
		        'priority'  => $social_icons_priority++,
		        'panel'  => 'woof_social_panel',
		    )
		);
	
			$wp_customize->add_setting(
				'woof_social_' . $key, 
				array(
					'transport' => 'postMessage', 
					'sanitize_callback' => 'woof_sanitize_uri'
				)
			);
			$wp_customize->add_control(
				'woof_social_' . $key, 
				array(
					'section' => 'woof_social_' . $key, 
					'type' => 'text'
				)
			);
	
	}
}
add_action( 'customize_register', 'woof_customize_social_register' );
	
function woof_customizer_social_head() { ?>

   	<style type="text/css">
        <?php if(get_theme_mod( 'woof_icon_color' )){ ?>
			.top-bar-section a.woof_social { color: <?php echo get_theme_mod( 'woof_icon_color' ); ?>; }
		<?php } ?>
		<?php if(get_theme_mod( 'woof_icon_hover_color' )){ ?>
			.top-bar-section a.woof_social:hover { color: <?php echo get_theme_mod( 'woof_icon_hover_color' ); ?>; }
		<?php } ?>
    </style>
    <?php
}
add_action( 'wp_head', 'woof_customizer_social_head' );

?>