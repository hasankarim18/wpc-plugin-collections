<?php
namespace Hasan\WpPluginCollections\QueryBuilder;

use WP_Query;

if (!defined('ABSPATH')) {
    exit;
}
class QueryBuilder
{
    public function register()
    {
        add_action('init', [$this, 'init']);
    }

    public function init()
    {
        add_shortcode('wpc_query_builder_1', [$this, 'query_builder_1']);
    }

    public function query_builder_1()
    {
        ob_start();
        ?>
        <h2><?php esc_html_e('Query Builder 1', WPPC_TEXT_DOMAIN); ?></h2>
        <?php
        $args = [
            'post_type' => ['post'],
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => [

                'relation' => 'OR',
                [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => 'quia',
                    //  'operator' => 'IN',
                    //  'includes_children' => true

                ],
                [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => 'rem'
                ]
            ]
        ];
        $query_one = new WP_Query($args);

        if ($query_one->have_posts()):
            ?>
            <table>
                <tr>
                    <th>Post title</th>
                    <th>Publish date</th>
                    <th>Category</th>
                </tr>
                <?php
                while ($query_one->have_posts()) {
                    $query_one->the_post();
                    $terms = get_the_terms(get_the_ID(), 'category');
                    ?>
                    <tr>
                        <td style="margin:5px">
                            <a href="<?php echo esc_attr(get_the_permalink()); ?>"><?php esc_html(the_title()); ?></a>
                        </td>
                        <td style="margin:5px"><?php echo esc_html(get_the_date()); ?></td>
                        <td style="margin:5px"><?php

                        // foreach ($terms as $term) {
                        //     echo "<span style='margin-right:10px;border:0.5px solid black; padding:5px;border-radius:10px'>" . $term->name . ' </span>';
                        // }
        
                        $term_lists = wp_list_pluck($terms, 'name');
                        echo implode(', ', $term_lists);

                        ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
            wp_reset_postdata();
        endif;
        ?>
        <?php
        return ob_get_clean();

    }

}