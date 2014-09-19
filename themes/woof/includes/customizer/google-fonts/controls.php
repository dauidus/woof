<?php

// =============================================================================
// CONTROLS.PHP
// -----------------------------------------------------------------------------
// Sets up custom controls for the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Custom Controls
// =============================================================================

// Custom Controls
// =============================================================================

function gwfc_add_customizer_custom_controls( $wp_customize ) {

	//  Add Custom Subtitle
	//  =============================================================================

	class gwfc_sub_title extends WP_Customize_Control {
		public $type = 'sub-title';
		public function render_content() {
		?>
			<h4 class="gwfc-custom-sub-title"><?php echo esc_html( $this->label ); ?></h4>
		<?php
		}
	}

	//  Add Custom Description
	//  =============================================================================

	class gwfc_description extends WP_Customize_Control {
		public $type = 'description';
		public function render_content() {
		?>
			<p class="gwfc-custom-description"><?php echo esc_html( $this->label ); ?></p>
		<?php
		}
	}

}

add_action( 'customize_register', 'gwfc_add_customizer_custom_controls' );