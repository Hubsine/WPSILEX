<?php
/**
 * Single Product Image
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.14
 */
		
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

?>

<?php 
/**
* Check if Cloud Zoom is active
**/
if ( in_array( 'cloud-zoom-for-woocommerce/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
?>
		
		<div class="images">
		
			<?php
				if ( has_post_thumbnail() ) {
		
					$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );

					$attachment_count   = count( $product->get_gallery_attachment_ids() );
		
					if ( $attachment_count > 0 ) {
						$gallery = '[product-gallery]';
					} else {
						$gallery = '';
					}
		
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="magnificPopup' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
		
				} else {
		
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		
				}
			?>
		
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		
		</div>

<?php } else { ?>
			
			<div class="images prod_images">
				
				<script type="text/javascript">
				
					(function($){
					   $(window).load(function(){
						   $('.productSlider').iosSlider({
								scrollbar: false,
								snapToChildren: true,
								desktopClickDrag: true,
								infiniteSlider: false,
								navPrevSelector: $('.products_slider_previous'),
								navNextSelector: $('.products_slider_next'),
								scrollbarHeight: '2',
								scrollbarBorderRadius: '0',
								scrollbarOpacity: '0.5',
								onSliderLoaded: productSlider2Load,
								onSlideChange: productSlider2Load,
								onSliderResize: productSlider2Load
							});
							
							$('.productThumbs .button').each(function(i) {				
								$(this).bind('click', function() {
									$('.productSlider').iosSlider('goToSlide', i+1);						
								});				
							});
							
			
							$('.productThumbs').iosSlider({
								desktopClickDrag: true,
								snapToChildren: true,
								snapSlideCenter: false,
								infiniteSlider: false
							});
							
							function productSlider2Load(args) {
								
								currentSlide = args.currentSlideNumber;
								$('.productThumbs').iosSlider('goToSlide', args.currentSlideNumber);
								
								/* update indicator */
								$('.productThumbs .button').removeClass('selected');
								$('.productThumbs .button:eq(' + (args.currentSlideNumber-1) + ')').addClass('selected');
								
								/* update height of the first slider */
		
								setTimeout(function() {
									var setHeight = $('.productSlider .item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
									$('.productSlider').animate({ height: setHeight }, 300);
								},300);
								
							}
					   })
					})(jQuery);
		
				</script>
			
			
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
							<a href="<?php echo $src[0] ?>" class="zoom" rel="magnificPopup[product-gallery]"></a>
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
									
									printf( '<div class="item"><span>%s</span><a href="%s" class="zoom" rel="magnificPopup[product-gallery]"></a></div>', wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ), wp_get_attachment_url( $attachment_id ) );
									
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
		
				if ( $attachment_ids ) {
				
				?>
				
				<div class = 'productThumbs'>
					
					<div class = 'slider'>
						
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="button"><div itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ) ?></div></div>
						<?php endif; ?>
						
						<?php
				
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
							
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="button">%s</div>', $image ), $attachment_id, $post->ID, $image_class );
							
							$loop++;
						}
						
						if ($loop < 4) {
							for ($i=1; $i<(4-$loop); $i++) {
							?>
								<div class="button"><!-- empty placeholder --></div>
							<?php
							}
						}
						?>
			
					</div>
				
				</div>
				
				<?php } ?>
			
			</div>
	
<?php } ?>

	
	<div class="clearfix"></div>
