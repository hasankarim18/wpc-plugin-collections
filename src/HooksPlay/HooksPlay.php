<?php

namespace Hasan\PostReadingTimePlus\HooksPlay;

if (!defined('ABSPATH')) {
    exit;
}

class HooksPlay
{
    function register()
    {
        $features = [
            new TitleModify()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }
    }



}