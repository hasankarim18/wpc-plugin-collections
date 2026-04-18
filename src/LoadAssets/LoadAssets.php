<?php

namespace Hasan\WpPluginCollections\LoadAssets;



class LoadAssets
{
    public function register()
    {
        // #load admin_assets 

        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts_callback']);
    }

    public function admin_enqueue_scripts_callback($screen)
    {
        // var_dump("kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk");

        if ($screen == 'tools_page_prtp-read-time') {
            wp_enqueue_script('prtp_load_js', WPPC_PLUGIN_URI . '/src/Assets/js/main.js', ['jquery'], true);
            wp_enqueue_style('prtp_style', WPPC_PLUGIN_URI . '/src/Assets/css/main.css', [], 'all');
        }



    }
}