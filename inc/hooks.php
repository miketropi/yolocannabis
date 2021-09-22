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

/**
 * Single Product
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products', 20 );

function wc_change_number_related_products( $args ) {
    // Change number of upsells output
    $args['posts_per_page'] = 3;
    $args['columns'] = 3; //change number of upsells here
    return $args;
}
