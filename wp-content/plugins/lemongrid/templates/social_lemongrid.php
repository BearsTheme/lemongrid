<?php
/* variable */
$social = $attr['social'];

/**
 * instagramSocialTemp
 *
 * @param array $data
 * @return HTML
 */
if( ! function_exists( 'instagramSocialTemp' ) ) :
	function instagramSocialTemp( $datas )
	{
		$output = '';
		$grid = renderGridDefault( count( $datas ) );
		
		foreach( $datas as $k => $data ) :
			$style = implode( ';', array( 
				"background: url({$data['photo']}) no-repeat center center / cover, #FFF", 
				) );

			$output .= '
				<div class=\'lemongrid-item grid-stack-item\' data-gs-x=\''. esc_attr( $grid[$k]['x'] ) .'\' data-gs-y=\''. esc_attr( $grid[$k]['y'] ) .'\' data-gs-width=\''. esc_attr( $grid[$k]['w'] ) .'\' data-gs-height=\''. esc_attr( $grid[$k]['h'] ) .'\'>
					<div class=\'grid-stack-item-content\' style=\''. esc_attr( $style ) .'\'>
						
					</div>
				</div>';
		endforeach;

		return $output;
	}
endif;

/**
 * flickrSocialTemp
 *
 * @param array $data
 * @return HTML
 */
if( ! function_exists( 'flickrSocialTemp' ) ) :
	function flickrSocialTemp( $datas )
	{
		return 'hello flickr';
	}
endif;

?>
<div class="lemongrid-wrap lemongrid-social social-<?php esc_attr_e( $social ); ?>">
	<div class="lemongrid-inner grid-stack">
		<?php 
		if( is_array( $attr['media'] ) && count( $attr['media'] ) > 0 ) :
			_e( call_user_func( $social . 'SocialTemp', $attr['media'] ) );
		else :
			/* error message */
			_e( '...', TB_NAME );
		endif;
		?>
	</div>
</div>