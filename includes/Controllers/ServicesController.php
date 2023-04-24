<?php

namespace RECA\Controllers;

use RECA\Menus\Admin;

/**
 * Class ServicesController
 * This class initializes all the services that our plugin requires on load.
 *
 * @package Controllers
 */
class ServicesController {

	/**
	 * Initiliazes all the methods required by our plugin
	 *
	 * @return void
	 */
	public static function init(): void {
		self::init_routes();
		new Admin();
	}

	/**
	 * Initializes all the API routes classes that our plugin uses
	 *
	 * @return void
	 */
	protected static function init_routes(): void {
		$api_path         = '/includes/Apis/';
		$api_files        = glob( RECA_PLUGIN_PATH . $api_path . '*.php' );
		$routes_namespace = 'RECA\Apis\\';
		foreach ( $api_files as $api_file ) {
			$api_class = $routes_namespace . basename( $api_file, '.php' );
			new $api_class();
		}
	}


}