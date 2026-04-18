<?php

namespace Hasan\WpPluginCollections\Subscribers;
if (!defined('ABSPATH')) {
    exit;
}

class CreateSubscriberPT
{
    public function register()
    {
        add_action('init', [$this, 'cptui_register_my_cpts_subscriber']);
    }

    function cptui_register_my_cpts_subscriber()
    {

        /**
         * Post Type: Subscribers.
         */

        $labels = [
            "name" => esc_html__("Subscribers", "twentytwentyfive"),
            "singular_name" => esc_html__("Subscriber", "twentytwentyfive"),
        ];

        $args = [
            "label" => esc_html__("Subscribers", "twentytwentyfive"),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => false,
            "rewrite" => ["slug" => "subscriber", "with_front" => true],
            "query_var" => true,
            "supports" => ["title"],
            "show_in_graphql" => false,
        ];

        register_post_type("subscriber", $args);
    }

}




