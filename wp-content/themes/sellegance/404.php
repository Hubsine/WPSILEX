<?php get_header(); ?>

	<?php if (!is_front_page()) : ?>
		<div class="row">
			<div class="col-sm-12">
				<header class="page-header">
					<h1 class="entry-title title-page"><?php echo __('Page Not Found', 'sellegance'); ?></h1>
								
					<?php echo et_breadcrumbs(); ?>
					
					<div class="clearfix"></div>
				</header><!-- .page-header -->
			</div>
		</div>
	<?php endif ?> 

	<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
		<!-- woocommerce message -->
		<?php  wc_print_notices(); ?>
	<?php } ?>  
		
	<div class="error404_cont">
	<div class="error404page">404</div>
	<p class="error404"><?php _e("Sorry, but you are looking for something that isn't here.", "sellegance") ?></p>
	<a class="error404button btn btn-default" href="<?php echo home_url(); ?>"><?php _e('Return To The Homepage', 'sellegance') ?></a>

	</div>

<?php get_footer(); ?>