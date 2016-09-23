<?php

global $woocommerce, $wpdb, $wp_query, $sellegance_opt;

$sidebar_pos = $sellegance_opt['shop_sidebar'] ? $sellegance_opt['shop_sidebar'] : 'left';
if (isset($_GET["product_sidebar"])) { $sidebar_pos = $_GET["product_sidebar"]; }

$prodrow = $sellegance_opt['products_per_row'] ? $sellegance_opt['products_per_row'] : 'three_side';
if (isset($_GET["product_num"])) { $prodrow = $_GET["product_num"]; }
get_header('shop'); ?>

	<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
		<!-- woocommerce message -->

		<div class="row">
			<div class="col-sm-12">    
		<?php  wc_print_notices(); ?>
			</div>
		</div>

	<?php } ?>

	<div class="woocommerce woocommerce-page">

		 <div class="page-header">
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			
			<?php echo et_breadcrumbs(); ?>

		 </div>
					 
		<div class="row side_<?php echo $sidebar_pos; ?>">
		
		
		<?php if( $sidebar_pos == 'fullwidth' ): ?>
			<div id="primary" class="col-sm-12 full_width">
		<?php else: ?>
			<div id="primary" class="col-sm-9 sidebar side<?php echo $sidebar_pos; ?>">
		<?php endif; ?>              

		<?php 
		global $wp_query;
		$cat = $wp_query->get_queried_object(); 

		$attach_id = sellegance_brands_thumbnail_id($cat->term_id);		
		$image = wp_get_attachment_image_src($attach_id,'brands');
		?>

		<div class="brand-desc clearfix">
			<?php if($attach_id > 0) {
				$image = $image[0]; ?>
			<div class="brand-logo"><img class="attachment-shop_thumbnail wp-post-image" src="<?php echo $image?>" /></div>
			<?php } ?>
			
			<?php if(isset($cat->description) && $cat->description !='') {
				echo do_shortcode($cat->description);
				} ?>
		</div>
		

		<?php if ( have_posts() ) : ?>       
		
		<div class="category_header">

			 <?php if (woocommerce_products_will_display()): ?>
				
				<div class="toolbar toolbar-top">
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					<div class="clear"></div>
				</div>
			 
			 <?php endif ?> 
  
			</div>
			
		<?php if (woocommerce_product_subcategories(array( 'before' => '<div id="shop_categories" class="'.$prodrow.'"><ul id="products_cat" class="products">', 'after' => '</ul></div>' ))) : ?>         
		<?php endif; ?>
			
			<div id="prodrow" class="row <?php echo $prodrow?>">
				<div class="col-sm-12">

					<?php $view_mode = $sellegance_opt['products_default_view']; ?>

					<?php 
						if($view_mode == 'list') {
							$view_class = 'products-list'; 
						} else {
							$view_class = 'products-grid'; 
						}
					?>
					
						<ul id="products" class="product-loop <?php echo $view_class; ?>">                    

							<?php while ( have_posts() ) : the_post(); ?>

								<?php woocommerce_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						
						</ul>
						
				 </div>
			 </div>


			<?php else : ?>
			
				<?php if ( ! woocommerce_product_subcategories() ) : ?>
	
					 <h3><?php _e( 'No products found which match your selection.', 'sellegance' ); ?></h3>
	
				<?php endif; ?>            
	
			<?php endif; ?>
	
			<div class="clearfix"></div>
			
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		</div>
		
		<?php if( $sidebar_pos == 'left' ||  $sidebar_pos == 'right' ): ?>
			<div class="col-sm-3 rsidebar">
				<div class="aside_sidecolumn">
					<?php dynamic_sidebar('shop_sidebar'); ?>
				</div>
			</div>            
		<?php endif; ?>

	  </div>

	</div>


<?php get_footer('shop'); ?>