!( function( $ ) {
	'use strict';

	/**
	 * lemonGrid Obj
	 */
	var lemonGrid = {
		init: function() {
			var self = this,
				lemongridElem = $( '.grid-stack' );

			if( lemongridElem.length <= 0 )
				return;

			lemongridElem.each( function( e ) {
				var lemonItem = $( this ),
					options = {
						cell_height		: 120,
        				vertical_margin	: 20,
        				animate			: true,
					};

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