<?php
if ( ! defined( 'PHOEBE_VERSION' ) ) {
	die;
}

class Phoebe_Public {
	private $plugin_name;
	private $version;
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	public function enqueue_styles() {
      if(is_single()){
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/phoebe-public.css', array(), $this->version, 'all' );
      }
	}
	public function enqueue_scripts() {
      if(is_single()){
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/phoebe-public.js', array( 'jquery' ), $this->version, false );
      }
	}
  public function enqueue_scripts_styles_init() {
    wp_register_script( 'phoebe_restapi', '' );
	wp_localize_script( 'phoebe_restapi', 'phoebe_framework', array( 'route' => esc_url_raw( rest_url() ), 'nonce' => wp_create_nonce( 'wp_rest' ) ) );
    wp_enqueue_script( 'phoebe_restapi' );
  }
  public function phoebe_add_pay_vars($public_query_vars){
	$public_query_vars[] = 'phoebe_pay'; 
    return $public_query_vars;
  }
    public function phoebe_pay_redirect(){
	global $wp;
	global $wp_query;
	$query =  $wp_query->query_vars['phoebe_pay'];  
    if (isset($query)&&$query){ 
        $sets = $this->get_settings();
		$blog_title = get_bloginfo('name');
		$alipay_url =  $sets->alipay_pic;
		$wxpay_url =  $sets->wxpay_pic;
		$qqpay_url =  $sets->qqpay_pic;
		require plugin_dir_path( __FILE__ ) . 'partials/phoebe-pay-display.php';   
        exit;
		} 
    }
  
  public function phoebe_add_query_vars($public_query_vars){
	$public_query_vars[] = 'download'; 
    return $public_query_vars;
  }
  
  public function phoebe_ui_redirect(){
		global $wp;
		global $wp_query;
		$id =  $wp_query->query_vars['download'];  
		if (isset($id)&&$id){ 
		    $current_url = home_url(add_query_arg(array(),$wp->request));
            $post_id = intval(trim($id));
			$totalUser = get_total_cmt_user($post_id,$which=0);
			$poster = wp_get_attachment_image_src(get_post_thumbnail_id($post_id));
            $poster = $poster[0];
            $blog_title = get_bloginfo('name');
            $posts = $this->get_att_meta($post_id);
            $sets = $this->get_settings();
            //print_r($current_url);
            //print_r($sets);
            
            $qrcode_api = $sets->public_api;
            $cookie = $_COOKIE;
            $curruser = $this->userCommentStatus($post_id,$cookie);
			require plugin_dir_path( __FILE__ ) . 'partials/phoebe-public-display.php';   
            exit;
		}   
  } 
  ///////
 public function userCommentStatus($id,$cookie){
	global $table_prefix;
	global $wpdb;
	$admin = $this->adminCheck($cookie);
	if($admin =='logined')
	{
	    return true;	
		
	}else{
	
	$email = $this->getCommentUser($cookie);
	
	if(!$email)
	{
		return false;
	}
	
	$commentsTable = $table_prefix.'comments';

	$sql = "SELECT * FROM $commentsTable WHERE comment_post_ID = '$id' and comment_approved ='1'and comment_author_email = '$email' limit 1";

	$res =  $wpdb->get_results($sql);

	if($res)
	{
		return true;
		
	}else{
		
		return false;
	}
	}
}


public function getCommentUser($cookie)
{
	
	foreach($cookie as $key =>$value)
{
	preg_match("/(.*?)@(.*)/",$value,$temp);

	if(count($temp)>=3)
	{
		return  $value;
	}
}
}


public function adminCheck($cookie)
{

	$currentUser = $this->getAdmininfo();
	$currrntEmail = $currentUser['uemail'];
	$currrntUser = $currentUser['uname'];
	
	foreach($cookie as $key =>$value)
    {
	    
		preg_match('/wordpress_logged(.*)/',$key,$tmp);

		if($tmp)
		{

			preg_match('/'.$currrntUser.'(.*?)/',$value,$tmp2);
			
			if($tmp2[0]==$currrntUser)
			{
				return true;
			}else{
			
			    return false;
		    }
		}
	   
    }
	
}

public function getAdmininfo()
{
	global $table_prefix;
	global $wpdb;
	
	$table = $table_prefix.'users';
	
	$sql = "SELECT * FROM $table WHERE ID = '1' LIMIT 1";

	$res =  $wpdb->get_results($sql);
	
	return array(
	'uname'=>$res[0]->user_login,
	'uemail'=>$res[0]->user_email
	);
	
}

public function getOripost($currPostid){
	global $table_prefix;
    global $wpdb;

	$table = $table_prefix.'posts';

  $sql = "SELECT post_title FROM $table WHERE ID = '$currPostid' LIMIT 1";

  $res =  $wpdb->get_results($sql);
  
  $currPostitle = $res[0]->post_title;
	
  return $currPostitle;
}

public function user_status($post_id){

    $email = null;
    $user_ID = (int) wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;

        $admin_email = get_the_author_meta('user_email',1);
        if ($email == $admin_email) {
            return true;
        }
    }elseif(isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
    	
            $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
            
    	
    } else {
        return false;
    }
    if(empty($email)) {
        return false;
    }

    global $wpdb;
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return true;
        } else {
        return false;
        	
    }
}
  
  
  //////
public function get_settings(){
 
    global $wpdb;
	
	$table_name = $wpdb->prefix . 'phoebe_settings';
	
	$res = $wpdb->get_row("SELECT * FROM $table_name where id= 0");
	
	return $res;

 
 
 } 
  
  public function get_att_meta($id){
	
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'phoebe_posts';
	
	$res = $wpdb->get_row("SELECT * FROM $table_name where post_id= '$id'");
	
	return $res;
	
	
}
  public function add_phoebe_rest_api(){
  
   register_rest_route('vue/phoebe', 'v1/get_rencentposts/', array(
    'methods' => 'post',
    'callback' => 'get_rencentposts_by_RestAPI',
  ));
  
  register_rest_route('vue/phoebe', 'v1/add_attachment/', array(
    'methods' => 'post',
    'callback' => 'add_attachment_by_RestAPI',
  ));
	  
  register_rest_route('vue/phoebe', 'v1/get_attachinfo/', array(
    'methods' => 'post',
    'callback' => 'user_get_attachinfo_by_RestAPI',
  ));

  register_rest_route('vue/phoebe', 'v1/get_attachlist/', array(
    'methods' => 'post',
    'callback' => 'get_attachlist_by_RestAPI',
  ));
  
  register_rest_route('vue/phoebe', 'v1/get_attachment/', array(
    'methods' => 'post',
    'callback' => 'get_attachment_by_id',
  ));
  
  register_rest_route('vue/phoebe', 'v1/refresh_attachment/', array(
    'methods' => 'post',
    'callback' => 'refresh_attachment_by_id',
  ));
 
  register_rest_route('vue/phoebe', 'v1/get_phoebe_settings/', array(
    'methods' => 'post',
    'callback' => 'get_phoebe_settings',
  ));
   
  register_rest_route('vue/phoebe', 'v1/update_phoebe_settings/', array(
    'methods' => 'post',
    'callback' => 'update_phoebe_settings',
  ));

    register_rest_route( 'vue/phoebe', 'v1/get_posts', array(
      'methods' => 'post',
      'callback' => 'get_attachpost'
    ) );
 
    register_rest_route( 'vue/phoebe', 'v1/get_hisdata', array(
      'methods' => 'post',
      'callback' => 'get_hisdata'
    ) );
 
    register_rest_route( 'vue/phoebe', 'v1/update_hisdata', array(
      'methods' => 'POST',
      'callback' => 'get_hisdata'
    ) );
  
  
  }
  
  public function phoebe_attr_to_show($content)
{
	if(is_single())
	{
		$post_id = get_the_ID();
        $is_commented =  $this->user_status($post_id);
        if(!$is_commented){
            $is_commented = $this->userCommentStatus($post_id,$_COOKIE);
        }
      
        $posts = $this->get_att_meta($post_id);
        $activator = $posts->att_off;
        $att_pwd_cmt_require = $posts->att_comment;
        $att_password = $posts->att_pass;
        $att_name = $posts->att_name;
        $att_version = $posts->att_version;
        $att_preview_url = $posts->att_preview;

        if($att_pwd_cmt_require && !$is_commented){
            $att_password = "请评论本文！通过后密码在此处显示。";
        }
		$preview_contents ="";
		if($att_preview_url){
		    $preview_contents .= '<a class="phoebe_post_pre" rel="external nofollow" href="'.$att_preview_url.'" target="_blank">附件预览
		</a> ';
		
		}
		if($activator){
		    $content .= '<br>';
		    $content .= 
		  '<div class="phoebe_post_preview">
	        <div class="phoebe_post_title">
		          <h4 class="phoebe_title">附件信息</h4>
		          <div class="phoebe_curr_name">附件名：'.$att_name.'</div>
		          <div class="phoebe_curr_version">当前版本：<code>v'.$att_version.'</code></div>
          </div>
	        <div class="phoebe_post_pre_dlinks">		
              <a class="phoebe_post_dlinks" rel="external nofollow" href="'.site_url().'/?download='.$post_id.'" target="_blank">下载附件
					    </a>
					    '.$preview_contents.'      
          </div>
      </div>';
		}
	}
	return $content;
}

}
