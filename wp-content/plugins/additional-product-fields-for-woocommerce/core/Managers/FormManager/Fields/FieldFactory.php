<?php


namespace rednaowooextraproduct\core\Managers\FormManager\Fields;


use Exception;
use rednaowooextraproduct\core\Managers\FormManager\FBColumn;
use undefined\DTO\FBFieldBaseOptions;

class FieldFactory{
    /**
     * @param $column FBColumn
     * @param $fieldOptions FBFieldBaseOptions
     */
    public static function GetField($loader,$column,$fieldOptions,$entry=null)
    {
        switch ($fieldOptions->Type)
        {
            case 'text':
            case 'textarea':
            case 'datepicker':
            case 'colorpicker':
                return new FBTextField($loader, $column,$fieldOptions,$entry);
            case 'radio':
            case 'checkbox':
            case 'dropdown':
                return new FBMultipleOptionsField($loader,$column,$fieldOptions,$entry);
            case 'paragraph':
            case 'divider':
                return new FBNoneField($loader,$column,$fieldOptions,$entry);
            case 'datepicker ':



        }

        $field=null;
        $field=\apply_filters('woo-extra-product-get-field-by-type',$field,$loader,$fieldOptions->Type,$column,$fieldOptions,$entry);

        if($field==null)
            throw new Exception('Invalid field type '.$fieldOptions->Type);

        return $field;
    }

}