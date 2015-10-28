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
	        	'heading' => __( 'User Name', TB_NAME ),
	        	'param_name' => 'username',
	        	'value' => '',
	        	'group' => __( 'Source Settings', TB_NAME ),
	        	'description' => __( 'Ex: muradosmann, laurenconrad, ... ', TB_NAME )
	        	),
	    	array(
	        	'type' => 'textfield',
	        	'heading' => __( 'API Key', TB_NAME ),
	        	'param_name' => 'api_key',
	        	'value' => '',
	        	'group' => __( 'Source Settings', TB_NAME ),
	        	'description' => __( 'Instagram: Client Id / Flickr: Key', TB_NAME )
	        	),
	        array(
	        	'type' => 'lg_grid_template',
	        	'heading' => __( 'Grid Template', TB_NAME ),
	        	'param_name' => 'grid_template',
	        	'value' => __( '', TB_NAME ),
	        	'group' => __( 'Grid', TB_NAME ),
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
				'social' 		=> 'instagram',
				'username'		=> '',
				'api_key'		=> '',
				'grid_template' => '',
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
		 * Setup social
		 */
		switch( $atts['social'] ) {
			case 'instagram':
				require_once TB_INCLUDES . 'socials/instagram.class.php';
				$insta = new LG_Instagram();
				$insta->username = $atts['username'];
				// $insta->client_id = '2a87113cbe65405aa10b491fc6e39242';
				$insta->client_id = $atts['api_key'];
				$media = $insta->getMedia();
				break;
			case 'flickr':
				require_once TB_INCLUDES . 'socials/flickr.class.php';
				$flickr = new LG_Flickr();
				$flickr->username = $atts['username'];
				// $flickr->key = 'f668d07759169ca3db29e9a60bff128d';
				$flickr->key = $atts['api_key'];
				$media = $flickr->getMedia();
				break;
		}
		
		$atts['media'] = ( isset( $media ) ) ? $media : array();
		$atts['elementID'] = 'lemongrid_id' . rand( 1, (int) date( 'ymdhis' ) );

		wp_enqueue_style('tb-lemongrid-custom-script', TB_CSS . 'lemongrid-custom-script.css' );
		wp_add_inline_style( 'tb-lemongrid-custom-script', renderGridCustomSpaceCss( $atts['elementID'], $atts['space'] ) );
		
		return lgLoadTemplate( $atts, $content );
	}
}
?>