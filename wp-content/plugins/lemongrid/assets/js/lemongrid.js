! ( function( $ ) {
	'use strict';

	/**
	 * Confirm
	 */
	$.lgConfirm = function( opts, callback ) {
		var content = $( '<div>', {
			class: 'lg-modal-wrap',
			html: '<div class=\'lg-modal-inner\'><p class=\'lg-modal-title\'>'+ opts.title +'</p><div class=\'lg-modal-body\'>'+ opts.content +'</div><button class=\'lg-modal-ok\'>'+ opts.btnText +'</button></div>',
		} );

		/**
		 * Confirm success
		 */
		content.find( '.lg-modal-ok' ).on( 'click', function() {
			callback.call( this, content );
			content.remove();
		} )

		/**
		 * Close Confirm
		 */
		$( content ).on( 'click', function( e ) {
			if( $( e.target ).hasClass( 'lg-modal-wrap' ) )
				content.remove();
		} )

		$( 'body' ).append( content );
	}
	
	/**
	 * General func
	 */
	function getLemonGridSize( elem ) {
		var result = [];

		/**
		 * Check elem exist
		 */
		if( elem.length <= 0 )
			return;

		elem.each( function( e ) {
	        var node = $( this ).data('_gridstack_node');
	        result.push( {
	        	x: node.x,
	            y: node.y,
	            w: node.width,
	            h: node.height
	        } )
		} )

		return result;
	}

	function lgApplyLemonGrid( data ) {
		console.log( data );
	}

	/**
	 * lemonGrid
	 */

	function lemonGrid( elem, opts ) {
		this.lemonGridItems = $( elem );
		this._init();
	}

	lemonGrid.prototype._opts = function() {

	}


	lemonGrid.prototype._toolbarHandle = function( item ) {
		var toolbarElem = item.find( '.lemongrid-toolbar' );

		/**
		 * Check toolbar exist
		 */
		if( toolbarElem.length <= 0 ) return;

		var self = this,
			saveLayoutElem = toolbarElem.find( '.lg-toolbar-icon--save-layout' );

		/**
		 * applyHandle
		 */
		$( saveLayoutElem, 'body' ).on( 'click', function( e ) {
			e.preventDefault();
			var lemonGridMap = getLemonGridSize( item.find( '.grid-stack > .grid-stack-item:visible' ) );

			$.lgConfirm( { 
				title: 'Save grid layout', 
				content: '<input type=\'text\' id=\'lg-grid-name\' placeholder=\'layout name\'>', 
				btnText: 'Add' }, 
				function( content ) {
					var grid_name = content.find( '#lg-grid-name' ).val();
					self._request( 'lgApplyLemonGrid', { name: grid_name, gridMap: lemonGridMap }, lgApplyLemonGrid );
				} )
		} );
	}

	lemonGrid.prototype._request = function( task, data, callback ) {
		/**
		 * Set action
		 */
		data.action = task;

		/**
		 * Ajax handle
		 */
		$.ajax( {
			type: 'POST',
			url: lemongridObj.ajaxurl,
			data: data,
			success: function( result ) {
				callback.call( this, result );
			}
		} )
	}

	lemonGrid.prototype._init = function() {
		/**
		 * Check lemonGridItems exist
		 */
		if( this.lemonGridItems.length <= 0 ) return;

		var self = this;
		this.lemonGridItems.each( function() {
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

			self._toolbarHandle( lemonItem );
		} )
	}

	/**
	 * DOM load complete
	 */
	$( function() {

		/**
		 * Use lemonGrid
		 */
		new lemonGrid( '.lemongrid--element', {

		} );
	} )
} )( jQuery )