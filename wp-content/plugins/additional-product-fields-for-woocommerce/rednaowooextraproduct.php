<?php
/**
 * Plugin Name: Extra Product Options Builder for WooCommerce
 * Plugin URI: http://smartforms.rednao.com/getit
 * Description: Additional product fields for woocommerce
 * Author: RedNao
 * Author URI: http://rednao.com
 * Version: 1.2.13
 * Text Domain: Extra products for WooCommerce
 * Domain Path: /languages/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 * Slug: additional-product-fields-for-woocommerce
 */


use rednaowooextraproduct\core\Loader;

spl_autoload_register('rednaowooextraproduct');
function rednaowooextraproduct($className)
{
    if(strpos($className,'rednaowooextraproduct\\')!==false)
    {
        $NAME=basename(\dirname(__FILE__));
        $DIR=dirname(__FILE__);
        $path=substr($className,21);
        $path=str_replace('\\','/', $path);
        require_once $DIR.$path.'.php';
    }
}

new Loader('rednaowooextraproduct');


