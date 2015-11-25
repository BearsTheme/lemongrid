/**
 * Lemongrid Backend Script
 * Author: BEARS Themes
 * Author Url: http://themebears.com
 */

 ! ( function( $ ) {

 	var lgBackend = {
 		widget: function() {
 			$( 'body' ).on( 'change', '[data-widget-switch-group]', function() {
 				var groupName = $( this ).val(),
 					content = $( this ).parents( '.widget-content' );

 				content.find( '.lg-group-field' ).each( function() {
 					var group = $( this ).data( 'group' );
 					
 					if( groupName == group )
 						$( this ).fadeIn( 'slow' )
 					else
 						$( this ).fadeOut( 0 )

 				} )

 			} )
 		}
 	}

 	/* DOM ready */
 	$( function() {

 		/* Use widget api */
 		lgBackend.widget();
 	} )
 } )( jQuery )