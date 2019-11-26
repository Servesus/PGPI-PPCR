<?php


namespace rednaowooextraproduct\core\Managers\FormManager\Calculator;




use Exception;
use rednaowooextraproduct\core\Managers\FormManager\Fields\FBFieldBase;
use rednaowooextraproduct\pr\Managers\FormManager\Calculator\GroupOfFieldsInGroupCalculator;
use rednaowooextraproduct\pr\Managers\FormManager\Calculator\PricePerDayCalculator;

class CalculatorFactory
{
    /**
     * @param $field FBFieldBase
     * @return
     */
    public static function GetCalculator($field)
    {
        switch ($field->Options->PriceType)
        {
            case 'fixed_amount':
                return new FixedAmountCalculator($field);
            case 'current_value':
                return new CurrentValueCalculator($field);
            case 'quantity':
                return new QuantityCalculator($field);
            case 'percent_of_original_price':
                return new PercentOfOriginalPriceCalculator($field);
            case 'percent_or_original_price_plus_options':
                return new PercentOfOriginalPricePlusOptionsCalculator($field);
            case 'price_per_char':
                return new PricePerCharCalculator($field);
            case 'price_per_word':
                return new PricePerWordCalculator($field);
            case 'none':
                return new NoneCalculator($field);
            case 'options':
                return new OptionsCalculator($field);
            case 'price_per_item':
                return new PricePerItemCalculator($field);
            case 'sum_of_fields_in_group':
                return new GroupOfFieldsInGroupCalculator($field);
            case 'price_per_day':
                return new PricePerDayCalculator($field);



        }

        throw new Exception('Undefined calculator'.$field->Options->PriceType);
    }
}