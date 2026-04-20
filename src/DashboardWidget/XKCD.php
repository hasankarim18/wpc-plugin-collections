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

        add_action("wp_dashboard_setup", [$this, "register_xkcd_dashboard_setup"]);
    }

    public function register_xkcd_dashboard_setup()
    {


        wp_add_dashboard_widget('wpc_xkcd_daily_comic', 'Daily Fun Dose 😁😁😁😁', [$this, 'render_skcd_daily_comic_dashboard']);
    }

    public function fetch_comic_from_api()
    {
        $url = "https://xkcd.com/info.0.json";

        $response = wp_remote_get($url, [
            'timeout' => 10
        ]);

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        if (empty($data) || empty($data->img)) {
            return;
        }

        return $data;
    }

    public function get_comic_data()
    {
        // 1. check cache first
        $cached = get_transient(self::CACHE_KEY);

        if ($cached !== false) {
            return $cached;
        }

        // 2 fetch cache data 
        $data = $this->fetch_comic_from_api();

        if ($data) {
            // Cache for 24 hours
            set_transient(self::CACHE_KEY, $data, DAY_IN_SECONDS);
        }

        return $data;

    }


    public function render_skcd_daily_comic_dashboard()
    {
        ///  var_dump("88888888888888888888888888888888888888888888888888888888888888888888-- render xkcd");

        $data = $this->get_comic_data();

        if (!$data) {
            echo '<p>Unable to load comic at the moment. Please try again later.</p>';
            return;
        }
        ?>
        <div class="wpc_xkcd_daily_comic">
            <?php // echo plugin_dir_url(__FILE__); ?>
            <div class="wpc_xkcd_daily_comic_img">
                <img style="width:100%; max-width:385px;height:auto; " src="<?php echo esc_attr($data->img); ?>"
                    alt="<?php echo esc_attr($data->alt) ?>">
            </div>
            <h2>
                <strong> <?php echo esc_html($data->title); ?></strong>
            </h2>
        </div>
        <?php
        ;
    }


}