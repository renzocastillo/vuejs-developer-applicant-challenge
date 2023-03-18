<?php
namespace Includes\Apis;
use WP_REST_Controller;

class ApiRoutes extends WP_REST_Controller{
	protected $namespace;
	protected $rest_base;
	protected $methods;

	/**
	 * @param $namespace
	 * @param $rest_base
	 */
	public function __construct( $namespace, $rest_base ) {
		$this->namespace = $namespace;
		$this->rest_base = $rest_base;
		add_action('rest_api_init',[$this,'register_routes']);
	}

	public function register_routes() {
		register_rest_route($this->namespace,$this->rest_base,$this->methods);
	}

	public function register_method($method,$callback,$permission_callback){
		switch ($method){
			case 'read':
				$method=\WP_REST_Server::READABLE;
				break;
			case 'create':
				$method = \WP_REST_Server::CREATABLE;
				break;
			case 'update':
				$method = \WP_REST_Server::EDITABLE;
				break;
			default:
				break;
		}
		$this->methods[] = [
			'methods'=>$method,
			'callback'=>$callback,
			'permission_callback'=>$permission_callback
		];

		//wp_die(json_encode($this->methods));
	}



}