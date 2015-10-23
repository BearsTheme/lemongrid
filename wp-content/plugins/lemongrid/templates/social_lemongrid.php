<?php
/* variable */
$social = $attr['social'];

/**
 * instagramSocialTemp
 *
 * @param array $data
 */
if( ! function_exists( 'instagramSocialTemp' ) ) :
	function instagramSocialTemp( $datas )
	{
		$output = '';

		foreach( $datas as $k => $data ) :
			$style = implode( ';', array( 
				"background: url({$data['photo']['url']}) no-repeat center center / cover, #FFF", 
				) );

			$output .= '
				<div class=\'lemongrid-item\' style=\''. esc_attr( $style ) .'\'>
					'. __( $k ) .'
				</div>';
		endforeach;

		return $output;
	}
endif;

/**
 * flickrSocialTemp
 *
 * @param array $data
 */
if( ! function_exists( 'flickrSocialTemp' ) ) :
	function flickrSocialTemp( $datas )
	{
		return 'hello flickr';
	}
endif;

?>
<div class="lemongrid-wrap lemongrid-social social-<?php esc_attr_e( $social ); ?>">
	<div class="lemongrid-inner">
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