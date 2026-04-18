<?php

namespace Hasan\WpPluginCollections\HooksPlay;

class TitleModify
{
    public function register()
    {
        add_filter('the_title', [$this, 'upperclass_the_blog_title']);
    }

    public function upperclass_the_blog_title($title)
    {
        $new_title = strtoupper($title);
        if (!is_admin()) {
            if (is_main_query() && get_post_type() == 'post' && is_single()):
                return $new_title;

            endif;
        }

        return $title;

    }
}