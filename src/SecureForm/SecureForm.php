<?php
namespace Hasan\WpPluginCollections\SecureForm;

if (!defined('ABSPATH')) {
    exit;
}

class SecureForm
{
    public function register()
    {

        add_action('init', [$this, 'init_short_code']);
        // add_action('init', [$this, 'callback_save_secure_form']);
    }

    public function init_short_code()
    {

        add_shortcode("wpc_secure_form", [$this, 'wpc_secure_form_shortcode_callback']);

        add_action('wp_ajax_action_save_secure_form', [$this, 'callback_save_secure_form_ajax']);
        add_action('wp_ajax_nopriv_action_save_secure_form', [$this, 'callback_save_secure_form_ajax']);

        // enqueue scripts 

        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script('wpc_secure-form-ajax', plugin_dir_url(__FILE__) . 'js/secure-form-ajax.js', ['jquery'], true);

            wp_localize_script("wpc_secure-form-ajax", 'sf_config', [
                'sf_nonce' => wp_create_nonce('sf_nonce'),
                'site_url' => site_url(),
                'admin_url' => admin_url(),
                'ajax_url' => admin_url('admin-ajax.php'),
                'action' => 'action_save_secure_form'
            ]);
        });


    }


    public function callback_save_secure_form_ajax()
    {
        if (!wp_verify_nonce($_REQUEST['nonce'], 'sf_nonce')) {
            wp_send_json_error('Unauthorized Request');
        }

        wp_parse_str($_REQUEST['form_data'], $post);

        if (!is_string($post['name'])) {
            wp_send_json_error('Name is not valid text');
        }

        if (!is_email($post['email'])) {
            wp_send_json_error('Email is not valid');
        }

        if (!is_numeric($post['age'])) {
            wp_send_json_error('Mobile must be number');
        }

        if (!is_string($post['message'])) {
            wp_send_json_error('Messabe must be plain text');
        }

        $sanitize = $post;
        $sanitize['name'] = sanitize_text_field($sanitize['name']);
        $sanitize['email'] = sanitize_email($sanitize['email']);
        $sanitize['age'] = intval($sanitize['age']);
        $sanitize['message'] = sanitize_textarea_field($sanitize['message']);


        wp_send_json_success($sanitize);
    }

    public function callback_save_secure_form()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['wpc_secure_form_submit']) &&
            $_POST['wpc_secure_form_submit'] === 'Submit'
        ) {
            if (
                !isset($_POST['name-wpc-secure-form-nonce']) &&
                !wp_verify_nonce(isset($_POST['name-wpc-secure-form-nonce']), 'action_wpc_secure_form_nonce')
            ) {
                die(" warning From cannot be verified");
                //  return;
            }

            if (!is_string($_POST['name'])) {
                wp_die('Error: Name must be string');
            }

            if (!is_email($_POST['email'])) {
                wp_die("Error Email is not valid");
            }

            if (!is_string($_POST['mobile']) && strlen($_POST['mobile']) >= 11) {
                wp_die('Mobile Number is not valid!!!');
            }

            if (!is_string($_POST['message'])) {
                wp_die('Message is not valid! I must be string and strip of all tags');
            }

            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_text_field($_POST['email']);
            $mobile = sanitize_text_field($_POST['mobile']);
            $message = sanitize_text_field($_POST['message']);

            $data = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'message' => $message
            ];

            // echo "<pre>";
            // echo var_dump($data);
            // echo "</pre>";



            //   die("Form is working");
            //   wp_safe_redirect(site_url('/secure-contact'));
        }
    }

    public function wpc_secure_form_shortcode_callback()
    {


        ob_start();
        include_once plugin_dir_path(__FILE__) . 'css.php';
        ?>
        <div>
            <div id="wpc-secure-plugin-data"></div>
            <form id="wpc-secure-form" method="POST">

                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email">
                </div>
                <div>
                    <label for="mobile">Age</label>
                    <input min="1" max="50" type="number" id="age" name="age">
                </div>
                <div>
                    <label for="name">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <input id="wpc_sf" type="submit" value="Submit" name="wpc_secure_form_submit">

            </form>


            <?php
            $form_html = ob_get_clean();

            return $form_html;
    }

}