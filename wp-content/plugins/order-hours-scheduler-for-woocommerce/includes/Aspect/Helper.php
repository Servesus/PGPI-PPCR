<?php
namespace Zhours\Aspect;

use \ZZHoursDelivery\InputDelivery;

defined('ABSPATH') or die('No script kiddies please!');

class Helper
{
    public static function copyrightYear($start_year)
    {
        $current_year = date('Y');

        if ($current_year > $start_year) return $start_year . '-' . $current_year;
        return $current_year;
    }
    public static function times($times, $callback) {
        for($_i = 0; $_i < $times; $_i++) {
            call_user_func($callback);
        }
    }
    public static function ifChildInputMethod ($method) {
        if (!class_exists(InputDelivery::class))
            return false;
        $parent_class = get_class_methods(Input::class);
        $child_class = get_class_methods(InputDelivery::class);
        $output = array_merge(array_diff($parent_class, $child_class), array_diff($child_class, $parent_class));
        return in_array($method, $output);
    }
}
