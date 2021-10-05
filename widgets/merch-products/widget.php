<?php
namespace YoloElementorWidgets\Widgets\Merch_Products;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Yolo_Merch_Products extends Widget_Base {

	public function get_name() {
		return 'yolo-merch-products';
	}

	public function get_title() {
		return __( 'Merch Products', 'text-domain' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'text-domain' ),
			]
		);

		$this->add_control(
			'all_desc',
			[
				'label' => __( 'All Description', 'text-domain' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        $terms = get_terms( array(
            'taxonomy' => 'merch_category',
            'hide_empty' => false,
        ) );

        ?>
        <div class="elementor-merch-products">
            <div class="woo-merch-products-wrap">
                <div class="woo-col-category">
                    <?php 
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            echo '<ul class="tabs-nav woo-nav">';
                                foreach ( $terms as $term ) {
                                    echo '<li><a class="" href="#' . $term->slug . '">' . $term->name . '</a></li>';
                                }
                                echo '<li class="active"><a href="#all">All</a></li>';
                                
                            echo '</ul>';
                        }
                    ?>
                </div>

                <div class="woo-col-content">
                    <?php
                        $terms_arr = array();
                        foreach ( $terms as $term ) {
                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                $terms_arr[] = $term->slug;

                                $wp_query = new \WP_Query(
                                    array(
                                      'post_type'           => 'product',
                                      'post_status'         => 'publish',
                                      'posts_per_page'      => -1,
                                      'tax_query'           => array(
                                        array(
                                            'taxonomy' => 'merch_category',
                                            'field'    => 'slug',
                                            'terms'    => $term->slug,
                                        ),
                                      ),
                                    )
                                );

                                echo '<div class="tabs-panel" data-term="' . $term->slug . '">';
                                    echo '<div class="woo-term-desc">' . $term->description . '</div>';

                                    echo '<div class="woo-products-list">';
                                        while ( $wp_query->have_posts() ) : $wp_query->the_post();
                                            ?>
                                                <div class="woo-product-item-wrap">
                                                    <div class="woo-product-item">
                                                        <div class="woo-product-thumb">
                                                            <?php if ( has_post_thumbnail() ) : ?>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_post_thumbnail(); ?>
                                                                </a>
                                                            <?php endif; ?>

                                                            <?php do_action( 'woocommerce_single_add_to_cart'); ?>
                                                        </div>
                                                        <div class="woo-product-info">
                                                            <h2 class="woo-product-title">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h2>
                                                            
                                                            <div class="woo-variation-add-to-cart">
                                                                <a href="<?php the_permalink(); ?>" class="woo-variation-add-to-cart button alt">Add to cart</a>
                                                            </div>
                                                            <?php //do_action( 'woocommerce_loop_add_to_cart'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                    ?>
                    <div class="tabs-panel active"  data-term="all">
                        <?php 
                            $wp_query = new \WP_Query(
                                array(
                                    'post_type'           => 'product',
                                    'post_status'         => 'publish',
                                    'posts_per_page'      => -1,
                                    'tax_query'           => array(
                                        array(
                                            'taxonomy' => 'merch_category',
                                            'field'    => 'slug',
                                            'terms'    => $terms_arr,
                                            'operator' => 'IN',
                                        ),
                                      ),
                                )
                            );

                            if( !empty( $settings['all_desc'] ) ) {
                                echo '<div class="woo-term-desc">' . $settings['all_desc'] . '</div>';
                            }
                            echo '<div class="woo-products-list">';
                                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                                    ?>
                                        <div class="woo-product-item-wrap">
                                            <div class="woo-product-item">
                                                <div class="woo-product-thumb">
                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail(); ?>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php do_action( 'woocommerce_single_add_to_cart'); ?>
                                                </div>
                                                <div class="woo-product-info">
                                                    <h2 class="woo-product-title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h2>
                                                    
                                                    <div class="woo-variation-add-to-cart">
                                                        <a href="<?php the_permalink(); ?>" class="woo-variation-add-to-cart button alt">Add to cart</a>
                                                    </div>
                                                    <?php //do_action( 'woocommerce_single_add_to_cart'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            echo '</div>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
	}

	protected function content_template() {

	}
}
