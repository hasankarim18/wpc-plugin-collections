<?php

namespace Hasan\WpPluginCollections\NewsLetter\NewsLetterOnlyEmail;

if (!defined('ABSPATH')) {
    exit;
}


class NewsLetterOnlyEmail
{
    public function register()
    {
        add_action('init', [$this, 'init']);
    }


    public function init()
    {
        add_shortcode('wpc_news_letter_only_email', [$this, 'render_shortcode']);
    }

    public function get_user_ip()
    {
        return "User Ip";
    }

    public function handle_form()
    {
        $email = "";
        $ip_address = $this->get_user_ip();
        $post_data = [
            'post_title' => "Newsletter Subscription" . '$email',
            'post_content' => sprintf(
                "Email: %s\IP Address: %s\nSubscribed on:%s",
                $email,
                $ip_address,
                current_time('mysql')
            )
        ];

        $post_id = wp_insert_post($post_data);
    }

    public function render_shortcode($atts, $content)
    {
        ob_start();
        ?>
        <div class="wpc_news_letter_only_email">
            <form>
                <h2>NewsLetterOnlyEmail</h2>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }


}