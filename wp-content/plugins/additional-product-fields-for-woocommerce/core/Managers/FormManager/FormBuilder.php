<?php


namespace rednaowooextraproduct\core\Managers\FormManager;


use rednaowooextraproduct\core\Loader;
use rednaowooextraproduct\core\Managers\FormManager\Fields\FBFieldBase;
use undefined\DTO\FormBuilderOptions;
use WC_Product;

class FormBuilder
{
    /** @var FormBuilderOptions */
    public $Options;
    /** @var FBRow[] */
    public $Rows;
    public $Entries;
    /** @var WC_Product */
    public $Product;

    public $OptionsUnitPrice;
    public $GrandTotal;
    public $Quantity;
    public $OptionsTotal;

    /** @var FBFieldBase[] */
    public $Fields;
    /** @var Loader */
    public $Loader;
    public function __construct($loader,$options,$entry,$product)
    {
        $this->Loader=$loader;
        $this->Fields=array();
        $this->Entries=$entry;
        $this->Options=$options;
        $this->Rows=array();
        $this->Product=$product;

        $this->OptionsUnitPrice=0;
        $this->GrandTotal=0;
        $this->Quantity=0;
        $this->OptionsTotal=0;


    }

    public function CalculationsAreValid()
    {
        foreach($this->Fields as $field)
        {
            if(!$field->Calculator->GetIsValid())
                return false;
        }

        return true;

    }
    public function GetPrice(){
        return $this->Product->get_price();
    }

    public function GetProductRegularPrice(){
        return $this->Product->get_regular_price();
    }

    public function GetProductSalePrice(){
        return $this->Product->get_sale_price();
    }

    public function Initialize(){
        foreach($this->Options->Rows as $row)
            $this->Rows[]=new FBRow($this->Loader,$this,$row);

        foreach($this->Rows as $Row)
            foreach ($Row->Columns as $Column)
                $this->Fields[]=$Column->Field;

        $this->ExecuteCalculations();

        return $this;
    }

    public function GetPriceOfNotDependantFields()
    {
        $total=0;
        foreach($this->Fields as $field)
        {
            if(!$field->Calculator->GetDependsOnOtherFields())
                $total+=$field->Calculator->GetPrice();
        }

        return $total;
    }

    private function ExecuteCalculations()
    {
        foreach($this->Fields as $field)
        {
            if(!$field->Calculator->GetDependsOnOtherFields())
                $field->Calculator->ExecuteAndUpdate();
        }


        foreach($this->Fields as $field)
        {
            if($field->Calculator->GetDependsOnOtherFields())
                $field->Calculator->ExecuteAndUpdate();
        }



        foreach($this->Fields as $field)
        {
            $this->OptionsUnitPrice+=$field->Calculator->GetPrice();
        }

        $this->OptionsTotal=$this->OptionsUnitPrice*$this->Quantity;
        $this->GrandTotal=($this->OptionsUnitPrice+$this->GetPrice())*$this->Quantity;


    }

    public function GenerateLineItems()
    {
        $lineItems=array();
        foreach($this->Fields as $field)
        {
            if($field->Entry==null)
                continue;
            $lineItems=\array_merge($lineItems,$field->GetLineItems());
        }

        return $lineItems;

    }


}