<?php
namespace Hasan\WpPluginCollections\QuickQrCode;

if (!defined('ABSPATH')) {
    exit;
}


class QuickQrCode
{
    public function register()
    {
        $features = [
            new AdminPanel()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }

        add_filter('the_content', [$this, 'append_qr_code']);
    }


    public function append_qr_code($content)
    {
        if (!is_admin()) {
            if (is_single()) {
                $url = get_permalink();
                $qr_url = "https://quickchart.io/qr?text={$url}&dark=f00&light=0ff";
                $qr_code = "get qr code";
                ob_start();
                $scan_text = get_option('wpc_qr_scan_text', esc_html__("Scan me", WPPC_TEXT_DOMAIN));
                ?>

                <div>
                    <?php echo $content; ?>
                </div>
                <div class="qr_code">
                    <div style="
                    display: flex;
                     justify-content: center; 
                     align-items: center;
                     flex-direction:column;
                     position:fixed;
                     top:50px;
                     right:10px;
                     text-align: center;
                     ">
                        <img src="<?php echo esc_attr($qr_url); ?>" alt="">
                        <span><?php echo esc_html($scan_text); ?></span>
                    </div>

                </div>
                <?php
                return ob_get_clean();

            }
        }

        return $content;
    }
}