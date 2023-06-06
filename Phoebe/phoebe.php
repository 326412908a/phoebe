<?php

/**
 * @link              https://www.lylares.com/phoebe.html
 * @since             1.0.0
 * @package           Phoebe
 *
 * @wordpress-plugin
 * Plugin Name:       Phoebe
 * Plugin URI:        https://www.lylares.com/phoebe.html
 * Screenshot:        https://support.lylares.com/static/images/007vLMz8ly1g2czurl67aj31kd0u0dgn.jpg
 * Description:       Phoebe是一款基于Vue设计开发的响应式Wordpress附件独立页下载插件。
 * Version:           1.2.5
 * Author:            LYLARES
 * Author URI:        https://www.lylares.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Phoebe
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'PHOEBE_VERSION', '1.2.5' );
define('PHOEBE_MINIMUM_WP_VERSION', '4.0');
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
require('phoebe_user_auth.php');
require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-updates/plugin-update-checker.php';
    $ExampleUpdateChecker = PucFactory::buildUpdateChecker(
	'https://support.lylares.com/api/check/version?autoupdate=1',
	__FILE__
    );
function activate_Phoebe() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-phoebe-activator.php';
	Phoebe_Activator::activate();
}
function deactivate_Phoebe() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-phoebe-deactivator.php';
	Phoebe_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_Phoebe' );
register_deactivation_hook( __FILE__, 'deactivate_Phoebe' );
require plugin_dir_path( __FILE__ ) . 'includes/class-phoebe.php';
function Run_Phoebe() {
	$plugin = new Phoebe();
	$plugin->run();
}
Run_Phoebe();
