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
 * @param string $dirTemp
 */
function lgLoadTemplate( $attr, $content = null )
{	
	if ( is_file( $attr['template'] ) ) :
		ob_start(); include $attr['template']; return ob_get_clean();
	else :
		return __( 'Template not exist!', TB_NAME );
	endif;
}
?>