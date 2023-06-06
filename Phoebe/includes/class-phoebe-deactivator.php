<?php

class Phoebe_Deactivator {

	public static function deactivate() {

		self::plugin_deactivation_deltable();

	}

	private static function plugin_deactivation_deltable() {
      
		global $wpdb;
		$phoebe_settings = $wpdb->prefix .'phoebe_settings';
		$phoebe_posts = $wpdb->prefix .'phoebe_posts';
		//$wpdb->query("DROP TABLE IF EXISTS $phoebe_settings");
		//$wpdb->query("DROP TABLE IF EXISTS $phoebe_posts");
		delete_option('phoebe_version');
      
	}

}
