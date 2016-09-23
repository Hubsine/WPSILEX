<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<div class="empty_bag">

    <h3 class="empty_bag_message"><?php _e('Your cart is currently empty.', 'sellegance') ?></h3>
    <a class="empty_bag_button btn btn-default" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e('Return To Shop', 'sellegance') ?></a>

</div>

<?php do_action('woocommerce_cart_is_empty'); ?>