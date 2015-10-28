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
function lgLoadTemplate( $atts, $content = null )
{	
	$plg_dir_temp = TB_DIR . 'templates/';
	$theme_dir_temp = get_template_directory() . '/lemongrid_templates/';

	/**
	 * Set template path
	 */
	$template_path = ( is_file( $theme_dir_temp . $atts['template'] ) ) 
		? $theme_dir_temp . $atts['template']
		: $plg_dir_temp . $atts['template']; 

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
 * lgToolbarFrontend
 * 
 * @param array $params
 *
 * @return HTML 
 */
function lgToolbarFrontend( $params ) {
	/**
	 * Check admin login
	 */
	if( ! is_super_admin() ) return;

	$toolArr = apply_filters( 'lemongrid_toolbar_frontend', array(
		array(
			'tag' => 'a',
			'attrs' => array( 
				'class' => 'lg-toolbar-icon lg-toolbar-icon--save-layout ' . ( empty( $params['atts']['grid_template'] ) ? 'lg-toolbar-icon-disable' : '' ), 
				'href' => '#', 
				'title' => __( 'Save layout', TB_NAME ), 
				'data-grid-name' => $params['atts']['grid_template'] ),
			'content' => sprintf( '<i class=\'fa fa-floppy-o\'></i>' ),
			),
		array(
			'tag' => 'a',
			'attrs' => array( 
				'class' => 'lg-toolbar-icon lg-toolbar-icon--save-as-layout', 
				'href' => '#', 
				'title' => __( 'Save as layout', TB_NAME ) ),
			'content' => sprintf( '<i class=\'ion-ios-grid-view\'></i>' ),
			),
		), $params );

	$output = '';
	foreach( $toolArr as $item ) :
		/**
	     * Build attr element
	     */
		$attrArr = array();
		if( count( $item['attrs'] ) > 0 )
			foreach( $item['attrs'] as $attr => $data )
				array_push( $attrArr, "{$attr}='{$data}'" );

		$output .= "<li class='lemongrid-toolbar-item'><{$item['tag']} ". implode( ' ', $attrArr ) .">{$item['content']}</{$item['tag']}></li>";
	endforeach;

	return sprintf( '
		<ul class=\'lemongrid-toolbar\'>
			%s
		</ul>', $output );
}

/**
 * lbGetLemonGridLayouts
 */
function lbGetLemonGridLayouts( $name = '' ) {
	$lemongrid_grid_layouts = get_option( 'lemongrid_grid_layouts', json_encode( array() ) );
	$layoutArr = json_decode( $lemongrid_grid_layouts, true );

	if( ! empty( $name ) ) :
		$result = isset( $layoutArr[$name] ) ? $layoutArr[$name] : array();
	else :
		$result = $layoutArr;
	endif;

	return $result;
}

/**
 * lgApplyLemonGrid
 */
function lgApplyLemonGrid() {
	$layout_arr = lbGetLemonGridLayouts();
	$layout_arr[$_POST['name']] = $_POST['gridMap'];

	update_option( 'lemongrid_grid_layouts', json_encode( $layout_arr ) );
	exit();
}
add_action( 'wp_ajax_lgApplyLemonGrid', 'lgApplyLemonGrid' );
add_action( 'wp_ajax_nopriv_lgApplyLemonGrid', 'lgApplyLemonGrid' );

/**
 * renderGridCustomSpaceCss
 *
 * @param string $contentID
 * @param int $space
 *
 * @return Css string
 */
function renderGridCustomSpaceCss( $contentID, $space = 0 ) {
	$output = '';
	$gridWidth = array(  
		'8.33333333%', '16.66666667%', '25%', '33.33333333%', '41.66666667%', '50%', 
		'58%', '66.66666667%', '75%', '83.33333333%', '91.66666667%', '100%',
		);

	$output .= sprintf( '.lemongrid-wrap.%s .lemongrid-inner{ margin-left: -%spx; }', $contentID, $space );
	$output .= sprintf( '.lemongrid-wrap.%s .lemongrid-inner .lemongrid-item{ margin: 0 0 20px %spx; }', $contentID, $space );
	foreach( $gridWidth as $k => $itemWidth ) :
		$output .= sprintf( '.lemongrid-wrap.%s .grid-stack > .grid-stack-item[data-gs-width=\'%s\'] {width: calc( %s - %spx );}', $contentID, $k + 1, $itemWidth, $space );
	endforeach;

	return $output;
}
?>