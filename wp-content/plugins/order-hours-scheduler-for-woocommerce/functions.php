<?php
namespace Zhours;

defined('ABSPATH') or die('No script kiddies please!');

use Zhours\Aspect\InstanceStorage, Zhours\Aspect\Page, Zhours\Aspect\TabPage, Zhours\Aspect\Box, Zhours\Aspect\Ajax;

function get_current_status() {
    if (!plugin_enabled()) return true;
    list($rewrite, $status) = InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('schedule')->scope(function (TabPage $schedule) {
                $force_status = Box::get('force status');
                return $force_status->scope(function ($box) use ($schedule) {
                    $rewrite = Input::get('force rewrite status');
                    $rewrite = $rewrite->getValue($box, null, $schedule);
                    $status = Input::get('force status');
                    $status = $status->getValue($box, null, $schedule);
                    return [$rewrite, $status];
                });
            });
        });
    });

    if($rewrite) { // return force status if enabled
        return $status;
    }
    $periods = get_day_periods();
    if (!$periods)
        return;

    $holidays_calendar = get_holidays();

    $holidays = explode(', ', $holidays_calendar);
    if (is_holiday($holidays)) return false;

    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    $current_index = \date_i18n('N') - 1;
    $current_index = $days[$current_index];

    $today = isset($periods[$current_index]) ? $periods[$current_index] : null;

    if (!$today) {
        return false;
    }

    $time = \date_i18n('H:i');

    $matches = array_filter($today, function ($element) use ($time) {
        return $time >= $element['start'] && $time <= $element['end'];
    });
    return count($matches) !== 0;
}

function get_status_on_special_date($date) {
    $time = $date[1];
    $date = $date[0];
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    $day_of_week = date('N', strtotime($date));
    $periods = get_day_periods();
    $day = $days[$day_of_week - 1];
    if (isset($periods[$day])) {
        $matches = array_filter($periods[$day], function ($element) use ($time) {
            return $time >= $element['start'] && $time <= $element['end'];
        });
        return count($matches) !== 0;

    }
    return false;
}

function is_holiday($dates) {
    if (!$dates) return false;
    $date_format = check_date_format();
    $today = date($date_format, current_time( 'timestamp' ));
    foreach ($dates as $date){

        if ($today == $date){
            return true;
        }
    }
}

function check_date_format() {
    $standartFormat = 'd/m';
    $wpFormat = get_option('date_format');
    $wpFormat = preg_replace('/(\/y)|(y-)|(-y)|(.y)|(y)/i', '', $wpFormat);
    if (preg_match('/(d)|(m)/i', $wpFormat)) {
        return $wpFormat;
    } else return $standartFormat;
}

function plugin_enabled() {
    return InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
            return Page::get('order hours')->scope(function () {
                return TabPage::get('schedule')->scope(function (TabPage $schedule) {
                    $status = Box::get('status');
                    $enabled = Input::get('order hours status');
                    return $enabled->getValue($status, null, $schedule);
                });
            });
        }) === '1';
}

function get_alertbutton() {
    list ($hide, $text, $size, $color, $bg_color) = InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('alert button')->scope(function (TabPage $alertbutton) {
                $options = Box::get('options');
                $hide = Input::get('hide');
                $text = Input::get('text');
                $size = Input::get('font size');
                $color = Input::get('color');
                $bg_color = Input::get('background color');
                $values = [$hide, $text, $size, $color, $bg_color];

                return array_map(function (Input $value) use ($options, $alertbutton) {
                    return $value->getValue($options, null, $alertbutton);
                }, $values);
            });
        });
    });

    $color = ($color) ? $color : 'black';
    $bg_color = ($bg_color) ? $bg_color : 'transparent';

    ?>

    <style>
        .zhours_alertbutton {
            color: <?= $color; ?>;
            background-color: <?= $bg_color; ?>;
        <?php
         if ($hide && get_current_status()) {
         ?>
            display: none;
        <?php } ?>
            display: none;
            padding: <?= $size; ?>px;
            font-size: <?= $size; ?>px;
            line-height: 1;
        }
    </style>
    <div class="zhours_alertbutton">
        <?= $text; ?>
    </div>
    <?php
}

function is_enable_cache_clearing() {
    return InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('schedule')->scope(function (TabPage $schedule) {
                $days_schedule = Box::get('cache management');
                $cache_clearing = Input::get('enable cache clearing');
                return $cache_clearing->getValue($days_schedule, null, $schedule);
            });
        });
    });
}

function is_hide_add_to_cart() {
    return InstanceStorage::getGLobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('alert button')->scope(function (TabPage $alertbutton) {
                $cart_functionality = Box::get('cart functionality');
                $hide = Input::get('hide');
                return $hide->getValue($cart_functionality, null, $alertbutton);
            });
        });
    });
}

function get_day_periods() {
    return InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('schedule')->scope(function (TabPage $schedule) {
                $days_schedule = Box::get('days schedule');
                $period = Input::get('period');
                return $period->getValue($days_schedule, null, $schedule);
            });
        });
    });
}

function get_holidays() {
    return InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('schedule')->scope(function (TabPage $schedule) {
                $holidays_schedule = Box::get('holidays schedule');
                $calendar = Input::get('holidays calendar');
                return $calendar->getValue($holidays_schedule, null, $schedule);
            });
        });
    });
}

function get_alertbar()
{
    if(isset($_COOKIE['not_show_alert_bar']))
        return null;

    list($hide_alert_bar, $message, $size, $color, $bg_color, $alert_position, $custom_position) = InstanceStorage::getGlobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('alert bar')->scope(function (TabPage $alertbar) {
                $options = Box::get('options');
                $hide_alert_bar = Box::get('hide alert bar');
                $message = Input::get('message');
                $size = Input::get('font size');
                $color = Input::get('color');
                $bg_color = Input::get('background color');
                $alert_position = Input::get('alert bar position');
                $custom_position = Input::get('custom position');
                $values = [$hide_alert_bar, $message, $size, $color, $bg_color, $alert_position, $custom_position];
                return array_map(function (Input $value) use ($options, $alertbar) {
                    return $value->getValue($options, null, $alertbar);
                }, $values);
            });
        });
    });
    $color = ($color) ? $color : 'black';
    $bg_color = ($bg_color) ? $bg_color : 'white';
    ?>
    <style>
        .zhours_alertbar {
        <?php
        if ($alert_position === 'Top'): ?>
            top: 0;
        <?php elseif ($alert_position === 'Custom' && $custom_position) :
            echo $custom_position . ';';
        else : ?>
            bottom: 0;
        <?php endif; ?>
            z-index: 1000;
            position: fixed;
            width: 100%;
            color: <?= $color; ?>;
            background-color: <?= $bg_color; ?>;
            padding: <?= $size; ?>px;
            font-size: <?= $size; ?>px;
            line-height: 1;
            text-align: center;
        }

        .zhours_alertbar-space {
            height: <?=$size*3?>px;
        }
    </style>

    <div class="zhours_alertbar-space"></div>
    <div class="zhours_alertbar">
        <?= $message; ?>
        <?php
        if ($hide_alert_bar && isset($hide_alert_bar['checkbox'])) : ?>
            <div class="zhours_alertbar-close-box">
                <?php
                if (isset($hide_alert_bar['edit']) && $hide_alert_bar['edit']) : ?>
                    <span class="close-box-icon"> <?= $hide_alert_bar['edit'] ?> </span>
                <?php endif; ?>
                <img id="zhours_alertbar-close" src="<?= esc_url( plugins_url( 'assets/close_icon.png', __FILE__ ) ) ?>" alt="Close" >
            </div>
        <?php endif; ?>
    </div>
    <style>
        .zhours_alertbar-close-box {
            display: inline-block;
            float: right;
        }
        .close-box-icon {
            position: relative;
            top: -5px;
            right: 5px;
        }
        .zhours_alertbar-close-box img{
            cursor: pointer;
            width: 20px;
            display: inline-block !important;
        }
    </style>
    <script>
        jQuery(document).ready(function ($) {
            $('#zhours_alertbar-close').on('click', function () {
                $('.zhours_alertbar').fadeOut();
                $('.zhours_alertbar-space').fadeOut();
                var now = new Date();
                now.setTime(now.getTime() + 7 * 24 * 3600 * 1000);
                document.cookie = "not_show_alert_bar=true; expires=" + now.toUTCString() + "; domain=<?= get_formatted_site_url() ?>;path=/";
            });
        });
    </script>
    </script>
    <?php
}

function get_formatted_site_url() {
    $url = get_site_url();
    $host = parse_url($url, PHP_URL_HOST);
    $names = explode(".", $host);

    if(count($names) == 1) {
        return $names[0];
    }

    $names = array_reverse($names);
    return $names[1] . '.' . $names[0];
}

function get_add_on_plugins() {
    return InstanceStorage::getGLobalStorage()->asCurrentStorage(function () {
        return Page::get('order hours')->scope(function () {
            return TabPage::get('add-ons')->scope(function (TabPage $alertbutton) {
                $box = Box::get('plugins');
                return $box;
            });
        });
    });
}

function check_if_holiday($date) {
    $date = date(check_date_format(), strtotime($date));
    $holidays = get_holidays();
    $holidays = explode(', ', $holidays);
    foreach ($holidays as $holiday) {
        if (strpos($date, $holiday) !== false)
            return true;
    }
    return false;
}

function get_date_from_day_of_the_week($day, $is_cycled = false) {
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $date = new \DateTime();
    if (in_array(strtolower($day), $days)) {
        if ($is_cycled)
            $date->modify('+1 day');
        $day_of_week = strtolower(date('l', $date->getTimestamp()));
        while ($day_of_week !== $day) {
            $date->modify('+1 day');
            $day_of_week = strtolower(date('l', $date->getTimestamp()));
        }
    }
    return $date;
}

function cache_cleaner($is_cycled = false) {
    if (!is_enable_cache_clearing()) {
        if (wp_next_scheduled( 'zhours_cache_clear_open' )) {
            wp_clear_scheduled_hook( 'zhours_cache_clear_open' );
        }
        if (wp_next_scheduled( 'zhours_cache_clear_close' )) {
            wp_clear_scheduled_hook( 'zhours_cache_clear_close' );
        }
        return;
    }
    if (wp_next_scheduled( 'zhours_cache_clear_open' ) && wp_next_scheduled( 'zhours_cache_clear_close' ) ) {
        return;
    }
    $all_periods = get_day_periods();
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $current_index = \date_i18n('N') - 1;
    $current_date_time = date_i18n( 'Y-m-d H:i:s');
    $day_of_week = strtolower(date('l', strtotime($current_date_time)));
    foreach ($all_periods as $key => $day_periods) {
        if (!$is_cycled && array_search($key, $days) < $current_index)
            continue;
        foreach ($day_periods as $val => $period) {
            $start = get_date_from_day_of_the_week($key, $is_cycled);
            $start->setTime(explode(':', $period['start'])[0], explode(':', $period['start'])[1]);
            $start = $start->format('Y-m-d H:i:s');
            $end = get_date_from_day_of_the_week($key, $is_cycled);
            $end->setTime(explode(':', $period['end'])[0], explode(':', $period['end'])[1]);
            $end = $end->format('Y-m-d H:i:s');
            if ($current_date_time < $start) {
                if( !wp_next_scheduled( 'zhours_cache_clear_open' ) ) {
                    $time_offset = date('Y-m-d H:i:s', strtotime('-' . get_option('gmt_offset') . ' hours', strtotime($start)));
                    wp_schedule_event(strtotime($time_offset), 'daily', 'zhours_cache_clear_open');
                }
                if( !wp_next_scheduled( 'zhours_cache_clear_close' ) ) {
                    $time_offset = date('Y-m-d H:i:s', strtotime('-' . get_option('gmt_offset') . ' hours', strtotime($end)));
                    wp_schedule_event(strtotime($time_offset), 'daily', 'zhours_cache_clear_close');
                }
            }
            if ($current_date_time > $start && $current_date_time < $end) {
                if( !wp_next_scheduled( 'zhours_cache_clear_close' ) ) {
                    $time_offset = date('Y-m-d H:i:s', strtotime('-' . get_option('gmt_offset') . ' hours', strtotime($end)));
                    wp_schedule_event(strtotime($time_offset), 'daily', 'zhours_cache_clear_close');
                }
            }
            if (wp_next_scheduled( 'zhours_cache_clear_open' ) && wp_next_scheduled( 'zhours_cache_clear_close' ) ) {
                return;
            }
            if ($is_cycled && $day_of_week === $key) {
                return;
            }
            if (end($all_periods) === $day_periods) {
                cache_cleaner(true);
            }
        }
    }
}

add_filter('pre_option_zhours_current_status', function () {
    return get_current_status() ? "yes" : "no";
});

add_filter('check_if_store_hours_is_opened', function ($date) {
    return get_status_on_special_date($date) ? true : false;
});

add_filter('check_if_holiday', function ($date) {
    return check_if_holiday($date) ? true : false;
});

add_filter('get_period_schedule_by_day', function ($day) {
    return isset(get_day_periods()[$day]) ? get_day_periods()[$day] : null;
});

add_filter('body_class', function ($classes) {
    if (!get_current_status())
        $classes[] = 'zhours-closed-store';
    return $classes;
});
function zhours_cache_clear($status){
    delete_directory(ABSPATH . 'wp-content/cache/');
    wp_clear_scheduled_hook( 'zhours_cache_clear_' . $status );
    cache_cleaner();
}

function delete_directory($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK );

        foreach( $files as $file ){
            delete_directory( $file );
        }
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );
    }
}

add_action('zhours_cache_clear_open', function () {
    zhours_cache_clear('open');
});

add_action('zhours_cache_clear_close', function () {
    zhours_cache_clear('close');
});