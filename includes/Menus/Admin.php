<?php

namespace Includes\Menus;

class Admin {
	public function __construct(){
		add_action('admin_menu',[$this, 'create_admin_menu' ]);
		add_action('admin_enqueue_scripts',[$this,'register_scripts_and_styles']);
	}

	public function create_admin_menu(){
		global $submenu;
		$capability = 'manage_options';
		$admin_path = '/wp-admin/admin.php?page=';
		$page_slug = RCRC_MENU_SLUG;
		$page_path = $admin_path.$page_slug;
		$text_domain = RCRC_DOMAIN_NAME;
		add_menu_page(
		 __('Renzo Castillo',$text_domain),
		 __('Renzo Castillo',$text_domain),
			$capability,
			$page_slug,
			[$this,'menu_page_template'],
			'',
		);

		if(current_user_can($capability)){
			$submenu[$page_slug][]=[__('Renzo Castillo',$text_domain),$capability,$page_path.'#/'];
			$submenu[$page_slug][]=[__('Settings',$text_domain),$capability,$page_path.'#/settings'];
		}
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
			'ajaxURL'=>admin_url('admin-ajax.php'),
			'apiURL'=>home_url('/wp-json'),
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
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		return $tag;
	}

	public function menu_page_template(){
		echo '<div class="wrap"><div id="app"></div></div>';
	}

}