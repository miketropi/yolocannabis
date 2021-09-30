<?php 
/**
 * Hooks
 * 
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function alone_body_classes( $classes ) {

    if ( 'merch' == get_field('product_type') ) {
        $classes[] = 'poduct-type-merch';
    }

	return $classes;
}
add_filter( 'body_class', 'alone_body_classes' );


add_action( 'woocommerce_loop_product_link_open', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_loop_product_link_close', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_single_title', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_upsell_display', 'woocommerce_upsell_display', 15 );




add_action( 'woocommerce_shop_item_category', 'woocommerce_template_category', 10 );

function woocommerce_template_category() {
    the_terms( get_the_ID(), 'product_cat', '<div class="woocommerce-product__cat">', ', ' , '</div>' );
}

add_action( 'woocommerce_shop_item_tag', 'woocommerce_template_tag', 10 );

function woocommerce_template_tag() {
    the_terms( get_the_ID(), 'product_tag', '<div class="woocommerce-product__tag"><h3>Tags</h3>', ', ' , '</div>' );
}

/**
 * Single Product
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
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
                                        
                                        <h2 class="woocommerce-product__title">Coming soon</h2>
                                        <div class="woocommerce-product__cat">
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
                                <div class="woocommerce-product__cat">
                                    <a href="#subscrible_section">Subscribe to our newsletter below</a>
                                </div>   
                            </li>';


            $content = str_replace( '</ul>', $coming_soon . '</ul>', $content );
        }

    }
    
    return $content;
}, 10, 2 );

/**
 * Bestseller load more
 */

function products_load_more_scripts() {
 
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
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'products_loadmore', get_stylesheet_directory_uri() . '/src/products-loadmore.js', array('jquery'), $randomVersion = rand(0, 99999) );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'products_loadmore', 'products_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $bestsells->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $bestsells->max_num_pages
	) );
 
 	wp_enqueue_script( 'products_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'products_load_more_scripts' );


function products_loadmore_ajax_handler(){
	// prepare our arguments for the query
    $args = array(
        'post_type'           => 'product',
        'post_status' 		  => 'publish',
        'posts_per_page'      => 3,
        'meta_key'            => 'total_sales',
        'orderby'             => 'meta_value_num',
        'order'               => 'desc',
        'paged' => $_POST['page'] + 1,
        'meta_query' => array(
            array(
                'key'     => 'product_type',
                'value'   => 'merch',
                'compare' => '=',
            ),
        ),
    );

	// it is always better to use WP_Query but not here
	$moreproducts = new WP_Query($args);
 
	if ( $moreproducts->post_count != 0 ) :
 
		while ( $moreproducts->have_posts() ) { $moreproducts->the_post();
            wc_get_template_part( 'content', 'product' );
        }
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'products_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'products_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}




add_filter('post_age_gate_custom_fields', 'age_gate_custom_fields', 10, 1);

function age_gate_custom_fields($fields){
    $fields .= '<div class="custom-field-location">
                    <label>Select your location</label>
                    <select name="custom-location" id="custom_location">
                        <option value="">Select province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>
                    <div class="location-error"></div>
                </div>';
    $fields .= '<div class="custom-field-term">
                    <label><input type="checkbox" name="ag_field_terms" value="1" /> I acknowledge that I must be <b>19</b> or older to enter this website and to buy and receive products from yolocannabis.ca</label>
                    <div class="term-error"></div>
                </div>';
    
    return $fields;
}