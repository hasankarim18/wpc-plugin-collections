<?php
namespace Hasan\WpPluginCollections\QuickQrCode;
if (!defined('ABSPATH')) {
    exit;
}

class AdminPanel
{
    public function register()
    {

        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);

        // admin notice
        add_action('admin_notices', [$this, 'admin_notices']);


        // SAVE THE FORM ADMIN POST

        add_action('admin_post_wpc_qrcode_save_admin_panel_settings', [$this, 'save_admin_settings']);


        // SAVE THE FORM WITH AJAX

        add_action('wp_ajax_wpc_qrcode_ajax_save', [$this, 'qrcode_handle_with_ajax']);


    }

    public function admin_menu()
    {
        add_menu_page(
            'QrCode',
            'QrCode',
            'manage_options',
            'qr-code',
            [$this, 'qrcode_menu_page'],
            plugin_dir_url(__FILE__) . 'assets/qr-code.png',
            20
        );
        // add submenu options page

        add_submenu_page('qr-code', "QrCode", 'Save via Admin Post', 'manage_options', 'qr-code', [$this, 'qrcode_menu_page']);
        add_submenu_page('qr-code', "QrCode Option 2", 'Save via Ajax', 'manage_options', 'qr-code-options', [$this, 'qrcode_menu_page_ajax']);
    }

    public function admin_scripts($hook)
    {
        // var_dump('--------------------------------------------------' . $hook);

        if ('toplevel_page_qr-code' !== $hook && 'qrcode_page_qr-code-options' !== $hook)
            return;
        wp_enqueue_style('wpc_qrcode_admin_menu_style', plugin_dir_url(__FILE__) . 'wpc_qrcode_admin_menu_style.css', [], 'all');

        wp_enqueue_script('wpc_qrcode_script', plugin_dir_url(__FILE__) . 'wpc_qrcode_script.js', ['jquery'], true);

        wp_localize_script('wpc_qrcode_script', 'wpc_qr_code', [
            'nonce' => wp_create_nonce('wpc_qrcode_nonce'),
            'action' => 'wpc_qrcode_ajax_save',
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
    }

    public function save_admin_settings()
    {
        $scan_text = $_POST['scan_text'];
        update_option('wpc_qr_scan_text', $scan_text);

        wp_safe_redirect(admin_url('admin.php?page=qr-code&status=success'));
        //    exit;
    }

    public function qrcode_menu_page()
    {
        $scan_text = get_option('wpc_qr_scan_text', 'Scan me');
        ?>
        <div class="wrap">
            <h2>Qr Code Options Save with "Admin Post"</h2>
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <?php

                wp_nonce_field('wpc_qccode_nonce_1');
                ?>
                <input type="hidden" name="action" value="wpc_qrcode_save_admin_panel_settings">
                <table>
                    <tr>
                        <td><label for="title">Scan text</label></td>
                        <td><input value="<?php echo esc_attr($scan_text); ?>" type="text" name="scan_text"></td>
                    </tr>
                    <!-- submit -->
                    <tr>
                        <td>
                            <input type="submit" value="submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
    }

    public function admin_notices()
    {
        if (isset($_GET['status']) && 'success' == $_GET['status']) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p>Settings saved successfully</p>
            </div>
            <?php
        }
    }

    // SAVE VIA AJAX⬇️

    public function qrcode_handle_with_ajax()
    {
        if (
            !isset($_REQUEST['nonce']) &&
            !wp_verify_nonce($_REQUEST['nonce'], 'wpc_qrcode_nonce')
        ) {
            wp_send_json_error("Invalid request");
        }

        wp_parse_str($_REQUEST['form_data'], $post);

        $scan_text = sanitize_text_field($post['scan_text']);

        update_option('wpc_qr_scan_text', $scan_text);

        wp_send_json_success($post);
    }


    public function qrcode_menu_page_ajax()
    {
        $scan_text = get_option('wpc_qr_scan_text', 'Scan me');
        ?>
        <div class="wrap">
            <h2>Qr Code Options Save with "AJAX"</h2>
            <form id="wpc_qrcode_ajax_form" method="POST" ?>
                <table>
                    <tr>
                        <td><label for="title">Scan text</label></td>
                        <td><input value="<?php echo esc_attr($scan_text); ?>" type="text" name="scan_text"></td>
                    </tr>
                    <!-- submit -->
                    <tr>
                        <td>
                            <input type="submit" value="submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
    }

}