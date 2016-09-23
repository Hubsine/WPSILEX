<?php
global $woo_options;
global $woocommerce;
global $sellegance_opt;

$colorscheme = $sellegance_opt['header_text_color'];
$colorscheme .= ' '. $sellegance_opt['topbar_text_color'];

$headertype = $sellegance_opt['header_layout'];
$main_layout = $sellegance_opt['main_layout'];
$navposition = $sellegance_opt['navigation_inside'];

if ($navposition==1) $navposition = "navbar_inside"; else $navposition= "navbar_outside";

if (isset($_GET["headertype"])) { $headertype = $_GET["headertype"]; }
$responsive = $sellegance_opt['responsive_layout'];
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<!-- Basic Page Needs -->
<meta charset="<?php bloginfo('charset'); ?>" />
<?php if( $responsive == 'responsive' || $responsive == 'responsive940'): ?>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
<?php endif;?>


<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
<!-- WordPress wp_head() -->
<?php wp_head(); ?> 

</head>

<body <?php body_class(); ?>>

<?php 

if (is_page_template('template-home-fullslider.php')) {
  $homeslider = 'fullslider';
  if ($sellegance_opt['top_bar']==1) {
	$homeslider = 'fullslider_tb';
  }
} else {
	$homeslider='';
}

?>

<div id="big_wrapper" class="wrapper_header <?php echo $colorscheme ?> <?php echo $main_layout ?> <?php echo $headertype ?> <?php echo $navposition ?>">
<div id="page_wrapper" class="<?php echo $homeslider; ?>">

<?php if ($sellegance_opt['top_bar']==1) { ?>
<div id="header_topbar">
	<div class="container">
		<div class="topbar_inner">
			<div class="row">

				<div class="col-sm-8 info">
				<?php if ( has_nav_menu( 'topbar' ) ) : ?>
					 <?php wp_nav_menu(array(
						   'theme_location' => 'topbar',
						   'container' => 'div',
						   'container_class' => 'topbarmenu',
						   'menu_class' => '',
						   'echo' => true,
						   'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						   'before' => '',
						   'after' => '',
						   'link_before' => '',
						   'link_after' => '',
						   'depth' => 0,
						   'fallback_cb' => false,
						   ));
					 ?>
				<?php endif; ?>
				</div>

				<div class="col-sm-4 social">

					<div class="rightnav">

						<?php if (function_exists('icl_get_languages')) { ?>
							<div class="header-switch language-switch">
							<?php languages_list(); ?>
							</div>
						<?php } ?>

						<?php if ( has_nav_menu( 'secondary' ) ) : ?>
						   <div class="header-switch nav-switch">       
								<?php 
								$title = $sellegance_opt['topbar_dropdown_title'];
								wp_nav_menu(array(
								  'theme_location' => 'secondary',
								  'container' =>false,
								  'menu_class' => '',
								  'echo' => true,
								  'items_wrap'      => '<span class="current">'.$title.'</span><div class="header-dropdown"><ul>%3$s</ul></div>',
								  'before' => '',
								  'after' => '',
								  'link_before' => '',
								  'link_after' => '',
								  'depth' => 0,
								  'fallback_cb' => false,
								  'walker' => new TDL_Menu_Right()
								));
								?>
						   </div>
						<?php endif; ?>
					</div>

					<ul id="social-icons">
						<?php
						$facebook = $sellegance_opt['tdl_facebook_url'];
						$twitter = $sellegance_opt['tdl_twitter_url'];	
						$googleplus = $sellegance_opt['tdl_googleplus_url'];	
						$pinterest = $sellegance_opt['tdl_pinterest_url'];	
						$vimeo = $sellegance_opt['tdl_vimeo_url'];	
						$youtube = $sellegance_opt['tdl_youtube_url'];	
						$flickr = $sellegance_opt['tdl_flickr_url'];	
						$skype = $sellegance_opt['tdl_skype_url'];
						$behance = $sellegance_opt['tdl_behance_url'];
						$dribbble = $sellegance_opt['tdl_dribbble_url'];
						$tumblr = $sellegance_opt['tdl_tumblr_url'];
						$linkedin = $sellegance_opt['tdl_linkedin_url'];
						$github = $sellegance_opt['tdl_github_url'];
						$vine = $sellegance_opt['tdl_vine_url'];
						$instagram = $sellegance_opt['tdl_instagram_url'];
						$dropbox = $sellegance_opt['tdl_dropbox_url'];
						$rss = $sellegance_opt['tdl_rss_url'];
						$stumbleupon = $sellegance_opt['tdl_stumbleupon_url'];
						$paypal = $sellegance_opt['tdl_paypal_url'];
						$etsy = $sellegance_opt['tdl_etsy_url'];
						$foursquare = $sellegance_opt['tdl_foursquare_url'];
						$soundcloud = $sellegance_opt['tdl_soundcloud_url'];
						$spotify = $sellegance_opt['tdl_spotify_url'];
						?>
										
						<?php if($facebook) { ?><li class="facebook"><a target="_blank" href="<?php echo $facebook; ?>" title="Facebook"><i class="fa fa-facebook"></i></a></li><?php } ?>
						<?php if($twitter) { ?><li class="twitter"><a target="_blank" href="<?php echo $twitter; ?>" title="Twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>
						<?php if($googleplus) { ?><li class="googleplus"><a target="_blank" href="<?php echo $googleplus; ?>" title="Googleplus"><i class="fa fa-google-plus"></i></a></li><?php } ?>
						<?php if($pinterest) { ?><li class="pinterest"><a target="_blank" href="<?php echo $pinterest; ?>" title="Pinterest"><i class="fa fa-pinterest"></i></a></li><?php } ?>
						<?php if($vimeo) { ?><li class="vimeo"><a target="_blank" href="<?php echo $vimeo; ?>" title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li><?php } ?>
						<?php if($youtube) { ?><li class="youtube"><a target="_blank" href="<?php echo $youtube; ?>" title="YouTube"><i class="fa fa-youtube"></i></a></li><?php } ?>
						<?php if($flickr) { ?><li class="flickr"><a target="_blank" href="<?php echo $flickr; ?>" title="Flickr"><i class="fa fa-flickr"></i></a></li><?php } ?>
						<?php if($skype) { ?><li class="skype"><a target="_blank" href="<?php echo $skype; ?>" title="Skype"><i class="fa fa-skype"></i></a></li><?php } ?>
						<?php if($behance) { ?><li class="behance"><a target="_blank" href="<?php echo $behance; ?>" title="Behance"><i class="fa fa-behance"></i></a></li><?php } ?>
						<?php if($dribbble) { ?><li class="dribbble"><a target="_blank" href="<?php echo $dribbble; ?>" title="Dribbble"><i class="fa fa-dribbble"></i></a></li><?php } ?>
						<?php if($tumblr) { ?><li class="tumblr"><a target="_blank" href="<?php echo $tumblr; ?>" title="Tumblr"><i class="fa fa-tumblr"></i></a></li><?php } ?>
						<?php if($linkedin) { ?><li class="linkedin"><a target="_blank" href="<?php echo $linkedin; ?>" title="Linkedin"><i class="fa fa-linkedin"></i></a></li><?php } ?>
						<?php if($github) { ?><li class="github"><a target="_blank" href="<?php echo $github; ?>" title="Github"><i class="fa fa-github"></i></a></li><?php } ?>
						<?php if($vine) { ?><li class="vine"><a target="_blank" href="<?php echo $vine; ?>" title="Vine"><i class="fa fa-vine"></i></a></li><?php } ?>
						<?php if($instagram) { ?><li class="instagram"><a target="_blank" href="<?php echo $instagram; ?>" title="Instagram"><i class="fa fa-instagram"></i></a></li><?php } ?>
						<?php if($dropbox) { ?><li class="dropbox"><a target="_blank" href="<?php echo $dropbox; ?>" title="Dropbox"><i class="fa fa-dropbox"></i></a></li><?php } ?>
						<?php if($rss) { ?><li class="rss"><a target="_blank" href="<?php echo $rss; ?>" title="RSS"><i class="fa fa-rss"></i></a></li><?php } ?>
						<?php if($stumbleupon) { ?><li class="stumbleupon"><a target="_blank" href="<?php echo $stumbleupon; ?>" title="Stumbleupon"><i class="fa fa-stumbleupon"></i></a></li><?php } ?>
						<?php if($paypal) { ?><li class="paypal"><a target="_blank" href="<?php echo $paypal; ?>" title="Paypal"><i class="fa fa-paypal"></i></a></li><?php } ?>
						<?php if($etsy) { ?><li class="etsy"><a target="_blank" href="<?php echo $etsy; ?>" title="Etsy"><i class="fa fa-etsy"></i></a></li><?php } ?>
						<?php if($foursquare) { ?><li class="foursquare"><a target="_blank" href="<?php echo $foursquare; ?>" title="Foursquare"><i class="fa fa-foursquare"></i></a></li><?php } ?>
						<?php if($soundcloud) { ?><li class="soundcloud"><a target="_blank" href="<?php echo $soundcloud; ?>" title="Soundcloud"><i class="fa fa-soundcloud"></i></a></li><?php } ?>
						<?php if($spotify) { ?><li class="spotify"><a target="_blank" href="<?php echo $spotify; ?>" title="Spotify"><i class="fa fa-spotify"></i></a></li><?php } ?>
					</ul> 
				
				</div> <!-- .social -->
			</div>
		</div> <!-- .topbar_inner -->
	</div> <!-- .container -->
</div> <!-- #header_topbar -->
<?php } ?>

<?php
	if ( is_page_template('template-home-fullslider.php') ) { 
		get_template_part( 'includes/slider','loop' );
	} else {
		get_template_part( 'includes/header','loop' );
	} 
?>


<div id="midcontent" class="<?php echo $sellegance_opt['maincontent_text_color']; ?>">

  <div class="container">
	
	  <div class="contentwrapper">