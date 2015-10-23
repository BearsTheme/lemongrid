<?php 
/**
 * lgFileScanDirectory
 *
 * @param string $dir
 * @param string $reg
 */
function lgFileScanDirectory( $dir, $reg ) 
{
	$result_files = array();

	if( is_dir( $dir ) && $files = scandir( $dir ) ) :
		
		$files = array_diff( $files, array( '.', '..' ) );

		if( count( $files ) <= 0 ) 
			return;

		foreach( $files as $filename )
			if( TRUE == preg_match( $reg, $filename ) ) 
				$result_files[$filename] = str_replace( '\\', '/', $dir ) . $filename;

	endif;

	return $result_files;
}

/**
 * lgShortcodeContent
 * 
 * @param array $attr
 * @param string $content
 */
function lgLoadTemplate( $attr, $content = null )
{	
	$plg_dir_temp = TB_DIR . 'templates/';
	$theme_dir_temp = get_template_directory() . '/lemongrid_templates/';

	/**
	 * Set template path
	 */
	$template_path = ( is_file( $theme_dir_temp . $attr['template'] ) ) 
		? $theme_dir_temp . $attr['template']
		: $plg_dir_temp . $attr['template']; 

	/**
	 * Check template path exist
	 */
	if ( is_file( $template_path ) ) :
		ob_start(); include $template_path; return ob_get_clean();
	else :
		return __( 'Template not exist!', TB_NAME );
	endif;
}
?>