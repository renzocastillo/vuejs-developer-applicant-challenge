<?php

namespace Includes\Apis\Routes;

use Includes\Controllers\ApiRoutesController;
use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;

/**
 *
 */
class SettingsRoutesController extends ApiRoutesController {
	/**
	 * @var string
	 */
	protected $rest_base = '/settings';

	/**
	 * @param $request
	 *
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function update_data( $request ) {
		$key             = $request['key'];
		$value           = $request['value'];
		$settings_option = RCRC_SETTINGS_OPTION;
		$settings        = get_option( $settings_option );
		$result          = false;
		if ( array_key_exists( $key, $settings ) ) {
			$validation_result = $this->validateSetting( $key, $value );
			$value             = $validation_result['value'];
			$success           = $validation_result ['success'];
			if ( $success ) {
				if ( isset( $value ) ) {
					$settings[ $key ] = $value;
					$result           = update_option( $settings_option, $settings );
				}
			}
		}

		return rest_ensure_response( $result );

	}

	/**
	 * @param $setting_key
	 * @param $setting_value
	 *
	 * @return array
	 */
	public function validateSetting( $setting_key, $setting_value ): array {
		$success = true;
		switch ( $setting_key ) {
			case 'numrows':
				if ( !intval( $setting_value ) || $setting_value < 1 || $setting_value > 5 ) {
					$success = false;
				}
				break;
			case 'humandate':
				$booleans_arr = array( 1, 0, 'true', 'false',true,false );
				if ( in_array( $setting_value, $booleans_arr, true ) ) {
					$setting_value = rest_sanitize_boolean( $setting_value );
				} else {
					$success = false;
				}
				break;
			case 'emails':
				if ( count( $setting_value ) <= 5 ) {
					foreach ( $setting_value as $email_value ) {
						if ( ! is_email( $email_value ) ) {
							$success = false;
							break;
						}
					}
				} else {
					$success = false;
				}
				break;
			default:
				$success = false;
				break;
		}

		return array(
			'value'   => $setting_value,
			'success' => $success,
		);

	}

	/**
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_data( $data = array() ) {
		$settings_option = RCRC_SETTINGS_OPTION;
		$settings        = get_option( $settings_option );

		return rest_ensure_response( $settings );
	}

	/**
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_data_permissions() {
		$response = 'true';

		return rest_ensure_response( $response );
	}

	/**
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function update_data_permissions() {
		$response = 'true';

		return rest_ensure_response( $response );
	}
}