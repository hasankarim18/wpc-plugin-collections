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
use Hasan\WpPluginCollections\QueryBuilder\QueryBuilder;
use Hasan\WpPluginCollections\DashboardWidget\DashboardWidget;
use Hasan\WpPluginCollections\ContactFormCollections\ContactFormCollections;
use Hasan\WpPluginCollections\AlertMessage\AlertMessage;



if (!defined('ABSPATH')) {
    exit;
}


class Main
{
    use Singleton;
    public $modules = [];
    public function init()
    {

        add_action('plugins_loaded', [$this, 'boot']);
    }

    public function loadTextDomain()
    {
        // var_dump('---------------------------------------------------' . dirname(plugin_basename(__DIR__)) . '/i18n');

    }

    public function boot()
    {

        // Initialize features, hooks, services
        // $this->reading_time = new ReadingTime();
        // $this->reading_time->register();


        //  var_dump('-----------------------------------------------------------' . WPPC_RELATIVE_PATH . '/languages');

        $modules = [
            new ReadingTime(),
            new LoadAssets(),
            new HooksPlay(),
            new QuickQrCode(),
            new SecureForm(),
            new Subscribers(),
            new QueryBuilder(),
            new DashboardWidget(),
            new ContactFormCollections(),
            new AlertMessage()
        ];



        foreach ($modules as $module) {
            $module->register();
        }

        load_plugin_textdomain(WPPC_TEXT_DOMAIN, false, WPPC_RELATIVE_PATH . '/languages');

    }
}