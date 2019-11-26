<?php


namespace rednaowooextraproduct\core\Managers\FormManager;


use undefined\DTO\FBRowOptions;

class FBRow
{
    /** @var FBRowOptions */
    public $Options;

    /** @var FBColumn[] */
    public $Columns;
    /** @var FormBuilder */
    public $Form;
    public $Loader;
    public function __construct($loader,$form,$options)
    {
        $this->Loader=$loader;
        $this->Form=$form;
        $this->Options=$options;

        $this->Columns=array();
        foreach($this->Options->Columns as $column)
            $this->Columns[]=new FBColumn($this->Loader, $this,$column);
    }

}