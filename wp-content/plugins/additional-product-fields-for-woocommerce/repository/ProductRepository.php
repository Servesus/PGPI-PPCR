<?php


namespace rednaowooextraproduct\repository;


class ProductRepository
{
    public function GetProductExtraOptions($productId)
    {
        $meta= \get_post_meta($productId,'_rednao_advanced_product_options',true);
        return $meta;

    }

    public function SaveProductExtraOptions($productId,$options)
    {
        if($options==''||$options==null)
        {
            \delete_post_meta($productId,'_rednao_advanced_product_options');
        }else
            \update_post_meta($productId,'_rednao_advanced_product_options',$options);
    }

    public function GetVariations($productId)
    {
        $product = wc_get_product( $productId);

        $variations=array();
        $attributes=array();
        if ( $product && is_object( $product ) && is_callable( array( $product, 'get_available_variations' ) ) ) {
            $variations     = $this->GetAvailableVariations( $product );
            $attributes     = $product->get_variation_attributes();
            $all_attributes = $product->get_attributes();
            if ( $attributes ) {
                foreach ( $attributes as $key => $value ) {
                    if ( ! $value ) {
                        $attributes[ $key ] = array_map( 'trim', explode( "|", $all_attributes[ $key ]['value'] ) );
                    }
                }
            }
        }

        return array( 'Variations' => $variations, 'Attributes' => $attributes );
    }


    public function GetAvailableVariations( $product ) {
        $available_variations = array();

        foreach ( $product->get_children() as $child_id ) {
            $variation    = wc_get_product( $child_id );
            $variation_id = $this->GetVariationId( $variation );
            if ( empty( $variation_id ) || ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $variation->is_in_stock() ) ) {
                continue;
            }
            if ( apply_filters( 'woocommerce_hide_invisible_variations', FALSE, $this->GetId( $product ), $variation ) && ! $variation->variation_is_visible() ) {
                continue;
            }

            $available_variations[] = $this->get_available_variation( $variation, $product );
        }

        return $available_variations;
    }

    private function GetId( $product ) {
        if ( is_callable( array( $product, 'get_id' ) ) && is_callable( array( $product, 'get_parent_id' ) ) ) {
            if ( $this->GetProductType( $product ) == "variation" ) {
                return $product->get_parent_id();
            }

            return $product->get_id();
        }
        if ( is_object( $product ) ) {
            return $product->id;
        }

        return 0;
    }

    private function GetProductType( $product = NULL ) {
        if ( is_object( $product ) ) {
            if ( is_callable( array( $product, 'get_type' ) ) ) {
                return $product->get_type();
            } else {
                return $product->product_type;
            }
        }

        return FALSE;
    }

    private function GetVariationId( $product ) {
        if ( is_callable( array( $product, 'get_id' ) ) ) {
            return $product->get_id();
        }

        return $product->variation_id;
    }

    public function get_available_variation( $variation, $product ) {
        if ( is_numeric( $variation ) ) {
            $variation = wc_get_product( $variation );
        }

        return apply_filters( 'tc_epo_woocommerce_available_variation', array(
            'variation_id' => $this->GetVariationId( $variation ),
            'attributes'   => $variation->get_variation_attributes(),
            'is_in_stock'  => $variation->is_in_stock(),
            'price'=>$variation->get_price(),
            'sale_price'=>$variation->get_sale_price()
        ), $product, $variation );
    }
}