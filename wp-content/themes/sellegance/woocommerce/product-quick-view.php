<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $post;
global $sellegance_opt;

$zoom = $sellegance_opt['zoom_effect'];

?>

	<div class="row product-info">

		<div class="col-sm-6">

			<div class="images prod_images">

				<a href="#" class='zoom hide'>Bug Fix</a>
				<?php
							
					if ( has_post_thumbnail() ) {

						$attachment_ids 	= $product->get_gallery_attachment_ids();
						$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
						$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
						$attachment_count   = count( $product->get_gallery_attachment_ids() );

						?>

							 
						<div class = 'productSlider'>
						
							<div class = 'slider'>
							
								<?php if ( has_post_thumbnail() ) : ?>
								
								<?php
									//Get the Thumbnail URL
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
									
									$attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );
							
								?>
								
								<div class="item">
									<span itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?></span>
								</div>
								
								<?php endif; ?>	
								
								<?php
					
									if ( $attachment_ids ) {
								
										$loop = 0;
										$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );						
										
										foreach ( $attachment_ids as $attachment_id ) {
					
											$classes = array( 'zoom' );
								
											if ( $loop == 0 || $loop % $columns == 0 )
												$classes[] = 'first';
								
											if ( ( $loop + 1 ) % $columns == 0 )
												$classes[] = 'last';
								
											$image_link = wp_get_attachment_url( $attachment_id );
								
											if ( ! $image_link )
												continue;
								
											$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
											$image_class = esc_attr( implode( ' ', $classes ) );
											$image_title = esc_attr( get_the_title( $attachment_id ) );
											
											printf( '<div class="item"><span>%s</span></div>', wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) );
											
											$loop++;
										}
								
									}
								?>
							
							</div>
							
							<?php if ( $attachment_count != 1 ) { ?>
							<div class='products_slider_previous'></div>
							<div class='products_slider_next'></div>
							<?php } ?>
							
						</div>
						
						<link rel="image_src" href="<?php echo $src[0] ?>" />
							
						<?php

					} else {

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

					}
				?>

			</div> <!-- .prod_images -->

		</div>

		<div class="col-sm-6 product_meta">

			<div class="page-header">
				<h3 class="product-name test-triggers"><?php the_title(); ?></h3>
			</div>

			<div class="prodlink"><a class="btn btn-default btn-sm" href="<?php the_permalink(); ?>"><?php _e( 'View Product', 'sellegance' ); ?></a></div>

			<?php woocommerce_template_loop_rating(); ?>

			<div class="prodcode"><span itemprop="productID" class="sku_wrapper"><?php _e( 'Product code', 'sellegance' ); ?>: <span class="sku"><?php echo $product->get_sku(); ?></span></span></div>

			<?php woocommerce_template_single_price(); ?>
			
			<?php woocommerce_template_single_excerpt(); ?>

			<?php woocommerce_template_single_add_to_cart(); ?>

		</div>

	</div>