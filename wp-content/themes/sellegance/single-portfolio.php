<?php global $sellegance_opt; ?>

<?php get_header(); ?>
	<div class="row">
		<div class="col-sm-12">
			<header class="page-header">
				<h1 class="entry-title title-page"><?php the_title(); ?></h1>
				<h3 class="sub-title-page"><?php echo get_post_meta(get_the_ID(), 'tdl_port_caption', TRUE); ?></h3>
							
				<?php echo et_breadcrumbs(); ?>

			</header><!-- .page-header -->
		</div>
	</div>

		<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
			<!-- woocommerce message -->
			<div class="row">
				<div class="col-sm-12">    
			<?php  wc_print_notices(); ?>
				</div>
			</div>
		<?php } ?>

<?php  
$format = get_post_meta( get_the_ID(), 'tdl_port_type', true ); if( false === $format ) { $format = 'pic'; };
?>

<?php if (have_posts()) : while (have_posts()) : the_post();

$getterms = get_the_terms(get_the_ID(), 'port-group');
				
if ($getterms) {
	 $portterms = array();
	 foreach ($getterms as $getterm) {
	 $portterms[] = $getterm->slug;
}
					
}
$portid = get_the_ID();
$the_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full-width');
$alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
$date = get_post_meta( get_the_ID(), 'tdl_port_date', true );
$client = get_post_meta( get_the_ID(), 'tdl_port_client', true );
$url = get_post_meta( get_the_ID(), 'tdl_port_url', true );
$type = get_post_meta( get_the_ID(), 'tdl_port_type', true );
$content_post = get_post( get_the_ID() );
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]>', $content);

$nextpost = get_next_post();
if ($nextpost) {
	$nextpostid = $nextpost->ID;
	$nextpostlink = get_permalink( $nextpostid );
}
$prevpost = get_previous_post();
if($prevpost) {
	$prevpostid = $prevpost->ID;
	$prevpostlink = get_permalink( $prevpostid );
}
$portfolio_link = get_permalink($sellegance_opt['portfolio_page']);

?>  

	<div class="row single-portfolio">
		<div class="col-md-8 portfolio_left_area">
		
			<div class="product_navigation visible-sm">
				<div class="nav-back"><?php _e('Back to', 'sellegance'); ?> <a href="<?php echo $portfolio_link; ?>"><?php _e('Portfolio', 'sellegance'); ?></a></div>
				<div class="product_navigation_container">
					<?php if( $nextpost ) { ?><a class="next" title="<?php echo $nextpost->post_title; ?>" href="<?php echo $nextpostlink; ?>"></a><?php } ?>
					<?php if( $prevpost ) { ?><a class="prev" title="<?php echo $prevpost->post_title; ?>" href="<?php echo $prevpostlink; ?>"></a><?php } ?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
						 
			<?php if( $type == 'pic' ): ?>
				
				<?php if ( has_post_thumbnail() ):?>
				<div class="entry_image single_image">
					<span itemprop="image">
						<a href="<?php echo $full_thumb[0]; ?>" rel="magnificPopup" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo $the_thumb[0]; ?>" width="<?php echo $the_thumb[1]; ?>" height="<?php echo $the_thumb[2]; ?>" alt="<?php if(count($alt)) echo $alt; ?>" title="<?php the_title_attribute(); ?>" />
						</a>
					</span>
				</div>
			
			<?php endif; ?>

		<?php elseif( $type == 'gallery' && get_post_meta( get_the_ID(), 'tdl_port_thumbnails', true ) == 0 ): ?>

				<?php if ( rwmb_meta( 'tdl_port_gallery') !== '' ):?>
				<?php 
				$gallery = rwmb_meta( 'tdl_port_gallery', 'type=image&size=large' );
				$post_thumbnails = get_post_meta( get_the_ID(), 'tdl_post_thumbnails', true );
				?> 
			
				<script type="text/javascript">
				
					(function($){
						 $(window).load(function(){
							 $('#post_slider_<?php echo get_the_ID(); ?>').iosSlider({
								scrollbar: false,
								snapToChildren: true,
								desktopClickDrag: true,
								infiniteSlider: false,
								autoSlide: <?php if (get_post_meta( get_the_ID(), 'tdl_port_slideshow', true ) == 1) {echo "true";} else {echo "false";}?>,
								autoSlideTimer: <?php echo get_post_meta( get_the_ID(), 'tdl_port_slideshowSpeed', true ); ?>,
								navPrevSelector: $('.products_slider_previous'),
								navNextSelector: $('.products_slider_next'),
								scrollbarHeight: '2',
								scrollbarBorderRadius: '0',
								scrollbarOpacity: '0.5',
								onSliderLoaded: custom_post_UpdateSliderHeight,
								onSlideChange: custom_post_UpdateSliderHeight,
								onSliderResize: custom_post_UpdateSliderHeight,
							
						});
			
						function custom_post_UpdateSliderHeight(args) {
												
							currentSlide = args.currentSlideNumber;
							
							/* update height of the first slider */
				
								setTimeout(function() {
									var setHeight = $('#post_slider_<?php echo get_the_ID(); ?> .item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
									$('#post_slider_<?php echo get_the_ID(); ?>').animate({ height: setHeight+30 }, 300);
								},300);
								
							}
						
						})
					})(jQuery);
			
				</script>
					
				<div id="post_slider_<?php echo get_the_ID(); ?>" class="postSlider"> 
					<div class = "slider"> 
						<?php foreach ( $gallery as $gallery_image ): ?>
						 <div class="item">
							<span itemprop="image">
								<a class="zoom" rel="magnificPopup[gallery_<?php echo get_the_ID(); ?>]" href="<?php echo $gallery_image['url']; ?>" title="<?php the_title_attribute(); ?>"></a>
								<img src="<?php echo $gallery_image['url']; ?>" width="<?php echo $gallery_image['width']; ?>" height="<?php echo $gallery_image['height']; ?>" alt="<?php echo $gallery_image['alt']; ?>" title="<?php the_title_attribute(); ?>" />
							</span>
						</div>
						<?php endforeach; ?>
						
					</div>
					
					<div class='products_slider_previous'></div>
					<div class='products_slider_next'></div>
				 </div>
				
			<?php endif; ?>
			
			<?php elseif( $type == 'gallery' && get_post_meta( get_the_ID(), 'tdl_port_thumbnails', true ) == 1 ): ?>

				<?php if ( rwmb_meta( 'tdl_port_gallery') !== '' ):?>
				<?php 
				$gallery = rwmb_meta( 'tdl_port_gallery', 'type=image&size=large' );
				$post_thumbnails = get_post_meta( get_the_ID(), 'tdl_post_thumbnails', true );
				?> 
					
				<div id="post_gallery_<?php echo get_the_ID(); ?>" class="postGallery gallery"> 
					<div class = "row"> 
						<?php foreach ( $gallery as $gallery_image ): ?>

						<?php $gthumb = et_resize( $gallery_image['url'], 300, 200, true, false ); ?>

						 <div class="col-xs-6 col-md-4">
							<span itemprop="image">
								<a class="thumbnail" rel="magnificPopup[gallery_<?php echo get_the_ID(); ?>]" href="<?php echo $gallery_image['url']; ?>" title="<?php the_title_attribute(); ?>">
								<img src="<?php echo $gthumb[0]; ?>" width="<?php echo $gthumb[1]; ?>" height="<?php echo $gthumb[2]; ?>" alt="<?php echo $gallery_image['alt']; ?>" title="<?php the_title_attribute(); ?>" /></a>
							</span>
						</div>
						<?php endforeach; ?>
						
					</div>
					<div class="clearfix"></div>

				 </div>
				
			<?php endif; ?>

			<?php elseif( $type == 'video' ): ?>

				<?php if ( get_post_meta( get_the_ID(), 'tdl_port_video', true ) !== '' ):?>
				<?php
				$video_embed_code = get_post_meta( get_the_ID(), 'tdl_port_video', true );
				$vendor = parse_url($video_embed_code);?>
				
				<div class="entry_image single_image">
				
				<div class="vcontainer">
				<?php if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ ?>
							
				<?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_embed_code, PHP_URL_QUERY ), $my_array_of_vars ); ?>
								<iframe width="620" height="350" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
				<?php } else { ?>
								<iframe width="620" height="350" src="http://www.youtube.com/embed<?php echo parse_url($video_embed_code, PHP_URL_PATH);?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
				<?php } } ?>
					
				<?php if ($vendor['host'] == 'vimeo.com'){ ?>
				<iframe src="http://player.vimeo.com/video<?php echo parse_url($video_embed_code, PHP_URL_PATH);?>?title=1&amp;byline=1&amp;portrait=1" width="620" height="350" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>  
				<?php } ?>        
	 
						
				</div>
				</div>    
				<?php endif; ?>

			<?php endif; ?>
			
				<div class="product_share">
				<?php $full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full'); ?>
					<ul>    
						<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank" title="<?php _e('Share on Facebook', 'sellegance'); ?>"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="twitter" title="<?php _e('Tweet this item', 'sellegance'); ?>" ><i class="fa fa-twitter"></i></a></li> 
						 <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="google-plus" onclick="javascript:window.open(this.href,
								'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php _e('Share on Google+', 'sellegance'); ?>"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="<?php the_permalink(); ?>" data-image="<?php echo $full_thumb[0] ?>" data-desc="<?php strip_tags(the_title()); ?>" class="btnPinIt">
								<i class="fa fa-pinterest"></i>
						</a></li>
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
			
			</div>
			
			<div class="col-md-4 portfolio_right_area">
			
				<div class="product_navigation hidden-sm">
					<div class="nav-back"><?php _e('Back to', 'sellegance'); ?> <a href="<?php echo $portfolio_link; ?>"><?php _e('Portfolio', 'sellegance'); ?></a></div>
					<div class="product_navigation_container">
						<?php if( $nextpost ) { ?><a class="next" title="<?php echo $nextpost->post_title; ?>" href="<?php echo $nextpostlink; ?>"></a><?php } ?>
						<?php if( $prevpost ) { ?><a class="prev" title="<?php echo $prevpost->post_title; ?>" href="<?php echo $prevpostlink; ?>"></a><?php } ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				
					<div class="portfolio_meta">
					
						<?php if( $content ): ?>
						<div class="portfolio_description">
							<h3><?php _e('Description', 'sellegance'); ?></h3>
							<?php echo $content; ?>
						</div>
						<?php endif; ?>
						
						<div class="portfolio_details">    
							<ul class="project_details">
							
								<?php if( $date ): ?>
								<li class="published" title="September 27, 2012">
									<span class="fl"><?php _e('Date:', 'sellegance'); ?></span>
									<div><?php echo $date; ?></div>
								</li>
								<?php endif; ?>        
					
								<?php if( $client ): ?>
								<li class="user_name">
									<span class="fl"><?php _e('Client:', 'sellegance'); ?></span>
									<div><?php echo $client; ?></div>
								</li>
								<?php endif; ?>
								
								<li class="port_category">
									<span class="fl"><?php _e('Categories:', 'sellegance'); ?></span>
									<?php echo get_the_term_list( $post->ID, 'port-group', '<div>', ', ', '</div>' ); ?>
								</li>
								
							</ul>
								<?php if( checkurl( $url ) ): ?>
								<div class="project_button"><a href="<?php echo $url; ?>" target="_blank"><?php _e('View Project', 'sellegance'); ?></a></div>
								<?php endif; ?>
						</div>
					</div> 
					
									 
				
			</div> 
						 
		</div>
		
		<?php if( $sellegance_opt['portfolio_related'] != 0 ): ?>
		
		<?php $portid = get_the_ID(); $sliderrandomid = rand();  ?>
		
			<script>
			(function($){
				$(window).load(function(){
				/* items_slider */
				$('.items_slider_id_<?php echo $sliderrandomid ?> .items_slider').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					navNextSelector: $('.items_slider_id_<?php echo $sliderrandomid ?> .items_sliders_nav .big_arrow_right'),
					navPrevSelector: $('.items_slider_id_<?php echo $sliderrandomid ?> .items_sliders_nav .big_arrow_left'),
					onSliderLoaded: custom_portfolio_UpdateSliderHeight,
					onSlideChange: custom_portfolio_UpdateSliderHeight,
					onSliderResize: custom_portfolio_UpdateSliderHeight
				});
				
				function custom_portfolio_UpdateSliderHeight(args) {
										
					currentSlide = args.currentSlideNumber;
					
					/* update height of the first slider */
		
					setTimeout(function() {
					
						var setHeight = $('.items_slider_id_<?php echo $sliderrandomid ?> .items_slider .portfolio-item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
						$('.items_slider_id_<?php echo $sliderrandomid ?> .items_slider').animate({ height: setHeight+20 }, 300);
					},300);			
						
					}		
				})
			})(jQuery);
			</script>
		
			<div id="related_portslider" class="items_slider_id_<?php echo $sliderrandomid ?>">
				<div class="items_sliders_header">
					<div class="items_sliders_title">
						<div class="featured_section_title"><span><?php _e('Related Projects', 'sellegance'); ?></span></div><div class="clearfix"></div>

							<div class="items_sliders_nav">                        
								<a class='big_arrow_right'></a>
								<a class='big_arrow_left'></a>
								<div class='clearfix'></div>
							</div>
						
					</div>
				</div>
			
				<div class="items_slider_wrapper">
					<div class="items_slider portfolioitems_slider">
						 <ul class="slider">
							<?php
					
							$args = array(
								'post_status' => 'publish',
								'post_type' => 'portfolio',
								'post__not_in' => array( $portid ),
								'posts_per_page' => 8,
								'tax_query' => array( array( 'taxonomy' => 'port-group', 'field' => 'slug', 'terms' => $portterms))
							);
							
							$recentPosts = new WP_Query( $args );
							
							if ( $recentPosts->have_posts() ) : ?>
										
								<?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); 
								 $height = $sellegance_opt['portfolio_related_height'];
								 $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
								 $thumb = et_resize( $thumb[0], 300, $height, true, false );
								?>
							
									<li class="portfolio-item">
		
										<figure>
											<a class="link-to-post" href="<?php the_permalink(); ?>">
											<img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
											</a>
										</figure>
										
										<div class="portfolio-item-details">
											<span class="portfolio-item-category">
											<?php echo get_the_term_list( $post->ID, 'port-group', '', ', ', '' ); ?>
											</span>
											<h4 class="portfolio-item-title"><a class="link-to-post" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										</div>                                
									</li>
						
								<?php endwhile; // end of the loop. ?>
								
							<?php
		
							endif;
							//wp_reset_query();
							
							?>
						</ul>               
					</div>
				</div> <!-- .items_slider_wrapper -->

			</div>
		
		<?php endif; wp_reset_postdata(); ?>
		
		
		<?php if ($sellegance_opt['portfolio_comments']==1) { ?>
		<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					 comments_template( '', true );
				?>
				
		<?php } ?>


<?php endwhile; endif; ?>

<?php get_footer(); ?>