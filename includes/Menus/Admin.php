<?php

namespace Includes\Menus;

class Admin {
	public function __construct(){
		add_action('admin_menu',[$this, 'create_admin_menu' ],11);
		add_action('admin_enqueue_scripts',[$this,'register_scripts_and_styles']);
	}

	public function create_admin_menu(){
		$capability = 'manage_options';
		$menu_slug = RCRC_MENU_SLUG;
		$graph = $menu_slug.'-graph';
		$settings = $menu_slug.'-settings';
		$text_domain = RCRC_DOMAIN_NAME;
		add_menu_page(
		 __('Renzo Castillo',$text_domain),
		 __('Renzo Castillo',$text_domain),
			$capability,
			$menu_slug,
			[$this,'menu_page_template'],
			'',
		);
		add_submenu_page(
			$menu_slug,
			__('Table',$text_domain),
			__('Table',$text_domain),
			$capability,
			$menu_slug,
			[$this,'menu_page_template'],
		);
		add_submenu_page(
			$menu_slug,
			__('Graph',$text_domain),
			__('Graph',$text_domain),
			$capability,
			$graph,
			[$this,'menu_page_template'],
		);
		add_submenu_page(
			$menu_slug,
			__('Settings',$text_domain),
			__('Settings',$text_domain),
			$capability,
			$settings,
			[$this,'menu_page_template'],
		);
	}

	public function register_scripts_and_styles(){
		$this->load_scripts();
		$this->load_styles();
	}

	public function load_styles(){
		wp_register_style('vue-app',RCRC_PLUGIN_URL.'dist/assets/index.css');
		wp_enqueue_style('vue-app');
	}

	public function load_scripts(){
		wp_register_script('vue-app',RCRC_PLUGIN_URL.'dist/assets/index.js',[],rand(),true);
		wp_enqueue_script('vue-app');
		$args = [
			'adminURL'=>admin_url('/'),
			'adminPath'=> '/admin.php',
			'adminPages'=> [
				'home'=>'renzo-castillo',
				'settings'=>'renzo-castillo-settings'
			],
			'ajaxURL'=>admin_url('admin-ajax.php'),
			'apiURL'=>home_url('/wp-json'),
			'basePath'=>'/wp-admin',
		];
		wp_localize_script('vue-app','wpData',
			$args
		);

		add_filter('script_loader_tag', [$this,'add_type_attribute'] , 10, 3);
	}

	function add_type_attribute($tag, $handle, $src) {
		// if not your script, do nothing and return original $tag
		if ( 'vue-app' !== $handle ) {
			return $tag;
		}
		// change the script tag by adding type="module" and return it.
		return '<script type="module" src="' . esc_url( $src ) . '"></script>';
	}

	public function menu_page_template(){
		echo '<div class="wrap"><div id="app"></div></div>';
	}

}