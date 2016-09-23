<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby' 				=> $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>    
    
    <?php $sliderrandomid = rand() ?>
    
    <script>
	jQuery(document).ready(function($) {
		/* items_slider */
		$('.items_slider_id_<?php echo $sliderrandomid ?> .items_slider').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			navNextSelector: $('.items_slider_id_<?php echo $sliderrandomid ?> .items_sliders_nav .big_arrow_right'),
			navPrevSelector: $('.items_slider_id_<?php echo $sliderrandomid ?> .items_sliders_nav .big_arrow_left')
		});
	});
	</script>
    
        <br /><br />
        <div class="items_slider_id_<?php echo $sliderrandomid ?>">
            
            <div class="items_sliders_header">
                <div class="items_sliders_title">
                    <div class="featured_section_title"><span><?php _e('You may be interested in&hellip;', 'sellegance') ?></span></div>
                    <div class='clearfix'></div>
                </div>
                <div class="items_sliders_nav">                        
                    <a class='big_arrow_right'></a>
                    <a class='big_arrow_left'></a>
                    <div class='clearfix'></div>
                </div>
            </div>
 
        
            <div class="items_slider_wrapper">
                <div class="items_slider">
                    <ul class="slider">
                    <?php woocommerce_product_loop_start(); ?>
                    
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        
				<?php wc_get_template_part( 'content', 'product' ); ?>
            
                        <?php endwhile; // end of the loop. ?>
                        
                        <?php woocommerce_product_loop_end(); ?>
                    </ul>     
                </div>
            </div>
        
        </div>
    
<?php endif;

wp_reset_query();