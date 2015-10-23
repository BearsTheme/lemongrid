<?php
/* variable */
$social = $attr['social'];

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
		$grid = renderGridDefault( count( $datas ) );
		
		foreach( $datas as $k => $data ) :
			$style = implode( ';', array( 
				"background: url({$data['photo']}) no-repeat center center / cover, #FFF", 
				) );

			$info = '';
			switch ( $social ) {
				case 'flickr':
					
					break;
				
				default: /* instagram */
					$info .= '
					<div class=\'lemongrid-info\'>
						<h2 class=\'lemongrid-title\'>'. esc_attr( $data['description'] ) .'</h2>
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
<div class="lemongrid-wrap lemongrid-social social-<?php esc_attr_e( $social ); ?>">
	<div class="lemongrid-inner grid-stack">
		<?php 
		if( is_array( $attr['media'] ) && count( $attr['media'] ) > 0 ) :
			_e( call_user_func( 'itemSocialTemp', $attr['media'], $social ) );
		else :
			/* error message */
			_e( '...', TB_NAME );
		endif;
		?>
	</div>
</div>