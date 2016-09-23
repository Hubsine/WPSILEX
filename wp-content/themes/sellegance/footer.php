<?php global $sellegance_opt; ?>


			</div> <!-- .contentwrapper -->
		</div> <!-- .container -->
	</div> <!-- #midcontent -->

	<div id="footer_top" class="<?php echo $sellegance_opt['footer_top_text_color']; ?>">
		<div class="container">
			<div class="widget_area">
				<div class="row">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer_top' ) ) ?>
				</div>
			</div>
		</div>
	</div>

	<div id="footer_bottom" class="<?php echo $sellegance_opt['footer_bottom_text_color']; ?>">
		<div class="container">
			<div class="widget_area">
				<div class="row">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer_bottom' ) ) ?>
				</div>
			</div>
		</div>
	</div>

	<div id="footer_copyright" class="<?php echo $sellegance_opt['footer_copyright_text_color']; ?>">
		<div class="container">
			<div class="copy_inner">
				<div class="row">    
					<div class="col-sm-5 copytxt">
						<?php if(isset($sellegance_opt['footer_text'])){
							echo do_shortcode($sellegance_opt['footer_text']);
						} ?>
					</div>            
					<div class="col-sm-7 cards">
						<img src="<?php if (!$sellegance_opt['payment_icons']['url'] ) { ?><?php echo get_template_directory_uri(); ?>/images/payment_cards.png
						<?php } else echo $sellegance_opt['payment_icons']['url']; ?>" alt="" />
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php if ($sellegance_opt['backtotop']) { ?>
			<a class="go-top"></a>
		<?php } ?>

	<?php if ($sellegance_opt['tracking_code']) {
		echo $sellegance_opt['tracking_code'];
	} ?>

	<?php if ($sellegance_opt['custom_js_code']) { ?>
		<!-- Custom js code -->
		<script type="javascript">
			<?php echo $sellegance_opt['custom_js_code']; ?>
		</script>
	<?php } ?>

	<?php wp_footer(); ?>

	</body>
</html>