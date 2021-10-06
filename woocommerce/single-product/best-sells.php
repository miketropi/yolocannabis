<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bestsells = new WP_Query(
    array(
        'post_type'           => 'product',
        'post_status' 		  => 'publish',
        'posts_per_page'      => 3,
        'meta_key'            => 'total_sales',
        'orderby'             => 'meta_value_num',
        'order'               => 'desc',
        'meta_query' => array(
            array(
                'key'     => 'product_type',
                'value'   => 'merch',
                'compare' => '=',
            ),
        ),
    )
);

if ( $bestsells->post_count != 0 ) : ?>

	<section class="best-sells bestsells products">
		<?php
		$heading = apply_filters( 'woocommerce_product_bestsells_products_heading', __( 'BESTSELLERS', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php //woocommerce_product_loop_start(); ?>
        <div class="woo-products-list">

            <?php 
                while ( $bestsells->have_posts() ) { $bestsells->the_post();
                    //wc_get_template_part( 'content-seller', 'product' );
                    ?>
                        <div class="woo-product-item-wrap">
                            <div class="woo-product-item">
                                <div class="woo-product-thumb">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <div class="woo-quick-shop-form">
                                        <a class="close" href="#">Close</a>
                                        <?php do_action( 'woocommerce_single_add_to_cart'); ?>
                                    </div>
                                </div>
                                
                                <div class="woo-product-info">
                                    <h2 class="woo-product-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <?php do_action( 'woocommerce_loop_add_to_cart'); ?>
                                    
                                </div>
                                
                            </div>
                        </div>
                    <?php
                } 
            ?>
        
        <?php //woocommerce_product_loop_end(); ?>
        </div>

        <?php
            // don't display the button if there are not enough posts
            if (  $bestsells->max_num_pages > 1 )
                echo '<div class="products_loadmore"><a href="#">Load more</a></div>'; // you can use <a> as well
        ?>

	</section>

	<?php
endif;

wp_reset_postdata();
