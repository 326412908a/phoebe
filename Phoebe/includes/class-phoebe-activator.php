<?php

class Phoebe_Activator {

	public static function activate() {

	
		self::phoebe_activation_cretable();

		self::phoebe_activation_insertdate();

		self::phoebe_update_db_check();

	}

	private static function phoebe_activation_cretable() {
		global $wpdb;
	
		$charset_collate = '';
		if (!empty($wpdb->charset)) {
		  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}
		if (!empty( $wpdb->collate)) {
		  $charset_collate .= " COLLATE {$wpdb->collate}";
		}
	
		$table_settings = $wpdb->prefix . 'phoebe_settings';
		$table_posts = $wpdb->prefix . 'phoebe_posts';
	
		   //if($wpdb->get_var("show tables like '$table_settings' ") != $table_settings) 
		  // { 
	
		$sql_settings = "CREATE TABLE $table_settings (
				id mediumint(9) NOT NULL,
				name tinytext NOT NULL,
				des text NOT NULL,
				author tinytext NOT NULL,
				url varchar(55) DEFAULT '' NOT NULL,
				theme varchar(255) NOT NULL,
				index_bg varchar(255) NOT NULL,
				ad_on varchar(255) NOT NULL,
				ad_content varchar(255) NOT NULL,
				help_content varchar(255) NOT NULL,
				reward_on varchar(255) NOT NULL,
				alipay_pic varchar(255) NOT NULL,
				wxpay_pic varchar(255) NOT NULL,
				qqpay_pic varchar(255) NOT NULL,
				msg_on varchar(255) NOT NULL,
			    public_api varchar(255) NOT NULL,
			    AppKey varchar(255) NOT NULL,
				PRIMARY KEY  (id)
			) $charset_collate;";
			 
			  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	 
			  dbDelta($sql_settings);
		  // }
	  
		//if($wpdb->get_var("show tables like '$table_posts' ") != $table_posts) 
		   //{ 
		$sql_posts = "CREATE TABLE $table_posts (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				post_id bigint(20) NOT NULL,
				post_name varchar(255) DEFAULT '' NOT NULL,
				att_name varchar(255) NOT NULL,
				att_type varchar(255) NOT NULL,
				att_size varchar(255) NOT NULL,
				att_version varchar(255) NOT NULL,
				att_author varchar(255) NOT NULL,
				att_desc varchar(255) NOT NULL,
				att_pass varchar(255) NOT NULL,
				att_links varchar(55) NOT NULL,
				att_pay tinyint(1) DEFAULT '0' NOT NULL,
				att_price varchar(255) NOT NULL,
				att_comment tinyint(1) DEFAULT '1' NOT NULL,
				att_preview varchar(55) NOT NULL,
				att_off varchar(255) DEFAULT 'on' NOT NULL,
				att_add_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				att_off_dld_url varchar(255) NOT NULL,
				PRIMARY KEY  (id),
				UNIQUE KEY  (post_id)
	
			) $charset_collate;";
	  
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
				dbDelta($sql_posts);
		//}
		
		update_option('phoebe_version',PHOEBE_VERSION);
	}

	private static function phoebe_activation_insertdate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'phoebe_settings';
		$data['name'] = 'phoebe';
		$data['desc'] = 'phoebe，一个基于Vue开发的Wordpress附件下载插件，支持附件后台独立管理。';
		$data['author']  = 'LYLARES';
		$data['url']  = 'https://www.lylares.com/phoebe.html';
		$data['theme'] = 2;
		$data['public_api'] = 'https://api.berryapi.net/';
		$data['AppKey'] = 'rPZnlscTe7xXDvTjC0YV64kjdhif1Fw1x';
		$wpdb->insert($table_name, $data);
	}

	private static function phoebe_update_db_check() {
	
		if (get_option('phoebe_version') != PHOEBE_VERSION) {
			self::phoebe_activation_cretable();
		}
	}

}
