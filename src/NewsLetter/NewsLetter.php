<?php
namespace Hasan\WpPluginCollections\NewsLetter;
if (!defined('ABSPATH')) {
    exit;
}

use Hasan\WpPluginCollections\NewsLetter\NewsLetterOnlyEmail\NewsLetterOnlyEmail;

class NewsLetter
{
    public function register()
    {
        $features = [
            new NewsletterAdmin(),
            new NewsLetterOnlyEmail(),
            new LoadAssets()
        ];

        foreach ($features as $feature) {
            $feature->register();
        }

        // 
    }
}