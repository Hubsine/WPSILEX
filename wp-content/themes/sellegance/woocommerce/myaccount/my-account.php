<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $woocommerce;

wc_print_notices(); ?>


<div class="my-account-left">
    <div class="my-account-left-wrap">
    

        <ul class="nav my-account-nav">
          <li class="active myorders"><a href="#my-orders" data-toggle="tab"><?php _e("My Orders", "sellegance"); ?></a></li>
          <?php if ( $downloads = $woocommerce->customer->get_downloadable_products() ) { ?>
          <li class="mydownloads"><a href="#my-downloads" data-toggle="tab"><?php _e("My Downloads", "sellegance"); ?></a></li>
          <?php } ?>
    
          <li class="myaddress"><a href="#address-book" data-toggle="tab"><?php _e("Address Book", "sellegance"); ?></a></li>
          <li class="mypassword"><a href="#edit-account" data-toggle="tab"><?php _e("Edit Account", "sellegance"); ?></a></li>
          <li class="mylogout"><a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) ?>"><?php _e("Logout", "sellegance"); ?></a></li>
        </ul>
    
    </div>
</div>

<div class="my-account-right tab-content">

	<p class="well myaccount_user">
		<?php
		printf(
			__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
			$current_user->display_name,
			wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
		);

		printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);

		?>
	</p><br>
	
	<?php do_action( 'woocommerce_before_my_account' ); ?>
	
	<div class="tab-pane active" id="my-orders">
	
	<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
	
	</div>
	
	<?php if ( $downloads = $woocommerce->customer->get_downloadable_products() ) { ?>
	
	<div class="tab-pane" id="my-downloads">
	
	<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
	
	</div>
	
	<?php } ?>
	
	<div class="tab-pane" id="address-book">
	
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
	
	</div>
	
	<div class="tab-pane" id="edit-account">
	
	<?php wc_get_template( 'myaccount/form-edit-account.php' ); ?>
	
	</div>		
	
	<?php do_action( 'woocommerce_after_my_account' ); ?>
	
</div>