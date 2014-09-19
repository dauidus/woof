/**

* GWFC-LIVE.JS
* -----------------------------------------------------------------------------
* Initializes & sets up Google Web Fonts Customizer (GWFC) Live Preview JS 
* =============================================================================

*/

( function( $ ) {

	var list_font_weights = ['100', '100italic', '200', '200italic', '300', '300italic', '400', '400italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'];
	
	//
	//	body
	//

	/* checkbox */

	wp.customize( "gwfc_body_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-body-font-family").remove();
				$("head").find("#gwfc-body-style").remove();
				$("body").css("font-family", "");
				$("body").css("font-weight", "");
				$("body").css("font-style", "");
				$("body").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_body_font_family", function(value){
		
		value.bind(function(newval){

			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-body-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-body-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-body-font-family").remove();
				$("head").find("#gwfc-body-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("body").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-body-font-family").remove();
				$("head").find("#gwfc-body-style").remove();
				$("body").css("font-family", "");
				$("body").css("font-weight", "");
				$("body").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_body_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("body").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("body").css("font-style", fontStyle, "important");	

			}else{

				$("body").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_body_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("body").css("color", "");

			}else{

				$("body").css("color", fontColor, "important");

			}

		});

	});

	//
	//	h1
	//

	/* checkbox */

	wp.customize( "gwfc_h1_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-h1-font-family").remove();
				$("head").find("#gwfc-h1-style").remove();
				$("h1").css("font-family", "");
				$("h1").css("font-weight", "");
				$("h1").css("font-style", "");
				$("h1").css("font-style", "");
				$("h1").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_h1_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-h1-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-h1-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-h1-font-family").remove();
				$("head").find("#gwfc-h1-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("h1").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-h1-font-family").remove();
				$("head").find("#gwfc-h1-style").remove();
				$("h1").css("font-family", "");
				$("h1").css("font-weight", "");
				$("h1").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_h1_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("h1").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("h1").css("font-style", fontStyle, "important");	

			}else{

				$("h1").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_h1_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("h1").css("color", "");

			}else{

				$("h1").css("color", fontColor, "important");

			}

		});

	});

	//
	//	h2
	//

	/* checkbox */

	wp.customize( "gwfc_h2_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-h2-font-family").remove();
				$("head").find("#gwfc-h2-style").remove();
				$("h2").css("font-family", "");
				$("h2").css("font-weight", "");
				$("h2").css("font-style", "");
				$("h2").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_h2_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-h2-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-h2-font-family").length;
			
			if (checkLink > 0) {

				$("h2").find("#gwfc-h2-font-family").remove();
				$("h2").find("#gwfc-h2-style").remove();
				$("h2").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("h2").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-h2-font-family").remove();
				$("head").find("#gwfc-h2-style").remove();
				$("h2").css("font-family", "");
				$("h2").css("font-weight", "");
				$("h2").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_h2_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("h2").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("h2").css("font-style", fontStyle, "important");	

			}else{

				$("h2").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_h2_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("h2").css("color", "");

			}else{

				$("h2").css("color", fontColor, "important");

			}

		});

	});

	//
	//	h3
	//

	/* checkbox */

	wp.customize( "gwfc_h3_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-h3-font-family").remove();
				$("head").find("#gwfc-h3-style").remove();
				$("h3").css("font-family", "");
				$("h3").css("font-weight", "");
				$("h3").css("font-style", "");
				$("h3").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_h3_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-h3-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-h3-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-h3-font-family").remove();
				$("head").find("#gwfc-h3-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("h3").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-h3-font-family").remove();
				$("head").find("#gwfc-h3-style").remove();
				$("h3").css("font-family", "");
				$("h3").css("font-weight", "");
				$("h3").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_h3_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("h3").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("h3").css("font-style", fontStyle, "important");	

			}else{

				$("h3").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_h3_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("h3").css("color", "");

			}else{

				$("h3").css("color", fontColor, "important");

			}

		});

	});

	//
	//	h4
	//

	/* checkbox */

	wp.customize( "gwfc_h4_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-h4-font-family").remove();
				$("head").find("#gwfc-h4-style").remove();
				$("h4").css("font-family", "");
				$("h4").css("font-weight", "");
				$("h4").css("font-style", "");
				$("h4").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_h4_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-h4-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-h4-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-h4-font-family").remove();
				$("head").find("#gwfc-h4-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("h4").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-h4-font-family").remove();
				$("head").find("#gwfc-h4-style").remove();
				$("h4").css("font-family", "");
				$("h4").css("font-weight", "");
				$("h4").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_h4_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("h4").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("h4").css("font-style", fontStyle, "important");	

			}else{

				$("h4").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_h4_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("h4").css("color", "");

			}else{

				$("h4").css("color", fontColor, "important");

			}

		});

	});

	//
	//	h5
	//

	/* checkbox */

	wp.customize( "gwfc_h5_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-h5-font-family").remove();
				$("head").find("#gwfc-h5-style").remove();
				$("h5").css("font-family", "");
				$("h5").css("font-weight", "");
				$("h5").css("font-style", "");
				$("h5").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_h5_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-h5-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-h5-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-h5-font-family").remove();
				$("head").find("#gwfc-h5-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("h5").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-h5-font-family").remove();
				$("head").find("#gwfc-h5-style").remove();
				$("h5").css("font-family", "");
				$("h5").css("font-weight", "");
				$("h5").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_h5_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("h5").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("h5").css("font-style", fontStyle, "important");	

			}else{

				$("h5").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_h5_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("h5").css("color", "");

			}else{

				$("h5").css("color", fontColor, "important");

			}

		});

	});

	//
	//	h6
	//

	/* checkbox */

	wp.customize( "gwfc_h6_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-h6-font-family").remove();
				$("head").find("#gwfc-h6-style").remove();
				$("h6").css("font-family", "");
				$("h6").css("font-weight", "");
				$("h6").css("font-style", "");
				$("h6").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_h6_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-h6-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-h6-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-h6-font-family").remove();
				$("head").find("#gwfc-h6-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("h6").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-h6-font-family").remove();
				$("head").find("#gwfc-h6-style").remove();
				$("h6").css("font-family", "");
				$("h6").css("font-weight", "");
				$("h6").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_h6_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("h6").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("h6").css("font-style", fontStyle, "important");	

			}else{

				$("h6").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_h6_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("h6").css("color", "");

			}else{

				$("h6").css("color", fontColor, "important");

			}

		});

	});

	//
	//	blockquote
	//

	/* checkbox */

	wp.customize( "gwfc_blockquote_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-blockquote-font-family").remove();
				$("head").find("#gwfc-blockquote-style").remove();
				$("blockquote").css("font-family", "");
				$("blockquote").css("font-weight", "");
				$("blockquote").css("font-style", "");
				$("blockquote").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_blockquote_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-blockquote-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-blockquote-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-blockquote-font-family").remove();
				$("head").find("#gwfc-blockquote-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("blockquote").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-blockquote-font-family").remove();
				$("head").find("#gwfc-blockquote-style").remove();
				$("blockquote").css("font-family", "");
				$("blockquote").css("font-weight", "");
				$("blockquote").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_blockquote_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("blockquote").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("blockquote").css("font-style", fontStyle, "important");	

			}else{

				$("blockquote").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_blockquote_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("blockquote").css("color", "");

			}else{

				$("blockquote").css("color", fontColor, "important");

			}

		});

	});

	//
	//	p
	//

	/* checkbox */

	wp.customize( "gwfc_p_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-p-font-family").remove();
				$("head").find("#gwfc-p-style").remove();
				$("p").css("font-family", "");
				$("p").css("font-weight", "");
				$("p").css("font-style", "");
				$("p").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_p_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-p-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-p-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-p-font-family").remove();
				$("head").find("#gwfc-p-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("p").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-p-font-family").remove();
				$("head").find("#gwfc-p-style").remove();
				$("p").css("font-family", "");
				$("p").css("font-weight", "");
				$("p").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_p_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("p").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("p").css("font-style", fontStyle, "important");	

			}else{

				$("p").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_p_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("p").css("color", "");

			}else{

				$("p").css("color", fontColor, "important");

			}

		});

	});

	//
	//	li
	//

	/* checkbox */

	wp.customize( "gwfc_li_checkbox", function(value){

		value.bind(function(newval){
			
			if(newval == false){
				
				$("head").find("#gwfc-li-font-family").remove();
				$("head").find("#gwfc-li-style").remove();
				$("li").css("font-family", "");
				$("li").css("font-weight", "");
				$("li").css("font-style", "");
				$("li").css("color", "");

			}

		});


	});	

	/* font family */

	wp.customize( "gwfc_li_font_family", function(value){
		
		value.bind(function(newval){
							
			var fontFamily = newval;
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":"+list_font_weights.join(); +"";
			var googleFontSource = "<link id='gwfc-li-font-family' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#gwfc-li-font-family").length;
			
			if (checkLink > 0) {

				$("head").find("#gwfc-li-font-family").remove();
				$("head").find("#gwfc-li-style").remove();
				$("head").append(googleFontSource);
			
			} else {
			
				$("head").append(googleFontSource);
			
			}	

			$("li").css("font-family", "'"+fontFamily+"', sans-serif", "important");

			if(fontFamily == 'default'){
				
				$("head").find("#gwfc-l1-font-family").remove();
				$("head").find("#gwfc-l1-style").remove();
				$("l1").css("font-family", "");
				$("l1").css("font-weight", "");
				$("l1").css("font-style", "");

			}

		});

	});	

	/* font weight & style */

	wp.customize( "gwfc_li_font_weight", function(value){
		
		value.bind(function(newval){

			var fontWeight = newval.replace(/\D/g,'');
			var fontStyle = newval.replace(/[0-9]/g, '');

			$("li").css("font-weight", fontWeight, "important");
			
			if ( fontStyle != "" ){

				$("li").css("font-style", fontStyle, "important");	

			}else{

				$("li").css("font-style", "normal");	

			}				

		});

	});

	/* font color */

	wp.customize( "gwfc_li_font_color", function(value){
		
		value.bind(function(newval){

			var fontColor = newval;

			if( fontColor == false ){

				$("li").css("color", "");

			}else{

				$("li").css("color", fontColor, "important");

			}

		});

	});

	
} )( jQuery );