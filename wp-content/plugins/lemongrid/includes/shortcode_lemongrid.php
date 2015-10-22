<?php
vc_map(
	array(
		"name" => __("Lemon Grid", TB_NAME),
	    "base" => "lemon_grid",
	    "class" => "vc-lemon-grid",
	    "params" => array(
	    	array(
	            "type" => "loop",
	            "heading" => __("Source",TB_NAME),
	            "param_name" => "source",
	            'settings' => array(
	                'size' => array('hidden' => false, 'value' => 10),
	                'order_by' => array('value' => 'date')
	            	),
	            "group" => __("Source Settings", TB_NAME),
	        	),
	    	)
		)
	);

class WPBakeryShortCode_lemon_grid extends WPBakeryShortCode
{
	protected function content( $atts, $content = null )
	{
		
		return 'LemonGrid';
	}
}
?>