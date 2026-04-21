<?php

namespace Hasan\WpPluginCollections\NewsLetter;

if (!defined('ABSPATH')) {
    exit;
}


class LoadAssets
{
    public function register()
    {
        // load frontend assets
        add_action('wp_enqueue_scripts', [$this, 'newsletter_front_end_scripts']);
        // load admin assets

        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }

    public function newsletter_front_end_scripts()
    {
        wp_enqueue_style('wpc_newsletter_frontend_style', plugin_dir_url(__FILE__) . 'assets/newsletter-frontend.css', [], 'all');
    }

    public function admin_enqueue_scripts($hook)
    {
        wp_enqueue_style('wpc_newsletter_admin_style', plugin_dir_url(__FILE__) . 'assets/newsletter-admin.css', [], 'all');
    }
}