<?php
namespace Hasan\WpPluginCollections\ReadingTime;

if (!defined('ABSPATH')) {
    exit;
}


class MenuPage
{
    function register()
    {
        add_action(
            'admin_menu',
            [$this, 'admin_menu_callback']
        );
    }


    function admin_menu_callback()
    {
        add_management_page('Read time', 'Read time', 'manage_options', 'prtp-read-time', [$this, 'prtp_menu']);
    }

    public function prtp_menu()
    {
        if (isset($_POST['prtp_submit'])) {
            if (!isset($_POST['prtp_nonce']) || !wp_verify_nonce($_POST['prtp_nonce'], 'prtp_save_nonce')) {
                return;
            }
            $start_message = sanitize_text_field($_POST['start_message']);
            $end_message = sanitize_text_field($_POST['end_message']);
            $wpm = sanitize_text_field($_POST['wpm']);

            update_option('prtp_start_message', $start_message);
            update_option('prtp_end_message', $end_message);
            update_option('prtp_wpm', $wpm);

        }

        ?>
        <div class="wrap">
            <h2>Read time</h2>
            <form method="post">
                <?php
                wp_nonce_field('prtp_save_nonce', 'prtp_nonce');
                ?>
                <label for="">
                    <span>Start Message</span>
                    <input value="<?php echo esc_attr(get_option('prtp_start_message', 'Estimated read time: ')); ?>"
                        type="text" name="start_message">
                </label>
                <label for="">
                    <span>End Message</span>
                    <input value="<?php echo esc_attr(get_option('prtp_end_message', ' min.')); ?>" type="text"
                        name="end_message">
                </label>
                <label for="">
                    <span>Words per minute</span>
                    <input value="<?php echo esc_attr(get_option('prtp_wpm', 100)); ?>" type="number" min="100" step="20"
                        name="wpm">
                </label>
                <button type="submit" name="prtp_submit" class="button button-primary">Save Settings</button>
            </form>
        </div>
        <?php
    }
}