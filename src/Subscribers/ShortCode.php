<?php

namespace Hasan\WpPluginCollections\Subscribers;

use WP_Query;

if (!defined('ABSPATH')) {
    exit;
}

class ShortCode
{
    public function register()
    {
        add_action('init', [$this, 'init']);
    }

    public function init()
    {
        add_shortcode('wpc_subscriber_shortcode', [$this, 'create_short_code']);
        // adding js
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        // adding actin

        add_action('wp_ajax_action_wpc_subscriber_form', [$this, 'ajax_handler']);
        add_action('wp_ajax_nopriv_action_wpc_subscriber_form', [$this, 'ajax_handler']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('wpc-subscriber_script', plugin_dir_url(__FILE__) . 'wpc-subscriber.js', ['jquery'], true);

        wp_localize_script('wpc-subscriber_script', 'wpc_s_vers', [
            'nonce' => wp_create_nonce('wpc_subscriber_nonce'),
            'action' => 'action_wpc_subscriber_form',
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
    }

    public function ajax_handler()
    {
        if (!isset($_REQUEST['nonce']) && !wp_verify_nonce($_REQUEST['nonce'], 'wpc_subscriber_nonce')) {
            wp_send_json_error([
                "success" => false,
                "message" => "Invalid requrest."
            ]);
        }
        // parse the data
        wp_parse_str($_REQUEST['form_data'], $post);



        $name = sanitize_text_field($post['name'] ?? '');
        $email = sanitize_text_field($post['email'] ?? '');
        $phone = wp_kses_post(($post['phone'] ?? ''));

        //  wp_send_json_success($phone);
        //  wp_send_json_success($post);
        // Basic validattion

        if (empty($name) || empty($email)) {
            wp_send_json_error([
                "success" => false,
                "message" => "Name and email must be present"
            ]);

        }

        // check duplicate email

        $existing = new WP_Query([
            'post_type' => 'subscriber',
            'posts_per_page' => 1,
            'meta_query' => [
                [
                    'key' => 'email',
                    'value' => $email,
                    'compare' => '='
                ]
            ]
        ]);

        if ($existing->have_posts()) {
            wp_send_json_error([
                "message" => "This email has already been taken."
            ]);
        }

        // create post 

        $post_id = wp_insert_post([
            'post_title' => $name,
            'post_type' => 'subscriber',
            'post_status' => 'publish'
        ]);

        if (is_wp_error($post_id)) {
            wp_send_json_error([
                "success" => false,
                "message" => "Failed to create subscriber try again!!!"
            ]);
        }


        // save meta fields 

        update_post_meta($post_id, 'email', $email);
        update_post_meta($post_id, 'number', $phone);

        // success response 

        wp_send_json_success("Subscription successful");
    }

    public function create_short_code()
    {
        ob_start();
        include_once plugin_dir_path(__FILE__) . 'wp-subscriber_css.php';
        ?>
        <div id="wpc_subscriber_form_container" class="wpc_subscriber_form_container">
            <form id="wpc_subscriber_form">
                <h2 style="text-align: center;">
                    <?php esc_html_e("Get Subscribed.", WPPC_TEXT_DOMAIN); ?>
                </h2>

                <label for="wpc_name">
                    <span>
                        <?php esc_html_e("Name", WPPC_TEXT_DOMAIN); ?>
                    </span>
                    <input id="wpc_name" type="text" name="name">
                </label>

                <label for="wpc_email">
                    <span>
                        <?php esc_html_e("Email", WPPC_TEXT_DOMAIN); ?>
                    </span>
                    <input id="wpc_email" type="email" name="email">
                </label>

                <label for="wpc_phone">
                    <span>
                        <?php esc_html_e("Phone number", WPPC_TEXT_DOMAIN); ?>
                    </span>
                    <input id="wpc_phone" type="text" name="phone">
                </label>

                <input type="submit" value="<?php esc_attr_e("Submit", WPPC_TEXT_DOMAIN); ?>" name="wpc_subscriber_form_submit">

                <div id="wpc_s_success_message" class="wpc_hide">
                    <?php esc_html_e("Subscriber added successfully.", WPPC_TEXT_DOMAIN); ?>
                </div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}