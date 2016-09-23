<?php
/**
 * The template for displaying search forms in Sellegance
 *
 * @package sellegance
 */
?>


 <?php if ( in_array( 'yith-woocommerce-ajax-search/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
		<?php echo str_replace(".autocomplete", ".yithautocomplete", do_shortcode('[yith_woocommerce_ajax_search]'));; ?>
 <?php } else { ?>
<div class="search-wrapper">
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
			<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo _e( 'Search', 'woocommerce' ); ?>&hellip;" />
			<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
			<input type="hidden" name="post_type" value="product">
			<?php } ?>
	  </form>
</div><!-- row -->
<?php } ?>