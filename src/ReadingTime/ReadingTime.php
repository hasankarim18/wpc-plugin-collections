<?php
namespace Hasan\PostReadingTimePlus\ReadingTime;

if (!defined('ABSPATH')) {
    exit;
}


class ReadingTime
{
    function register()
    {
        $features = [
            new CalculateReadTime(),
            new MenuPage()
        ];

        foreach ($features as $feature) {
            # code...
            $feature->register();
        }


    }


}