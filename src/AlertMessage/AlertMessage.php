<?php

namespace Hasan\WpPluginCollections\AlertMessage;

if (!defined('ABSPATH')) {
    exit;
}

class AlertMessage
{
    public function register()
    {
        add_action('init', [$this, 'init']);

    }



    public function init()
    {
        add_shortcode('nice_alert_message', [$this, 'wpc_alert_message_render']);
        add_action('wp_enqueue_scripts', [$this, 'load_scripts']);
    }

    public function load_scripts()
    {
        wp_enqueue_style('alert-message-css', plugin_dir_url(__FILE__) . 'alert-message-css.css', [], 'all');
    }

    public function wpc_alert_message_render($atts, $content = null)
    {
        // Default attributes
        $attributes = shortcode_atts([
            'type' => 'info',        // success, warning, danger, info
        ], $atts);


        // #do shortcode
        $type = strtolower(trim($attributes['type']));
        $message = $content ? do_shortcode($content) : ''; // Support nested shortcodes

        // Validate type
        $allowed_types = ['success', 'warning', 'danger', 'info'];
        if (!in_array($type, $allowed_types)) {
            $type = 'info';
        }

        // Generate alert HTML
        ob_start();
        ?>
        <div class="wpc-alert wpc-alert-<?php echo esc_attr($type); ?>">
            <?php echo wp_kses_post($message); ?>
        </div>
        <?php
        return ob_get_clean();
    }
}