<?php

namespace Includes\Apis\Routes;

use Includes\Controllers\ApiRoutesController;
use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;

/**
 *
 */
class RemoteDataRoutesController extends ApiRoutesController {
	/**
	 * @var string
	 */
	protected $rest_base = '/remote-responseData';

	/**
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_data() {
		$api_data_transient = RCRC_API_DATA_TRANSIENT;
		// Check if the transient is already set.
		$cached_data = get_transient( $api_data_transient );

		if ( $cached_data ) {
			// If the transient is set, return the cached responseData.
			$data = $cached_data;
		} else {
			// If the transient is not set, call the external API.
			$response = wp_remote_get( 'https://miusage.com/v1/challenge/2/static/' );
			$data     = json_decode( wp_remote_retrieve_body( $response ) );
			// Save the responseData in a transient for 1 hour.
			set_transient( $api_data_transient, $data, HOUR_IN_SECONDS );
			// Return the responseData.
		}

		return rest_ensure_response( $data );
	}

	/**
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_data_permissions() {
		$response = 'true';

		return rest_ensure_response( $response );
	}

}