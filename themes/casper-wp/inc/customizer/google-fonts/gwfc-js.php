<?php
/*

* -----------------------------------------------------------------------------
* Initializes & sets up Google Web Fonts Customizer (dauid_google_fonts) Javascript 
* =============================================================================

*/
?>

<script type='text/javascript'>

<?php
$php_font_type_array = file_get_contents( get_template_directory() . '/inc/customizer/google-fonts/font-type-list.php' );
$js_font_type_array = json_encode($php_font_type_array);
echo "var javascript_array = ". $js_font_type_array . ";\n";
?>

jQuery(document).ready(function($) {

	var font_type_listSelect = $('#accordion-section-gwfc_customizer_section_fonts .customize-control-select');
	var font_type_listColor = $('#accordion-section-gwfc_customizer_section_fonts .customize-control-color');

	font_type_listSelect.css('display', 'none');
	font_type_listColor.css('display', 'none');

	//
	//	body
	//

	<?php
	foreach ($font_type_list as $key => $value) {
	?>

		var font_type_list<?php echo $key ?>CheckboxTrigger = $('#gwfc_<?php echo $key ?>_checkbox input[data-customize-setting-link=gwfc_<?php echo $key ?>_checkbox]');
	
		if(font_type_list<?php echo $key ?>CheckboxTrigger.is(':checked')){
	
			$('#gwfc_<?php echo $key ?>_font_family').css('display', 'block');
			$('#gwfc_<?php echo $key ?>_font_weight').css('display', 'block');
			$('#gwfc_<?php echo $key ?>_font_color').css('display', 'block');
	
		}
	
		font_type_list<?php echo $key ?>CheckboxTrigger.change(function() {
	
			if($(this).is(':checked')){
	
				$('#gwfc_<?php echo $key ?>_font_family').css('display', 'block');
				$('#gwfc_<?php echo $key ?>_font_weight').css('display', 'block');
				$('#gwfc_<?php echo $key ?>_font_color').css('display', 'block');
	
			}else{
	
				$('#gwfc_<?php echo $key ?>_font_family').css('display', 'none');
				$('#gwfc_<?php echo $key ?>_font_weight').css('display', 'none');
				$('#gwfc_<?php echo $key ?>_font_color').css('display', 'none');
	
				$('#gwfc_<?php echo $key ?>_font_family select[data-customize-setting-link=gwfc_<?php echo $key ?>_font_family]').val('default');
				$('#gwfc_<?php echo $key ?>_font_weight select[data-customize-setting-link=gwfc_<?php echo $key ?>_font_weight]').val('400');
				$('#gwfc_<?php echo $key ?>_font_color .wp-color-result').attr('style','');
	
			}
	
		}); 
		
	<?php
	}
	?>

</script>