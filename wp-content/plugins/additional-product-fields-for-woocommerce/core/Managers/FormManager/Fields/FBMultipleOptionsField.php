<?php


namespace rednaowooextraproduct\core\Managers\FormManager\Fields;


class FBMultipleOptionsField extends FBFieldBase
{
    public $optionsToReturn=null;
    public function GetSelectedOptions(){
        if($this->optionsToReturn==null)
        {
            $this->optionsToReturn=array();
            if(isset($this->Entry)&&isset($this->Entry->SelectedValues)&&isset($this->Options->Options))
            {
                foreach($this->Entry->SelectedValues as $selectedEntry)
                {
                    foreach($this->Options->Options as $selectedOption)
                    {
                        if($selectedOption->Id==$selectedEntry->Id)
                        {
                            $this->optionsToReturn[] = (object)\array_merge((array)$selectedEntry,(array)$selectedOption);
                        }
                    }
                }
            }

        }
        return $this->optionsToReturn;
    }

    public function GetLineItems(){
        $options=$this->GetSelectedOptions();
        foreach($options as $currentOption)
        {
            $currentOption->Value=$currentOption->Label;
            $currentOption->Label=$this->GetEntryValue('Label','');
        }
        $this->Entry->SelectedValues=$options;
        return array((object)\array_merge((array)$this->Entry,array(
            'Id'=>$this->Options->Id,
        )));
    }
}