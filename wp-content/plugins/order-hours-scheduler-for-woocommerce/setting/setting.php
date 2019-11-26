<?php
namespace Zhours;

use \Zhours\Aspect\Page, \Zhours\Aspect\TabPage, \Zhours\Aspect\Box;

defined('ABSPATH') or die('No script kiddies please!');

require_once __DIR__ . '/../functions.php';

$setting = new Page('order hours');

do_action('get_setting_page', $setting);

add_action('init', function (){
    $roles = ['shop_manager','administrator'];
    array_walk($roles, function ($role_name) {
        $role = get_role($role_name);
        $role->add_cap('zhours_manage_options', true);
    });
});

$setting
    ->setArgument('capability', 'zhours_manage_options')
    ->setArgument('parent_slug', 'woocommerce');

$setting->scope(function (Page $setting) {
    if ($setting->isRequested()) {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('zhours-style', plugin_dir_url(__FILE__) . '/setting.css');
            wp_enqueue_script('zhours-script', plugin_dir_url(__FILE__) . '/setting.js', ['jquery']);
        });
    }

    $schedule = new TabPage('schedule');
    $schedule->setArgument('capability', 'zhours_manage_options');

    $alertbar = new TabPage('alert bar');
    $alertbar->setArgument('capability', 'zhours_manage_options');

    $alertbutton = new TabPage('alert button');
    $alertbutton->setArgument('capability', 'zhours_manage_options');

    $add_on = new TabPage('add-ons');
    $add_on->setArgument('capability', 'zhours_manage_options');

    $setting->attach($schedule, $alertbar, $alertbutton, $add_on);

    $schedule->scope(function (TabPage $schedule) {
        $status = new Box('status');
        $status->attachTo($schedule);

        $enable = new Input('order hours status');

        $force_status = new Box('force status');
        $force_status
            ->setLabel('singular_name', 'Force Override Store Schedule')
            ->attachTo($schedule)
            ->scope(function ($box) {
                $rewrite = new Input('force rewrite status');
                $rewrite
                    ->setLabel('singular_name', 'Turn-on Force Override')
                    ->setArgument('default', false)
                    ->attachTo($box)
                    ->attach([true, ''])
                    ->setType(Input::TYPE_CHECKBOX);

                $status = new Input('force status');
                $status
                    ->setLabel('singular_name', 'Ordering Status')
                    ->setArgument('default', false)
                    ->attachTo($box)
                    ->setType(Input::TYPE_SELECT)
                    ->attach([false, 'Disabled'], [true, 'Enabled']);
            });

        $days_schedule = new Box('days schedule');
        $days_schedule->attachTo($schedule);

        $period = new Input('period');
        $period
            ->attachTo($days_schedule)
            ->setType(Input::TYPE_DAYS_PERIODS);

        $holidays_schedule = new Box('holidays schedule');
        $holidays_schedule->attachTo($schedule);

        $holidays_calendar = new Input('holidays calendar');
        $holidays_calendar
            ->attachTo($holidays_schedule)
            ->setType(Input::TYPE_HOLIDAYS_SCHEDULE);

        $cache = new Box('cache management');
        $cache->attachTo($schedule);

        $enable_cache_clearing = new Input('enable cache clearing');
        $enable_cache_clearing
            ->setArgument('default', false)
            ->setLabel('singular_name',  'Enable cache clearing')
            ->setLabelText('Website cache will be cleared for each scheduled store open and close event')
            ->setDescription('Important: Clearing the website cache may impact website loading speed and performance. Only locally stored cache is cleared, server side cache services are not cleared.')
            ->attachTo($cache)
            ->attach([true, ''])
            ->setType(Input::TYPE_CHECKBOX);


        $description = call_user_func(function () {
            if (get_current_status()) {
                $color = 'green';
                $current_status = 'open';
            } else {
                $color = 'red';
                $current_status = 'closed';
            }
            $current_status = strtoupper($current_status);
            $time = \date_i18n('H:i');
            return "<span style='background-color: $color; padding: 10px; display: inline-block; color: white; font-style: normal; line-height: 1;'>Current time: $time. Status: $current_status</span>";;
        });

        $enable
            ->setArgument('default', 0)
            ->setArgument('description', $description)
            ->attachTo($status)
            ->setType(Input::TYPE_SELECT)
            ->attach([0, 'Disabled'], [1, 'Enabled']);

    });

    $alertbar->scope(function (TabPage $alertbar) {
        $options = new Box('options');
        $options
            ->attachTo($alertbar)
            ->setLabel('singular_name', 'Alert Bar Options for Sitewide Notice');

        $hide_alert_bar = new Input('hide alert bar');
        $hide_alert_bar
            ->setLabel('singular_name', 'Hide Alert Bar')
            ->setType(Input::TYPE_CHECKBOX_EDIT_ONE_ROW)
            ->setArgument('default', false)
            ->attach([true, ''])
            ->setLabelText('Allow Customer to Hide Alert Bar')
            ->setClass('one-row-input')
            ->setDescription('Custom text for hide button, leave blank for icon only');

        $message = new Input('message');
        $message
            ->setLabel('singular_name', 'Alert Bar Message');

        $size = new Input('font size');
        $size
            ->setArgument('default', 16)
            ->setArgument('min', 1)
            ->setType(Input::TYPE_NUMBER)
            ->setLabel('singular_name', 'Alert Bar Font Size');

        $color = new Input('color');
        $color
            ->setType(Input::TYPE_COLOR)
            ->setLabel('singular_name', 'Alert Bar Color');

        $bg_color = new Input('background color');
        $bg_color
            ->setType(Input::TYPE_COLOR)
            ->setLabel('singular_name', 'Alert Bar Background Color');

        $alert_bar_position = new Input('alert bar position');
        $alert_bar_position
            ->setArgument('default', 'Bottom')
            ->setLabel('singular_name', 'Alert Bar Position')
            ->setType(Input::TYPE_RADIO)
            ->attachFew(array(
                'top'=> "Top",
                'bottom'=>  'Bottom',
                'custom' => 'Custom'
            ));
        $custom_position = new Input('custom position');
        $custom_position
            ->setType(Input::TYPE_TEXT)
            ->setLabel('singular_name', 'Custom Position (CSS)')
            ->setArgument('description', 'Custom align position top or bottom eg.: top: 20px or bottom: 10px')
            ->setClass('custom-position-input');

        $options->attach($hide_alert_bar, $message, $size, $color, $bg_color, $alert_bar_position, $custom_position);
    });

    $alertbutton->scope(function (TabPage $alertbutton) {

        $cart_functionality = new Box('cart functionality');
        $cart_functionality
            ->attachTo($alertbutton)
            ->setLabel('singular_name', 'Add to Cart Functionality');

        $hide = new Input("hide");
        $hide
            ->setArgument('default', false)
            ->setLabel('singular_name', 'Hide Add to Cart button if Closed')
            ->attachTo($cart_functionality)
            ->attach([true, ''])
            ->setType(Input::TYPE_CHECKBOX)
            ->setClass('reverse');

        $options = new Box('options');
        $options
            ->attachTo($alertbutton)
            ->setLabel('singular_name', 'Alert Button Options for Checkout');

        $text = new Input('text');
        $text->setLabel('singular_name', 'Alert Button Text');

        $size = new Input('font size');
        $size
            ->setArgument('default', 16)
            ->setArgument('min', 1)
            ->setType(Input::TYPE_NUMBER)
            ->setLabel('singular_name', 'Alert Button Font Size');

        $color = new Input('color');
        $color
            ->setType(Input::TYPE_COLOR)
            ->setLabel('singular_name', 'Alert Button Color');

        $bg_color = new Input('background color');
        $bg_color
            ->setType(Input::TYPE_COLOR)
            ->setLabel('singular_name', 'Alert Button Background Color');

        $options->attach($text, $size, $color, $bg_color);
    });

    $add_on->scope(function (TabPage $add) {
        $plugins = new Box('plugins');
        $plugins
            ->setLabel('singular_name', 'Plugins')
            ->attachTo($add);

        $delivery_plugin = new Input('');
        $delivery_plugin
            ->setType(Input::TYPE_CARD_PLUGIN)
            ->setLabelText('Delivery and Pickup Functionality')
            ->setDescription('Allow customers to select delivery time or pickup date time to checkout for orders')
            ->setPluginHookName('order_hours_delivery_is_exist')
            ->setLink('https://www.bizswoop.com/wp/orderhours/delivery')
            ->attachTo($plugins);
    });
});
