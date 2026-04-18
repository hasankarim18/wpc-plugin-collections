<?php

namespace Hasan\WpPluginCollections\Subscribers;

if (!defined('ABSPATH')) {
    exit;
}

class Subscribers
{


    public function register()
    {
        $features = [
            new CreateSubscriberPT(),
            new CreateAcf()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }
    }




}
