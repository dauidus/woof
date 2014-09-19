<?php

	/* ==========================================================================
    Social Icons
    ========================================================================== */

	$wp_customize->add_panel( 'dauid_social_panel', array(
	    'priority'       => 200,
	    'capability'     => 'edit_pages',
	    'theme_supports' => '',
	    'title'          => 'Social Icons',
	    'description'    => 'Still working on auto reloading the check marks when the text field returns false... need Jesch!',
	) );
	
	// social_icons list
	require get_template_directory() . '/inc/customizer/social-icons/social-icons-list.php';
	
	$social_icons_priority = 1;
	
	foreach ($social_icons as $key => $value) {
	
		if ( get_theme_mod( 'dauid_social_' . $key ) != "" ) {
			$alert_check = '&#10004; &nbsp; ';
		} else {
			$alert_check = '&nbsp; &nbsp; &nbsp; &nbsp;';
		}
		
		$wp_customize->add_section( 'dauid_social_' . $key, array(
		        'title'     => $alert_check . $value,
		        'priority'  => $social_icons_priority++,
		        'panel'  => 'dauid_social_panel',
		    )
		);
	
		$wp_customize->add_setting('dauid_social_' . $key, array('transport' => 'refresh', 'sanitize_callback' => 'dauid_sanitize_uri'));
		$wp_customize->add_control('dauid_social_' . $key, array('section' => 'dauid_social_' . $key, 'type' => 'text'));
	
	}

?>