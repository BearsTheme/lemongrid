<?php
vc_map(
	array(
		"name" => __( "Gallery LemonGrid", TB_NAME ),
	    "base" => "gallery_lemongrid",
	    "class" => "vc-gallery-lemongrid",
	    "category" => __("LemonGrid Shortcodes", TB_NAME),
	    "params" => array(
	    	array(
				'type' => 'el_id',
				'param_name' => 'element_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading' => __( 'Element ID', TB_NAME ),
				'description' => __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', TB_NAME ),
				'group' => __( 'Source Settings', TB_NAME ),
				),
	    	array(
				'type' => 'attach_images',
				'heading' => __( 'Images', TB_NAME ),
				'param_name' => 'images',
				'value' => '',
				'description' => __( 'Select images from media library.', TB_NAME ),
				'group' => __( 'Source Settings', TB_NAME ),
				),
	    	array(
	        	'type' => 'textfield',
	        	'heading' => __( 'Cell Height', TB_NAME ),
	        	'param_name' => 'cell_height',
	        	'value' => 120,
	        	'group' => __( 'Grid', TB_NAME ),
	        	),
	        array(
	        	'type' => 'textfield',
	        	'heading' => __( 'Space', TB_NAME ),
	        	'param_name' => 'space',
	        	'value' => 20,
	        	'group' => __( 'Grid', TB_NAME ),
	        	),
	    	array(
	            'type' => 'textfield',
	            'heading' => __( 'Extra Class',TB_NAME ),
	            'param_name' => 'class',
	            'value' => '',
	            'description' => __( '',TB_NAME ),
	            'group' => __( 'Template', TB_NAME )
	        ),
	    	array(
	            'type' => 'lg_template',
	            'heading' => __( 'Template', TB_NAME ),
	            'param_name' => 'template',
	            'shortcode' => 'gallery_lemongrid',
	            'group' => __( 'Template', TB_NAME ),
	        	),
	    	)
		)	
	);

class WPBakeryShortCode_gallery_lemongrid extends WPBakeryShortCode
{
	protected function content( $atts, $content = null )
	{
		$atts = shortcode_atts( array(
				'element_id'	=> '',
				'images' 		=> '',
				'cell_height'	=> 120,
				'space'			=> 20,
				'template'		=> '',
				'class' 		=> '',
			    ), $atts);

		/**
		 * Enqueue script
		 */
		LemonGrid::include_script();

		/**
		 * Lib JS Imagelightbox
		 */
		wp_enqueue_script( 'tb-imagelightbox', 'http://osvaldas.info/examples/image-lightbox-responsive-touch-friendly/imagelightbox.js', array( 'jquery' ), '1.0.0', true );

		$atts['class_id'] = 'lemon_grid_id_' . $atts['element_id'];
		
		wp_enqueue_style( 'tb-lemongrid-custom-script', TB_CSS . 'lemongrid-custom-script.css' );
		wp_add_inline_style( 'tb-lemongrid-custom-script', renderGridCustomSpaceCss( $atts['class_id'], $atts['space'] ) );

		return lgLoadTemplate( $atts, $content );
	}
}