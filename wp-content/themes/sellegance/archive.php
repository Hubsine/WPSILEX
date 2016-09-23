<?php 
$page_for_posts = get_option('page_for_posts');
$blog = get_post($page_for_posts);
global $sellegance_opt;
$blog_layout = $sellegance_opt['blog_layout'];
if (isset($_GET["blog_layout"])) { $blog_layout = $_GET["blog_layout"]; }
$sidebar_pos = $sellegance_opt['blog_sidebar'] ? $sellegance_opt['blog_sidebar'] : 'right';
?>

<?php get_header(); ?>

<div class="col-sm-12">
		<header class="page-header">
			<h1 class="entry-title title-page">
				<?php
				if ( is_category() ) {
					printf( __( 'Category Archives: %s', 'sellegance' ), '<span>' . single_cat_title( '', false ) . '</span>' );

				} elseif ( is_tag() ) {
					printf( __( 'Tag Archives: %s', 'sellegance' ), '<span>' . single_tag_title( '', false ) . '</span>' );

				} elseif ( is_author() ) {
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					*/
					the_post();
					printf( __( 'Author Archives: %s', 'sellegance' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();

				} elseif ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'sellegance' ), '<span>' . get_the_date() . '</span>' );

				} elseif ( is_month() ) {
					printf( __( 'Monthly Archives: %s', 'sellegance' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				} elseif ( is_year() ) {
					printf( __( 'Yearly Archives: %s', 'sellegance' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				} else {
					_e( 'Archives', 'sellegance' );

				}
				?>
			</h1>
						
			<?php 
			// BREADCRUMBS
			 echo et_breadcrumbs();
			?>
			<div class="clearfix"></div>
		</header><!-- .page-header -->
</div>

<div class="row side_<?php echo $sidebar_pos; ?>">
	<div id="primary" class="col-sm-9 sidebar">

		<div class="mainborder">

		<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
			<!-- woocommerce message -->
			<?php  wc_print_notices(); ?>
		<?php } ?>  
	
		<div class="postcontent nobottommargin">
		
		<?php if (have_posts()) : ?>
		
			<div id="posts" class="clearfix">

				<div class="blog-layout blog-<?php echo $blog_layout;?>">
			
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part( 'includes/post', $blog_layout ); ?>
					<?php endwhile;?>

				</div>
			
			</div>
			
			<div class="navigation page-navigation clearfix">
				<?php tdl_pagination(); ?>
			</div>
			
		<?php else: ?>
			
		<div class="styledmsg errormsg clearfix"><span class="clearfix"><?php _e("Sorry, Couldn't find any Posts..!", "sellegance") ?></span></div>
			
		<?php endif; ?>
		<?php wp_reset_query(); ?>
			
		</div>

		</div> <!-- .mainborder -->
	
	</div> <!-- .sidebar -->

	<div class="col-sm-3 rsidebar">
		<div class="aside_sidecolumn">
			<?php get_sidebar(); ?>
		</div>
	</div>

</div>
<?php get_footer(); ?>