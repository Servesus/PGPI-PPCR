<?php


namespace rednaowooextraproduct\core\Managers;


use Exception;
use rednaowooextraproduct\core\Loader;
use rednaowooextraproduct\core\Managers\CartItemPrinter\CartItemPrinter;
use rednaowooextraproduct\core\Managers\FormManager\FormBuilder;
use rednaowooextraproduct\core\Managers\OrderLineBuilder\OrderLineBuilder;
use rednaowooextraproduct\core\Managers\OrderLineUpdater\OrderLineUpdater;
use rednaowooextraproduct\repository\ProductRepository;
use WC_Order;
use WC_Order_Item_Product;
use WC_Product_Simple;
use WooCommerce;

class WooStagesManager
{
    /**
     * WooStagesManager constructor.
     * @param $loader Loader
     */

    /** @var Loader */
    public $Loader;
    public function __construct($loader)
    {
        $this->Loader=$loader;
        add_filter( 'woocommerce_get_item_data', array( $this, 'GetItemData' ), 50, 2 );
        add_filter( 'woocommerce_order_item_meta_start', array( $this, 'PrintEmail' ), 50, 4 );
        add_filter( 'wc_get_template', array( $this, 'GetCartTemplate' ), 10, 5 );
        add_filter( 'woocommerce_add_cart_item_data', array( $this, 'AddCartItemData' ),10,2 );
        add_action( 'woocommerce_before_calculate_totals',array($this,'BeforeCalculateTotal'));
        add_action( 'woocommerce_order_item_' . 'line_item' . '_html', array( $this, 'OrderLineItem' ), 10, 2 );

        \add_action('woocommerce_thankyou',array($this,'OrderCreated'));
        add_filter( 'woocommerce_add_to_cart_validation', array($this,'AddToCartValidation'), 10, 4 );
        add_action( 'woocommerce_checkout_create_order_line_item', array( $this, 'AddMetaToOrder' ), 50, 4 );
        add_action('template_redirect',array($this,'WooCommerceLoaded'));
        add_filter( 'woocommerce_checkout_cart_item_quantity', array( $this, 'CartItemName' ), 10, 3 );
        add_action( 'woocommerce_saved_order_items', array( $this, 'UpdateOrderItem' ), 10, 2 );
        add_action( 'admin_enqueue_scripts', array( $this, 'RegisterAdminScript' ) );
        add_action( 'wp_ajax_woocommerce_tm_get_variations_array', array( $this, 'GetVariations' ) );
      //  add_action( 'woocommerce_cart_loaded_from_session',array($this,'LoadFromSession'));

    }

    /**
     * @param $itemId
     * @param $item WC_Order_Item_Product
     * @param $order
     * @param $plainText
     */
    public function PrintEmail($itemId,$item,$order,$plainText)
    {
        $meta=$item->get_meta('rn_entry');
        if($meta==''||$meta==null||!isset($meta->Fields)||count($meta->Fields)==0)
            return;

        $printer=new CartItemPrinter($meta->Fields);
        $data=$printer->GetItemData();
        foreach($data as $item)
        {
            echo $item['display'];
        }
    }

    public function OrderCreated($orderId)
    {
        $order = wc_get_order( $orderId );
        foreach ( $order->get_items() as  $item_key => $item_values ) {

            if($item_values->get_meta('rn_entry')!=''){

                $count=\get_option('rednaowooextraproduct_order_count',0);
                $count++;
                \update_option('rednaowooextraproduct_order_count',$count);
                return;
            }
        }
    }

    public function GetVariations(){
        $variations = array();
        $attributes = array();
        if ( isset( $_POST['post_id'] ) ) {
            $repository=new ProductRepository();
            $variations=$repository->GetVariations(\strval($_POST['post_id'] ));

            \wp_send_json(array(
                'success'=>true,
                'result'=>$variations
            ));
            return;
        }

        \wp_send_json_error(array(
            'success'=>false,
            'errorMessage'=>'An error occurred, please try again'
        ));
        die();
    }

    public function RegisterAdminScript(){
        $screen = get_current_screen();
        if ( $screen->id=='shop_order'){
            $this->Loader->AddRNTranslator(array('InternalShared'));
            $this->Loader->AddScript('shared-core','js/dist/SharedCore_bundle.js',array('@RNTranslator','wp-element'));
            $this->Loader->AddScript('dashboard','js/dist/OrderDashboard_bundle.js',array('@shared-core'));
            $this->Loader->AddStyle('woo-extra-products-admin-style','styles/order.css');
        }



    }

    public function UpdateOrderItem( $order_id = 0, $items = array() ) {

        $orderLineUpdater=new OrderLineUpdater();
        $orderLineUpdater->Initialize($items);
        $orderLineUpdater->Execute();

    }

    public function AddMetaToOrder( $item, $cart_item_key, $values,$order ) {
        if ( isset( $values['rn_entry'] )&&isset($values['rn_line_items']) ) {
            $lineItems=$values['rn_line_items'];
            foreach($lineItems as $fieldItem)
            {
                \apply_filters('woo-extra-product-before-add-order-meta',$fieldItem);
            }


            $item->add_meta_data( 'rn_entry', $values['rn_entry'] );
            $item->add_meta_data( 'rn_line_items', $lineItems) ;

        }

    }


    /**
     * @param string $item_id
     * @param WC_Order_Item_Product $item wc
     */
    public function OrderLineItem($item_id = "", $item = array() ){
        $lineItems=$item->get_meta('rn_line_items');
        if($lineItems==''||count($lineItems)==0)
            return;

        global $thepostid;
        $order=\wc_get_order($item->get_order_id());
        $builder=new OrderLineBuilder();
        $builder->Initialize($order,$item,$lineItems);
        $builder->Execute();

    }

    public function WooCommerceLoaded(){

        add_filter( 'woocommerce_add_to_cart_validation', array($this,'AddToCartValidation'), 10, 4 );
        if(\function_exists('is_checkout')&&!\is_checkout())
            add_filter( 'woocommerce_cart_item_name', array( $this, 'CartItemName' ), 10, 3 );
    }

    public function CartItemName($title = "", $cart_item = array(), $cart_item_key = "" ){
        if(!isset($cart_item['rn_entry']))
            return $title;

        /** @var WC_Product_Simple $data */
        $data=$cart_item['data'];
        $link=$data->get_permalink($cart_item);

        $nonce=\wp_create_nonce('edit_'.$cart_item['key']);
        if(\strpos($link,'?')===false)
            $link.='?';
        else
            $link.='&';
        $link.='cart_item='.$cart_item['key'].'&nonce='.$nonce;

        $title= $title."<br/><a class='rn-edit-options' style=\"font-size: 12px; display: block;\" href=\"$link\">Edit Options</a>";
        return $title;


    }


    public function AddToCartValidation($valid, $product_id, $quantity,$variation =''){
        if(isset($_POST['RednaoSerializedFields']))
        {
            $data=\json_decode(\stripslashes($_POST['RednaoSerializedFields']));
            if($data==null)
                return true;
            if(isset($data->PreviousCartKey))
            {
                WC()->cart->remove_cart_item( $data->PreviousCartKey );
                unset( WC()->cart->removed_cart_contents[ $data->PreviousCartKey ] );

            }
            $options=\json_decode((new ProductRepository())->GetProductExtraOptions($product_id));
            $product=null;
            if($variation!='')
                $product=wc_get_product($variation);
            else
                $product = wc_get_product( $product_id );

            $form=new FormBuilder($this->Loader,$options,$data,$product);
            $form->Quantity=$quantity;
            $form->Initialize();

            if(\floatval($data->Totals->GrandTotal)==$form->GrandTotal&&
                $data->Totals->ProductPrice==$form->GetPrice()&&
                $data->Totals->OptionsUnitPrice==$form->OptionsUnitPrice&&
                $data->Totals->OptionsTotal==$form->OptionsTotal&&
                $form->CalculationsAreValid()
            )
                return true;
            else{
                wc_add_notice( __( 'Invalid product price, please try again.', 'woocommerce' ), 'error' );
                return false;

            }
        }
        return true;
    }

    public function BeforeCalculateTotal($cart_object ){

        foreach ( $cart_object->cart_contents as $key => $value ) {
            if(isset($value['rn_entry']))
            {
                $entry=$value['rn_entry'];
                if(isset($entry->Totals))
                {

                    /** @var WC_Product_Simple $cartItem */
                    $cartItem = $value['data'];
                    $cartItem->set_price($entry->Totals->ProductPrice+$entry->Totals->OptionsUnitPrice);
                }


            }


        }
    }

    public function AddCartItemData($cart_item_meta, $product_id){
        if(isset($_POST['RednaoSerializedFields']))
        {
            $data=\json_decode(\stripslashes($_POST['RednaoSerializedFields']));
            if($data==null)
                return null;
            $options=\json_decode((new ProductRepository())->GetProductExtraOptions($product_id));

            $product = wc_get_product( $product_id );
            $form=new FormBuilder($this->Loader,$options,$data,$product);
            $form->Initialize();
            $lineItems=$form->GenerateLineItems();
            $cart_item_meta['rn_entry']=$data;
            $cart_item_meta['rn_options']=$options;
            $cart_item_meta['rn_line_items']=$lineItems;
        }

        return $cart_item_meta;
    }

    public function GetItemData( $other_data, $cart_item ) {

        if(isset($cart_item['rn_entry']))
        {
            $cart=new CartItemPrinter($cart_item['rn_entry']->Fields);
            $other_data=\array_merge($other_data, $cart->GetItemData());

        }
        return $other_data;

    }



    public function GetCartTemplate($located = "", $template_name = "", $args = "", $template_path = "", $default_path = "" ){
        $templates = array( 'cart/cart-item-data.php' );

        if ( in_array( $template_name, $templates ) ) {
            $located = wc_locate_template( $template_name, 'rn-advanced-product-options', $this->Loader->DIR.'templates/' );
            if ( file_exists( $located ) ) {
                $located = $located;
            }
        }

        return $located;
    }


}