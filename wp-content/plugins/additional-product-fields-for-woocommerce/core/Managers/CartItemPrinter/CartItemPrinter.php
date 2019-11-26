<?php


namespace rednaowooextraproduct\core\Managers\CartItemPrinter;


use rednaowooextraproduct\core\Managers\FormManager\Fields\FBFieldBase;
use stdClass;

class CartItemPrinter
{
    /** @var stdClass[] */
    public $Fields;
    public function __construct($fields)
    {
        $this->Fields=$fields;
    }

    public function GetItemData()
    {
        $other_data=array();
        foreach($this->Fields as $field)
        {
            $value='';
            if(isset($field->SelectedValues))
            {
                $values=array();
                foreach($field->SelectedValues as $currentValue)
                {
                    $values[]=$currentValue->Value;
                }
                $value=\implode(', ',$values);
            }else
                if(isset($field->Value))
                    $value=$field->Value;
                else
                    continue;

            $display=null;
            $display=\apply_filters('woo_extra_products_display_'.$field->Type.'_for_cart',$display,$field);
            if($display==null)
                $display="
                    <div style='width: 100%'>
                        <label style='font-weight: bold;'>" . esc_html($field->Label) . ":</label>
                        <label> " . esc_html($value) . "</label>
                    </div>    
                ";
            if(\is_array($value)&&count($value)>0)
                $other_data[]=array('name'=>$field->Label,'value'=>$value,'field'=>$field,'key'=>'rnfield'.$field->Id,'type'=>$field->Type,'display'=>$display);
            else
            if(\is_scalar($value)&&trim($value)!='')
                $other_data[]=array('name'=>$field->Label,'value'=>$value,'field'=>$field,'key'=>'rnfield'.$field->Id,'type'=>$field->Type,'display'=>$display);
            else
                $other_data[]=array('name'=>$field->Label,'value'=>$value,'field'=>$field,'key'=>'rnfield'.$field->Id,'type'=>$field->Type,'display'=>$display);



        }

        return $other_data;
    }

}