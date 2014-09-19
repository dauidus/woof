<?php
/*
Plugin Name: Google Web Fonts Customizer (GWFC)
Version: 1.0.2
Description: This plugin integrates <strong>WordPress Customizer</strong> with <strong>Google Web Fonts</strong>, to add and use google web fonts to any themes, no coding needed. Already supported with <strong>font weight, style and color</strong>.
Author: Chanif Al-Fath
Author URI: http://www.chanif.com/
Plugin URI: http://www.chanif.com/project/google-web-fonts-customizer/
License: GPL
*/

/**

* GWFC.PHP
* -----------------------------------------------------------------------------
* Initializes & sets up the WordPress Live Preview with Google Web Fonts 
* Customizer (GWFC) feature, by setup sections, controls, and settings.
* =============================================================================

*/

/**

* TABLE OF CONTENTS
* -----------------------------------------------------------------------------
* 	01. Setup Menu
* 	02. Include Controls, Options Register, Output
* 	03. Include JS & CSS
* 	04. Enqueue Google Font CSS into head
* =============================================================================

*/	
// 	02. Include Controls, Options Register, Output
// =============================================================================

require_once( get_template_directory() . '/includes/customizer/google-fonts/controls.php' );
require_once( get_template_directory() . '/includes/customizer/google-fonts/register.php' );
require_once( get_template_directory() . '/includes/customizer/google-fonts/output.php' );


// 	03. Include JS & CSS
// =============================================================================

function gwfc_customizer_js() {

	?>

	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/includes/customizer/google-fonts/gwfc.js' ?>" ></script>
	
	<?php
}

add_action( 'customize_controls_print_footer_scripts', 'gwfc_customizer_js' );


// 	04. Enqueue Google Font CSS into head
// =============================================================================

function gwfc_head_css(){ 

	//
	// 	Tags data
	// 	1. Tags.
	//

	// font type list
	require get_template_directory() . '/includes/customizer/google-fonts/font-type-list.php';

	foreach ($font_type_list as $key => $value) {

		$font_family = get_theme_mod("gwfc_" . $key . "_font_family");
		$font_weight_style = get_theme_mod("gwfc_" . $key . "_font_weight");
		$font_weight = preg_replace("/[^0-9?! ]/","", $font_weight_style);
		$font_style = preg_replace("/[^A-Za-z?! ]/","", $font_weight_style);
		$font_color = get_theme_mod("gwfc_" . $key . "_font_color");

		if( $font_style == "" ){ $font_style = "normal"; }

		if( get_theme_mod( "gwfc_" . $key . "_checkbox" ) == true ){

		?>

		<link id='gwfc-<?php echo $key; ?>-font-family' href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", get_theme_mod("gwfc_" . $key . "_font_family") ) . ":" . $font_weight_style . ( $font_weight_style != '400' ? ',400' : '' ) ; ?>" rel='stylesheet' type='text/css'>

		<style id="<?php echo "gwfc-" . $key ."-style"; ?>">

		<?php echo $key; ?>{

			<?php if($font_family != 'default'){ ?>
			font-family: '<?php echo $font_family;?>', sans-serif !important;
			<?php } ?>			
			font-weight: <?php echo $font_weight;?> !important;
			font-style: <?php echo $font_style;?> !important;
			<?php if($font_color != false){ ?>
			color: <?php echo $font_color;?> !important;
			<?php } ?>
		}

		</style>

		<?php
		
		}

	}
	
}

add_action( 'wp_head', 'gwfc_head_css' );