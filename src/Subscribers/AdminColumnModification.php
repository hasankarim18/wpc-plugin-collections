<?php

namespace Hasan\WpPluginCollections\Subscribers;

if (!defined('ABSPATH')) {
    exit;
}

class AdminColumnModification
{
    public function register()
    {
        add_action('init', [$this, 'init']);
    }

    public function init()
    {
        // #setp-1 Add custom columns
        add_filter('manage_subscriber_posts_columns', [$this, 'add_custom_columns']);

        // #step-2 Populate Column Data 

        add_action('manage_subscriber_posts_custom_column', [$this, 'poplulate_column_data'], 10, 2);

        // #step-3 Make columns sorttable 

        add_filter('manage_edit-subscriber_sortable_columns', [$this, 'make_column_sortable']);

        // step 4 Enable Sorting Logic 

        add_action('pre_get_posts', [$this, 'enable_sorting_logic']);

    }

    // #step 1

    public function add_custom_columns($columns)
    {
        // Remove unwanted columns if needed
        unset($columns['date']);

        $columns['email'] = 'Email';
        $columns['mobile'] = 'Mobile';
        $columns['date'] = 'Date';

        return $columns;
    }


    // #step 2

    public function poplulate_column_data($column, $post_id)
    {
        if ($column === 'email') {
            echo esc_html(get_post_meta($post_id, 'email', true));
        }

        if ($column === 'mobile') {
            echo esc_html(get_post_meta($post_id, 'number', true));
        }
    }

    // #step 3

    public function make_column_sortable($columns)
    {
        $columns['email'] = 'email';
        //  $columns['mobile'] = 'mobile';
        return $columns;
    }

    // #step 4

    public function enable_sorting_logic($query)
    {
        if (!is_admin() || !$query->is_main_query())
            return;

        if ($query->get('post_type') !== 'subscriber')
            return;

        if ($query->get('orderby') === 'email') {
            $query->set('meta_key', 'email');
            $query->set('orderby', 'meta_value');
        }

        // if ($query->get('orderby') === 'mobile') {
        //     $query->set('meta_key', 'mobile');
        //     $query->set('orderby', 'meta_value');
        // }

    }



}