<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-edibles', $product ); ?>>
	<section class="product-header">
		<div class="entry-featured">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
			
			<?php 
				// Related category
				$product_id = get_the_ID();
				$cats_array = array( 0 );
				$cats = wp_get_post_terms( $product_id, 'product_cat' );
				foreach ( $cats as $cat ) {
				$cats_array[] = $cat->term_id;
				}
				$cats_array = array_map( 'absint', $cats_array );

				$related = new WP_Query(
					array(
						'post_type'           => 'product',
						'post_status' 		  => 'publish',
						'posts_per_page'      => -1,
						//'post__not_in'        => array( $product_id ),
						'tax_query'           => array(
							'relation' => 'OR',
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $cats_array,
								'operator' => 'IN',
							),
						),
					)
				);
				
			?>

			<?php if ( $related->post_count != 0 ) { ?>
				<div class="product-field custom-select">
					<select name="product_field" id="product_field">
						<?php 
							while ( $related->have_posts() ) { $related->the_post(); 
								
								if( $product_id == get_the_ID() ) {
									echo '<option value="'. get_the_ID() .'" selected="selected">' . get_the_title() . '</option>';
								} else {
									echo '<option value="'. get_the_ID() .'">' . get_the_title() . '</option>';
								}
							}
						?>
					</select>
				</div>
			<?php } wp_reset_postdata(); ?>
		</div>
		<div class="summary entry-summary">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_excerpt - 20
			 */
			do_action( 'woocommerce_single_title' );
			do_action( 'woocommerce_single_excerpt' );
			?>

			<?php  
				$total_thc = get_field('total_thc');
				$total_cbd = get_field('total_cbd');
				$servings = get_field('servings');
				$per_pack = get_field('per_pack');
			?>

			<?php if( !empty( $total_thc ) || !empty( $total_cbd ) || !empty( $servings ) || !empty( $per_pack ) ) { ?>
				<ul class="product-metas">
					<?php if( !empty( $total_thc ) ) { ?>
						<li>
							<h3 class="meta-title">TOTAL THC</h3>
							<?php echo '<div class="meta-value">' . $total_thc . '<span class="unit">mg</span></div>' ?>
						</li>
					<?php } ?>

					<?php if( !empty( $total_cbd ) ) { ?>
						<li>
							<h3 class="meta-title">TOTAL CBD</h3>
							<?php echo '<div class="meta-value">' . $total_cbd . '<span class="unit">mg</span></div>' ?>
						</li>
					<?php } ?>

					<?php if( !empty( $servings ) ) { ?>
						<li>
							<h3 class="meta-title">SERVINGS</h3>
							<?php echo '<div class="meta-value">' . $servings . '</div>'; ?>
						</li>
					<?php } ?>

					<?php if( !empty( $per_pack ) ) { ?>
						<li>
							<h3 class="meta-title">PER PACK</h3>
							<?php echo '<div class="meta-value">' . $per_pack . '</div>'; ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</section>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_upsell_display - 15
	 */
	do_action( 'woocommerce_upsell_display' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>