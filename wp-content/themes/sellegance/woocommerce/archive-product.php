<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;
global $sellegance_opt;

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

	<div class="page-header">
		<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		
		<?php echo et_breadcrumbs();?>

	</div>

	<div class="row side_<?php echo $sidebar_pos; ?>">		
	
	<?php if( $sidebar_pos == 'fullwidth' ): ?>
		<div id="primary" class="col-sm-12 full_width">
	<?php else: ?>
		<div id="primary" class="col-sm-9 sidebar side<?php echo $sidebar_pos; ?>">
	<?php endif; ?>

		<div class="mainborder">

			<?php if ( have_posts() ) : ?>  

				<div class="category_header">


					<?php if( is_shop() ): ?>

					<?php  
					$shop_banner = $sellegance_opt['shop_banner'];
					global $wp_query;
					$cat = $wp_query->get_queried_object();
					?>
					
					<?php if( $shop_banner == '1'): ?>
					
					<?php           

					$image = $sellegance_opt['shop_banner_img']['url'];
					$description = $sellegance_opt['shop_banner_desc'];
					$color = $sellegance_opt['shop_banner_desc_color'];
					$position = $sellegance_opt['shop_banner_desc_align'];
					$link = $sellegance_opt['shop_banner_link'];
		 
					if($image && $image !=''){

						?> <?php if(!empty ($link)) { ?><a href="<?php echo $link; ?>"><?php }; ?>
							<div class="grid_slider">

							<img class="cat-banner" src="<?php echo $image ?>" /> 
							
							<?php  if(!empty ($description)) { ?>
									<div class="product-category-description <?php echo $color; ?> <?php echo $position; ?>">
										<?php echo $description; ?>
									</div>
							<?php } ?>

							</div>
							
						<?php } ?>

						<?php if(!empty ($link)) { ?></a><?php }; ?>

						<?php endif; ?>            
					
					<?php else: ?>

						<?php
						global $wp_query;
						$cat = $wp_query->get_queried_object();
						
						$meta = get_option('banner');
						if (empty($meta)) $meta = array();
						if (!is_array($meta)) $meta = (array) $meta;
						$meta = isset($meta[$cat->term_id]) ? $meta[$cat->term_id] : array();
						$catimage = $meta['banner_image'];
						$bannercolor = $meta['color'];
						$bannerposition = $meta['position'];
						if($catimage && $catimage !=''){
							
							foreach ($catimage as $att) {
							// get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
							$src = wp_get_attachment_image_src($att, 'full');
							$src = $src[0];				
							?>

								<div class="grid_slider">
									<?php  if(isset($cat->description) && $cat->description !='' && !is_shop()) { ?>
											<div class="product-category-description <?php echo $bannercolor; ?> <?php echo $bannerposition; ?>">
												<?php echo do_shortcode($cat->description); ?>
											</div>
									<?php } ?>                    
									<img class="cat-banner" src="<?php echo $src ?>" /> 
								</div>
						 
							<?php } ?>
						<?php } ?>
				
					<?php endif; ?>

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
					
				</div> <!-- .category_header -->
					
				<?php if (woocommerce_product_subcategories(array( 'before' => '<div id="shop_categories" class="'.$prodrow.'"><ul id="products_cat" class="products">', 'after' => '</ul></div>' ))) : ?>
				<?php endif; ?>
			
				<div id="prodrow" class="row <?php echo $prodrow?>">
					
					<div class="col-sm-12">

						<?php $view_mode = $sellegance_opt['products_default_view']; ?>
						
						<?php 
							if($view_mode == 'list') {
								$view_class = 'products-list'; 
							}else{
								$view_class = 'products-grid'; 
							}
						?>
						
						<ul id="products" class="product-loop <?php echo $view_class; ?>">                    

							<?php while ( have_posts() ) : the_post(); ?>

								<?php woocommerce_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

						</ul>
						
						

					</div>

				</div> <!-- #prodrow --> 
	
	
			<?php else : ?>
			
				<?php if ( ! woocommerce_product_subcategories() ) : ?>
	
					 <h3><?php _e( 'No products found which match your selection.', 'sellegance' ); ?> </h3>
	
				<?php endif; ?>            
	
			<?php endif; ?>
			
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

			<?php if($sellegance_opt['global_search']==1 &&get_search_query() ) : ?>
			  <?php
			    /**
			     * Include pages and posts in search
			     */
			    query_posts( array( 'post_type' => array( 'post', 'page', 'portfolio' ), 's' => get_search_query() ) );

			    if(have_posts()){ echo '<div class="row"><div class="large-12 columns"><hr/>'; }

			    ?> 
			    <div class="search_portfolio">
			    	<h2 class="search-title"><?php _e('Portfolios', 'sellegance'); ?></h2>
			    	<div class="row">
			    <?php 
			    	// rewind the posts to filter for portfolio items
			    	rewind_posts();
			    	$i = 0;
			    	while( have_posts() ) : the_post();
			    		if( $post->post_type == 'portfolio' ) {
			    			$i++;
			    			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
			    			$thumb = et_resize( $thumb[0], 600, 300, true, false );
			    		
			    	?>
			    	
			    <div id="portfolio-<?php the_ID(); ?>" class="portfolio-item col-sm-3">
			    <?php if ( has_post_thumbnail() ):?>
			    	<figure>
			    		<a class="link-to-post" href="<?php the_permalink(); ?>">
			    		<img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
			    		</a>
			    	</figure>
			     <?php endif; ?>   
			    	<div class="portfolio-item-details">
			    		<span class="portfolio-item-category">
			    		<?php echo get_the_term_list( $post->ID, 'port-group', '', ', ', '' ); ?>
			    		</span>
			    		<h4 class="portfolio-item-title"><a class="link-to-post" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			    	</div>
			    </div>

			    <?php				
			    };		
			    	endwhile; 
			    	if( $i == 0 ) { printf('<div class="col-sm-12"><h4>%s</h4></div>', __('No portfolios match the search terms', 'sellegance')); }
			    ?>
			    	</div>
			    </div>
			    
			    
			    <div class="search_pages">
			    	<h2 class="search-title"><?php _e('Pages', 'sellegance'); ?></h2>
			    	<ol>
			    <?php 
			    	// return only our post items
			    	$i = 0;
			    	while( have_posts() ) : the_post(); 
			    		if( $post->post_type == 'page' ) {
			    			$i++;
			    			printf('<li><h4><a href="%1$s">%2$s</a></h4><p>%3$s</p></li>', get_permalink(), get_the_title(), get_the_excerpt()); 
			    		}
			    	endwhile;
			    	if( $i == 0 ) { printf('<li><h4>%s</h4></li>', __('No pages match the search terms', 'sellegance')); }
			    ?>
			    	</ol>

			    </div>                

			    <div class="search_posts">
			    	<h2 class="search-title"><?php _e('Posts', 'sellegance'); ?></h2>
			    	<ol>
			    <?php 
			    	// return only our post items
			    	$i = 0;
			    	while( have_posts() ) : the_post(); 
			    		if( $post->post_type == 'post' ) {
			    			$i++;
			    			printf('<li><h4><a href="%1$s">%2$s</a></h4><p>%3$s</p></li>', get_permalink(), get_the_title(), get_the_excerpt()); 
			    		}
			    	endwhile;
			    	if( $i == 0 ) { printf('<li><h4>%s</h4></li>', __('No posts match the search terms', 'sellegance')); }
			    ?>
			    	</ol>
			    </div>
			    <?php

			    if(have_posts()){ echo '</div></div>'; }

			    wp_reset_query();
			  ?>
			<?php endif; ?>
	
		</div><!-- mainborder -->

	</div> <!-- #primary -->
	
	<?php if( $sidebar_pos == 'left' ||  $sidebar_pos == 'right' ): ?>
		<div class="col-sm-3 rsidebar">
			<div class="aside_sidecolumn">
				<?php dynamic_sidebar('shop_sidebar'); ?>
			</div>
		</div>
	<?php endif; ?>          
  </div>

<?php get_footer('shop'); ?>