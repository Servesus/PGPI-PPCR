<?php


namespace rednaowooextraproduct\core;


class FreeCartItemPrinter
{
    public function __construct()
    {
        add_filter('woo_extra_products_display_colorpicker_for_cart',array($this,'ColorPickerFormat'),10,2);
    }

    public function ColorPickerFormat($return,$value){
        $html='';
        $html.="
                    <div style='width: 100%'>
                        <label style='font-weight: bold;'>" . esc_html($value->Label) . ":</label>
                        <div style='display: inline-block;'>
                            <div style='display: inline-block; margin-right: 2px;width:10px;height:10px; border-radius: 100px; background-color: ".$value->Value."'></div>
                            <label> " . esc_html($value->Value) . "</label>    
                        </div>
                        
                    </div>    
                ";
        return $html;
    }

}