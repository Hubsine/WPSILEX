<?php
/**
 * Single product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $sellegance_opt;
?>

<?php if ($sellegance_opt['catalog_mode']!=1) { ?>
<div class="quantity"><input name="<?php echo $input_name; ?>" data-min="<?php echo $min_value; ?>" data-max="<?php echo $max_value; ?>" value="<?php echo $input_value; ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>
<?php } ?>