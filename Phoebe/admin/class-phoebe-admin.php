<?php
if ( ! defined( 'PHOEBE_VERSION' ) ) {
	die;
}

class Phoebe_Admin {

	private $plugin_name;

	private $version;

	public function __construct($plugin_name,$version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
  
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name,'https://unpkg.com/element-ui/lib/theme-chalk/index.css', array(), $this->version, 'all');
		
		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/el-main.css', array(), $this->version, 'all');

	}

	public function enqueue_scripts() {

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/Vue.js',array(),$this->version,false);
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        wp_enqueue_style('thickbox');
      

	}
  
  public  function add_more_scrips($para){
  
    wp_enqueue_script($para , plugin_dir_url( __FILE__ ) . 'js/md5.js',array(),$para1,false);
    wp_enqueue_script($para, plugin_dir_url( __FILE__ ) . 'js/init.js',array(),$para1,false);
  
  
  }
  
  public  function add_option_rest_page(){
    
    add_menu_page( 'Phoebe', 'Phoebe', 'manage_options', 'phoebe_attach_options', 'create_admin_Page', '', 60 );
	
	
    require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/phoebe-admin-display.php';
	
  }
  
   public function phoebe_update_db_check() {
    
    if (get_option('phoebe_version') != PHOEBE_VERSION) {
        phoebe_activation_cretable();
    }
   } 
    public function left_admin_footer_text($text) {
	$text = ''; 
	return $text;
    }
	
	public function right_admin_footer_text($text) {
	$text = "";
	return $text;
    }
  
}