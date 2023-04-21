<?php

namespace Includes\Controllers;

use WP_REST_Controller;
use WP_REST_Server;

/**
 * Class APiRoutesController
 *
 * This class it's an abstraction class to be consumed to register any api route.
 *
 * @package Controllers
 */
class ApiRoutesController extends WP_REST_Controller {
	/**
	 * The API namespace slug.
	 *
	 * @var string
	 */
	protected $namespace;
	/**
	 * The API rest base slug.
	 *
	 * @var string
	 */
	protected $rest_base;
	/**
	 * The args containing all the set of API routes to register.
	 *
	 * @var array|array[]
	 */
	protected array $args;

	/**
	 * Built in construct method which registers all routes on initialization.
	 */
	public function __construct() {
		$this->namespace = RECA_API_NAMESPACE;
		$this->args      = array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_data' ),
				'permission_callback' => array( $this, 'get_data_permissions' ),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'update_data' ),
				'permission_callback' => array( $this, 'update_data_permissions' ),
			),
		);
		$this->add_methods();
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register all routes using the namspace, the restbase and the methods through args.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route( $this->namespace, $this->rest_base, $this->args );
	}

	/**
	 * Registers addtional methods that the route API might want to include.
	 *
	 * @return void
	 */
	public function add_methods() {
	}

	/**
	 * Abstract method which will be used by the API route to get data.
	 *
	 * @param mixed $data Contains all the query string variables included at the GET request.
	 * @return void
	 */
	public function get_data( $data = array() ) {

	}
	/**
	 * Validate capability permissions for the get_data function.
	 */
	public function get_data_permissions() {

	}

	/**
	 * Abstract method which will be used by the API route to post data.
	 *
	 * @param mixed $request constains the data used by post method.
	 * @return void
	 */
	public function update_data( $request ) {

	}
	/**
	 * Validate capability permissions for the update_data function.
	 */
	public function update_data_permissions() {

	}
}
