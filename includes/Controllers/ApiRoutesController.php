<?php
namespace Includes\Controllers;
use WP_REST_Controller;
use WP_REST_Server;

class ApiRoutesController extends WP_REST_Controller{
	protected $namespace;
	protected $rest_base;
	protected array $args;

	/**
	 */
	public function __construct( ) {
		$this->namespace = RCRC_API_NAMESPACE;
		$this->args      = [
			[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            =>[$this,'getData'],
			'permission_callback' =>[$this,'getDataPermissions']
			],
			['methods'=> WP_REST_Server::EDITABLE,
			 'callback'=>[$this,'updateData'],
			 'permission_callback'=>[$this,'updateDataPermissions']
			]
		];
		$this->add_methods();
		add_action('rest_api_init',[$this,'register_routes']);
	}

	public function register_routes() {
		register_rest_route($this->namespace,$this->rest_base,$this->args);
	}
	public function add_methods(){
	}

	public function getData(){

	}

	public function getDataPermissions(){

	}

	public function updateData($args){

	}

	public function updateDataPermissions(){

	}

}