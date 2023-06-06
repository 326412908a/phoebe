<?php
if ( ! defined( 'PHOEBE_VERSION' ) ) {
	die;
}

class Phoebe {
	protected $loader;
	protected $plugin_name;
	protected $version;
	public function __construct() {
		if ( defined( 'PHOEBE_VERSION' ) ) {
			$this->version = PHOEBE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
        
        if ( defined( 'PHOEBE_AUTH_IP' ) ) {
			$this->_AUTH_IP = PHOEBE_AUTH_IP;
		} else {
			$this->_AUTH_IP = '192.0.0.0';
		}
        
        if ( defined( 'PHOEBE_AUTH_DOMIAN' ) ) {
			$this->_AUTH_DOMIAN = PHOEBE_AUTH_DOMIAN;
		} else {
			$this->_AUTH_DOMIAN = '0.0.0.0';
		}
      
		$this->plugin_name = 'Phoebe';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/libs.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-public-libs.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-phoebe-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-phoebe-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-phoebe-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-phoebe-public.php';
		$this->loader = new Phoebe_Loader();
	}

	private function set_locale() {
		$plugin_i18n = new Phoebe_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new Phoebe_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_option_rest_page');
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action('plugins_loaded',$plugin_admin, 'phoebe_update_db_check');
		$this->loader->add_filter('admin_footer_text',$plugin_admin,'left_admin_footer_text'); 
		$this->loader->add_filter('update_footer',$plugin_admin,'right_admin_footer_text', 11); 

	}

	private function define_public_hooks() {
		$plugin_public = new Phoebe_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $this->loader->add_action('init',$plugin_public,'enqueue_scripts_styles_init');
        $this->loader->add_action('rest_api_init',$plugin_public,'add_phoebe_rest_api');
		$this->loader->add_action('query_vars', $plugin_public, 'phoebe_add_query_vars');
        $this->loader->add_action("template_redirect",$plugin_public,'phoebe_ui_redirect');
		$this->loader->add_action('query_vars', $plugin_public,'phoebe_add_pay_vars');
        $this->loader->add_action("template_redirect",$plugin_public,'phoebe_pay_redirect');
        $this->loader->add_action('the_content',$plugin_public,'phoebe_attr_to_show');

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
