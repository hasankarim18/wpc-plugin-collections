<?php

namespace Hasan\WpPluginCollections\DashboardWidget;
if (!defined('ABSPATH')) {
    exit;
}

class DashboardWidget
{
    public function register()
    {


        $features = [
            new XKCD()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }

    }





}