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

    }

    public function admin_menu()
    {
        add_menu_page('QrCode', 'QrCode', 'manage_options', 'qr-code', [$this, 'qrcode_menu_page'], 'smiley', 20);
        // add submenu options page

        add_submenu_page('qr-code', "QrCode Option 1", 'Option 1', 'manage_options', 'qr-code-options', [$this, 'qrcode_menu_page']);
        add_submenu_page('qr-code', "QrCode Option 2", 'Option 2', 'manage_options', 'qr-code-options', [$this, 'qrcode_menu_page_ajax']);
    }

    public function admin_scripts($hook)
    {
        var_dump($hook);

        if ('toplevel_page_qr-code' !== $hook)
            return;
        wp_enqueue_style('wpc_qrcode_admin_menu_style', plugin_dir_url(__FILE__) . 'wpc_qrcode_admin_menu_style.css', [], 'all');
    }

    public function qrcode_menu_page()
    {
        $title = get_option('wpc_qr_code_title', 'Scan me');
        ?>
        <div class="wrap">
            <h2>Qr Code Options Save with "Admin Post"</h2>
            <form action="<?php echo admin_url('admin-post.php'); ?>">
                <?php

                wp_nonce_field('wpc_qccode_nonce_1');
                ?>
                <input type="hidden" name="action" value="wpc_qrcode_save_admin_panel_settings">
                <table>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><input value="<?php echo esc_attr($title); ?>" type="text" name="title"></td>
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


    public function qrcode_menu_page_ajax()
    {
        ?>
        <div class="wrap">
            <h2>Qr Code Options Save with "AJAX"</h2>
            <form action=""></form>
        </div>
        <?php
    }

}