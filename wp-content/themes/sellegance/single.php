<?php 
global $sellegance_opt;
$page_for_posts = get_option('page_for_posts');
$blog = get_post($page_for_posts);
$sidebar_pos = $sellegance_opt['blog_sidebar'] ? $sellegance_opt['blog_sidebar'] : 'right';
?>
<?php  $format = get_post_format(); if( false === $format ) { $format = 'standart'; } ?>
<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="page-header">

		<h3 class="sub-title-page"><?php echo $blog->post_title; ?></h3>
		<h1 class="entry-title title-page" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></h1>
		
		<?php echo et_breadcrumbs(); ?>

	</header>
		


	<div class="row side_<?php echo $sidebar_pos; ?> blogsingle ">
	
		<div id="primary" class="col-md-9 sidebar">

			<div id="content" class="site-content mainborder" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
				
				<div class="blog_list single_blog_title">
				
					
				<div class="entry_post">
				<div class="entry_meta clearfix">
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
					<ul>
						<li class="author"><?php _e( 'By', 'sellegance' ); ?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></li>
						<li class="date_show"><span><?php _e( 'Posted on', 'sellegance' ); ?></span> <?php the_time( get_option('date_format') ); ?></li>
					</ul>
				<?php endif; // End if 'post' == get_post_type() ?>
				</div>
				</div>
				<div class="clearfix"></div>
				</div>
			
			
			 <?php  if ( get_post_meta(get_the_ID(), 'tdl_post_featured_image', true) == '1' ) :?>    
						
				<?php 
				$the_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'post-thumb');
				$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
				$alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
				?>
				
				<?php if( $format == 'standart' ): ?><!-- Standart Post --> 
					<?php if ( has_post_thumbnail() ):?>
						<div class="entry_image single_image">
						<a class="zoom" rel="magnificPopup" href="<?php echo $full_thumb[0]; ?>" title="<?php the_title_attribute(); ?>"></a>
						<a href="<?php echo $full_thumb[0]; ?>" rel="magnificPopup" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo $the_thumb[0]; ?>" width="<?php echo $the_thumb[1]; ?>" height="<?php echo $the_thumb[2]; ?>" 
				alt="<?php if(count($alt)) echo $alt; ?>" title="<?php the_title_attribute(); ?>" />
						</a>
						</div>
					<?php endif; ?>
					
				<?php elseif( $format == 'video' ): ?><!-- Video Post --> 
					<?php if ( get_post_meta( get_the_ID(), 'tdl_post_video', true ) !== '' ):?>
					<?php
					$video_embed_code = get_post_meta( get_the_ID(), 'tdl_post_video', true );
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

				<?php elseif( $format == 'gallery' ): ?><!-- Gallery Post -->
					<?php if ( rwmb_meta( 'tdl_post_gallery') !== '' ):?>
					<?php 
					$gallery = rwmb_meta( 'tdl_post_gallery', 'type=image&size=large' );
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
										autoSlide: <?php if (get_post_meta( get_the_ID(), 'tdl_post_slideshow', true ) == 1) {echo "true";} else {echo "false";}?>,
										autoSlideTimer: <?php echo get_post_meta( get_the_ID(), 'tdl_post_slideshowSpeed', true ); ?>,								
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
									<img src="<?php echo $gallery_image['url']; ?>" width="<?php echo $gallery_image['width']; ?>" height="<?php echo $gallery_image['height']; ?>" alt="<?php echo $gallery_image['alt']; ?>" title="<?php the_title_attribute(); ?>" /></a>
									</span>
								</div>
								<?php endforeach; ?>
								
							</div>
							
							<div class='products_slider_previous'></div>
							<div class='products_slider_next'></div>
					   </div> 

					<?php endif; ?>

				<?php else: ?>    
				<?php endif; ?>
				 <?php endif; ?>           
					<div class="entry-content">
						<?php the_content(); ?>
						<div class="clearfix"></div>
						
						<?php wp_link_pages( array( 'before' => '<ul class="page_links"><li>' . __( 'Pages:', 'sellegance' ).'</li>', 'after' => '</li></ul>','separator' => '<li>' ) ); ?>

					</div><!-- .entry-content -->
					
				<div class="product_share post_share"> 
				<?php $full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full'); ?>
					<ul>    
						<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank" title="<?php _e('Share on Facebook', 'sellegance'); ?>"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="twitter" title="<?php _e('Tweet this item', 'sellegance'); ?>" data-toggle="tooltip"><i class="fa fa-twitter"></i></a></li> 
						 <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="google-plus" onclick="javascript:window.open(this.href,
							  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php _e('Share on Google+', 'sellegance'); ?>"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="<?php the_permalink(); ?>" data-image="<?php echo $full_thumb[0] ?>" data-desc="<?php strip_tags(the_title()); ?>" class="btnPinIt">
						    <i class="fa fa-pinterest"></i></a> 
						</li>
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
					<div class="clearfix"></div>        
				</div>
					
				<div class="entry-meta-foot">
					<ul>
						 <?php if( has_category() ): ?>
						 <li><span><?php _e( 'Posted in', 'sellegance' ); ?></span> <?php the_category( ', ' ); ?></li>
						<?php endif; ?>

						  <?php $tags_list = get_the_tag_list( '', __( ', ', 'sellegance' ) );
							   if ( $tags_list ) :?>
						 <li class="tags"><?php printf( __( 'Tags: %1$s', 'sellegance' ), $tags_list ); ?></li>
						 <?php endif; // End if $tags_list ?>

					 </ul>
					 <div class="clearfix"></div>
				</div><!-- .entry-meta-foot -->


				<?php if($sellegance_opt['post_prev_next']==1) { ?>
					<?php the_previousnextlinks(); ?>
				<?php } ?>

				<?php if($sellegance_opt['blog_related_posts']==1) { ?>
					<?php getRelatedPosts(); ?>
				<?php } ?>


				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
			
			<?php edit_post_link( __( 'Edit', 'sellegance' ), '<span class="edit-link">', '</span>' ); ?>  
			</div>
			

			<div class="col-md-3 rsidebar">
				 <div class="aside_sidecolumn">
					  <?php get_sidebar(); ?>
				 </div>
			</div>            
		

		</div>

	</article><!-- #post-<?php the_ID(); ?> -->

<?php get_footer(); ?>