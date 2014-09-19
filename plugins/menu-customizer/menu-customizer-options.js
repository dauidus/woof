/*
 * Menu Customizer screen options JS.
 */

// Global ajaxurl, 
(function($) {
	var customizeMenuOptions = {
		init : function() {
			// Add a screen options button to the Menus page header.
			var button = '<a id="customizer-menu-screen-options-button" title="Menu Options" href="#"></a>',
				header = $( '#accordion-section-menus .accordion-sub-container ' );
			header.find( '.accordion-section:first .accordion-section-title' ).append( button );
			$( '#screen-options-wrap' ).prependTo( header );
			$( '#customize-control-menu_customizer_options' ).remove();
			$( '#screen-options-wrap' ).removeClass( 'hidden' );
			$( '#customizer-menu-screen-options-button' ).click( function() {
				$( '#customizer-menu-screen-options-button' ).toggleClass( 'active' );
				$( '#screen-options-wrap' ).toggleClass( 'active' );
				return false;
			} );
		}
	}

	// Show/hide/save screen options (columns). From common.js.
	var columns = {
		init : function() {
			var that = this;
			$('.hide-column-tog').click( function() {
				var $t = $(this), column = $t.val();
				if ( $t.prop('checked') ) {
					that.checked(column);
				}
				else {
					that.unchecked(column);
				}

				that.saveManageColumnsState();
			});
			$( '.hide-column-tog' ).each( function() {
			var $t = $(this), column = $t.val();
				if ( $t.prop('checked') ) {
					that.checked(column);
				}
				else {
					that.unchecked(column);
				}
			} );
		},

		saveManageColumnsState : function() {
			var hidden = this.hidden();
			$.post(ajaxurl, {
				action: 'hidden-columns',
				hidden: hidden,
				screenoptionnonce: $('#screenoptionnonce').val(),
				page: 'nav-menus'
			});
		},

		checked : function(column) {
			$('.field-' + column).show();
		},

		unchecked : function(column) {
			$('.field-' + column).hide();
		},

		hidden : function() {
			this.hidden = function(){
				return $('.hide-column-tog').not(':checked').map(function() {
					var id = this.id;
					return id.substring( id, id.length - 5 );
				}).get().join(',');
			};
		},
	};

	$( document ).ready( function() {
		columns.init();
		customizeMenuOptions.init();
	} );

})(jQuery);