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
		 * Lib JS Gridstack
		 */
		wp_register_script( 'gridstack', TB_JS . 'gridstack.js', array( 'jquery' ) );
		wp_register_style('gridstack', TB_CSS . 'gridstack.css', array(), '1.0');

		/**
		 * Script LemonGrid
		 */
		wp_register_script( 'tb-lemongrid-script', TB_JS . 'lemongrid.js', array( 'jquery', 'gridstack' ) );
		wp_register_style('tb-lemongrid-script', TB_CSS . 'lemongrid.css', array(), '1.0');
	}
}