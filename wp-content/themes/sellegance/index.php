<?php
/**
 * The main template file.
 *
 * @package sellegance
 */

get_header(); 

?>

<?php
global $sellegance_opt;
$page_for_posts = get_option('page_for_posts');
$blog = get_post($page_for_posts);
$sidebar_pos = $sellegance_opt['blog_sidebar'] ? $sellegance_opt['blog_sidebar'] : 'right';
$blog_layout = $sellegance_opt['blog_layout'] ? $sellegance_opt['blog_layout'] : 'standard';
if (isset($_GET["blog_layout"])) { $blog_layout = $_GET["blog_layout"]; }
?>


<div class="row">
	<div class="col-sm-12">
		<header class="page-header">
			<?php if (!is_front_page()) : ?>
				<h1 class="entry-title title-page"><?php echo $blog->post_title; ?></h1>
				<h3 class="sub-title-page"><?php echo get_post_meta($page_for_posts, 'tdl_page_caption', TRUE); ?></h3>
							
				<?php echo et_breadcrumbs(); ?>
			<?php endif; ?>
		</header><!-- .page-header -->
	</div>
</div>


<div class="row side_<?php echo $sidebar_pos; ?> blogpostslist">
	
	<div id="primary" class="col-sm-9 sidebar">
	
		<div class="postcontent nobottommargin">
			
			<?php if (have_posts()) : ?>
			
				<div id="posts" class="clearfix">

					<div class="blog-layout blog-<?php echo $blog_layout;?>">
				
						<?php while (have_posts()) : the_post(); ?>

							<?php get_template_part( 'includes/post', $blog_layout ); ?>
					
						<?php endwhile;?>

					</div> <!-- .blog-layout -->
				
				</div>

				<?php if ($blog_layout=='grid') { ?>

					<script type="text/javascript">

						var $ = jQuery.noConflict();

						$(window).load(function() {
							
							// cache container
							var $container = $('.blog-grid');
							
							// initialize isotope
							$container.isotope({
								itemSelector : '.post_grid',
								animationEngine : 'best-available',
								layoutMode : 'fitRows',

								animationOptions: {
									easing: 'easeInOutQuad',
									queue: false
								}

							});

						});

					</script>

				<?php } ?>
			
				<div class="navigation page-navigation clearfix">

					<?php tdl_pagination(); ?>
				
				</div>
				
			<?php else: ?>
				
				<div class="styledmsg errormsg clearfix"><span class="clearfix"><?php _e("Sorry, Couldn't find any Posts..!", "sellegance") ?></span></div>
				
			<?php endif; ?>


				<ul class="pager articles-nav">
					<li class="previous"><?php next_posts_link(__('&larr; Older Posts', 'sellegance')); ?></li>
					<li class="next"><?php previous_posts_link(__('Newer Posts &rarr;', 'sellegance')); ?></li>

				</ul>	
			
			<?php //wp_reset_query(); ?>
				
		</div>

	</div> <!-- #primary -->

	<div class="col-sm-3 rsidebar">
		<div class="aside_sidecolumn">
			<?php get_sidebar(); ?>
		</div>
	</div>

</div> <!-- .blogpostslist -->

<?php get_footer(); ?>