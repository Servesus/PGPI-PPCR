<?php


namespace rednaowooextraproduct\core\Managers\FormManager;


use rednaowooextraproduct\core\Managers\FormManager\Fields\FBFieldBase;
use rednaowooextraproduct\core\Managers\FormManager\Fields\FieldFactory;
use undefined\DTO\FBColumnOptions;
use undefined\DTO\FBRowOptions;

class FBColumn
{
    /** @var FBColumnOptions */
    public $Options;
    /** @var FBFieldBase */
    public $Field;
    /** @var FBRow */
    public $Row;
    public $Loader;
    public function __construct($loader,$row,$options)
    {
        $this->Loader=$loader;
        $this->Row=$row;
        $this->Options=$options;
        $this->Field=FieldFactory::GetField($loader,$this,$options->Field,null);
    }

}