<?php

namespace Hasan\WpPluginCollections\DashboardWidget;

if (!defined('ABSPATH')) {
    exit;
}

class XKCD
{
    const CACHE_KEY = 'wpc_xkcd_daily_comic_data';

    public function register()
    {
        add_action('init', [$this, 'init']);
    }

    public function init()
    {
        add_action('wp_dashboard_setup', [$this, 'register_xkcd_dashboard_setup']);
    }

    public function register_xkcd_dashboard_setup()
    {
        wp_add_dashboard_widget(
            'wpc_xkcd_daily_comic',
            'Daily Fun Dose 😁',
            [$this, 'render_xkcd_daily_comic_dashboard']
        );
    }

    /**
     * Fetch comic from API
     */
    private function fetch_comic_from_api()
    {
        $url = "https://xkcd.com/info.0.json";

        $response = wp_remote_get($url, [
            'timeout' => 10,
        ]);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        if (empty($data) || empty($data->img)) {
            return false;
        }

        return $data;
    }

    /**
     * Get comic (cached or fresh)
     */
    private function get_comic_data()
    {
        // 1. Check cache first
        $cached = get_transient(self::CACHE_KEY);

        if ($cached !== false) {
            return $cached;
        }

        // 2. Fetch fresh data
        $data = $this->fetch_comic_from_api();

        if ($data) {
            // Cache for 24 hours
            set_transient(self::CACHE_KEY, $data, DAY_IN_SECONDS);
        }

        return $data;
    }

    /**
     * Render dashboard widget
     */
    public function render_xkcd_daily_comic_dashboard()
    {
        $data = $this->get_comic_data();

        if (!$data) {
            echo '<p>Unable to load comic at the moment. Please try again later.</p>';
            return;
        }
        ?>

        <div class="wpc_xkcd_daily_comic">
            <div class="wpc_xkcd_daily_comic_img">
                <img style="width:100%; max-width:400px;height:auto;" src="<?php echo esc_url($data->img); ?>"
                    alt="<?php echo esc_attr($data->alt); ?>">

                <p style="margin-top:10px;">
                    <?php echo esc_html($data->title); ?>
                </p>
            </div>
        </div>

        <?php
    }
}