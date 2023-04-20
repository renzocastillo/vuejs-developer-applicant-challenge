<?php

namespace Includes\Controllers;

use Includes\Menus\Admin;

/**
 *
 */
class ServicesController {

	/**
	 * @return void
	 */
	public static function init(): void {
		self::init_routes();
		new Admin();
	}

	/**
	 * @return void
	 */
	protected static function init_routes(): void {
		$api_path         = '/includes/Apis/';
		$api_files        = glob( RECA_PLUGIN_PATH . $api_path . '*.php' );
		$routes_namespace = 'Includes\Apis\\';
		foreach ( $api_files as $api_file ) {
			$api_class = $routes_namespace . basename( $api_file, '.php' );
			new $api_class();
		}
	}


}