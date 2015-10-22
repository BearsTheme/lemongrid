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
	            'shortcode' => 'social_lemongrid',
	            'group' => __( 'Template', TB_NAME ),
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
				require_once TB_INCLUDES . 'socials/flickr.class.php';
				$flickr = new LG_Flickr();
				$flickr->username = 'mysunday20';
				$flickr->key = 'f668d07759169ca3db29e9a60bff128d';
				$media = $flickr->getMedia();
				break;
		}
		
		$atts['media'] = ( isset( $media ) ) ? $media : array();
		
		return lgLoadTemplate( $atts, $content );
	}
}
?>