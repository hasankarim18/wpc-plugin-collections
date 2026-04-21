<?php


namespace Hasan\WpPluginCollections\NewsLetter;

if (!defined('ABSPATH')) {
    exit;
}

class NewsletterAdmin
{
    public function register()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        add_menu_page(
            "Newsletter",
            "Newsletter",
            "manage_options",
            'newsletter',
            [$this, 'admin_render'],
            plugin_dir_url(__FILE__) . 'assets/news-letter.png',
            100
        );

        add_submenu_page(
            'newsletter',
            "Newsletter",
            "Options",
            'manage_options',
            'newsletter',    // if slug is same it behaves same as parent
            [$this, 'admin_render']
        );
        add_submenu_page('newsletter', "Newsletter", "Options 2", 'manage_options', 'newsletter-options-2', [$this, 'options_two']);
    }

    public function admin_render()
    {
        ?>
        <div class="wrap">
            <h2>NewsLetter</h2>
            <div class="wpc_news_letter_box_container_grid">
                <div class="wpc_news_letter_box">
                    <h3> NewsLetter Only Email</h3>
                    <p>
                        <span class="wpc_newsletter_shortcode_title">Shortcode</span>
                        <span class="wpc_newsletter_shortcode">wpc_news_letter_only_email</span>
                    </p>
                </div>
                <div class="wpc_news_letter_box">
                    <h3> Details Collection</h3>
                    <p>
                        <span class="wpc_newsletter_shortcode_title">Shortcode</span>
                        <span class="wpc_newsletter_shortcode">wpc_news_letter_only_email</span>
                    </p>
                </div>
                <!--  -->
            </div>
        </div>
        <?php
    }

    public function options_two()
    {
        ?>
        option 2
        <?php
    }

}