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
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products', 20 );

function wc_change_number_related_products( $args ) {
    // Change number of upsells output
    $args['posts_per_page'] = 3;
    $args['columns'] = 3; //change number of upsells here
    return $args;
}

add_action( 'elementor/element/woocommerce-products/section_content/after_section_end', function( $element, $args ) {
	$element->start_injection( [
        'at' => 'after',
        'of' => 'paginate',
    ] );

    $element->add_control(
		'coming_soon',
		[
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => __( 'Coming Soon', 'text-domain' ),
            'label_on' => __( 'Show', 'text-domain' ),
            'label_off' => __( 'Hide', 'text-domain' ),
		]
	);

    $element->end_injection();
}, 10, 2 );

add_action( 'elementor/widget/render_content', function( $content, $widget ) {
    if ( 'woocommerce-products' === $widget->get_name() ) {
        $settings = $widget->get_settings();
        
        if ( '' !== $settings['coming_soon'] ) {
            /*$coming_soon = '';

            $wp_query = new WP_Query(
                array(
                    'post_type'           => 'product',
                    'posts_per_page'      => -1,
                    'post_status' 		  => 'pending',
                )
            );

            if ( $wp_query->post_count != 0 ) {
                while ( $wp_query->have_posts() ) { $wp_query->the_post(); 
                    $coming_soon = '<li class="product product-coming-soon">
                                        <div class="woocommerce-loop-product__thumb">
                                            <img width="300" height="405" src="' . get_stylesheet_directory_uri() . '/images/pro-coming-soon.png' . '" class="attachment-woocommerce_thumbnail" alt="">  
                                        </div>
                                        
                                        <h2 class="woocommerce-loop-product__title">Coming soon</h2>
                                        <div class="woocommerce-loop-product__cat">
                                            <a href="#subscrible_section">Subscribe to our newsletter below</a>
                                        </div>   
                                    </li>';
                }
            }*/

            $coming_soon = '<li class="product product-coming-soon">
                                <div class="woocommerce-loop-product__thumb">
                                    <img width="300" height="405" src="' . get_stylesheet_directory_uri() . '/images/pro-coming-soon.png' . '" class="attachment-woocommerce_thumbnail" alt="">  
                                </div>
                                
                                <h2 class="woocommerce-loop-product__title">Coming soon</h2>
                                <div class="woocommerce-loop-product__cat">
                                    <a href="#subscrible_section">Subscribe to our newsletter below</a>
                                </div>   
                            </li>';


            



            $content = str_replace( '</ul>', $coming_soon . '</ul>', $content );
        }

    }
    
    return $content;
 }, 10, 2 );