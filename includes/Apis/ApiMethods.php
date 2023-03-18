<?php
namespace Includes\Apis;
use Includes\Apis\ApiRoutes;

class ApiMethods{
	public function __construct() {
		$this->registerApiRoutes();
	}

	public function getRemoteData(){
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

	public function updateSetting($setting_key,$setting_value){
		$settings_option = RCRC_SETTINGS_OPTION;
		$settings = get_option($settings_option);
		if(array_key_exists($setting_key,$settings)){
			$setting_value = $this->validateSetting($setting_key,$setting_value);
			if($setting_value){
				$settings[$setting_key] =$setting_value;
				$result                 = update_option($settings_option,$settings);
			}else{
				$result = false;
			}
		}else{
			$result= false;
		}
		return rest_ensure_response($result);

	}

	public function validateSetting($setting_key,$setting_value){
		switch ($setting_key){
			case 'numrows':
				$setting_value = is_int($setting_value) && $setting_value >=1 && $setting_value <=5 ? $setting_value : false;
				break;
			case 'humandate':
				$setting_value = is_bool($setting_value) ? $setting_value : false;
				break;
			case 'emails':
				if(count($setting_value) <= 5){
					foreach($setting_value as $email_value){
						if(!is_email($email_value)){
							$setting_value= false;
							break;
						}
					}
				}else{
					$setting_value = false;
				}
				break;
			default:
				$setting_value =false;
				break;
		}
		return $setting_value;

	}

	public function getSettings(){
		$settings_option = RCRC_SETTINGS_OPTION;
		$settings = get_option($settings_option);
		return rest_ensure_response($settings);
	}
	public function getRouteAccess(){
		$response= 'true';
		return rest_ensure_response($response);
	}

	public function registerApiRoutes(){
		$api_routes= new ApiRoutes(RCRC_API_NAMESPACE,'/settings');
		$api_routes->register_method('read',[$this, 'getRemoteData' ],[$this,'getRouteAccess']);
		$api_routes->register_method('update',[$this, 'updateSetting' ],[$this,'getRouteAccess']);
		$api_routes->register_method('read',[$this, 'getSettings' ],[$this,'getRouteAccess']);
	}
}

