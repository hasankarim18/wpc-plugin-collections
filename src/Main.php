<?php
// #declare proper namespaces 
namespace Hasan\WpPluginCollections;


// #Uncomment and write proper namespaces
use Hasan\WpPluginCollections\App\Singleton;
use Hasan\WpPluginCollections\HooksPlay\HooksPlay;
use Hasan\WpPluginCollections\ReadingTime\ReadingTime;
use Hasan\WpPluginCollections\LoadAssets\LoadAssets;
use Hasan\WpPluginCollections\QuickQrCode\QuickQrCode;
use Hasan\WpPluginCollections\SecureForm\SecureForm;
use Hasan\WpPluginCollections\Subscribers\Subscribers;



if (!defined('ABSPATH')) {
    exit;
}


class Main
{
    use Singleton;
    public $modules = [];
    public function init()
    {
        //  add_action('plugins_loaded', [$this, 'loadTextDomain']);
        add_action('plugins_loaded', [$this, 'boot']);
    }

    public function loadTextDomain()
    {
        load_plugin_textdomain(
            'trovia-wp-subscription-plus',
            false,
            dirname(plugin_basename(WPPC_PLUGIN_FILE)) . '/i18n'
        );
    }

    public function boot()
    {

        // Initialize features, hooks, services
        // $this->reading_time = new ReadingTime();
        // $this->reading_time->register();


        $modules = [
            'reading_time' => new ReadingTime(),
            'load_assets' => new LoadAssets(),
            'hooks_play' => new HooksPlay(),
            'quick_qr_code' => new QuickQrCode(),
            'secure_form' => new SecureForm(),
            'subscriber' => new Subscribers()
        ];



        foreach ($modules as $key => $module) {
            $module->register();
        }

    }
}