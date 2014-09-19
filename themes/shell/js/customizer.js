/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Circle logo
	wp.customize( 'dauid_logo_circle', function( value ) {
        value.bind( function( to ) {
        	if (false == to){
	            $( '.blog-logo img' ).css( {'-webkit-border-radius' : '0',
	        								'-moz-border-radius' : '0',
	        								'border-radius' : '0'
	        	} );
        	} else {
	            $( '.blog-logo img' ).css( {'-webkit-border-radius' : '50%',
	        								'-moz-border-radius' : '50%',
	        								'border-radius' : '50%'
	        	} );
	        }
        } );
    });
    // Logo frame
	wp.customize( 'dauid_logo_frame', function( value ) {
        value.bind( function( to ) {
        	if (false == to){
	            $( '.blog-logo img' ).css( {'border' : 'none',
											'-webkit-box-shadow' : 'none',
											'-moz-box-shadow' : 'none',
											'box-shadow' : 'none'
	        	} );
        	} else {
	            $( '.blog-logo img' ).css( {'border' : '3px solid white',
	    									'-webkit-box-shadow' : '0 1px 1px rgba(0,0,0,0.3)',
	   										'-moz-box-shadow' : '0 1px 1px rgba(0,0,0,0.3)',
	   										'box-shadow' : '0 1px 1px rgba(0,0,0,0.3);} )'
	        	} );
	        }
	    });
    });
    // Footer info
	wp.customize( 'dauid_custom_footer', function( value ) {
        value.bind( function( to ) {
        	if (false == to){
	            $( '.copyright').html('<a href="http://dauid.us" rel="home">dauidus framework</a> by Dave Winter');
        	} else {
	            $( '.copyright').html(to);
	        }
        } );
    });

	
	
	
	
	// Header Color
	wp.customize( 'dauid_header_color', function( value ) {
        value.bind( function( to ) {
            $( 'header.site-header' ).css( 'background-color', to );
        } );
    });
    // Menu color
	wp.customize( 'dauid_menu_color', function( value ) {
        value.bind( function( to ) {
            $( 'nav.nav-menu a' ).css( 'color', to );
        } );
    });
    // Menu hover color
	wp.customize( 'dauid_menu_hover_color', function( value ) {
        value.bind( function( to ) {
            $( 'nav.nav-menu a:hover' ).css( 'color', to );
        } );
    });
    // Menu active color
	wp.customize( 'dauid_menu_active_color', function( value ) {
        value.bind( function( to ) {
            $( 'nav.nav-menu li.current-menu-item a' ).css( 'color', to );
        } );
    });
    // Header text color
	wp.customize( 'dauid_header_textcolor', function( value ) {
		value.bind( function( to ) {
            $( '.blog-description' ).css( 'color', to );
        } );
	});
	// social icons color
	wp.customize( 'dauid_icon_color', function( value ) {
        value.bind( function( to ) {
            $( 'header.site-header a.dauid_social' ).css( 'color', to );
        } );
    });
    // social icons hover color
	wp.customize( 'dauid_icon_hover_color', function( value ) {
        value.bind( function( to ) {
            $( 'header.site-header a.dauid_social:hover' ).css( 'color', to );
        } );
    });
    
	
	
	
	
	// Link color
	wp.customize( 'dauid_link_color', function( value ) {
        value.bind( function( to ) {
            $( '.white-section a' ).css( 'color', to );
        } );
    });
	// Link Hover color
	wp.customize( 'dauid_link_hover_color', function( value ) {
        value.bind( function( to ) {
            $( '.white-section a:hover' ).css( 'color', to );
        } );
    });
	
	
	
	
	
	// blog title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.blog-title a' ).text( to );
		} );
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.blog-description' ).text( to );
		} );
	});	
	
} )( jQuery );
