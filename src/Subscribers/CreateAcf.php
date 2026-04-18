<?php

namespace Hasan\WpPluginCollections\Subscribers;

if (!defined('ABSPATH')) {
    exit;
}


class CreateAcf
{

    public function register()
    {
        add_action('acf/include_fields', function () {
            if (!function_exists('acf_add_local_field_group')) {
                return;
            }

            acf_add_local_field_group(array(
                'key' => 'group_69e33722efbf0',
                'title' => 'Subscriber field',
                'fields' => array(
                    array(
                        'key' => 'field_69e33723bdebf',
                        'label' => 'Email',
                        'name' => 'email',
                        'aria-label' => '',
                        'type' => 'email',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_69e3374fbdec0',
                        'label' => 'Number',
                        'name' => 'number',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'min' => '',
                        'max' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'step' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'subscriber',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
                'display_title' => '',
                'allow_ai_access' => false,
                'ai_description' => '',
            ));
        });


    }
}


