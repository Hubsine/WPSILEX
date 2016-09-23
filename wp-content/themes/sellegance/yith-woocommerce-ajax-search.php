<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


//wp_enqueue_script('yith_wcas_jquery-autocomplete' );
//wp_enqueue_script('yith_wcas_frontend' );
$rand_id = rand();
?>

<div class="search-wrapper yith-ajaxsearchform-container <?php echo $rand_id; ?>_container">
<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
	<input type="search"
		value="<?php echo get_search_query() ?>"
		name="s"
		id="<?php echo $rand_id; ?>_yith"
		class="yith-s"
		placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>"
		data-loader-icon="<?php echo str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ?>"
		data-min-chars="<?php echo get_option('yith_wcas_min_chars'); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>
</div><!-- row -->

<script type="text/javascript">
jQuery(function($){
	$('#<?php echo $rand_id; ?>_yith').yithautocomplete({
		minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
		appendTo: '.<?php echo $rand_id; ?>_container',
		serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
		onSearchStart: function(){
			$('.<?php echo $rand_id; ?>_container').append('<div class="loading"><i></i><i></i><i></i><i></i></div>');
		},
		onSearchComplete: function(){
			$('.<?php echo $rand_id; ?>_container .loading').remove();

		},
		onSelect: function (suggestion) {
			if( suggestion.id != -1 ) {
				window.location.href = suggestion.url;
			}
		}
	});
});
</script>