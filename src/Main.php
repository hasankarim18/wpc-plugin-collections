<?php
// #declare proper namespaces 
namespace Hasan\PostReadingTimePlus;


// #Uncomment and write proper namespaces
use Hasan\PostReadingTimePlus\App\Singleton;
use Hasan\PostReadingTimePlus\HooksPlay\HooksPlay;
use Hasan\PostReadingTimePlus\ReadingTime\ReadingTime;
use Hasan\PostReadingTimePlus\LoadAssets\LoadAssets;



if (!defined('ABSPATH')) {
    exit;
}


class Main
{
    use Singleton;

    public $reading_time;
    public $load_assets;
    public $hooks_play;

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
            dirname(plugin_basename(PRTP_PLUGIN_FILE)) . '/i18n'
        );
    }

    public function boot()
    {
        // Initialize features, hooks, services
        $this->reading_time = new ReadingTime();
        //  $this->reading_time->register();

        // load assets 
        $this->load_assets = new LoadAssets();
        $this->load_assets->register();

        // hooks play
        $this->hooks_play = new HooksPlay();
        $this->hooks_play->register();

    }
}