<?php

namespace Includes\Apis\Routes;

use Includes\Controllers\ApiRoutesController;

class RemoteDataRoutesController extends ApiRoutesController {
	protected $rest_base ="/remote-data";
	public function getData() {
		$api_data_transient = RCRC_API_DATA_TRANSIENT;
		// Check if the transient is already set
		$cached_data = get_transient( $api_data_transient );

		if ( $cached_data ) {
			// If the transient is set, return the cached data
			$data= $cached_data;
		} else {
			// If the transient is not set, call the external API
			$response= wp_remote_get('https://miusage.com/v1/challenge/2/static/');
			$data = json_decode(wp_remote_retrieve_body( $response ));
			// Save the data in a transient for 1 hour
			set_transient( $api_data_transient, $data, HOUR_IN_SECONDS );
			// Return the data
		}
		return rest_ensure_response($data);
	}

	public function getDataPermissions() {
		$response= 'true';
		return rest_ensure_response($response);
	}

}