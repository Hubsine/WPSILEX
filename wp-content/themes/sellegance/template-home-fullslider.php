<?php
/*
Template Name: Homepage - Full-screen slider
*/
?>
<?php get_header(); ?>

	<div class="row">
		
		<div id="primary" class="col-sm-12 full_width">

		<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
			<!-- woocommerce message -->
			<?php  wc_print_notices(); ?>
		<?php } ?>
		
		
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php } ?>
				
				<div class="entry-content">
					<div class="content_wrapper four_side shopproductlist">
						
						<?php the_content(); ?>
						
						<?php wp_link_pages( array( 'before' => '<ul class="page_links"><li>' . __( 'Pages:', 'sellegance' ).'</li>', 'after' => '</li></ul>','separator' => '<li>' ) ); ?>
						
						<?php edit_post_link( __( 'Edit', 'sellegance' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div><!-- .entry-content -->
				
			</article><!-- #post-<?php the_ID(); ?> -->

		<?php endwhile; // end of the loop. ?>
		
		</div>

	</div>
	
<?php get_footer(); ?>