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

/**
 * renderGridDefault
 *
 * @param int $count
 * @return array
 */
function lgRenderGridDefault( $count = 0 )
{	
	$grid = array(); $col = 12; $x = 0; $y = 0;
	if( $count == 0 ) return $grid;

	while( $count > 0 ) {
	    array_push( $grid, array( 'x' => $x, 'y' => $y, 'w' => 4, 'h' => 2 ) );
	    $x += 4;
	    if( $x >= 12 ) : $x = 0; $y += 2; endif;
	    $count -= 1;
	} 

	return $grid;
}

/**
 * lgToolbarGridBuilder
 *
 * @param array $params
 */
// function lgToolbarGridBuilder( $params )
// {
// 	$output = 'hello dev';

// 	return $output;
// }
// add_filter('lemongrid_before_content', 'lgToolbarGridBuilder');
?>