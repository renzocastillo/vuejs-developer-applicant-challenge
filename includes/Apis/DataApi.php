<?php

namespace Includes\Apis;

use Includes\Controllers\ApiRoutesController;
use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;


/**
 * Class DataApi
 *
 * This class retrieves the data from miusage.com remote API.
 *
 * @package Apis
 */
class DataApi extends ApiRoutesController {
	/**
	 * The slug for your rest base API
	 *
	 * @var string
	 * @access protected
	 */
	protected $rest_base = '/remote-data';

	/**
	 * Retrieve the data from miusage API only if transient doesn't exist (lives for 1 hour).
	 *
	 * @param  array $data This contains all the data that has been send as query strings.
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_data( $data = array() ) {
		$api_data_transient = RECA_API_DATA_TRANSIENT;
		$transient_data     = get_transient( $api_data_transient );
		$update_data        = ! empty( $data ) && rest_sanitize_boolean( $data['update'] );

		if ( $transient_data && ! $update_data ) {
			// If the transient is set, return the cached remoteData.
			$data = $transient_data;
		} else {
			// If the transient is not set, call the external API.
			$response = wp_remote_get( 'https://miusage.com/v1/challenge/2/static/' );
			$data     = json_decode( wp_remote_retrieve_body( $response ) );
			// Save the remoteData in a transient for 1 hour.
			set_transient( $api_data_transient, $data, HOUR_IN_SECONDS );
			// Return the remoteData.
		}

		return rest_ensure_response( $data );
	}

	/**
	 * Validate if current role trying to access this API is an administrator.
	 */
	public function get_data_permissions() {
		return current_user_can( 'administrator' );
	}
}
