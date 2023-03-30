<?php

namespace Includes\Controllers;

use WP_REST_Controller;
use WP_REST_Server;

/**
 *
 */
class ApiRoutesController extends WP_REST_Controller {
	/**
	 * @var string
	 */
	protected $namespace;
	/**
	 * @var
	 */
	protected $rest_base;
	/**
	 * @var array|array[]
	 */
	protected array $args;

	/**
	 */
	public function __construct() {
		$this->namespace = RCRC_API_NAMESPACE;
		$this->args      = array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_data' ),
				'permission_callback' => array( $this, 'get_data_permissions' ),
			),
			array(
				'methods'             => WP_REST_Server::EDITABLE,
				'callback'            => array( $this, 'update_data' ),
				'permission_callback' => array( $this, 'update_data_permissions' ),
			)
		);
		$this->add_methods();
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * @return void
	 */
	public function register_routes() {
		register_rest_route( $this->namespace, $this->rest_base, $this->args );
	}

	/**
	 * @return void
	 */
	public function add_methods() {
	}

	/**
	 * @return void
	 */
	public function get_data( $data = array() ) {

	}

	/**
	 * @return void
	 */
	public function get_data_permissions() {

	}

	/**
	 * @param $args
	 *
	 * @return void
	 */
	public function update_data( $args ) {

	}

	/**
	 * @return void
	 */
	public function update_data_permissions() {

	}

}