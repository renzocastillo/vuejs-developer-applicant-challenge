<?php
/**
 * Plugin Name:     Renzo Castillo
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Vue.js developer applicant challenge
 * Author:          Renzo Castillo
 * Author URI:      YOUR SITE HERE
 * Text Domain:     renzo-castillo
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Renzo_Castillo
 */

// Your code starts here.
// No direct access allowed.
use Includes\Apis\ApiMethods;

if(!defined('ABSPATH')) exit();

require_once  'vendor/autoload.php';

final class RenzoCastillo{

	public function __construct(){
		$this->constants();
		register_activation_hook(__FILE__,[$this,'activate']);
		register_deactivation_hook(__FILE__,[$this,'deactivate']);
		add_action('plugins_loaded', [$this,'initialize'] );
	}

	public function constants(){
		define('RCRC_VERSION','1.0.0');
		define('RCRC_PLUGIN_PATH',plugin_dir_path(__FILE__));
		define('RCRC_PLUGIN_URL',plugins_url(__FILE__));
		define('RCRC_API_NAMESPACE','renzo/v1');
		define('RCRC_API_DATA_TRANSIENT','rcrc_api_data');
		define('RCRC_SETTINGS_OPTION','test_project_option');
	}

	public function activate(){
		$settings_option_name = RCRC_SETTINGS_OPTION;
		$settings_exists = get_option($settings_option_name);
		if(! $settings_exists){
			$value = [
				'numrows'=>'5',
				'humandate'=>true,
				'emails'=>[
					'admin_email'=>get_bloginfo('admin_email')
				]
			];
			update_option($settings_option_name,$value);
		}
	}

	public function deactivate(){

	}
	public function initialize(){
		new ApiMethods();
	}

}
new RenzoCastillo();

/*function enqueue_scripts(){
     global $post;
    if(has_shortcode($post->post_content, "latestPosts")){
                 wp_enqueue_script('vue', 'https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js', [], '2.5.17');
    }
 }*/