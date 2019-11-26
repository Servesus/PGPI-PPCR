<?php
/**
 * Created by PhpStorm.
 * User: Edgar
 * Date: 2/25/2019
 * Time: 8:57 AM
 */

namespace rednaowooextraproduct\core;





use rednaoformpdfbuilder\ajax\DesignerAjax;
use rednaoformpdfbuilder\ajax\TemplateListAjax;
use rednaoformpdfbuilder\Integration\Processors\Entry\Retriever\EntryRetrieverBase;
use rednaoformpdfbuilder\Integration\Processors\Loader\ProcessorLoaderBase;

use rednaowooextraproduct\ajax\OrderDesignerAjax;
use rednaowooextraproduct\ajax\ProductDesignerAjax;
use rednaowooextraproduct\core\Managers\FormManager\Fields\FBTextField;
use rednaowooextraproduct\core\Managers\WooStagesManager;
use rednaowooextraproduct\panel\ProductBuilderPanel;
use rednaowooextraproduct\pr\PRLoader;
use rednaowooextraproduct\repository\ProductRepository;
use undefined\DTO\FormBuilderOptions;


class Loader extends PluginBase
{
    /** @var PRLoader */
    public $PRLoader=null;
    public $RECORDS_TABLE;
    public $TEMPLATES_TABLE;
    public $FormConfigTable;




    public function __construct($prefix)
    {
        parent::__construct($prefix,15,2);
        load_plugin_textdomain( 'rednaowooextraproduct', false, dirname( plugin_basename( dirname(__FILE__) ) ) . '/languages/' );
        new WooStagesManager($this);
        new ProductDesignerAjax($this,$prefix);
        new OrderDesignerAjax($this,$prefix);

        if($this->IsPR())
        {
            new PRLoader($this);
        }

    }

    public function IsPR(){
        return \file_exists($this->DIR.'pr');
    }



    public function OnPluginIsActivated()
    {
        set_transient( '_woo_extra_products_go_to_welcome', true, 30 );
    }


    public function CheckIfPDFAdmin(){
        if(!current_user_can('manage_options'))
        {
            die('Forbidden');
        }
    }


    public function OnCreateTable()
    {

    }

    public function RegisterScripts(){
        global $post, $typenow, $current_screen;

        if($current_screen->post_type=='product')
        {
            $this->EnqueueProductBuilder();
        }
    }




    public function CreateHooks()
    {
        add_action('admin_menu', array($this,'WelcomePageMenu'));
        add_action( 'admin_head', array($this,'RemoveWelcomePage' ));
        add_action( 'admin_init', array($this,'AdminInit') );
        add_action( 'admin_notices', array($this,'ReviewNotice') );
        add_action('admin_enqueue_scripts',array($this,'RegisterScripts'));
        add_filter( 'woocommerce_product_data_tabs', array( $this, 'AddProductTab' ) );
        add_action( 'woocommerce_product_data_panels', array( $this, 'AddProductPanel' ) );
        add_action( 'woocommerce_process_product_meta', array( $this, 'SaveProductMeta' ) );
        add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'BeforeAddToCartButton' ) );
        add_filter('woo-extra-product-get-additional-fields',array($this,'GetAllFields'),10,5);
        \add_filter('woo-extra-product-get-field-by-type',array($this,'GetPHPField'),10,6);

        new FreeCartItemPrinter();
    }

    public function ReviewNotice(){
        $review=new ReviewHelper($this);
        $review->Start();

    }

    public function GetAllFields($fields){
        $fields[]='FBMaskedField';
        $fields[]='FBColorPickerField';
        $fields[]='FBCheckBox';
        $fields[]='FBDatePicker';
        $fields[]='FBDivider';
        $fields[]='FBDropDown';
        $fields[]='FBMaskedField';
        $fields[]='FBParagraph';
        $fields[]='FBRadio';
        $fields[]='FBTextArea';
        $fields[]='FBTextField';
        return $fields;
    }

    public function GetPHPField($field,$loader,$fieldType,$column,$fieldOptions,$entry)
    {
        if($field!=null)
            return $field;
        switch ($fieldType)
        {
            case 'masked':
                return new FBTextField($loader,$column,$fieldOptions,$entry);
        }
    }

    public function WelcomePageMenu(){
        add_dashboard_page('Welcome', 'Welcome', 'read', 'woo-extra-product-welcome', array($this,'WelcomePage'));
    }

    public function RemoveWelcomePage(){
        remove_submenu_page( 'index.php', 'woo-extra-product-welcome' );
    }

    public function WelcomePage(){
        global $rninstance;
        $rninstance=$this;
        require_once $this->DIR.'pages/Welcome.php';
    }

    public function AdminInit(){
        if ( ! get_transient( '_woo_extra_products_go_to_welcome' ) ) {
            return;
        }

        // Delete the redirect transient
        delete_transient( '_woo_extra_products_go_to_welcome' );

        // Bail if activating from network, or bulk
        if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
            return;
        }

        // Redirect to bbPress about page
        wp_safe_redirect( add_query_arg( array( 'page' => 'woo-extra-product-welcome' ), admin_url( 'index.php' ) ) );

    }


    public function BeforeAddToCartButton(){
        $previousData=null;
        if(isset($_GET['cart_item'])&&isset($_GET['nonce']))
        {
            $nonce=strval($_GET['nonce']);
            $cartKey=strval($_GET['cart_item']);
            if(!\wp_verify_nonce($nonce,'edit_'.$cartKey))
                return;

            $cart_contents = WC()->cart->cart_contents;
            if(isset($cart_contents[$cartKey]))
            {
                $cartItem=$cart_contents[$cartKey];
                $previousData=array();
                if(isset($cartItem['rn_entry']))
                {
                    $previousData['Fields']=$cartItem['rn_entry']->Fields;
                }

                $previousData['CartKey']=$cartKey;
                $previousData['Quantity']=$cartItem['quantity'];
            }
        }





        echo '<div id="RNAddToCartContainer"></div>';
        global $product;
        $repository=new ProductRepository();
        /** @var FormBuilderOptions $options */
        $options=\json_decode($repository->GetProductExtraOptions($product->get_id()));
        if($options==false)
            return;

        $dependencies=array();
        if(isset($options->ExtensionsUsed))
        {
            foreach($options->ExtensionsUsed as $extension)
            {
                $dependencies=\apply_filters('woo-extra-product-get-extension-runnable-'.$extension,$dependencies);
            }
        }

        $this->AddRNTranslator(array('InternalShared'));
        $this->AddScript('shared-core','js/dist/SharedCore_bundle.js',array('@RNTranslator','wp-element'));
        $this->AddScript('internal-shared','js/dist/InternalShared_bundle.js',array('@shared-core'));
        $this->AddScript('form-builder','js/dist/FormBuilder_bundle.js',array('@RNTranslator','@internal-shared'));

        if(isset($options->DynamicFieldTypes))
        {
            if(isset($options->Version))
            {
                foreach ($options->DynamicFieldTypes as $currentDynamicField)
                {
                    $dependencies[] = '@' . $currentDynamicField;
                    $this->AddScript($currentDynamicField, 'js/dist/' . $currentDynamicField . '_bundle.js', array('@form-builder'));
                }
            }else{
                $additionalFields=array();
                $additionalFields=\apply_filters('woo-extra-product-get-additional-fields',$additionalFields);
                $dependencies=array();
                foreach ($additionalFields as $field)
                {
                    $dependencies[]='@'.$field;
                    $this->AddScript($field,'js/dist/'.$field.'_bundle.js',array('@form-builder'));
                }
            }


        }

        $this->AddScript('runnable-form-builder','js/dist/RunnableFormBuilder_bundle.js',\array_merge($dependencies, array('@form-builder')));

        $this->LocalizeScript('ProductBuilderOptions','form-builder','ProductBuilder',array(
           'Options'=>(array)$options,
           "URL"=>$this->URL,
           'IsVariable'=>$product->has_child(),
           'WCCurrency'=>array(
              'Format'=>get_woocommerce_price_format(),
              'Decimals'=>wc_get_price_decimals(),
              'ThousandSeparator'=>wc_get_price_thousand_separator(),
              'DecimalSeparator'=>wc_get_price_decimal_separator(),
              'Symbol'=>get_woocommerce_currency_symbol(),
            ),
            'Product'=>array(
                "Id"=>$product->get_id(),
                'Price'=>$product->get_price(),
                'SalePrice'=>$product->get_sale_price()

            ),
            'Variations'=>$repository->GetVariations($product->get_id()),
            'PreviousData'=>$previousData
        ));
    }

    public function SaveProductMeta(){
        if(isset($_POST['rednao_advanced_product_options'])&&\is_object(\json_decode(\stripslashes($_POST['rednao_advanced_product_options']))))
        {
            global $post_id;
            $repository=new ProductRepository();
            $repository->SaveProductExtraOptions($post_id,$_POST['rednao_advanced_product_options']);
        }else{
            global $post_id;
            $repository=new ProductRepository();
            $repository->SaveProductExtraOptions($post_id,'');
        }
    }


    public function AddProductTab($tabs){
        $tabs['rednao-advanced-products'] = array(
            'label'  => esc_html__( 'Advanced Product Options', 'advanced-product-options' ),
            'target' => 'rednao-advanced-products',
            'class'  => array( 'rednao-advanced-products','hide_if_grouped')
        );

        return $tabs;
    }


    public function AddProductPanel(){
        $panel= new ProductBuilderPanel($this);
        $panel->Execute();
    }

    public function AddDeactivationDialog(){

    }

    private function EnqueueProductBuilder()
    {
    }

}