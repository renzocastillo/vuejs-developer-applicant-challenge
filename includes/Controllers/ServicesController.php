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
		$routes           = array(
			'RemoteDataRoutesController',
			'SettingsRoutesController',
		);
		$routes_namespace = 'Includes\Apis\Routes\\';
		foreach ( $routes as $route ) {
			$route = $routes_namespace . $route;
			new $route();
		}

	}
}