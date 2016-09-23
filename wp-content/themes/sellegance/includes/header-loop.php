<?php
global $woo_options;
global $woocommerce;
global $sellegance_opt;
?>

<?php if ( $sellegance_opt['fixed_navigation']==1 ) { ?>

	<div id="sticky-menu" class="clearfix">
		<div class="container clearfix">
			
			<div class="nav" id="navigation">
				<div class="navbar-header">
					<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" class="navbar-brand">
					<?php if($sellegance_opt['site_logo']['url']){
						$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
						$sellegance_opt['site_logo']['url'] = $protocol. str_replace(array('http:', 'https:'), '', $sellegance_opt['site_logo']['url']);
						
						$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
						echo '<img src="'.$sellegance_opt['site_logo']['url'].'" class="header_logo" alt="'.$site_title.'"/>';
					} else {bloginfo( 'name' );}?>
					</a>
				</div>
				 <?php navigation(); ?>
			</div>
					
			<?php if ( $sellegance_opt['catalog_mode']!=1 ) { 
				// Check if WooCommerce is active
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				?>
					
				<?php sellegance_top_cart(); ?>

			 <?php } ?>
			<?php } ?>

			<div class="sticky-search-trigger"><a href="#"></a></div>

			<div class="sticky-search-area"> 
				<?php if(function_exists('get_product_search_form')) {
					get_product_search_form();
				} else {
					get_search_form();
				} ?>
				<div class="sticky-search-area-close"><a href="#"></a> </div>
			</div>
		</div>
	</div>

<?php } ?>

<div id="header">
	<div class="container">
		<div class="header_box">
			<div class="header_container">
		
				<?php if($sellegance_opt['header_text']) { ?>
				<div class="custominfo"><?php echo $sellegance_opt['header_text']; ?></div>
				<?php } ?>
			
			
				<?php if ( $sellegance_opt['catalog_mode']!=1 ) { 
					
					//Check if WooCommerce is active
					if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					?> 

					<?php sellegance_top_cart(); ?>
						
					<?php } ?>
				<?php } ?>

				<div class="header_search">
					<div class="search-trigger"><a href="#"></a></div>
				
					<div class="search-area">
						<?php if(function_exists('get_product_search_form')) {
							get_product_search_form();
						} else {
							get_search_form();
						} ?>
						<div class="search-area-close"><a href="#"></a></div>
					</div>
				</div>

				<div class="logo">

					<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
					<?php if($sellegance_opt['site_logo']['url']){
						$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
						$sellegance_opt['site_logo']['url'] = $protocol. str_replace(array('http:', 'https:'), '', $sellegance_opt['site_logo']['url']);
						
						$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
						echo '<img src="'.$sellegance_opt['site_logo']['url'].'" class="header_logo" alt="'.$site_title.'"/>';
					} else {bloginfo( 'name' );}?>
					</a>
				</div>

				<?php if($sellegance_opt['responsive_layout']!='fixed') {
					$navclass='hidden-sm hidden-xs';
					$mobclass='visible-sm visible-xs';
					} else {
						$navclass =''; $mobclass='';
					}
				?>
				
				<div class="desktop_nav <?php echo $navclass; ?>">
					<div class="nav" id="navigation">
						 <?php navigation(); ?>
					</div> 
				</div>

				<div class="menu-icon <?php echo $mobclass; ?>"><i class="fa fa-bars"></i> <?php _e('Menu', 'sellegance') ?></div>

				<div class="mobile-nav side-block">
					<div class="close-mobile-nav close-block"><?php _e('Navigation', 'sellegance') ?><i class="fa fa-times"></i></div>
						<?php
						if ( has_nav_menu( 'mobile-menu' ) ) {
							wp_nav_menu( array( 
								'theme_location' => 'mobile-menu'
							) );
						} else {
							wp_nav_menu(array(
								'theme_location' => 'primary-menu'
							)); 
						}
						?>
				</div>

			</div> <!-- .header_container -->
		</div> <!-- .header_box -->
	</div> <!-- .container -->
</div> <!-- #header -->