<?php
/**
* LG_Flickr PHP
* @author BEARS Themes <bearsthemes@gmail.com>
* @license http://opensource.org/licenses/mit-license.php The MIT License
*/

class LG_Flickr
{
	public $username 	= '';
	public $key 		= '';
	public $slice 		= 9;
	public $uri_flickr = 'https://api.flickr.com/services/rest/?';

	function __construct()
	{

	}

	/**
	 * getMedia
	 */
	function getMedia()
	{
		$id = $this->getUserID();
		
	}

	/**
	 * getUserID
	 */
	function getUserID()
	{
		$params = array(
			'method' 			=> 'flickr.people.findByUsername',
			'api_key' 			=> $this->key,
			'username' 			=> $this->username,
			'format' 			=> 'json',
			'nojsoncallback' 	=> 1
			);

		$uri_request = $this->uri_flickr . http_build_query( $params );

		$get = wp_remote_get( $uri_request );
		print_r($uri_request);
		if ( is_wp_error($get) )
            return new WP_Error( 'site_down', __( 'Unable to communicate with Flickr.', 'bearsthemes' ) );

        if ( 200 != wp_remote_retrieve_response_code( $get ) )
            return new WP_Error( 'invalid_response', __( 'Flickr did not return a 200.', 'bearsthemes') );

        $data = json_decode( $get['body'] );

        return ( $data->user->id ) ? $data->user->id : '';
	}
}
?>