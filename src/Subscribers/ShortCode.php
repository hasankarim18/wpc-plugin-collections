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
        if (!isset($_REQUEST['nonce']) && !wp_verify_nonce($_REQUEST['nonnce'], 'wpc_subscriber_nonce')) {
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
                <div>
                    <h2 style="text-align: center;">Get Subscribed.</h2>
                    <label for="">
                        <span>Name</span>
                        <input type="text" name="name">
                    </label>
                    <label for="">
                        <span>Email</span>
                        <input type="email" name="email">
                    </label>
                    <label for="">
                        <span>Phone Number</span>
                        <input type="text" name="phone">
                    </label>
                </div>
                <div class="wpc_subscriber_form_submit">
                    <input type="submit" value="Submit" name="wpc_subscriber_form_submit">
                </div>
                <div id="wpc_s_success_message" class="wpc_hide">
                    Subscriber added successfully.
                </div>
                <div id="wpc_s_error_message" class="wpc_hide">

                </div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}