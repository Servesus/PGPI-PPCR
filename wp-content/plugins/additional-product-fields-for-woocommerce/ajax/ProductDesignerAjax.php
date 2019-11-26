<?php


namespace rednaowooextraproduct\ajax;


use rednaowooextraproduct\repository\ProductRepository;

class ProductDesignerAjax extends AjaxBase
{

    public function __construct($core, $prefix)
    {
        parent::__construct($core, $prefix, 'product_designer');
    }


    protected function RegisterHooks()
    {
        $this->RegisterPrivate('load_variations','LoadVariations');
    }

    public function LoadVariations(){
        $productId=$this->GetRequired('ProductId');
        $productNonce=$this->GetRequired('ProductNonce');

        if(!\wp_verify_nonce($productNonce,$productId.'_product_designer'))
            $this->SendErrorMessage('Invalid request');

        $this->SendSuccessMessage((new ProductRepository())->GetVariations($productId));

    }
}