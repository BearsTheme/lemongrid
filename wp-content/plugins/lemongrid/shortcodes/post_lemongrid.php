<?php
vc_map(
	array(
		"name" => __( "Post LemonGrid", TB_NAME ),
	    "base" => "post_lemongrid",
	    "class" => "vc-post-lemongrid",
	    "category" => __("LemonGrid Shortcodes", TB_NAME),
	    "params" => array(
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
	    	)
		)
	);

class WPBakeryShortCode_post_lemongrid extends WPBakeryShortCode
{
	protected function content( $atts, $content = null )
	{
		
		return 'Post LemonGrid';
	}
}
?>