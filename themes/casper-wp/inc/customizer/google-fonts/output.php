<?php
 
// =============================================================================
// OUTPUT.PHP
// -----------------------------------------------------------------------------
// Sets up output to be showed in the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
// 	01. Enqueue Javascript (JS)
// =============================================================================

// Enqueue Javascript (JS)
// =============================================================================

function gwfc_customizer_live_preview() {

	wp_enqueue_script( 
		'gwfc-customizer-js',
		get_template_directory_uri() . '/inc/customizer/google-fonts/gwfc-live.js',
		array( 'jquery','customize-preview' ),
		'',	
		true
	);
	
}

add_action( 'customize_preview_init', 'gwfc_customizer_live_preview' );