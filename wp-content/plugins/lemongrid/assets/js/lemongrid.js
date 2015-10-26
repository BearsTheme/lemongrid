! ( function( $ ) {
	'use strict';

	/**
	 * lemonGrid Obj
	 */
	var lemonGrid = {
		init: function() {
			var self = this,
				lemongridElem = $( '.lemongrid--element' );
			console.log( self );
			if( lemongridElem.length <= 0 )
				return;

			lemongridElem.each( function( e ) {
				var lemonItem = $( this ),
					gridStack = lemonItem.find( '.grid-stack' ),
					options = gridStack.data( 'lemongrid-options' );

				/**
				 * Disables widgets moving/resizing.
				 */
				if( ! lemongridObj.gridBuilder ) {
					options.static_grid = true;
				}

				gridStack.gridstack( options );

				/**
				 * Toolbar handle
				 */
				new self.toolBarHandle( lemonItem );
			} )
		},
		toolBarHandle: function( lemonElem ) {
			var toolbarElem = lemonElem.find( '.lemongrid-toolbar' );

			/**
			 * Check toolbar exist
			 */
			if( toolbarElem.length <= 0 ) return;

			var applyElem = toolbarElem.find( '.lg-toolbar-icon--apply' ),
				applyFaveriteElem = toolbarElem.find( '.lg-toolbar-icon--apply-faverite' );

			$( 'body', applyElem ).on( 'click', this.applyHandle );

			$( 'body', applyFaveriteElem ).on( 'click', this.applyFaveriteHandle )
		},
		applyHandle: function( e ) {
			alert( 1 );
		},
		applyFaveriteHandle: function( e ) {
			alert( 2 );
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