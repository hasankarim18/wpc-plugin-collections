<?php

namespace Hasan\PostReadingTimePlus\ReadingTime;

if (!defined('ABSPATH')) {
    exit;
}

class CalculateReadTime
{
    function register()
    {
        add_filter('the_content', [$this, 'calcualte_reading_time']);
    }

    function calcualte_reading_time($content)
    {
        $word_count = (int) str_word_count(strip_tags($content));
        $show_read_time = apply_filters('trtp_show_read_time', get_option('trtp_show_read_time', true));
        // 🔥 Filter: words per minute
        $word_num = apply_filters('prtp_words_per_minute', get_option('prtp_wpm', 100));

        $reading_time = ceil($word_count / (int) $word_num);

        // 🔥 Filter: start message
        $start_message = apply_filters('prtp_start_message', get_option('prtp_start_message', 'Estimated read time: '));

        // 🔥 Filter: end message
        $end_message = apply_filters('prtp_end_message', get_option('prtp_end_message', ' min.'));

        // 🔥 Final output filter (very important)
        $output = '<p>' . $start_message . $reading_time . $end_message . '</p>';

        $output = apply_filters('prtp_output_html', $output, $reading_time, $word_count);

        ob_start();
        if ($show_read_time):
            ?>
            <div>
                <p>Considered wpm: <?php echo $word_num; ?></p>
                <p>
                    <?php echo $output; ?>
                </p>

            </div>
            <?php
        endif;
        echo $content;
        ?>
        <?php
        return ob_get_clean();
    }

}