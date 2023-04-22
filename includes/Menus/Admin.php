<?php

namespace Includes\Menus;

/**
 * Class Admin
 * This class generates all the wp admin dashboard pages
 */
class Admin {
	/**
	 * Initializes all the admin pages
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts_and_styles' ) );
		add_action( 'admin_head', array( $this, 'add_admin_favicon' ) );
		add_action( 'in_admin_header', array( $this, 'my_plugin_admin_header' ) );
		add_action( 'admin_menu', array( $this, 'create_admin_menu' ), 11 );
	}

	/**
	 * Creates all plugin admin menu pages and subpages
	 *
	 * @return void
	 */
	public function create_admin_menu() {
		$capability  = 'manage_options';
		$menu_slug   = RECA_MENU_SLUG;
		$graph       = $menu_slug . '-graph';
		$settings    = $menu_slug . '-settings';
		$text_domain = RECA_DOMAIN_NAME;
		add_menu_page(
			__( 'Renzo Castillo', 'renzo-castillo' ),
			__( 'Renzo Castillo', 'renzo-castillo' ),
			$capability,
			$menu_slug,
			array( $this, 'menu_page_template' ),
			'',
		);
		add_submenu_page(
			$menu_slug,
			__( 'Table', 'renzo-castillo' ),
			__( 'Table', 'renzo-castillo' ),
			$capability,
			$menu_slug,
			array( $this, 'menu_page_template' ),
		);
		add_submenu_page(
			$menu_slug,
			__( 'Graph', 'renzo-castillo' ),
			__( 'Graph', 'renzo-castillo' ),
			$capability,
			$graph,
			array( $this, 'menu_page_template' ),
		);
		add_submenu_page(
			$menu_slug,
			__( 'Settings', 'renzo-castillo' ),
			__( 'Settings', 'renzo-castillo' ),
			$capability,
			$settings,
			array( $this, 'menu_page_template' ),
		);
	}

	/**
	 * Regiser JS scripts and CSS styles used by our admin menu
	 *
	 * @return void
	 */
	public function register_scripts_and_styles() {
		$top_level_page = 'toplevel_page_renzo-castillo';
		$base_slug      = 'renzo-castillo';
		$screen         = get_current_screen();
		if ( strpos( $screen->id, $base_slug ) === 0 || $screen->id === $top_level_page ) {
			$this->load_scripts();
			$this->load_styles();
		}
	}

	/**
	 * Register all admin CSS styles
	 *
	 * @return void
	 */
	public function load_styles() {
		wp_register_style( 'vue-app', RECA_PLUGIN_URL . 'dist/assets/index.css', array(), true, 'all' );
		wp_enqueue_style( 'vue-app' );

	}

	/**
	 * Register all admin JS scripts
	 *
	 * @return void
	 */
	public function load_scripts() {
		wp_register_script( 'vue-app', RECA_PLUGIN_URL . 'dist/assets/index.js', array(), RECA_VERSION, true );

		/*
		I tried to use this function to add the type=module for the vue-app script tag but appearently is not working:
		wp_script_add_data( 'vue-app', 'type', 'module' );
		*/
		wp_enqueue_script( 'vue-app' );
		$args = array(
			'adminURL'           => admin_url( '/' ),
			'adminPath'          => '/admin.php',
			'adminPages'         => array(
				'table'    => 'renzo-castillo',
				'graph'    => 'renzo-castillo-graph',
				'settings' => 'renzo-castillo-settings',
			),
			'ajaxURL'            => admin_url( 'admin-ajax.php' ),
			'apiURL'             => home_url( '/wp-json/' ),
			'apiName'            => RECA_API_NAMESPACE,
			'apiSettings'        => '/settings',
			'apiData'            => '/remote-data',
			'basePath'           => '/wp-admin',
			'nonce'              => wp_create_nonce( 'wp_rest' ),
			'translationStrings' => array(
				'table_page'    => __( 'Table page', 'renzo-castillo' ),
				'graph_page'    => __( 'Graph page', 'renzo-castillo' ),
				'graph_values'  => __( 'Values', 'renzo-castillo' ),
				'settings_page' => __( 'Settings page', 'renzo-castillo' ),
				'numrows'       => __( 'Number of rows', 'renzo-castillo' ),
				'humandate'     => __( 'Human Date', 'renzo-castillo' ),
				'emails'        => __( 'Emails', 'renzo-castillo' ),
				'emails_list'   => __( 'Emails list', 'renzo-castillo' ),
				'remove'        => __( 'Remove', 'renzo-castillo' ),
				'add'           => __( 'Add', 'renzo-castillo' ),
				'refresh'       => __( 'Refresh', 'renzo-castillo' ),
			),
		);
		wp_localize_script( 'vue-app', 'wpData', $args );
		add_filter( 'script_loader_tag', array( $this, 'add_type_attribute' ), 10, 3 );
	}

	/**
	 * Adds  the type="module" attribute to the vue-app js script tag
	 *
	 * @param mixed $tag The js script tag.
	 * @param mixed $handle The script id.
	 * @param mixed $src The source file url.
	 *
	 * @return mixed|string
	 */
	public function add_type_attribute( $tag, $handle, $src ) {
		// if not your script, do nothing and return original $tag.
		if ( 'vue-app' !== $handle ) {
			return $tag;
		}

		// change the script tag by adding type="module" and return it.
		return '<script type="module" src="' . esc_url( $src ) . '"></script>';
	}

	/**
	 * Retrieves the basic html template on which Vue Application will be mounted
	 *
	 * @return void
	 */
	public function menu_page_template() {
		$template_path = RECA_PLUGIN_PATH . 'includes/Templates/';
		include_once $template_path . 'vue-app.php';

	}

	/**
	 * Retrieves our admin header and includes only at our plugin pages
	 *
	 * @return void
	 */
	public function my_plugin_admin_header() {
		$template_path  = RECA_PLUGIN_PATH . 'includes/Templates/';
		$top_level_page = 'toplevel_page_renzo-castillo';
		$base_slug      = 'renzo-castillo';
		$screen         = get_current_screen();
		if ( strpos( $screen->id, $base_slug ) === 0 || $screen->id === $top_level_page ) {
			include_once $template_path . 'header.php';
		}
	}
	/**
	 * Retrieves our favicon icon and includes only at our plugin pages
	 *
	 * @return void
	 */
	public function add_admin_favicon() {
		$top_level_page = 'toplevel_page_renzo-castillo';
		$base_slug      = 'renzo-castillo';
		$screen         = get_current_screen();
		if ( strpos( $screen->id, $base_slug ) === 0 || $screen->id === $top_level_page ) {
			echo '<link rel="shortcut icon" href="' . esc_url( RECA_PLUGIN_URL . 'assets/images/favicon.ico' ) . '" />';
		}
	}
}
