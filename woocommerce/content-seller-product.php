<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>

    <div class="woocommerce-loop-product__thumb">
        <?php 
            /**
             * Hook: woocommerce_loop_product_link_open.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_loop_product_link_open' );

            /**
             * Hook: woocommerce_loop_product_thumbnail.
             *
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_loop_product_thumbnail' );

            /**
             * Hook: woocommerce_loop_product_link_close.
             *
             * @hooked woocommerce_template_loop_product_link_close - 10
             */
            do_action( 'woocommerce_loop_product_link_close' );
        ?>
    </div>
    
    <?php 
        /**
         * Hook: woocommerce_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        //do_action( 'woocommerce_shop_loop_item_title' );

        the_title('<h2 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '">', '</a></h2>');

        /**
         * Hook: woocommerce_shop_item_category.
         *
         * @hooked woocommerce_template_category - 10
         */
        //do_action( 'woocommerce_shop_item_category' );
        
    ?>
    <?php
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item_title' );

	?>
</li>