<?php
/**
 * The Template for merch category
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


$terms = get_terms( array(
    'taxonomy' => 'merch_category',
    'hide_empty' => false,
) );

$tax_slug = '';
$tax_desc = '';
$tax = $wp_query->get_queried_object();
$current = get_the_terms( get_the_ID(), 'merch_category');

if ( ! empty( $tax ) && ! is_wp_error( $tax ) ) {
    $tax_slug = $tax->slug;
    $tax_desc = $tax->description;
}

?>

<main id="main" class="site-main" role="main">
    <div class="container">
        <div class="woo-content-wrap">
            <div class="woo-col-category">
                <?php 
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        echo '<ul>';
                            foreach ( $terms as $term ) {
                                if( $tax_slug == $term->slug ) {
                                    echo '<li class="current"><a href="'.get_term_link($term->slug, 'merch_category').'">' . $term->name . '</a></li>';
                                } else {
                                    echo '<li><a href="'.get_term_link($term->slug, 'merch_category').'">' . $term->name . '</a></li>';
                                }
                            }
                            echo '<li><a href="' . get_site_url() . '/merch">All</a></li>';
                            
                        echo '</ul>';
                    }
                ?>
            </div>

            <div class="woo-col-content">
                <?php 
                    if( !empty( $tax_desc ) ) {
                        echo '<div class="woo-term-desc">' . $tax_desc . '</div>';
                    }

                ?>

                <?php if ( have_posts() ) : ?>
                    <div class="woo-products-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="woo-product-item">
                                <div class="woo-product-thumb">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <h2 class="woo-product-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer( 'shop' );
