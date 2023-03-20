<?php

namespace Includes\Controllers;
use Includes\Menus\Admin;

class ServicesController {

	public static function init(): void {
		self::initRoutes();
		new Admin();
	}

	protected static function initRoutes(): void {
		$routes = [
			'RemoteDataRoutesController',
			'SettingsRoutesController'
		];
		$routes_namespace ="Includes\Apis\Routes\\";
		foreach ($routes as $route){
			$route = $routes_namespace.$route;
			new $route();
		}

	}
}