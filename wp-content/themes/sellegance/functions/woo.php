<?php

/*--------------------------------------------------------
	Adds custom classes to the array of body classes.
--------------------------------------------------------*/

function sellegance_body_classes( $classes ) {

	// add boxed layout class if selected
	if  ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	// Modify the array $classes to your needs
	if( is_page() )
	{
		$classes[] = 'woocommerce';
		$classes[] = 'woocommerce-page';
	}    
	return $classes;
	}

}
add_filter( 'body_class', 'sellegance_body_classes' );

 
/*--------------------------------------------------------
	Previous/Next Products Links
--------------------------------------------------------*/

function next_post_link_product($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
	adjacent_post_link_product($format, $link, $in_same_cat, $excluded_categories, false);
}

function previous_post_link_product($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
	adjacent_post_link_product($format, $link, $in_same_cat, $excluded_categories, true);
}

function adjacent_post_link_product( $format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true ) {
	if ( $previous && is_attachment() )
		$post = get_post( get_post()->post_parent );
	else
		$post = get_adjacent_post_product( $in_same_cat, $excluded_categories, $previous );

	if ( ! $post ) {
		$output = '';
	} else {
		$title = $post->post_title;

		if ( empty( $post->post_title ) )
			$title = $previous ? __( 'Previous Post','sellegance' ) : __( 'Next Post','sellegance' );

		$title = apply_filters( 'the_title', $title, $post->ID );

		$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID) );

		$image = 
		$date = mysql2date( get_option( 'date_format' ), $post->post_date );
		$rel = $previous ? 'prev' : 'next';

		$string = '<a href="' . get_permalink( $post ) . '" rel="'.$rel.'" title="'.$title.'" class="';
		$inlink = str_replace( '%title', $title, $link );
		$inlink = $string . $inlink . '"></a>';
		$output = str_replace( '%link', $inlink, $format );
	}

	$adjacent = $previous ? 'previous' : 'next';

	echo apply_filters( "{$adjacent}_post_link", $output, $format, $link, $post );
}

function get_adjacent_post_product( $in_same_cat = false, $excluded_categories = '', $previous = true ) {
	global $wpdb;

	if ( ! $post = get_post() )
		return null;

	$current_post_date = $post->post_date;
	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_cat || ! empty( $excluded_categories ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_cat ) {
			if ( ! is_object_in_taxonomy( $post->post_type, 'product_cat' ) )
				return '';
			$cat_array = wp_get_object_terms($post->ID, 'product_cat', array('fields' => 'ids'));
			if ( ! $cat_array || is_wp_error( $cat_array ) )
				return '';
			$join .= " AND tt.taxonomy = 'product_cat' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = 'product_cat'";
		if ( ! empty( $excluded_categories ) ) {
			if ( ! is_array( $excluded_categories ) ) {
				// back-compat, $excluded_categories used to be IDs separated by " and "
				if ( strpos( $excluded_categories, ' and ' ) !== false ) {
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.','sellegance' ), "'and'" ) );
					$excluded_categories = explode( ' and ', $excluded_categories );
				} else {
					$excluded_categories = explode( ',', $excluded_categories );
				}
			}

			$excluded_categories = array_map( 'intval', $excluded_categories );

			if ( ! empty( $cat_array ) ) {
				$excluded_categories = array_diff($excluded_categories, $cat_array);
				$posts_in_ex_cats_sql = '';
			}

			if ( !empty($excluded_categories) ) {
				$posts_in_ex_cats_sql = " AND tt.taxonomy = 'product_cat' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.id FROM $wpdb->posts AS p $join $where $sort";
	$query_key = 'adjacent_post_' . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result ) {
		if ( $result )
			$result = get_post( $result );
		return $result;
	}

	$result = $wpdb->get_var( $query );
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');

	if ( $result )
		$result = get_post( $result );

	return $result;
}

/*--------------------------------------------------------
	Grid/List switcher
--------------------------------------------------------*/

add_action('woocommerce_before_shop_loop', 'etheme_grid_list_switcher',115);
if(!function_exists('etheme_grid_list_switcher')) {
	function etheme_grid_list_switcher() { ?>

		<div class="btn-group view-switcher" data-toggle="buttons">
			<label title="Grid" class="btn btn-default btn-sm" id="switchToGrid">
				<input type="radio" name="options" id="grid" ><i class="fa fa-th"></i>
			</label>
			<label title="List" class="btn btn-default btn-sm" id="switchToList">
				<input type="radio" name="options" id="list" ><i class="fa fa-list"></i>
			</label>
		</div>

		<?php
	}   
}


/*--------------------------------------------------------
	Wishlist Label
--------------------------------------------------------*/

function yit_change_wishlist_label() {
	return __( 'Wishlist', 'sellegance' );
}    

function yit_change_browse_wishlist_label() {
	return __( 'View Wishlist', 'sellegance' );
}

add_filter( 'yith_wcwl_button_label', 'yit_change_wishlist_label' );
add_filter( 'yith-wcwl-browse-wishlist-label', 'yit_change_browse_wishlist_label' );

/* compare button */
global $yith_woocompare;
if ( isset($yith_woocompare) ) {
	remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
	
}


/*--------------------------------------------------------
	Minicart
--------------------------------------------------------*/

// Load minicart in header

if(!function_exists('sellegance_top_cart')) {
	function sellegance_top_cart() {
		global $woocommerce;
		?>

		<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 

			<div class="header_shopbag_container">
				
				<div class="header_shopbag">

					<di class="cart-trigger">
						<div class="cart-icon">
							<span class="cart-icon-body"></span>
							<span class="cart-icon-handle"></span>
						</div>
					</di>

					<div class="overview">
						<?php echo $woocommerce->cart->get_cart_total(); ?>
						<span class="minicart_items"><?php echo $woocommerce->cart->cart_contents_count; ?> <?php _e('item(s)', 'sellegance'); ?></span>
					</div>

					<div class="minicart_wrapper">
						
						<div class="minicart">

							 <?php if (sizeof($woocommerce->cart->cart_contents)>0) :?>
								<div class="bag-items"><?php echo sprintf(_n('%d item in the shopping cart', '%d items in the shopping cart', $woocommerce->cart->cart_contents_count, 'sellegance'), $woocommerce->cart->cart_contents_count); ?></div>
							 <?php endif; ?>

							<?php
							echo '<ul class="cart_list">';
								if (sizeof($woocommerce->cart->cart_contents)>0) :
									foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
								
										$_product = $cart_item['data'];
										if ($_product->exists() && $cart_item['quantity']>0) :
											echo '<li class="cart_list_product">';
												echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';

												echo '<div class="cart_list_product_title">';
													$product_title = $_product->get_title();

													echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a>';
													echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'sellegance').' '.$cart_item['quantity'].'</div>';
												echo '</div>';
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'sellegance') ), $cart_item_key );
												echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
												echo '<div class="clearfix"></div>';
											echo '</li>';
										endif;
									endforeach;
								echo '</ul>';
								?>

								<div class="minicart_total_checkout">
									<?php _e('Cart subtotal', 'sellegance'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>
								</div>
								
								<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button minicart_cart_btn btn btn-default"><?php _e('View Cart', 'sellegance'); ?></a>   
								
								<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button minicart_checkout_btn btn btn-default btn-cart"><?php _e('Proceed to Checkout', 'sellegance'); ?></a>

							<?php  
							echo '<ul>';
							else: echo '<li class="empty">'.__('No products in the cart.','sellegance').'</li>'; endif;
							echo '</ul>'; ?>

						</div> <!-- .minicart -->
				
					</div> <!-- .minicart_wrapper -->

				</div> <!-- .header_shopbag -->
				
			</div> <!-- .header_shopbag_container -->
			
			<script type="text/javascript">// <![CDATA[
			jQuery(function(){
				jQuery(".cart_list_product_title a").each(function(i){
					len=jQuery(this).text().length;
					if(len>35)
					{
						jQuery(this).text(jQuery(this).text().substr(0,35)+'...');
					}
				});
			});
			// ]]></script>

		<?php } ?>

	<?php }
}

// Handle cart in header fragment for ajax add to cart

add_filter('add_to_cart_fragments', 'mini_cart_header_dropdown');

if (!function_exists('mini_cart_header_dropdown')) {
	function mini_cart_header_dropdown( $fragments ) {		
		global $woocommerce;
		ob_start();
		?>

		<?php sellegance_top_cart(); ?>

	<?php		
	$fragments['.header_shopbag_container'] = ob_get_clean();		
	return $fragments;

	}
}

/*--------------------------------------------------------
	Show products count URL parameter
--------------------------------------------------------*/
 
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
	if( isset( $_GET['show_products'] ) ){ 
		if ($_GET['show_products'] == "all") {
			add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ) );
		} else {
			add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$_GET['show_products'].';' ) );
		}
	} else {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ) );
	}
	
/*--------------------------------------------------------
	Show tags in category description
--------------------------------------------------------*/	

		
	foreach ( array( 'pre_term_description' ) as $filter ) {
		remove_filter( $filter, 'wp_filter_kses' );
	}
	 
	foreach ( array( 'term_description' ) as $filter ) {
		remove_filter( $filter, 'wp_kses_data' );
	}
	
/*--------------------------------------------------------
	WooCommerce content functions
--------------------------------------------------------*/	
	
		
	function is_out_of_stock() {
		global $post;
		$post_id = $post->ID;
		$stock_status = get_post_meta($post_id, '_stock_status',true);
		
		if ($stock_status == 'outofstock') {
		return true;
		} else {
		return false;
		}
	}

	function add_product_actions() {
	?>
			<div class="product-actions"> 
			 <?php if (in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?> 
					<div class="action wishlist">
						<?php
							echo do_shortcode('[yith_wcwl_add_to_wishlist]');
						?> 
					</div>
			<?php } ?> 
			<?php if (in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?> 
					<div class="action compare">
						 <?php
							echo do_shortcode('[yith_compare_button]');  
						 ?>                
					</div> 
			<?php } ?>               

				<div class="clearfix"></div>    
			</div> 

	<?php
	}


	/*--------------------------------------------------------
		Ajax Quick View
	--------------------------------------------------------*/	

	add_action('wp_ajax_et_product_quick_view', 'et_product_quick_view');
	add_action('wp_ajax_nopriv_et_product_quick_view', 'et_product_quick_view');
	if(!function_exists('et_product_quick_view')) {
		function et_product_quick_view() {
			if(empty($_POST['prodid'])) {
				echo 'Error: Absent product id';
				die();
			}

			$args = array(
				'p'=>$_POST['prodid'],
				'post_type' => 'product'
			);

			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) : $the_query->the_post();
					woocommerce_get_template('product-quick-view.php');
				endwhile;
				wp_reset_query();
				wp_reset_postdata();
			} else {
				echo 'No posts were found!';
			}
			die();
		}
	}

	// Remove WooCommerce Lightbox

	add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

	function my_deregister_javascript() {
		wp_deregister_script( 'prettyPhoto' );
		wp_deregister_script( 'prettyPhoto-init' );
		wp_deregister_style( 'woocommerce_prettyPhoto_css' );
	}


	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

	add_action( 'woocommerce_single_product_summary', 'add_product_actions', 31);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);


	/* TEST FUNCTIONS */

	// Display 24 products per page. 
	//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );
