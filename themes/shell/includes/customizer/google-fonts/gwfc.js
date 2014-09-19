/**

* GWFC.JS
* -----------------------------------------------------------------------------
* Initializes & sets up Google Web Fonts Customizer (GWFC) Javascript 
* =============================================================================

*/

jQuery(document).ready(function($) {

	var gwfcSubtitle = $('#accordion-section-gwfc_customizer_section_fonts .customize-control-sub-title');
	var gwfcSelect = $('#accordion-section-gwfc_customizer_section_fonts .customize-control-select');
	var gwfcColor = $('#accordion-section-gwfc_customizer_section_fonts .customize-control-color');

	gwfcSubtitle.css('display', 'none');
	gwfcSelect.css('display', 'none');
	gwfcColor.css('display', 'none');

	//
	//	body
	//

	var gwfcBodyCheckboxTrigger = $('#customize-control-gwfc_body_checkbox input[data-customize-setting-link=gwfc_body_checkbox]');

	if(gwfcBodyCheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_body_sub_title').css('display', 'block');
		$('#customize-control-gwfc_body_font_family').css('display', 'block');
		$('#customize-control-gwfc_body_font_weight').css('display', 'block');
		$('#customize-control-gwfc_body_font_color').css('display', 'block');

	}

	gwfcBodyCheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_body_sub_title').css('display', 'block');
			$('#customize-control-gwfc_body_font_family').css('display', 'block');
			$('#customize-control-gwfc_body_font_weight').css('display', 'block');
			$('#customize-control-gwfc_body_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_body_sub_title').css('display', 'none');
			$('#customize-control-gwfc_body_font_family').css('display', 'none');
			$('#customize-control-gwfc_body_font_weight').css('display', 'none');
			$('#customize-control-gwfc_body_font_color').css('display', 'none');

			$('#customize-control-gwfc_body_font_family select[data-customize-setting-link=gwfc_body_font_family]').val('default');
			$('#customize-control-gwfc_body_font_weight select[data-customize-setting-link=gwfc_body_font_weight]').val('400');
			$('#customize-control-gwfc_body_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	h1
	//

	var gwfcH1CheckboxTrigger = $('#customize-control-gwfc_h1_checkbox input[data-customize-setting-link=gwfc_h1_checkbox]');

	if(gwfcH1CheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_h1_sub_title').css('display', 'block');
		$('#customize-control-gwfc_h1_font_family').css('display', 'block');
		$('#customize-control-gwfc_h1_font_weight').css('display', 'block');
		$('#customize-control-gwfc_h1_font_color').css('display', 'block');

	}

	gwfcH1CheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_h1_sub_title').css('display', 'block');
			$('#customize-control-gwfc_h1_font_family').css('display', 'block');
			$('#customize-control-gwfc_h1_font_weight').css('display', 'block');
			$('#customize-control-gwfc_h1_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_h1_sub_title').css('display', 'none');
			$('#customize-control-gwfc_h1_font_family').css('display', 'none');
			$('#customize-control-gwfc_h1_font_weight').css('display', 'none');
			$('#customize-control-gwfc_h1_font_color').css('display', 'none');

			$('#customize-control-gwfc_h1_font_family select[data-customize-setting-link=gwfc_h1_font_family]').val('default');
			$('#customize-control-gwfc_h1_font_weight select[data-customize-setting-link=gwfc_h1_font_weight]').val('400');
			$('#customize-control-gwfc_h1_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	h2
	//

	var gwfcH2CheckboxTrigger = $('#customize-control-gwfc_h2_checkbox input[data-customize-setting-link=gwfc_h2_checkbox]');

	if(gwfcH2CheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_h2_sub_title').css('display', 'block');
		$('#customize-control-gwfc_h2_font_family').css('display', 'block');
		$('#customize-control-gwfc_h2_font_weight').css('display', 'block');
		$('#customize-control-gwfc_h2_font_color').css('display', 'block');

	}

	gwfcH2CheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_h2_sub_title').css('display', 'block');
			$('#customize-control-gwfc_h2_font_family').css('display', 'block');
			$('#customize-control-gwfc_h2_font_weight').css('display', 'block');
			$('#customize-control-gwfc_h2_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_h2_sub_title').css('display', 'none');
			$('#customize-control-gwfc_h2_font_family').css('display', 'none');
			$('#customize-control-gwfc_h2_font_weight').css('display', 'none');
			$('#customize-control-gwfc_h2_font_color').css('display', 'none');

			$('#customize-control-gwfc_h2_font_family select[data-customize-setting-link=gwfc_h2_font_family]').val('default');
			$('#customize-control-gwfc_h2_font_weight select[data-customize-setting-link=gwfc_h2_font_weight]').val('400');
			$('#customize-control-gwfc_h2_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	h3
	//

	var gwfcH3CheckboxTrigger = $('#customize-control-gwfc_h3_checkbox input[data-customize-setting-link=gwfc_h3_checkbox]');

	if(gwfcH3CheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_h3_sub_title').css('display', 'block');
		$('#customize-control-gwfc_h3_font_family').css('display', 'block');
		$('#customize-control-gwfc_h3_font_weight').css('display', 'block');
		$('#customize-control-gwfc_h3_font_color').css('display', 'block');

	}

	gwfcH3CheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_h3_sub_title').css('display', 'block');
			$('#customize-control-gwfc_h3_font_family').css('display', 'block');
			$('#customize-control-gwfc_h3_font_weight').css('display', 'block');
			$('#customize-control-gwfc_h3_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_h3_sub_title').css('display', 'none');
			$('#customize-control-gwfc_h3_font_family').css('display', 'none');
			$('#customize-control-gwfc_h3_font_weight').css('display', 'none');
			$('#customize-control-gwfc_h3_font_color').css('display', 'none');

			$('#customize-control-gwfc_h3_font_family select[data-customize-setting-link=gwfc_h3_font_family]').val('default');
			$('#customize-control-gwfc_h3_font_weight select[data-customize-setting-link=gwfc_h3_font_weight]').val('400');
			$('#customize-control-gwfc_h3_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	h4
	//

	var gwfcH4CheckboxTrigger = $('#customize-control-gwfc_h4_checkbox input[data-customize-setting-link=gwfc_h4_checkbox]');

	if(gwfcH4CheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_h4_sub_title').css('display', 'block');
		$('#customize-control-gwfc_h4_font_family').css('display', 'block');
		$('#customize-control-gwfc_h4_font_weight').css('display', 'block');
		$('#customize-control-gwfc_h4_font_color').css('display', 'block');

	}

	gwfcH4CheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_h4_sub_title').css('display', 'block');
			$('#customize-control-gwfc_h4_font_family').css('display', 'block');
			$('#customize-control-gwfc_h4_font_weight').css('display', 'block');
			$('#customize-control-gwfc_h4_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_h4_sub_title').css('display', 'none');
			$('#customize-control-gwfc_h4_font_family').css('display', 'none');
			$('#customize-control-gwfc_h4_font_weight').css('display', 'none');
			$('#customize-control-gwfc_h4_font_color').css('display', 'none');

			$('#customize-control-gwfc_h4_font_family select[data-customize-setting-link=gwfc_h4_font_family]').val('default');
			$('#customize-control-gwfc_h4_font_weight select[data-customize-setting-link=gwfc_h4_font_weight]').val('400');
			$('#customize-control-gwfc_h4_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	h5
	//

	var gwfcH5CheckboxTrigger = $('#customize-control-gwfc_h5_checkbox input[data-customize-setting-link=gwfc_h5_checkbox]');

	if(gwfcH5CheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_h5_sub_title').css('display', 'block');
		$('#customize-control-gwfc_h5_font_family').css('display', 'block');
		$('#customize-control-gwfc_h5_font_weight').css('display', 'block');
		$('#customize-control-gwfc_h5_font_color').css('display', 'block');

	}

	gwfcH5CheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_h5_sub_title').css('display', 'block');
			$('#customize-control-gwfc_h5_font_family').css('display', 'block');
			$('#customize-control-gwfc_h5_font_weight').css('display', 'block');
			$('#customize-control-gwfc_h5_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_h5_sub_title').css('display', 'none');
			$('#customize-control-gwfc_h5_font_family').css('display', 'none');
			$('#customize-control-gwfc_h5_font_weight').css('display', 'none');
			$('#customize-control-gwfc_h5_font_color').css('display', 'none');

			$('#customize-control-gwfc_h5_font_family select[data-customize-setting-link=gwfc_h5_font_family]').val('default');
			$('#customize-control-gwfc_h5_font_weight select[data-customize-setting-link=gwfc_h5_font_weight]').val('400');
			$('#customize-control-gwfc_h5_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	h6
	//

	var gwfcH6CheckboxTrigger = $('#customize-control-gwfc_h6_checkbox input[data-customize-setting-link=gwfc_h6_checkbox]');

	if(gwfcH6CheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_h6_sub_title').css('display', 'block');
		$('#customize-control-gwfc_h6_font_family').css('display', 'block');
		$('#customize-control-gwfc_h6_font_weight').css('display', 'block');
		$('#customize-control-gwfc_h6_font_color').css('display', 'block');

	}

	gwfcH6CheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_h6_sub_title').css('display', 'block');
			$('#customize-control-gwfc_h6_font_family').css('display', 'block');
			$('#customize-control-gwfc_h6_font_weight').css('display', 'block');
			$('#customize-control-gwfc_h6_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_h6_sub_title').css('display', 'none');
			$('#customize-control-gwfc_h6_font_family').css('display', 'none');
			$('#customize-control-gwfc_h6_font_weight').css('display', 'none');
			$('#customize-control-gwfc_h6_font_color').css('display', 'none');

			$('#customize-control-gwfc_h6_font_family select[data-customize-setting-link=gwfc_h6_font_family]').val('default');
			$('#customize-control-gwfc_h6_font_weight select[data-customize-setting-link=gwfc_h6_font_weight]').val('400');
			$('#customize-control-gwfc_h6_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	blockquote
	//

	var gwfcBlockquoteCheckboxTrigger = $('#customize-control-gwfc_blockquote_checkbox input[data-customize-setting-link=gwfc_blockquote_checkbox]');

	if(gwfcBlockquoteCheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_blockquote_sub_title').css('display', 'block');
		$('#customize-control-gwfc_blockquote_font_family').css('display', 'block');
		$('#customize-control-gwfc_blockquote_font_weight').css('display', 'block');
		$('#customize-control-gwfc_blockquote_font_color').css('display', 'block');

	}

	gwfcBlockquoteCheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_blockquote_sub_title').css('display', 'block');
			$('#customize-control-gwfc_blockquote_font_family').css('display', 'block');
			$('#customize-control-gwfc_blockquote_font_weight').css('display', 'block');
			$('#customize-control-gwfc_blockquote_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_blockquote_sub_title').css('display', 'none');
			$('#customize-control-gwfc_blockquote_font_family').css('display', 'none');
			$('#customize-control-gwfc_blockquote_font_weight').css('display', 'none');
			$('#customize-control-gwfc_blockquote_font_color').css('display', 'none');

			$('#customize-control-gwfc_blockquote_font_family select[data-customize-setting-link=gwfc_blockquote_font_family]').val('default');
			$('#customize-control-gwfc_blockquote_font_weight select[data-customize-setting-link=gwfc_blockquote_font_weight]').val('400');
			$('#customize-control-gwfc_blockquote_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	p
	//

	var gwfcPCheckboxTrigger = $('#customize-control-gwfc_p_checkbox input[data-customize-setting-link=gwfc_p_checkbox]');

	if(gwfcPCheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_p_sub_title').css('display', 'block');
		$('#customize-control-gwfc_p_font_family').css('display', 'block');
		$('#customize-control-gwfc_p_font_weight').css('display', 'block');
		$('#customize-control-gwfc_p_font_color').css('display', 'block');

	}

	gwfcPCheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_p_sub_title').css('display', 'block');
			$('#customize-control-gwfc_p_font_family').css('display', 'block');
			$('#customize-control-gwfc_p_font_weight').css('display', 'block');
			$('#customize-control-gwfc_p_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_p_sub_title').css('display', 'none');
			$('#customize-control-gwfc_p_font_family').css('display', 'none');
			$('#customize-control-gwfc_p_font_weight').css('display', 'none');
			$('#customize-control-gwfc_p_font_color').css('display', 'none');

			$('#customize-control-gwfc_p_font_family select[data-customize-setting-link=gwfc_p_font_family]').val('default');
			$('#customize-control-gwfc_p_font_weight select[data-customize-setting-link=gwfc_p_font_weight]').val('400');
			$('#customize-control-gwfc_p_font_color .wp-color-result').attr('style','');

		}

	}); 

	//
	//	li
	//

	var gwfcListCheckboxTrigger = $('#customize-control-gwfc_li_checkbox input[data-customize-setting-link=gwfc_li_checkbox]');

	if(gwfcListCheckboxTrigger.is(':checked')){

		$('#customize-control-gwfc_li_sub_title').css('display', 'block');
		$('#customize-control-gwfc_li_font_family').css('display', 'block');
		$('#customize-control-gwfc_li_font_weight').css('display', 'block');
		$('#customize-control-gwfc_li_font_color').css('display', 'block');

	}

	gwfcListCheckboxTrigger.change(function() {

		if($(this).is(':checked')){

			$('#customize-control-gwfc_li_sub_title').css('display', 'block');
			$('#customize-control-gwfc_li_font_family').css('display', 'block');
			$('#customize-control-gwfc_li_font_weight').css('display', 'block');
			$('#customize-control-gwfc_li_font_color').css('display', 'block');

		}else{

			$('#customize-control-gwfc_li_sub_title').css('display', 'none');
			$('#customize-control-gwfc_li_font_family').css('display', 'none');
			$('#customize-control-gwfc_li_font_weight').css('display', 'none');
			$('#customize-control-gwfc_li_font_color').css('display', 'none');

			$('#customize-control-gwfc_l1_font_family select[data-customize-setting-link=gwfc_l1_font_family]').val('default');
			$('#customize-control-gwfc_li_font_weight select[data-customize-setting-link=gwfc_li_font_weight]').val('400');
			$('#customize-control-gwfc_li_font_color .wp-color-result').attr('style','');

		}

	}); 


});