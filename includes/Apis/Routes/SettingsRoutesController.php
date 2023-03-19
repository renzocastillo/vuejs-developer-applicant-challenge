<?php

namespace Includes\Apis\Routes;

use Includes\Controllers\ApiRoutesController;

class SettingsRoutesController extends ApiRoutesController {
	protected $rest_base= '/settings';

	public function updateData($args){
		$key = $args['key'];
		$value = $args['value'];
		$settings_option = RCRC_SETTINGS_OPTION;
		$settings = get_option($settings_option);
		if(array_key_exists($key,$settings)){
			$validation_result = $this->validateSetting($key,$value);
			$value = $validation_result['value'];
			$success = $validation_result ['success'];
			if ( $success ) {
				if ( isset( $value ) ) {
					$settings[ $key ] = $value;
					$result           = update_option( $settings_option, $settings );
				} else {
					$result = false;
				}
			}else{
				$result =false;
			}
		}else{
			$result= false;
		}
		return rest_ensure_response($result);

	}

	public function validateSetting($setting_key,$setting_value): array {
		$success = true;
		switch ($setting_key){
			case 'numrows':
				if ( !is_int( $setting_value ) || $setting_value < 1 || $setting_value > 5 ) {
						$success = false;
				}
				break;
			case 'humandate':
				$booleans_arr = [1,0,'true','false'];
				if(in_array($setting_value,$booleans_arr)){
					$setting_value = rest_sanitize_boolean($setting_value);
				}else{
					$success = false;
				}
				break;
			case 'emails':
				if(count($setting_value) <= 5){
					foreach($setting_value as $email_value){
						if(!is_email($email_value)){
							$success = false;
							break;
						}
					}
				}else{
					$success = false;
				}
				break;
			default:
				$success = false;
				break;
		}

		return [ 'value' =>$setting_value, 'success' =>$success];

	}

	public function getData(){
		$settings_option = RCRC_SETTINGS_OPTION;
		$settings = get_option($settings_option);
		return rest_ensure_response($settings);
	}

	public function getDataPermissions() {
		$response= 'true';
		return rest_ensure_response($response);
	}

	public function updateDataPermissions(){
		$response= 'true';
		return rest_ensure_response($response);
	}
}