<?php
vc_map(
	array(
		"name" => __( "Post LemonGrid", TB_NAME ),
	    "base" => "post_lemongrid",
	    "class" => "vc-post-lemongrid",
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
	            "type" => "loop",
	            "heading" => __( "Source",TB_NAME ),
	            "param_name" => "source",
	            'settings' => array(
	                'size' => array( 'hidden' => false, 'value' => 10 ),
	                'order_by' => array( 'value' => 'date' )
	            	),
	            "group" => __( "Source Settings", TB_NAME ),
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
	            'shortcode' => 'post_lemongrid',
	            'group' => __( 'Template', TB_NAME ),
	        	),
	    	)
		)
	);

class WPBakeryShortCode_post_lemongrid extends WPBakeryShortCode
{
	protected function content( $atts, $content = null )
	{
		$atts = shortcode_atts( array(
				'element_id'	=> '',
				'source'		=> '',
				'cell_height'	=> 120,
				'space'			=> 20,
				'template'		=> '',
				'class' 		=> '',
			    ), $atts);
		
		/**
		 * Enqueue script
		 */
		LemonGrid::include_script();

		$atts['class_id'] = 'lemon_grid_id_' . $atts['element_id'];

		/**
		 * wp_query
		 */
		list( $args, $wp_query ) = vc_build_loop_query( $atts['source'] );
        $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	    if( $paged > 1 ){
	    	$args['paged'] = $paged;
	    	$wp_query = new WP_Query( $args );
	    }
	    $atts['posts'] = $wp_query;

		wp_enqueue_style('tb-lemongrid-custom-script', TB_CSS . 'lemongrid-custom-script.css' );
		wp_add_inline_style( 'tb-lemongrid-custom-script', renderGridCustomSpaceCss( $atts['class_id'], $atts['space'] ) );
		
		return lgLoadTemplate( $atts, $content );
	}
}