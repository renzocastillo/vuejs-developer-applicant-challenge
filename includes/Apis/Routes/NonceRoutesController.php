<?php

namespace Includes\Apis\Routes;

class NonceRoutesController extends \Includes\Controllers\ApiRoutesController {

	protected $rest_base = '/nonce';

	public function get_data( $data = array() ) {
		$nonce = wp_create_nonce( 'my-nonce-action' );
		//$nonce = wp_get_current_user();

		return rest_ensure_response( $nonce );
	}


	public function get_data_permissions() {
		$response = 'true';

		return rest_ensure_response( $response );
	}

}