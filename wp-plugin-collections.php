<?php

/*
 * Plugin Name:       Wp plugin Collections
 * Plugin URI:        https://hasan.com/plugins/post-reading-time-plus/
 * Description:       Show the reading time of each post
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hasan
 * Author URI:        https://author.hasan.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain:       wp-plugin-collections
 * Domain Path:       /languages
 * 
 */


namespace Hasan\WpPluginCollections;



define('WPPC_PLUGIN_FILE', __FILE__);
define('WPPC_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WPPC_PLUGIN_URI', plugin_dir_url(__FILE__));
define('WPPC_TEXT_DOMAIN', 'wp-plugin-collections');

// 
define('WPPC_ACF_PATH', plugin_dir_path(__FILE__) . '/lib/advanced-custom-fields/');
define('WPPC_ACF_URL', plugin_dir_url(__FILE__) . '/lib/advanced-custom-fields/');
define('WPPC_RELATIVE_PATH', dirname(plugin_basename(__FILE__)));


// acf inincluded for the 6.8.01 for subscriber module
include_once(WPPC_ACF_PATH . 'acf.php');
require_once __DIR__ . '/vendor/autoload.php';




use Hasan\WpPluginCollections\Main;


add_action('plugins_loaded', function () {

});

Main::instance()->init();







/*


define('TWSP_PLUGIN_FILE', __FILE__);
define('TWSP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TWSP_PLUGIN_URI', plugin_dir_url(__FILE__));
define('TWSP_ACF_PATH', plugin_dir_path(__FILE__) . '/lib/advanced-custom-fields/');
define('TWSP_ACF_URL', plugin_dir_url(__FILE__) . '/lib/advanced-custom-fields/');

// you also may want to use 

/*


//1. activation_callback
function activation_hook_callback()
{
    //# do your activation code 
    // for example create database table 
}
register_activation_hook(__FILE__, 'activation_hook_callback');


// ----------------------------

//2. deactivation_callback 
function deactivation_hook_callback()
{
    //# do your deactivation code 
    // for example remove or clene database talbe when plugin deactivated
}

register_deactivation_hook(__FILE__, 'deactivation_hook_callback');

//3. when plugin is deleted 
function register_uninstall_hook_callback()
{
    //# do your code when plugin is deleted from site
    // for example remove or clene database talbe when plugin deactivated
}

register_uninstall_hook(__FILE__, 'plugin_deleted');


*/
