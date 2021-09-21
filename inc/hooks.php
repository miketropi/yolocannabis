<?php 
/**
 * Hooks
 * 
 */

add_action( 'woocommerce_loop_product_link_open', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_loop_product_link_close', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );


add_action( 'woocommerce_shop_loop_item_category', 'woocommerce_template_loop_category', 10 );

function woocommerce_template_loop_category() {
    the_terms( get_the_ID(), 'product_cat', '<div class="woocommerce-loop-product__cat">', ', ' , '</div>' );
}



