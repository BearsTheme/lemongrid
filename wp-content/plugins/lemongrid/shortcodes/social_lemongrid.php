<?php
vc_map(
	array(
		'name' => __( 'Social LemonGrid', TB_NAME ),
	    'base' => 'social_lemongrid',
	    'class' => 'vc-social-lemongrid',
	    'category' => __('LemonGrid Shortcodes', TB_NAME),
	    'params' => array(
	    	array(
	            'type' => 'dropdown',
	            'heading' => __( 'Social', TB_NAME ),
	            'param_name' => 'social',
	            'std' => 'instagram',
	            'value' => array(
	            	'Instagram' => 'instagram',
	            	'Flickr' => 'flickr',
	            	),
	            'group' => __( 'Source Settings', TB_NAME )
	        	),
	    	array(
	            "type" => "lg_template",
	            "heading" => __( "Template", TB_NAME ),
	            "param_name" => "template",
	            "shortcode" => "social_lemongrid",
	            "group" => __( "Template", TB_NAME ),
	        	),
	    	)
		)
	);

class WPBakeryShortCode_social_lemongrid extends WPBakeryShortCode
{
	protected function content( $atts, $content = null )
	{
		$atts = shortcode_atts( array(
				'social' 	=> 'instagram',
				'template'	=> '',
				'class' 	=> '',
			    ), $atts);

		/**
		 * Setup social
		 */
		switch( $atts['social'] ) {
			case 'instagram':
				require_once TB_INCLUDES . 'socials/instagram.class.php';
				$insta = new LG_Instagram();
				$insta->username = 'conghieu20';
				$insta->client_id = '2a87113cbe65405aa10b491fc6e39242';
				$media = $insta->getMedia();
				break;
			case 'flickr':
				break;
		}

		$atts['media'] = ( isset( $media ) ) ? $media : array();
		
		return lgLoadTemplate( $atts, $content );
	}
}
?>