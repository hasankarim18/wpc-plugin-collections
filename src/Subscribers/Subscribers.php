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
            new CreateAcf(),
            new ShortCode(),
            new AdminColumnModification()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }
    }




}
