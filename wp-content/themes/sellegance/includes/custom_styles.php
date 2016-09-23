<?php
global $woocommerce;

function sellegance_custom_styles() {

	global $sellegance_opt;
	
?>

	<!-- Custom CSS Styles -->

	<style>

		/* Body
		--------------------------------------- */
		<?php
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";

		if ($sellegance_opt['custom_overlay_pattern']['url']) {
			$pattern = $protocol. str_replace(array('http:', 'https:'), '', $sellegance_opt['custom_overlay_pattern']['url']);
		}
		else if ($sellegance_opt['overlay_pattern']) {
			$pattern = $protocol. str_replace(array('http:', 'https:'), '', $sellegance_opt['overlay_pattern']);
		} 
		else $pattern = get_template_directory_uri().'/images/patterns/5.png';

		?>
		<?php if (basename($pattern)!='0.png') { ?>
		.wrapper_header {
			background-image: url(<?php echo $pattern; ?>);
		}
		<?php } ?>

		/* Links
		--------------------------------------- */

		a { color: <?php echo $sellegance_opt['links_color']['regular']; ?>; }
		a:hover { color: <?php echo $sellegance_opt['links_color']['hover']; ?>; }
		a:active { color:<?php echo $sellegance_opt['links_color']['active']; ?>; }


		/* Titles font
		--------------------------------------- */

		h1,h2 {
			font-family: "<?php echo $sellegance_opt['title_font']['font-family']; ?>", Arial, Helvetica, sans-serif !important;
		}
		h1 {
			font-size: <?php echo $sellegance_opt['title_font']['font-size']; ?>;
		}

		/* Main body font
		--------------------------------------- */

		body, table.shop_table td.product-name .variation, .posts-widget .post_meta a, .yith-woocompare-widget .products-list a.remove, .mc_input {font-family: "<?php echo $sellegance_opt['body_font']['font-family']; ?>", Arial, Helvetica, sans-serif !important;}

		body {
			font-size: <?php echo $sellegance_opt['body_font']['font-size']; ?>;
		}

		.entry-meta-foot, .entry_meta {
			font-family: "<?php echo $sellegance_opt['other_font']['font-family']; ?>", Arial, Helvetica, sans-serif !important;
		}

		/* Buttons
		--------------------------------------- */

		a.button,
		button.button,
		input.button,
		.btn-default,
		#respond input#submit,
		#content input.button,
		.portfolio_details .project_button a,
		.add-to-container a.button,
		.added_to_cart,
		.tdl-button,
		.comment-text .reply a,
		.wpcf7 input[type="submit"],
		.woocommerce .widget_shopping_cart .buttons a.button,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce #respond input#submit,
		.woocommerce #content input.button,
		.woocommerce a.button,
		.woocommerce-page a.button,
		.woocommerce button.button,
		.woocommerce-page button.button,
		.woocommerce input.button,
		.woocommerce-page input.button,
		.woocommerce #respond input#submit,
		.woocommerce-page #respond input#submit,
		.woocommerce #content input.button,
		.woocommerce-page #content input.button,
		.woocommerce a.button.alt,
		.woocommerce-page a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce-page button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce-page input.button.alt,
		.woocommerce #respond input#submit.alt,
		.woocommerce-page #respond input#submit.alt,
		.woocommerce #content input.button.alt,
		.woocommerce-page #content input.button.alt,
		#portfolio-filter li.activeFilter a.btn-alt,
		.tp-bullets.simplebullets.round .bullet:hover,
		.tp-bullets.simplebullets.round .bullet.selected,
		.tp-bullets.simplebullets.navbar .bullet:hover,
		.tp-bullets.simplebullets.navbar .bullet.selected,
		.submit-wrap input.ninja-forms-field,
		.go-top {
			background: <?php echo $sellegance_opt['primary_color']; ?>;
		}
		a.button:hover,
		button.button:hover,
		input.button:hover,
		.btn-default:hover,
		.portfolio_details .project_button a:hover,
		.add-to-container a.button:hover,
		.added_to_cart:hover,
		.tdl-button:hover,
		.comment-text .reply a:hover,
		.wpcf7 input[type="submit"]:hover,
		.woocommerce .widget_shopping_cart .buttons a.button:hover,
		#respond input#submit:hover,
		#content input.button:hover,
		.woocommerce a.button:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce #content input.button:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce-page a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce-page button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce-page input.button.alt:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce-page #respond input#submit.alt:hover,
		.woocommerce #content input.button.alt:hover,
		.woocommerce-page #content input.button.alt:hover,
		#portfolio-filter li a.btn-alt:hover,
		.submit-wrap input.ninja-forms-field:hover {
			background: <?php echo $sellegance_opt['primary_color']; ?>;
			-webkit-box-shadow: inset 0 0 45px rgba(0, 0, 0, 0.25);
			box-shadow: inset 0 0 45px rgba(0, 0, 0, 0.25);
		}
		.go-top, .go-top:hover,.go-top:hover:before  {
			border-color:<?php echo $sellegance_opt['primary_color']; ?>;
			color:<?php echo $sellegance_opt['primary_color']; ?> !important;
		}


		a.button.minicart_checkout_btn,
		.woocommerce-page .button.alt.single_add_to_cart_button,
		.woocommerce .button.alt.single_add_to_cart_button,
		.woocommerce-page a.button.checkout-button,
		.woocommerce a.button.checkout-button,
		.woocommerce #place_order,
		.woocommerce .widget_shopping_cart .buttons a.checkout {
			background: <?php echo $sellegance_opt['secondary_color']; ?>;
		}
		a.button.minicart_checkout_btn:hover,
		.woocommerce-page .button.alt.single_add_to_cart_button:hover,
		.woocommerce .button.alt.single_add_to_cart_button:hover,
		.woocommerce-page a.button.checkout-button:hover,
		.woocommerce a.button.checkout-button:hover,
		.woocommerce #place_order:hover,
		.woocommerce .widget_shopping_cart .buttons a.checkout:hover {
			background: <?php echo $sellegance_opt['secondary_color']; ?>;
			-webkit-box-shadow: inset 0 0 45px rgba(0, 0, 0, 0.25);
			box-shadow: inset 0 0 45px rgba(0, 0, 0, 0.25);
		}
		.woocommerce .product_details .price,
		.woocommerce-page div.product p.price,
		.woocommerce div.product p.price,
		.woocommerce-page div.product span.price,
		.woocommerce div.product span.price {
			color: <?php echo $sellegance_opt['price_color']; ?>;
		}

		.product_main_info span.onsale,
		div.onsale {
			background: <?php echo $sellegance_opt['sale_tag_color']; ?>;
		}
		.woocommerce .star-rating span:before,
		.woocommerce-page .star-rating span:before,
		.woocommerce .star-rating:before,
		.woocommerce-page .star-rating:before {
			color: <?php echo $sellegance_opt['rating_stars_color']; ?>;
		}


		<?php if (!in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || !in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
		.product_details .product-actions .action {width: 100%; text-align:center;}
		.product_details .product-actions .action:first-child {text-align:center;}	
		.product_details .product-actions .wishlist a, .product_details .product-actions .compare a {margin:0;}	
		<?php endif; ?>

		<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
		.login-wrap { border-right:1px solid #ccc;}
		<?php endif; ?>

		<?php if ( !function_exists('icl_get_languages') || !has_nav_menu( 'secondary' ) ) { ?> 
		.header4 .custominfo, .header_nb.header4 .custominfo, .header_nb.header4 .fullslider .custominfo {right:130px;}
		<?php } ?>

		<?php if ( !function_exists('icl_get_languages') || !has_nav_menu( 'secondary' ) ) { ?> 
			
			.header4 .custominfo, .header_nb.header4 .custominfo, .header_nb.header4 .fullslider .custominfo {right:15px; left:auto}
			.header_nb.header4 .custominfo, .header_nb.header4 .fullslider .custominfo {right:0; left:auto}

			<?php if ( function_exists('icl_get_languages') or has_nav_menu( 'secondary' ) ) { ?>
			.header4 .custominfo, .header4 .fullslider .custominfo {right:130px;}
			<?php } ?>

		<?php } ?>

		<?php if ( $sellegance_opt['catalog_mode'] || ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ) { ?> 
		@media (min-width: 768px) and (max-width: 979px) {#navigation {right: 15px;}}
		@media (max-width: 767px) {#navigation {position:absolute; bottom:0px; left:50%; margin:0; margin-left:-100px}}
		<?php } ?>


		/* Products animation
		--------------------------------------- */

		.productanim1.product_item .image_container a, .productanim5.product_item .image_container a {
			float: left;
			-webkit-perspective: 600px;
			-moz-perspective: 600px;
		}
		.productanim1.product_item .image_container, .productanim5.product_item .image_container  {
			position:relative;
			width:auto;
			height: auto;
		}
		.productanim1 .loop_products, .productanim5 .loop_products {
			position:absolute;
			top:0;
			left:0;
		}
		.productanim1.product_item img, .productanim3.product_item img, .productanim5.product_item img {
			width:100%;
			height:auto;
		}
		.productanim1 .image_container a .front {
			-o-transition: all .4s ease-in-out;
			-ms-transition: all .4s ease-in-out;
			-moz-transition: all .4s ease-in-out;
			-webkit-transition: all .4s ease-in-out;
			transition: all .4s ease-in-out;
		}
		.productanim1 .image_container a .front {
			-webkit-transform: rotateX(0deg) rotateY(0deg);
			-webkit-transform-style: preserve-3d;
			-webkit-backface-visibility: hidden;

			-moz-transform: rotateX(0deg) rotateY(0deg);
			-moz-transform-style: preserve-3d;
			-moz-backface-visibility: hidden;
		}
		.productanim5 .image_container a .front {
			-webkit-opacity: 1;
			-moz-opacity: 1;
			opacity: 1;
			-webkit-transition: all .35s ease;
			-moz-transition: all .35s ease;
			-ms-transition: all .35s ease;
			-o-transition: all .35s ease;
			transition: all .35s ease;
		}
		.productanim1 .image_container a:hover .front {
			-webkit-transform: rotateY(180deg);
			-moz-transform: rotateY(180deg);
		}
		.productanim5 .image_container a:hover .front {
			-webkit-opacity: 0;
			-moz-opacity: 0;
			opacity: 0;
			-webkit-transition: all .35s ease;
			-moz-transition: all .35s ease;
			-ms-transition: all .35s ease;
			-o-transition: all .35s ease;
			transition: all .35s ease;
		}
		.productanim1 .image_container a .back/*, .productanim3 .image_container a .back*/ {
			-o-transition: all .4s ease-in-out;
			-ms-transition: all .4s ease-in-out;
			-moz-transition: all .4s ease-in-out;
			-webkit-transition: all .4s ease-in-out;
			transition: all .4s ease-in-out;
		}
		.productanim1 .image_container a .back {
			-webkit-transform: rotateY(-180deg);
			-webkit-transform-style: preserve-3d;
			-webkit-backface-visibility: hidden;

			-moz-transform: rotateY(-180deg);
			-moz-transform-style: preserve-3d;
			-moz-backface-visibility: hidden;
		}
		.productanim5 .image_container a .back {
			-webkit-opacity: 0;
			-moz-opacity: 0;
			opacity: 0;
			-webkit-transition: all .35s ease;
			-moz-transition: all .35s ease;
			-ms-transition: all .35s ease;
			-o-transition: all .35s ease;
			transition: all .35s ease;
		}
		.productanim1 .image_container a:hover .back/*, .productanim3 .image_container a:hover .back*/  {
			z-index:10;
			position:absolute;
			-webkit-transform: rotateX(0deg) rotateY(0deg);
			-moz-transform: rotateX(0deg) rotateY(0deg);
		}
		.productanim5 .image_container a:hover .back  {
		  -webkit-opacity: 1;
		  -moz-opacity: 1;
		  opacity: 1;
		  -webkit-transition: all .35s ease;
		  -moz-transition: all .35s ease;
		  -ms-transition: all .35s ease;
		  -o-transition: all .35s ease;
		  transition: all .35s ease;
		}

		<?php if ( $sellegance_opt['product_animation'] == 'productanim3') { ?>

		.productanim3.product_item  {
			list-style:none;
		}
		.productanim3 .image_container {
			position:relative;
			width:100%;
			overflow:hidden;
		}
		.productanim3 .image_container a.prodimglink {
			display: block;
			float: left;
			position: absolute;
			width: 100%;
			height: 200%;
			z-index: 1;
			margin-bottom: 0;
			-webkit-animation-fill-mode: both;
			-moz-animation-fill-mode: both;
			-o-animation-fill-mode: both;
			animation-fill-mode: both;
			-webkit-transition: all 1s cubic-bezier(0.190,1.000,0.220,1.000);
			-webkit-transition-delay: 0s;
			-moz-transition: all 1s cubic-bezier(0.190,1.000,0.220,1.000) 0s;
			-o-transition: all 1s cubic-bezier(0.190,1.000,0.220,1.000) 0s;
			transition: all 1s cubic-bezier(0.190,1.000,0.220,1.000) 0s;
		}
		.productanim3 .image_container a.prodimglink:hover {
			-webkit-transform: translate3d(0,-50%,0);
			-moz-transform: translate3d(0,-50%,0);
			-ms-transform: translate3d(0,-50%,0);
			-o-transform: translate3d(0,-50%,0);
			transform: translate3d(0,-50%,0);
			-webkit-transition: -webkit-transform 1s cubic-bezier(0.190,1.000,0.220,1.000);
			-webkit-transition-delay: 0s;
			-moz-transition: -moz-transform 1s cubic-bezier(0.190,1.000,0.220,1.000) 0s;
			-o-transition: -o-transform 1s cubic-bezier(0.190,1.000,0.220,1.000) 0s;
			transition: transform 1s cubic-bezier(0.190,1.000,0.220,1.000) 0s;
		}
		.productanim3 .image_container .front img, .productanim3 .image_container .back img {
			filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
			opacity: 1;
			padding-bottom:0;
			-webkit-transition: opacity 1.5s cubic-bezier(0.190,1.000,0.220,1.000);
			-webkit-transition-delay: 0ms;
			-moz-transition: opacity 1.5s cubic-bezier(0.190,1.000,0.220,1.000) 0ms;
			-o-transition: opacity 1.5s cubic-bezier(0.190,1.000,0.220,1.000) 0ms;
			transition: opacity 1.5s cubic-bezier(0.190,1.000,0.220,1.000) 0ms;
		}

		<?php } ?>


		/* Skins
		--------------------------------------- */

			/* Boxed */	
			
			.boxed .homeslider > .container > .widget,
			.slidercontainer, .slider_maincontainer {
				border: 1px solid #ddd;
				border-bottom: 0;
			}

			/* Framed */

			.framed #header .header_box {
				border: 1px solid #ddd;
				border-width: 7px 7px 0;
				background: #fff;
				padding: 16px 32px 0;
			}
			.framed.header3 .header_container {
					border-bottom: 1px solid #ddd;
				}
			.framed .desktop_nav {
				border: 1px solid #ddd;
				border-width: 1px 0;
			}
			.framed #header #menu {
				text-align: center;
			}
			.framed #menu>li>a {
				color: #999;
			}
			.framed .homeslider > .container > .widget {
				border: 1px solid #ddd;
				border-width: 0 7px;
			}
			.framed #midcontent .contentwrapper {
				border-width: 0 7px 0;
			}
			.framed #footer_top .widget_area {
				border-width: 0 7px 7px;
			}
			.framed #header_topbar .topbar_inner {
				background: transparent;
				border: 0;
			}


			/* Full Width */

			.fullwidth #midcontent .contentwrapper {
				border: 0;
				padding: 10px 0;
			}
			.wrapper_header.fullwidth #midcontent {
				border: 1px solid #ddd;
				border-width: 1px 0;
			}
			.wrapper_header.fullwidth .homeslider>.container {
				width: auto !important;
				padding: 0 !important;
			}
			/*.wrapper_header.fullwidth .desktop_nav {
				border-top: 1px solid #ddd;
			}*/
				.wrapper_header.header3 .desktop_nav {
					border:0;
				}
			.wrapper_header.fullwidth #header #menu {
				text-align: center;
			}
			.wrapper_header.fullwidth #header .header_box {
				border: 0;
			}
			.wrapper_header.fullwidth #midcontent {
				background: #fff;
			}
			.wrapper_header.fullwidth #footer_top {
				background: #f6f6f6;
			}
				.wrapper_header.fullwidth #footer_top .widget_area {
					border: 0;
					background: transparent;
					padding: 0;
				}

			.wrapper_header.transparent_header #footer_bottom .widget .widget-title,
			.wrapper_header.fullwidth #footer_bottom .widget .widget-title {
				border-color: #888;
			}
			.wrapper_header.transparent_header #footer_bottom .widget ul li,
			.wrapper_header.fullwidth #footer_bottom .widget ul li {
				color: #ddd;
			}
				.wrapper_header.transparent_header #footer_copyright .copy_inner,
				.wrapper_header.fullwidth #footer_copyright .copy_inner {
					border:0;
				}
			
			/* Transparent Header */

			.transparent_header #midcontent .contentwrapper {
				border: 0;
				padding: 10px 0;
			}
			.wrapper_header.transparent_header #midcontent {
				border: 1px solid #ddd;
				border-width: 1px 0;
			}
			.wrapper_header.transparent_header .homeslider>.container {
				width: auto !important;
				padding: 0 !important;
			}
				.wrapper_header.header3 .desktop_nav {
					border:0;
				}
			.wrapper_header.transparent_header #header.dark .desktop_nav {
				background: rgba(255,255,255,0.4);
			}
			.wrapper_header.transparent_header #header.light .desktop_nav {
				background: rgba(0,0,0,0.2);
			}
			.wrapper_header.transparent_header #header #menu {
				text-align: center;
			}
			.wrapper_header.transparent_header #header .header_box {
				border: 0;
			}
			.wrapper_header.transparent_header #midcontent {
				background: #fff;
			}
			.wrapper_header.transparent_header #footer_top {
				border-bottom: 1px solid #ddd;
				background: #f6f6f6;
			}
				.wrapper_header.transparent_header #footer_top .widget_area {
					border: 0;
					background: transparent;
				}


		/* Header
		--------------------------------------- */

			<?php if ($sellegance_opt['header_bg_color']!='transparent') { ?>
			#sticky-menu,
			<?php } ?>
			#header,
			#header_topbar {
				background-color: <?php echo $sellegance_opt['header_bg_color']; ?>;
			}
			<?php if ($sellegance_opt['topbar_bg_color']!='transparent') { ?>
			#header_topbar {
				background-color: <?php echo $sellegance_opt['topbar_bg_color']; ?>;
			}
			<?php } ?>
			.header_dark .custominfo,
			.header_dark .header_shopbag .overview .minicart_items {
				color: #bbb;
			}
			.header_dark .custominfo a,
			.header_dark .search-trigger a:before,
			.header_dark #sticky-menu .sticky-search-trigger a:before,
			.header_dark #menu>li>a,
			.header_dark .header_shopbag .overview .amount,
			.header_dark #header_topbar .topbarmenu a,
			.topbar_dark #header_topbar .topbarmenu a,
			.header_dark #header_topbar .social a,
			.topbar_dark #header_topbar .social a,
			.header_dark .header-switch span.current,
			.topbar_dark .header-switch span.current {
				color: #fff;
			}
			.header_dark .cart-icon .cart-icon-handle,
			.header_dark .cart-icon .cart-icon-body {
				border-color:#fff;
			}
			.header_dark .search-trigger,
			.wrapper_header.header_dark.fullwidth .desktop_nav,
			.header_dark #header_topbar .topbarmenu ul li,
			.topbar_dark #header_topbar .topbarmenu ul li,
			.header_dark #header_topbar .topbar_inner,
			.topbar_dark #header_topbar .topbar_inner {
				border-color: rgba(255, 255, 255, 0.25);
			}
			.topbar_dark.header_light #header_topbar .topbar_inner {
				border-color: transparent;
			}


		/* Logo
		--------------------------------------- */

			<?php 
			$logo_w=$sellegance_opt['logo_size']['width'];
			$logo_h=$sellegance_opt['logo_size']['height'];
			?>

			#header .header_container {
				height: <?php echo ($logo_h) ? (str_replace('px','',$logo_h) + 55) : 125; ?>px;
			}
			.header3 #header .header_container {
				height: <?php echo ($logo_h) ? str_replace('px','',$logo_h) : 70; ?>px;
			}
			.header3 .desktop_nav {
				left: <?php echo $logo_w; ?>;
				margin-left: 10px;
			}
			.logo {
				width: <?php echo ($logo_w) ? str_replace('px','',$logo_w) : 160; ?>px;
				height: <?php echo ($logo_h) ? str_replace('px','',$logo_h) : 70; ?>px;
				margin-left: -<?php echo ($logo_w) ? (str_replace('px','',$logo_w)/2) : 80; ?>px;
			}
			@media (max-width: 767px) {
				.logo {
					position: relative;
					margin: 10px auto;
					left: auto;
					right: auto;
					top: auto;
					max-width: 100%;
					height: auto;
				}
			}


		/* Footer Top
		--------------------------------------- */

		.wrapper_header.fullwidth #footer_top,
		.wrapper_header.transparent_header #footer_top {
			background: <?php echo $sellegance_opt['footer_top_bg']; ?>;
		}
		.wrapper_header.boxed #footer_top .widget_area {
			background: <?php echo $sellegance_opt['footer_top_bg']; ?>;
		}
			/* dark */

			#footer_top.dark .widget .widget-title {
				border-color: rgba(255, 255, 255, 0.20) !important;
			}
			.wrapper_header #footer_top.dark .widget ul li {
				border-color: rgba(255, 255, 255, 0.10) !important;
				color: #fff;
			}
			#footer_top.dark,
			#footer_top.dark {
				color: #ccc;
			}
			#footer_top.dark a,
			#footer_top.dark ul.product_list_widget li a, 
			#footer_top.dark .woocommerce ul.product_list_widget li a,
			#footer_top.dark ul.product_list_widget span.amount,
			#footer_top.dark  .woocommerce ul.product_list_widget span.amount,
			.wrapper_header #footer_top.dark .tagcloud a {
				color: #fff !important;
			}
			.wrapper_header #footer_top.dark .widget .widget-title,
			#footer_top.dark .posts-widget .post_meta,
			#footer_top.dark .woocommerce ul.product_list_widget del span.amount {
				color: rgba(255,255,255,0.75) !important;
			}
			.wrapper_header #footer_top.dark .tagcloud a,
			.wrapper_header #footer_bottom.dark .tagcloud a {
				background: transparent;
				border-color: #999;
			}
			.wrapper_header #footer_top.dark .tagcloud a:hover,
			.wrapper_header #footer_bottom.dark .tagcloud a:hover {
				background: #fff !important;
				color: #444 !important;
				border-color:#fff;
			}

			/* light */

			#footer_top.light .widget .widget-title {
				border-color: rgba(0, 0, 0, 0.15) !important;
			}
			.wrapper_header #footer_top.light .widget .widget-title,
			#footer_top.light ul.product_list_widget li a, 
			#footer_top.light .woocommerce ul.product_list_widget li a,
			.wrapper_header #footer_top.light .widget ul li a {
				color: rgba(0, 0, 0, 0.75) !important;
			}

		/* Footer Bottom
		--------------------------------------- */

		.wrapper_header.fullwidth #footer_bottom,
		.wrapper_header.transparent_header #footer_bottom {
			background: <?php echo $sellegance_opt['footer_bottom_bg']; ?>;
		}

			/* dark */

			#footer_bottom.dark .widget .widget-title {
				border-color: rgba(255, 255, 255, 0.20) !important;
			}
			.wrapper_header #footer_bottom.dark .widget ul li {
				border-color: rgba(255, 255, 255, 0.10) !important;
			}
			#footer_bottom.dark,
			#footer_bottom.dark {
				color: #ccc;
			}
			#footer_bottom.dark a,
			#footer_bottom.dark ul.product_list_widget li a, 
			#footer_bottom.dark .woocommerce ul.product_list_widget li a,
			#footer_bottom.dark ul.product_list_widget span.amount,
			#footer_bottom.dark  .woocommerce ul.product_list_widget span.amount
			 {
				color: #fff !important;
			}
			.wrapper_header #footer_bottom.dark .widget .widget-title,
			#footer_bottom.dark .posts-widget .post_meta,
			#footer_bottom.dark .woocommerce ul.product_list_widget del span.amount {
				color: rgba(255,255,255,0.75) !important;
			}

			/* light */

			#footer_bottom.light .widget .widget-title {
				border-color: rgba(0, 0, 0, 0.20) !important;
			}
			.wrapper_header #footer_bottom.light .tagcloud a,
			.wrapper_header #footer_bottom.light .widget .widget-title,
			#footer_bottom.light ul.product_list_widget li a, 
			#footer_bottom.light .woocommerce ul.product_list_widget li a,
			.wrapper_header #footer_bottom.light .widget ul li a {
				color: rgba(0, 0, 0, 0.75) !important;
			}
			.wrapper_header #footer_bottom.light .tagcloud a:hover {
				color: #fff !important;
			}
			.wrapper_header #footer_bottom.light .tagcloud a:hover {
				background: #000 !important;
				color: #fff !important;
				border-color:#000;
			}
			
		/* Copyright
		--------------------------------------- */

		.wrapper_header #footer_copyright {
			background: <?php echo $sellegance_opt['footer_copyright_bg']; ?>;
		}
		<?php if ($sellegance_opt['footer_copyright_bg']!='transparent'): ?>
		#footer_copyright .copy_inner {
			border: 0;
		}
		<?php endif; ?>
			.wrapper_header #footer_copyright.dark {
				color: #fff;
			}
			.wrapper_header #footer_copyright.light {
				color: #444;
			}

		/* Midcontent
		--------------------------------------- */

		.wrapper_header.fullwidth #midcontent,
		.wrapper_header.transparent_header #midcontent,
		.wrapper_header.fullwidth #midcontent .featured_section_title span,
		.wrapper_header.transparent_header #midcontent .featured_section_title span,
		.wrapper_header.fullwidth #midcontent .items_sliders_nav,
		.wrapper_header.transparent_header #midcontent .items_sliders_nav,
		.wrapper_header.fullwidth #midcontent .shortcode_tabgroup ul.tabs li.active,
		.wrapper_header.transparent_header #midcontent .shortcode_tabgroup ul.tabs li.active,
		.wrapper_header.fullwidth #midcontent .content_title.bold_title span,
		.wrapper_header.transparent_header #midcontent .content_title.bold_title span  {
			background: <?php echo $sellegance_opt['maincontent_bg_color']; ?> !important;
		}

		.wrapper_header.fullwidth #midcontent .contentwrapper,
		.wrapper_header.transparent_header #midcontent .contentwrapper,
		#midcontent.dark .btn-group .btn-default,
		#midcontent.dark .btn-group .btn-default:hover,
		#midcontent.dark .btn-group .btn-default:focus,
		#midcontent.dark .btn-group .btn-default:active,
		#midcontent.dark .btn-group .btn-default.active,
		#midcontent.dark #order_comments_field {
			background: transparent;
		}

		#midcontent.dark {
			color: #aaa;
		}
		#midcontent.dark .shortcode_banner_simple.light .shortcode_banner_simple_inside {
			color: #000;
		}
		#midcontent.dark .btn-group .btn-default {
			color: #777;
		}
		#midcontent.dark a,
		#midcontent.dark .btn-group .btn-default:hover,
		#midcontent.dark .btn-group .btn-default:focus,
		#midcontent.dark .btn-group .btn-default:active,
		#midcontent.dark .btn-group .btn-default.active,
		.woocommerce .widget_layered_nav ul li.chosen a:before,
		.woocommerce-page .widget_layered_nav ul li.chosen a:before {
			color: #ccc;
		}
		#midcontent.dark a:hover,
		#midcontent.dark .shortcode_banner_simple.dark .shortcode_banner_simple_inside h3,
		#midcontent.dark .shortcode_banner_simple.dark .shortcode_banner_simple_inside,
		#midcontent.dark code, #midcontent.dark pre {
			color: #fff !important;
		}
		#midcontent.dark .page-header,
		#midcontent.dark .tabs .tab-title,
		#midcontent.dark .tabs .tab-content,
		#midcontent.dark div.product div.product_meta > span,
		#midcontent.dark div.product div.product_meta,
		#midcontent.dark #content div.product div.product_meta,
		#midcontent.dark .product_share ul li a,
		#midcontent.dark .product_details h4,
		#midcontent.dark .product_details .product-actions .action,
		#midcontent.dark .toolbar,
		#midcontent.dark .widget .widget-title,
		#midcontent.dark #customer_details h3, 
		#midcontent.dark #order_review_heading,
		#midcontent.dark #order_review_box,
		#midcontent.dark #payment ul.payment_methods li,
		#midcontent.dark table.shop_table td,
		#midcontent.dark .woocommerce table.shop_table td,
		#midcontent.dark .toggle,
		#midcontent.dark .entry_post .entry_cat a,
		#midcontent.dark .entry_post .entry_meta ul li,
		#midcontent.dark .entry-meta-foot,
		#midcontent.dark .entry-meta-foot ul li,
		#midcontent.dark .post_neighbors_container .next_post,
		#midcontent.dark .items_sliders_header,
		#midcontent.dark .woocommerce-shipping-fields, 
		#midcontent.dark .create-account-block,
		.woocommerce #midcontent.dark #reviews #comments ol.commentlist li .comment-text,
		#midcontent.dark #review_form_wrapper,
		#midcontent.dark #respond h3,
		#midcontent.dark table.shop_table th, 
		#midcontent.dark .woocommerce table.shop_table th,
		.woocommerce #midcontent.dark p.stars a,
		#midcontent.dark .coupon h3,
		#midcontent.dark .shipping_calculator h3,
		#midcontent.dark .left_column_cart_shipping_wrapper,
		#midcontent.dark .cart_totals h3,
		#midcontent.dark .left_column_cart,
		#midcontent.dark .cart_totals tr,
		.woocommerce #midcontent.dark table.shop_table,
		.woocommerce-page #midcontent.dark table.shop_table,
		#midcontent.dark .shortcode_tabgroup ul.tabs li.active a,
		#midcontent.dark .shortcode_tabgroup.top .panels,
		#midcontent.dark .comment-author,
		#midcontent.dark .commentlist li article,
		#midcontent.dark #related-posts h3,
		#midcontent.dark .comments-title,
		#midcontent.dark .content_title.border_bottom h1,
		#midcontent.dark .content_title.border_bottom h2,
		#midcontent.dark .content_title.border_bottom h3,
		#midcontent.dark .content_title.border_bottom h4,
		#midcontent.dark .content_title.bold_title h1,
		#midcontent.dark .content_title.bold_title h2,
		#midcontent.dark .content_title.bold_title h3,
		#midcontent.dark .content_title.bold_title h4,
		#midcontent.dark .my-account-right header h4,
		#midcontent.dark .woocommerce .addresses .title h3,
		#midcontent.dark .woocommerce-page .addresses .title h3,
		.woocommerce #midcontent.dark .quantity .plus,
		.woocommerce #midcontent.dark .quantity .minus,
		#midcontent.dark .btn-group .btn-default,
		#midcontent.dark .product_sort,
		#midcontent.dark .blog-grid .blog_list .entry_date,
		.woocommerce .widget_layered_nav ul li.chosen a,
		.woocommerce-page .widget_layered_nav ul li.chosen a,
		#midcontent.dark .col.boxed .ins_box,
		#midcontent.dark .product_sliders_header a,
		#midcontent.dark .items_sliders_header a,
		#midcontent.dark .quote,
		#midcontent.dark #order_comments_field {
			border-color: rgba(255,255,255,0.20);
		}
		#midcontent.dark .btn-group .btn-default:hover,
		#midcontent.dark .btn-group .btn-default:focus,
		#midcontent.dark .btn-group .btn-default:active,
		#midcontent.dark .btn-group .btn-default.active,
		#midcontent.dark .col.boxed .ins_box:hover,
		#midcontent.dark .product_sliders_header a:hover,
		#midcontent.dark .items_sliders_header a:hover,
		#midcontent.dark .shortcode_banner_simple.borders.dark,
		#midcontent.dark .dark.borders .shortcode_banner_simple_inside {
			border-color: rgba(255,255,255,0.70);
		}
		.woocommerce #midcontent.dark .quantity .plus:hover,
		.woocommerce #midcontent.dark .quantity .minus:hover,
		#midcontent.dark .shortcode_banner_simple.dark .shortcode_banner_simple_sep,
		#midcontent.dark code, #midcontent.dark pre  {
			background: rgba(255,255,255,0.20);
		}
		.woocommerce #midcontent.dark .woocommerce-info, 
		.woocommerce-page #midcontent.dark .woocommerce-info,
		.woocommerce #midcontent.dark form.login, 
		.woocommerce-page #midcontent.dark form.login, 
		.woocommerce #midcontent.dark form.checkout_coupon, 
		.woocommerce-page #midcontent.dark form.checkout_coupon, 
		.woocommerce #midcontent.dark form.register, 
		.woocommerce-page #midcontent.dark form.register  {
			background: #333;
		}
		#midcontent .tabs .tab-title.opened,
		#midcontent .shortcode_tabgroup ul.tabs li.active a {
			border-bottom-color: <?php echo $sellegance_opt['maincontent_bg_color']; ?> !important;
		}

		<?php if ($sellegance_opt['responsive_layout']=='responsive940'): ?>
		body .container { max-width: 982px !important; }
		<?php endif; ?>


		/* Append CSS Code from the Theme Options
		--------------------------------------- */

		<?php echo $sellegance_opt['custom_css_code']; ?>

	</style>

	<script type="text/javascript">
		var products_default_view = "<?php echo $sellegance_opt['products_default_view']; ?>";
	</script>

<?php 
}

add_action( 'wp_head', 'sellegance_custom_styles', 100 );
?>