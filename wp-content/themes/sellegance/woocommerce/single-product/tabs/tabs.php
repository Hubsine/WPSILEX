<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

global $product, $sellegance_opt, $wp_query;
 
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$term_id = get_brands_term_by_product_id($product->id);
$attach_id = sellegance_brands_thumbnail_id($term_id);
$image = wp_get_attachment_url($attach_id);
$term = get_term($term_id,'brands');


if ( ! empty( $tabs ) ) : ?>

	<?php 
	$details_mode=$sellegance_opt['product_details_mode'];
	if (isset($_GET["details_mode"])) { $details_mode = $_GET["details_mode"]; }
	?>

	<div class="tabs <?php echo $details_mode; ?> clearfix">

		<?php foreach ( $tabs as $key => $tab ) : ?>        
			
			<a href="#tab-<?php echo esc_attr( $key ); ?>" id="tab_<?php echo $key ?>" class="tab-title"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
			<div class="tab-content" id="content_tab_<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>

		<?php if(($term_id = get_brands_term_by_product_id($product->id)) > 0): ?>
			<a href="#tab_brand" id="tab_brand" class="tab-title"><?php _e( 'About', 'sellegance' ); ?> <?php echo $term->name;?></a>
		<?php endif; ?>

		<?php if(($term_id = get_brands_term_by_product_id($product->id)) > 0): ?>
		<div class="brand-panel tab-content" id="content_tab_brand">
			<h2><?php _e( 'About', 'sellegance' ); ?> <?php echo $term->name;?></h2>
			<div class="brand_logo"><img title="<?php echo $term->name?>" src="<?php echo $image?>"></div>
			<div class="brand_description">
			<?php if($term->description) : ?>
				<p><?php echo $term->description; ?></p>
			<?php endif; ?>
			<div class="clearfix"></div>
			<a href="<?php echo get_term_link($term_id,'brands');?>" class="button btn btn-default"><?php _e( 'Show products', 'sellegance' ); ?> </a></div><div class="clearfix"></div>            
		</div>
	 <?php endif; ?>

	</div>

<?php endif; ?>