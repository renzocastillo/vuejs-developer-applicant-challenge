<?php

namespace RECA\Apis;

use RECA\Controllers\ApiRoutesController;
use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;

/**
 * Class Settings API
 *
 * This class gets all settings from our plugin, or updates them.
 *
 * @package Apis
 */
class SettingsApi extends ApiRoutesController {
	/**
	 * The slug for your rest base API.
	 *
	 * @var string
	 * @access protected
	 */
	protected $rest_base = '/settings';

	/**
	 * Update a specific setting through its key and value, sanitize it, validate it and update its option value.
	 *
	 * @param array $request This contains the key value pair which is sent through a post method.
	 *
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function update_data( $request ) {
		$key             = $request['key'];
		$value           = $request['value'];
		$settings_option = RECA_SETTINGS_OPTION;
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
	 * Receives the setting key and value and validates according to setting key
	 *
	 * @param string $setting_key The settings key.
	 * @param mixed  $setting_value The settings value.
	 *
	 * @return array
	 */
	public function validateSetting( string $setting_key, $setting_value ): array {
		$success = true;
		switch ( $setting_key ) {
			case 'numrows':
				if ( ! intval( $setting_value ) || $setting_value < 1 || $setting_value > 5 ) {
					$success = false;
				}
				break;
			case 'humandate':
				$booleans_arr = array( 1, 0, 'true', 'false', true, false );
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
	 * Retrieves all settings with their respective values.
	 *
	 * @param array $data In this case it will be ignored.
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_data( $data = array() ) {
		$settings_option = RECA_SETTINGS_OPTION;
		$settings        = get_option( $settings_option );

		return rest_ensure_response( $settings );
	}

	/**
	 * Validate if current role trying to access this API is an administrator.
	 */
	public function get_data_permissions() {
		return current_user_can( 'administrator' );
	}

	/**
	 * Validate if current role trying to access this API is an administrator.
	 */
	public function update_data_permissions() {
		return current_user_can( 'administrator' );
	}
}
