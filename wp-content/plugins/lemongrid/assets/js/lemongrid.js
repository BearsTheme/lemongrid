! ( function( $ ) {
	'use strict';

	/**
	 * lemonGrid Obj
	 */
	var lemonGrid = {
		init: function() { console.log( lemongridObj );
			var self = this,
				lemongridElem = $( '.grid-stack' );

			if( lemongridElem.length <= 0 )
				return;

			lemongridElem.each( function( e ) {
				var lemonItem = $( this ),
					options = lemonItem.data( 'lemongrid-options' );

				/**
				 * Disables widgets moving/resizing.
				 */
				if( ! lemongridObj.gridBuilder ) {
					options.static_grid = true;
				}

				lemonItem.gridstack( options );
			} )
		}
	};

	/**
	 * DOM load complete
	 */
	$( function() {

		/**
		 * Use lemonGrid
		 */
		new lemonGrid.init();
	} )
} )( jQuery )