<?php
/*
Plugin Name: HandMade WooCommerce Order Status Control
Description: Disable/Enable autocomplete for all/virtual/virtual downloadable products 
Version: 1.2
Author: HandMade Connections	
Author URI: http://www.handmade.co.za
*/



//WooCommerce settings 
add_filter( 'woocommerce_get_sections_products', 'handmade_add_section' );

function handmade_add_section( $sections ) {
	
	$sections['handmade'] = __( 'Handmade', 'text-domain' );
	return $sections;
	
}


/**
 * Add settings to the specific section we created before
 */
add_filter( 'woocommerce_get_settings_products', 'handmade_all_settings', 10, 2 );
function handmade_all_settings( $settings, $current_section ) {

    wp_enqueue_script('handmade', plugin_dir_url(__FILE__) . 'handmade.js', array('jquery'));
	/**
	 * Check the current section is what we want
	 **/
	if ( $current_section == 'handmade' ) {
		$settings_hmade = array();
		// Add Title to the Settings
		$settings_hmade[] = array( 'name' => __( 'Handmade Settings', 'text-domain' ), 'type' => 'title', 'desc' => __( 'The following options allow you to choose when to auto complete an order', 'text-domain' ), 'id' => 'handmade' );
        
        // Virtual downloadable products
		$settings_hmade[] = array(
			'name'     => __( 'Virtual downloadable products', 'text-domain' ),
			'desc_tip' => __( 'Process paid virtual downloadable orders to review if order should be granted download access.', 'text-domain' ),
			'id'       => 'hmade_vd',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Do not auto complete virtual downloadable orders', 'text-domain' ),
        );

        // Virtual products
		$settings_hmade[] = array(
			'name'     => __( 'Virtual products', 'text-domain' ),
			'desc_tip' => __( 'Auto complete virtual product paid orders.', 'text-domain' ),
			'id'       => 'hmade_v',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Auto complete virtual product orders', 'text-domain' ),
        );
        
        // all products
		$settings_hmade[] = array(
			'name'     => __( 'All products', 'text-domain' ),
			'desc_tip' => __( 'Auto complete all paid orders.', 'text-domain' ),
			'id'       => 'hmade_all',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Auto complete all orders', 'text-domain' ),
        );
		
		$settings_hmade[] = array( 'type' => 'sectionend', 'id' => 'handmade' );
		return $settings_hmade;
	
	/**
	 * If not, return the standard settings
	 **/
	} else {
		return $settings;
    }

    
}

add_action('woocommerce_checkout_order_processed', 'handmade_woocommerce_order');

function handmade_woocommerce_order( $order_id ) 
{
    $order = wc_get_order($order_id);
	foreach ($order->get_items() as $item_key => $item_values):
        $product_id = $item_values->get_product_id(); //get product id

        //get prodct settings i.e virtual
        $virtual_product = get_post_meta($product_id,'_virtual',true);
        $downloadable_product = get_post_meta($product_id,'_downloadable',true);
		
		$price = get_post_meta($product_id,'_regular_price',true);

        $virtuald=get_option('hmade_vd');
		
		if($virtuald=='yes' && $downloadable_product=='yes' && $virtual_product=='yes')
		{
			if($price=='0.00')
			{
				$order->update_status( 'processing' );
			}

		}
		
		
    endforeach;
}

add_action( 'woocommerce_payment_complete', 'handmade_woocommerce_payment_complete', 10, 1 );

function handmade_woocommerce_payment_complete( $order_id ) {
    $order = wc_get_order($order_id);
    foreach ($order->get_items() as $item_key => $item_values):
        $product_id = $item_values->get_product_id(); //get product id

        //get prodct settings i.e virtual
        $virtual_product = get_post_meta($product_id,'_virtual',true);
        $downloadable_product = get_post_meta($product_id,'_downloadable',true);

        $virtuald=get_option('hmade_vd');
        $virtual=get_option('hmade_v');
        $all=get_option('hmade_all');

        if($virtuald=='yes')
        {
            if($virtual_product=='yes' and $downloadable_product=='yes')
            {
                $order = wc_get_order( $order_id );
                $order->update_status( 'processing' );
            }
        }

        if($virtual=='yes')
        {
              if($virtual_product=='yes')
             {
                  $order = wc_get_order( $order_id );
                  $order->update_status( 'completed' );
             }
        }

        if($all=='yes')
        {
            $order = wc_get_order( $order_id );
            $order->update_status( 'completed' );
        }
         
        
        
    endforeach;
}


?>