<?php

/*
 * Plugin Name:       POST Reading time plus
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
 * Text Domain:       post-reading-time-plus
 * Domain Path:       /i18n
 * 
 */


namespace Hasan\PostReadingTimePlus;



define('PRTP_PLUGIN_FILE', __FILE__);
define('PRTP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PRTP_PLUGIN_URI', plugin_dir_url(__FILE__));

require_once __DIR__ . '/vendor/autoload.php';

use Hasan\PostReadingTimePlus\Main;


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
