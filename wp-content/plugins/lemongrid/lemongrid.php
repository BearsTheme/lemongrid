<?php
/**
*
* Plugin Name: Lemon Grid
* Plugin URI: http://themebears.com
* Description: This plugin is addon visual composer, which is developed by THEMEBEARS Team for Visual Comporser plugin.
* Version: 1.0.0
* Author: BEATS Theme
* Author URI: http://themebears.com
* Copyright 2015 themebears.com. All rights reserved.
*/

define( 'TB_NAME', 'bearstheme' );
define( 'TB_DIR', plugin_dir_path(__FILE__) );
define( 'TB_URL', plugin_dir_url(__FILE__) );
define( 'TB_INCLUDES', TB_DIR . "includes" . DIRECTORY_SEPARATOR );
define( 'TB_SHORTCODES', TB_DIR . "shortcodes" . DIRECTORY_SEPARATOR );

define( 'TB_CSS', TB_URL . "assets/css/" );
define( 'TB_JS', TB_URL . "assets/js/" );
define( 'TB_IMAGES', TB_URL . "assets/images/" );

/**
 * Require functions on plugin
 */
require_once TB_INCLUDES . 'functions.php';

/**
 * Use LemonGrid class
 */
new LemonGrid;

/**
 * LemonGrid Class
 * 
 */
class LemonGrid
{
	/**
	 * Init function, which is run on site init and plugin loaded
	 */
	public function __construct()
	{
		/**
		 * Enqueue Scripts on plugin
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_script' ) );

		/**
		 * Visual Composer action
		 */
		add_action( 'vc_before_init', array( $this, 'shortcode' ) );
	}

	/**
	 * Shortcode register
	 */
	function shortcode() 
	{
		require TB_INCLUDES . 'shortcode.php';
	}

	/**
	 * Register script on plugin
	 */
	function register_script()
	{	

		/**
		 * Lib JS Lodash
		 */
		wp_register_script( 'lodash', TB_JS . 'lodash.min.js' );

		/**
		 * Lib JS Gridstack
		 */
		wp_register_script( 'gridstack', TB_JS . 'gridstack.js', array( 'jquery', 'lodash' ) );
		wp_register_style( 'gridstack', TB_CSS . 'gridstack.css', array(), '1.0' );

		/**
		 * Lib JS Dynamics
		 */
		wp_register_script( 'dynamics', TB_JS . 'dynamics.min.js', array() );

		/**
		 * Lib ICON 
		 */
		wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '1.0' );
		wp_register_style( 'ionicon', TB_CSS . 'ionicons.min.css', array(), '1.0' );

		/**
		 * Script LemonGrid
		 */
		wp_register_script( 'tb-lemongrid-script', TB_JS . 'lemongrid.js', array( 'jquery', 'gridstack' ) );
		wp_register_style( 'tb-lemongrid-script', TB_CSS . 'lemongrid.css', array(), '1.0' );
	}

	/**
	 * include_script
	 */
	public static function include_script() 
	{
		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-resizable' );
		
		wp_enqueue_script( 'lodash' );

		wp_enqueue_style( 'gridstack' );
		wp_enqueue_script( 'gridstack' );
		
		wp_enqueue_script( 'dynamics' );

		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'ionicon' );
		
		wp_enqueue_style( 'tb-lemongrid-script' );
		wp_enqueue_script( 'tb-lemongrid-script' );

		/**
		 * Variable
		 */
		$lemongridArr = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			);

		/**
		 * Check admin login
		 * On handle grid builder when login with account admin
		 */
		if( is_super_admin() )
			$lemongridArr['gridBuilder'] = true;

		wp_localize_script( 'tb-lemongrid-script', 'lemongridObj', $lemongridArr );
	}
}