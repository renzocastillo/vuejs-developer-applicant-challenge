<?php

namespace Includes\Controllers;
class ServicesController {

	public static function init(): void {
		self::initRoutes();
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