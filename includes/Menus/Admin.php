<?php

namespace Includes\Menus;

/**
 *
 */
class Admin {
	/**
	 *
	 */
	public function __construct() {
		add_action( 'in_admin_header', array( $this, 'my_plugin_admin_header' ) );
		add_action( 'admin_menu', array( $this, 'create_admin_menu' ), 11 );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts_and_styles' ) );
	}

	/**
	 * @return void
	 */
	public function create_admin_menu() {
		$capability  = 'manage_options';
		$menu_slug   = RCRC_MENU_SLUG;
		$graph       = $menu_slug . '-graph';
		$settings    = $menu_slug . '-settings';
		$text_domain = RCRC_DOMAIN_NAME;
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
	 * @return void
	 */
	public function register_scripts_and_styles() {
		$this->load_scripts();
		$this->load_styles();
	}

	/**
	 * @return void
	 */
	public function load_styles() {
		wp_register_style( 'vue-app', RCRC_PLUGIN_URL . 'dist/assets/index.css', array(), true, 'all' );
		wp_enqueue_style( 'vue-app' );

	}

	/**
	 * @return void
	 */
	public function load_scripts() {
		wp_register_script( 'vue-app', RCRC_PLUGIN_URL . 'dist/assets/index.js', array(), RCRC_VERSION, true );
		wp_enqueue_script( 'vue-app' );
		$args = array(
			'adminURL'   => admin_url( '/' ),
			'adminPath'  => '/admin.php',
			'adminPages' => array(
				'table'    => 'renzo-castillo',
				'graph'    => 'renzo-castillo-graph',
				'settings' => 'renzo-castillo-settings',
			),
			'ajaxURL'    => admin_url( 'admin-ajax.php' ),
			'apiURL'     => home_url( '/wp-json' ),
			'basePath'   => '/wp-admin',
			'nonce'      => wp_create_nonce( 'wp_rest' ),
		);
		wp_localize_script( 'vue-app', 'wpData', $args );

		add_filter( 'script_loader_tag', array( $this, 'add_type_attribute' ), 10, 3 );
	}

	/**
	 * @param $tag
	 * @param $handle
	 * @param $src
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
	 * @return void
	 */
	public function menu_page_template() {

		echo '<noscript>Sorry, this page requires JavaScript to function properly. Please enable JavaScript in your browser and try again.</noscript>';

		echo '<div class="wrap"><div id="app" v-cloak></div></div>';

	}


	public function my_plugin_admin_header() {
		$template_path = RCRC_PLUGIN_PATH . 'includes/Templates/';
		$top_level_page = 'toplevel_page_renzo-castillo';
		$base_slug     = 'renzo-castillo';
		$screen        = get_current_screen();
		if ( strpos( $screen->id, $base_slug ) === 0 || $screen->id === $top_level_page ) {
			include_once( $template_path . 'header.php' );
		}
	}

}