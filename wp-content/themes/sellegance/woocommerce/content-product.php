<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
global $sellegance_opt;

if($product) $attachment_ids = $product->get_gallery_attachment_ids();

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

?>

	<?php $productshort_cart = $_product->post->post_excerpt;
echo $productshort_cart; ?>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<li class="product_item <?php if ($sellegance_opt['product_animation']) { ?><?php echo $sellegance_opt['product_animation']; ?> <?php } ?>">
		
		<div class="image_container">

			<?php
			
			if ($product->is_on_sale()) {				
				woocommerce_get_template( 'loop/sale-flash.php' );		
			} 
				
				if ($sellegance_opt['new_badge']) {
			
					$postdate 		= get_the_time( 'Y-m-d' );			// Post date
					$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
					$newness 		= $sellegance_opt['new_badge_duration']; 	// Newness in days
		
				if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
						if ($product->is_on_sale()) {
							echo '<div class="newbadge_sale">' . __( 'New', 'sellegance' ) . '</div>';
						}
						else echo '<div class="newbadge">' . __( 'New', 'sellegance' ) . '</div>';
					}				
				}

			
			if (is_out_of_stock()) {
				echo '<div class="outstock">' . __( 'Out of Stock', 'sellegance' ) . '</div>';
			}

			?>
	
	
			<a class="prodimglink" href="<?php the_permalink(); ?>">

				<div class="loop_product front"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog') ?></div>
				<?php if ($sellegance_opt['product_animation']!='noanim') { ?>
				
				<?php

					if ( $attachment_ids ) {
				
						$loop = 0;				
						
						foreach ( $attachment_ids as $attachment_id ) {
				
							$image_link = wp_get_attachment_url( $attachment_id );
				
							if ( ! $image_link )
								continue;
							
							$loop++;
							
							printf( '<div class="loop_products back">%s</div>', wp_get_attachment_image( $attachment_id, 'shop_catalog' ) );
							
							if ($loop == 1) break;
						
						}
				
					} else {
					?>
					
					<div class="loop_products back"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog') ?></div>
					
					<?php
						
					}
				?>
				
				<?php } ?>
				
			</a>
							
			<?php if ( $sellegance_opt['show_quick_view']==1 ) { ?>
				<div class="product_button_cont">
					<div class="product_button">
						<a class="button product_button show-quickly" data-prodid="<?php echo $post->ID;?>" style="font-size:11px; cursor: pointer;"><?php _e('Quick View', 'sellegance') ?> +</a>
					
					</div>
				</div>            
			<?php } else { ?>
				<?php if ( $sellegance_opt['catalog_mode']!=1 ) { ?> 
				<div class="product_button_cont">
					<div class="product_button"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
				</div>
				<?php } ?>
			<?php } ?>
		
		</div>
						
		<div class="product_details">

			<?php if ( $sellegance_opt['category_listing']) { 
				$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
				echo $product->get_categories( ', ', '<p class="category">' . _n( ' ', '', $size, 'woocommerce' ) . ' ', '</p>' );
				} ?>

			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				 
				//do_action( 'woocommerce_after_shop_loop_item_title' );

			?>

			<div class="product-excerpt">
			
				<?php the_excerpt(); ?>
			
			</div>

			<div class="add-to-container">
				
				<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_price - 10
					 */
					//if (etheme_get_option('product_page_price')) {
						do_action( 'woocommerce_after_shop_loop_item_title' );
					//}
				?>
				
				<?php 
					//if (etheme_get_option('product_page_addtocart')) {
						do_action( 'woocommerce_after_shop_loop_item' );
					//} 
				?>
			</div> <!-- .add-to-container -->
						
			<?php if (in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>            
					
				<div class="product-actions"> 

					<?php if (in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?> 
						<div class="action wishlist">
							<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?> 
						</div>
					<?php } ?>

					<?php if (in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?> 
						<div class="action compare">
							<?php echo do_shortcode('[yith_compare_button]'); ?>
						</div>
					<?php } ?>

				</div>

			<?php endif; ?>

		</div> <!-- .product_details -->

	</li>
