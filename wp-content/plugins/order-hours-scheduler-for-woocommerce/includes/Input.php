<?php
namespace Zhours;

use Zhours\Aspect\Box;

defined('ABSPATH') or die('No script kiddies please!');

class Input extends \Zhours\Aspect\Input
{
    const TYPE_DAYS_PERIODS = 'DaysPeriod';
    const TYPE_HOLIDAYS_SCHEDULE = 'HolidaysSchedule';
    const TYPE_DELIVERY_CHECKBOX = 'DeliveryCheckbox';
    const TYPE_CHECKBOX_EDIT_ONE_ROW = 'CheckBoxEditOneRow';
    const TYPE_CARD_PLUGIN = 'CardPlugin';

    public function htmlDaysPeriod($post, $parent)
    {
        $base_name = $this->nameInput($post, $parent);
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $value = $this->getValue($parent, null, $post);
        $value = (array)maybe_unserialize($value);

        foreach ($days as $day) {
            if (!isset($value[$day])) {
                $value[$day] = [];
            }
        }
        ?>
        <div class="aspect_days_periods">
            <div class="aspect_days_tabs">
                <?php foreach ($days as $day) { ?>
                    <a href="#" data-day="<?= esc_attr($day); ?>"><?php _e(ucwords($day)); ?></a>
                <?php } ?>
            </div>

            <?php foreach ($days as $day) {
                $day_period = $value[$day];
                $input_name = $base_name . '[' . esc_attr($day) . ']';
                ?>
                <div class="aspect_day_period" data-day="<?= esc_attr($day); ?>" data-base=<?= $base_name; ?>>
                    <table>
                        <thead>
                        <tr>
                            <th>Opening</th>
                            <th>Closing</th>
                            <td>
                                <button class="aspect_day_add button">+</button>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($day_period) === 0) {
                            $day_period = [['start' => null, 'end' => null]];
                        }
                        foreach ($day_period as $id => $period) {
                            $name = $input_name . '[' . $id . ']';
                            ?>
                            <tr class="aspect_period" data-id="<?= $id; ?>">
                                <td><input type="time" name="<?= $name; ?>[start]"
                                           class="aspect_day_start"
                                           value="<?= $period['start'] ?>"></td>
                                <td><input type="time" name="<?= $name; ?>[end]"
                                           class="aspect_day_end"
                                           value="<?= $period['end'] ?>"></td>
                                <td>
                                    <button class="aspect_day_delete button">&times;</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
        <?php
    }

    public function htmlHolidaysSchedule($post, $parent)
    {
        $base_name = $this->nameInput($post, $parent);
        $value = $this->getValue($parent, null, $post);
        $value = (array)maybe_unserialize($value);

        if (!isset($value[0])) {
            $value[0] = [];
        }
        $date_format = get_option('date_format');
        $input_name = $base_name;
        ?>

        <div class="aspect_holidays_calendar">
        <div class="aspect_holidays_tab">
            <table>
                <td>
                    <input type="text" id="date_picker" readonly="readonly" name="<?= $input_name ?>" value="<?= $value[0]; ?>">
                </td>
                <td>
                    <p>Click on Text Box to Open Calendar and Select Your Holidays</p>
                </td>
            </table>
        </div>

        <script>
            jQuery(document).ready(function () {
                function checkDateFormat(){
                    standartFormat = 'dd/mm';
                    wpFormat = '<?= $date_format ?>'.replace(/(\/y)|(y-)|(-y)|(.y)|(y)/ig, "");
                    if ((wpFormat.match(/m/ig) || []).length === 1) {
                        wpFormat = wpFormat.replace('m', 'mm');
                    }
                    if ((wpFormat.match(/d/ig) || []).length === 1) {
                        wpFormat = wpFormat.replace('d', 'dd');
                    }
                    if (/d/i.test(wpFormat)){
                        return wpFormat;
                    } else return standartFormat;
                }

                jQuery('#date_picker').multiDatesPicker({
                    dateFormat: checkDateFormat(),
                    showButtonPanel: true
                });
            });
        </script>
        <?php
    }

    public function htmlCheckboxEditOneRow($post, $parent) {
        $base_name = $this->nameInput($post, $parent);
        $value = $this->getValue($parent, null, $post);
        $classes = $this->getClass();

        if (!isset($value['checkbox']))
            $value['checkbox'] = false;
        ?>
                <label class="<?= $classes ?>"><input type="checkbox" <?php self::isChecked($value['checkbox']); ?>
                          name="<?= $base_name ?>[checkbox]"
                          value="1>">&nbsp;<?= $this->getLabelText() ?></label>

               <input class="large-text code <?= $classes ?>" type="text"
               name="<?= $base_name ?>[edit]"
               id="<?= $base_name ?>"
               value="<?= isset($value['edit']) ? $value['edit'] : '' ?>"/>
        <?php
            if (!empty($this->getDescription())) { ?>
                <p class="right-description-highlight description"> <?= $this->getDescription() ?></p>
                <?php
            }
        ?>
        <?php
    }

    public function htmlCardPlugin($post, $parent) {
        $plugins = get_add_on_plugins();
        ?>
        <div class="plugins-area">
        <?php
        foreach ($plugins->attaches as $key => $plugin) {
        ?>
            <div class="card-box-plugin" id="<?= $key ?>">
                <div class="card-box-header">
                    <?= $plugin->getLabelText() ?>
                </div>
                <div class="card-box-description">
                    <?= $plugin->getDescription() ?>
                </div>
                <div class="card-box-footer">
                    <div class="card-box-left-footer">
                    <?php
                        if (!has_action($plugin->getPluginHookName())) {
                            ?>
                            <span class="dot dot-enable"></span> <span><a href="<?= admin_url('plugins.php') ?>">Enable</a></span>
                            <?php
                        } else {
                            ?>
                            <span class="dot dot-active"></span><span>Active</span>
                            <?php
                        }
                     ?>
                    </div>
                    <div class="card-box-right-footer">
                        <a href="<?= $plugin->getLink() ?>">More info</a>
                    </div>
                </div>

            </div>
            <?php } ?>
        </div>
        <style>
        html th{
            width: 0 !important;
        }
        </style>
        <?php
    }
}
