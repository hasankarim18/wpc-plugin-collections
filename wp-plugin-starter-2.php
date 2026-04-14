<?php

/*
 * Plugin Name:       Wp plugin starter 2
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 * Requires Plugins:  my-plugin, yet-another-plugin
 */




/*


define('TWSP_PLUGIN_FILE', __FILE__);
define('TWSP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TWSP_PLUGIN_URI', plugin_dir_url(__FILE__));
define('TWSP_ACF_PATH', plugin_dir_path(__FILE__) . '/lib/advanced-custom-fields/');
define('TWSP_ACF_URL', plugin_dir_url(__FILE__) . '/lib/advanced-custom-fields/');

// you also may want to use 




// activation_callback
function activation_hook_callback(){
    //# do your activation code 
}
register_activation_hook(__FILE__, 'activation_hook_callback');


// ----------------------------

// deactivation_callback 
function deactivation_hook_callback(){
    //# do your deactivation code 
}

register_deactivation_hook(__FILE__, 'deactivation_hook_callback');


use Hasan\TroviaWpSubscriptionPlus\Main;


Main::instance()->init();



*/