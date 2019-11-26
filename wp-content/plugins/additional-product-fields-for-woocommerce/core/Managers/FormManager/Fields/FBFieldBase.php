<?php


namespace rednaowooextraproduct\core\Managers\FormManager\Fields;

use Exception;
use rednaowooextraproduct\core\Loader;
use rednaowooextraproduct\core\Managers\FormManager\Calculator\CalculatorBase;
use rednaowooextraproduct\core\Managers\FormManager\Calculator\CalculatorFactory;
use rednaowooextraproduct\core\Managers\FormManager\Calculator\NoneCalculator;
use rednaowooextraproduct\core\Managers\FormManager\FBColumn;
use undefined\DTO\FBFieldBaseOptions;

abstract class FBFieldBase
{
    /** @var FBFieldBaseOptions */
    public $Options;
    /** @var FBColumn */
    public $Column;
    public $Entry;
    /** @var CalculatorBase */
    public $Calculator;
    /** @var Loader */
    public $Loader;
    public function __construct($loader, $fbColumn, $options,$entry=null)
    {
        $this->Loader=$loader;
        $this->Column=$fbColumn;
        $this->Options=$options;

        $this->Entry=null;
        if($entry==null&&$this->Column!=null)
            foreach ($this->Column->Row->Form->Entries->Fields as $currentEntry )
            {
                if(!\is_array($currentEntry)&&$currentEntry->Id==$this->Options->Id)
                    $this->Entry=$currentEntry;
            }
        else
            $this->Entry=$entry;

        if(isset($this->Options->PriceType))
        {
            $this->Calculator=CalculatorFactory::GetCalculator($this);
        }else
            $this->Calculator=new NoneCalculator($this);




    }

    public function GetEntryValue($path,$default,$entryObject=null){
        $entry=null;
        if($entryObject!==null)
            $entry=$entryObject;
        else
            $entry=$this->Entry;
        if($entry==null||!isset($entry->$path))
            return $default;

        return $entry->$path;
    }


    public function GetRegularPrice(){
        return trim($this->Options->Price);
    }

    public function GetSalePrice(){
        return trim($this->Options->SalePrice);
    }

    public function GetValue(){
        return '';
    }

    public function GetLineItems(){
        return array();
    }


}
