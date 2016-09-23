<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

global $sellegance_opt;

// Get category permalink
$permalinks 	= get_option( 'woocommerce_permalinks' );
$category_slug 	= empty( $permalinks['category_base'] ) ? _x( 'product-category', 'slug', 'woocommerce' ) : $permalinks['category_base'];
 
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>	
	
	<div class="product_main_info">
	
		<?php
			/**
			 * woocommerce_before_single_product hook
			 *
			 * @hooked wc_print_notices - 10
			 */
			 do_action( 'woocommerce_before_single_product' );
		?>    

		<div class="product_navigation top"> 
		
		<?php
			$terms = get_the_terms($post->ID,'product_cat');
			$term_list = '';
			if( !empty( $terms )):
		?> 
			   
			<div class="product_navigation_wrapper visible-xs">	
				
				<?php
					foreach ($terms as $term) {
						$term_list .= '<a href="'.home_url() . '/' . $category_slug . '/'. $term->slug . '">' . $term->name . '</a>';
					}
					
					echo '<div class="nav-back">'. __('Back to ', 'sellegance').$term_list.'</div>';
				?>
				<?php if ($sellegance_opt['product_prev_next']==1) { ?>
				<div class="product_navigation_container">
					<?php next_post_link_product('%link', 'next', true); ?>
					<?php previous_post_link_product('%link', 'prev', true); ?>
				</div> 
				<?php } ?>

			</div>

			<div class="clearfix"></div> 

		<?php endif; ?>

	<div class="page-header">
		<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
	</div>

			<div itemprop="offers" itemscope itemtype="http://schema.org/Offer"  class="summary visible-xs">
			
				<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>
			
				<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
			
			</div> 
	   

		</div>

		<!-- Show sidebar -->
		<?php if (is_active_sidebar('product_sidebar')) $ps=1; else $ps=0; ?>

		<div class="row">

			<div class="product_details left_col col-sm-5 <?php echo ($ps==1) ? 'col-md-5' : ''; ?>">
			
				<?php
					/**
					 * woocommerce_show_product_images hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>
			
			</div>

			<?php 

			$details_mode=$sellegance_opt['product_details_mode'];
			if (isset($_GET["details_mode"])) { $details_mode = $_GET["details_mode"]; }


			if ($details_mode=='tab_accordion') {
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
				add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 32);
			}

			?>
			
			<div class="product_details right_col col-sm-7 <?php echo ($ps==1) ? 'col-md-7' : ''; ?>">
				<?php
					$terms = get_the_terms($post->ID,'product_cat');
					$term_list = '';
					if( !empty( $terms )):
				?>          

					<div class="product_navigation hidden-xs">
						<?php
							foreach ($terms as $term) {
								$term_list .= '<a href="'.home_url() . '/' . $category_slug . '/'. $term->slug . '">' . $term->name . '</a>';
							}
							
							echo '<div class="nav-back">'. __('Back to ', 'sellegance').$term_list.'</div>';
						?>        
						
						<?php if ($sellegance_opt['product_prev_next']==1) { ?>
							<div class="product_navigation_container">
								<?php next_post_link_product('%link', 'next tooltp', true); ?>
								<?php previous_post_link_product('%link', 'prev tooltp', true); ?>
							</div>
						<?php } ?>
						  
						<div class="clearfix"></div>
					</div>  
			  
				<?php endif; ?> 

			<?php if ($ps==1) { ?>
			<div class="row">
				<div class="col-sm-12 col-md-8">
			<?php } ?>

				<div class="summary">

					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
			
				</div><!-- .summary -->

			<?php if ($ps==1) { ?>
				</div>
				<div class="col-md-4 hidden-sm rsidebar">
					<div class="aside_sidecolumn">
						<?php dynamic_sidebar('product_sidebar'); ?>
					</div>
				</div>
			</div>
			<?php }?>


			
			</div> <!-- .right-col -->

		</div> <!-- .row -->
		
	</div>
	
	<?php
		//Get the Thumbnail URL
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
	?>
	


	<div class="afterproduct clearfix">
	
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>