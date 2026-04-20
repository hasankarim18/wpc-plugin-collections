<?php

namespace Hasan\WpPluginCollections\ContactFormCollections;

use Hasan\WpPluginCollections\ContactFormCollections\BasicContactForm\BasicContactForm;

if (!defined('ABSPATH')) {
    exit;
}

class ContactFormCollections
{
    public function register()
    {
        $features = [
            new BasicContactForm()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }
    }



}