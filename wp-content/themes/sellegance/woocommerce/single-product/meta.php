<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
global $sellegance_opt;
?>
			
			
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span itemprop="productID" class="sku_wrapper"><strong><?php _e( 'SKU:', 'sellegance' ); ?></strong>&nbsp;&nbsp;<span class="sku"><?php echo $product->get_sku(); ?></span></span>
		
	<?php endif; ?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'sellegance' ) . '&nbsp;&nbsp;', '.</span>' );
	?>
	
	<?php if(($term_id = get_brands_term_by_product_id($product->id)) > 0): $term = get_term($term_id,'brands');?>
	<span class="brand"><strong><?php _e( 'Brand:', 'sellegance' ); ?></strong> <a href="<?php echo get_term_link($term_id,'brands');?>"><?php echo $term->name?></a></span>
	<?php endif; ?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'sellegance' ) . '&nbsp;&nbsp;', '.</span>' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

	<?php if ($sellegance_opt['share_buttons']==1) { ?>
		<div class="product_share"> 
			
			<ul>    
				<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank" title="<?php _e('Share on Facebook', 'sellegance'); ?>"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="twitter" title="<?php _e('Tweet this item', 'sellegance'); ?>" data-toggle="tooltip"><i class="fa fa-twitter"></i></a></li> 
				 <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="google-plus" onclick="javascript:window.open(this.href,
					  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php _e('Share on Google+', 'sellegance'); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php if ( has_post_thumbnail() ) {
					$image_link = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
					<li><a href="<?php the_permalink(); ?>" data-image="<?php echo $image_link ?>" data-desc="<?php strip_tags(the_title()); ?>" class="btnPinIt pinterest"><i class="fa fa-pinterest"></i></a>
					</li>
				<?php } ?>
				<li><a href="mailto:enteryour@addresshere.com?subject=<?php strip_tags(the_title()); ?>&body=<?php echo strip_tags(apply_filters( 'woocommerce_short_description', $post->post_excerpt )); ?> <?php the_permalink(); ?>" class="envelope"  title="<?php _e('Email a Friend', 'sellegance'); ?>"><i class="fa fa-envelope"></i></a></li>
				<li><a href="<?php the_permalink(); ?>" class="link"  title="<?php _e('Permalink', 'sellegance'); ?>"><i class="fa fa-link"></i></a></li>  
			</ul>
			<script>
			(function($){
				$(window).load(function(){
					$('.btnPinIt').click(function() {
					    var url = $(this).attr('href');
					    var media = $(this).attr('data-image');
					    var desc = $(this).attr('data-desc');
					    window.open("//www.pinterest.com/pin/create/button/"+
					    "?url="+url+
					    "&media="+media+
					    "&description="+desc,"pinIt","toolbar=no, scrollbars=no, resizable=no, top=0, right=0, width=750, height=320");
					    return false;
					});
				})
			})(jQuery);
			</script>
		</div>
	<?php } ?>

</div>

