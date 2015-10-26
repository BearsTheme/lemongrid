<?php
/* variable */
$elementID = date( 'ymdhis' );
$social = $atts['social'];
list( $template_name ) = explode( '.', $atts['template'] );
$lemongrid_options = json_encode( array(
	'cell_height'		=> 120,
	'vertical_margin'	=> 20,
	'animate'			=> true,
	) );

/**
 * instagramSocialTemp
 *
 * @param array $data
 * @return HTML
 */
if( ! function_exists( 'itemSocialTemp' ) ) :
	function itemSocialTemp( $datas, $social )
	{
		$output = '';
		$grid = lgRenderGridDefault( count( $datas ) );
		
		foreach( $datas as $k => $data ) :
			$style = implode( ';', array( 
				"background: url({$data['photo']}) no-repeat center center / cover, #FFF", 
				) );

			$info = '';
			switch ( $social ) {
				case 'flickr':
					
					break;
				
				default: /* instagram */

					/* description */
					$description = ( isset( $data['description'] ) && ! empty( $data['description'] ) ) 
						? '<div class=\'lemongrid-description\'><p>'. esc_attr( $data['description'] ) .'</p></div>' 
						: '';

					$info .= '
					<div class=\'lemongrid-info\'>
						<div class=\'lemongrid-icon\'>
							<a href=\'#\' class=\'lemongrid-icon-picture\'><i class=\'fa fa-picture-o\'></i></a>
							<a href=\'#\' class=\'lemongrid-icon-link\'><i class=\'fa fa-link\'></i></a>
						</div>
						'. __( $description ) .'
					</div>';
					break;
			}

			$output .= '
				<div class=\'lemongrid-item grid-stack-item\' data-gs-x=\''. esc_attr( $grid[$k]['x'] ) .'\' data-gs-y=\''. esc_attr( $grid[$k]['y'] ) .'\' data-gs-width=\''. esc_attr( $grid[$k]['w'] ) .'\' data-gs-height=\''. esc_attr( $grid[$k]['h'] ) .'\'>
					<div class=\'grid-stack-item-content\' style=\''. esc_attr( $style ) .'\'>
						'. __( $info ) .'
					</div>
				</div>';
		endforeach;

		return $output;
	}
endif;

?>
<div class="lemongrid-wrap lemongrid--element lemongrid-social social-<?php esc_attr_e( $social ); ?> <?php esc_attr_e( $template_name ) ?>">
	<?php echo apply_filters( 'lemongrid_toolbar_frontend', lgToolbarFrontend( array( 'elementID' => $elementID, 'atts' => $atts ) ), array() ); ?>
	<?php echo apply_filters( 'lemongrid_before_content', '', array() ); ?>
	<div class="lemongrid-inner grid-stack" data-lemongrid-options="<?php esc_attr_e( $lemongrid_options ); ?>">
		<?php 
		if( is_array( $atts['media'] ) && count( $atts['media'] ) > 0 ) :
			_e( call_user_func( 'itemSocialTemp', $atts['media'], $social ) );
		else :
			/* error message */
			_e( '...', TB_NAME );
		endif;
		?>
	</div>
	<?php echo apply_filters( 'lemongrid_after_content', '', array() ); ?>
</div>