<?php

namespace Hasan\WpPluginCollections\ShortCode;

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
        add_shortcode('wpc_alert_message', [$this, 'wpc_alert_message_render']);
    }

    public function wpc_alert_message_render($atts, $content)
    {

        $attributes = shortcode_atts([], $atts);


        ob_start();
        ?>
        <p></p>
        <?php
        return ob_get_clean();

    }
}