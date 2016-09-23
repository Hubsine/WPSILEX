<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-----------------------------------------------------------------------------------*/


define('ET_FUNCTIONS', get_template_directory() . '/functions');
define('ET_INCLUDES', get_template_directory() . '/includes');
define('ET_ADMIN', get_template_directory() . '/admin');
define('ET_JS', get_template_directory() . '/js');
define('ET_CSS', get_template_directory() . '/css');
define('ET_IMAGES', get_template_directory() . '/images');
define('ET_DIRECTORY', get_template_directory());
define('ET_THEME_NAME', 'sellegance');
add_theme_support( 'woocommerce');
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*	 Make theme available for translation
/*	 Translations can be filed in the /languages/ directory
/*	 If you're building a theme based on Sellegance, use a find and replace
/*	 to change 'sellegance' to the name of your theme in all the template files
/*-----------------------------------------------------------------------------------*/

add_action('after_setup_theme', 'sellegance_theme_setup');

function sellegance_theme_setup(){
	load_theme_textdomain( 'sellegance', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) ) require_once($locale_file);
}


/*-----------------------------------------------------------------------------------*/
/* Includes
/*-----------------------------------------------------------------------------------*/

global $sellegance_opt;

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}

require_once( ET_INCLUDES . '/theme-options.php'); // Redux Options panel
require_once( ET_FUNCTIONS . '/megamenu/mega_menu.php' ); // Mega Menu
include_once( ET_INCLUDES . '/custom_styles.php'); // Custom Styles



define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/functions/metabox' ) );
define( 'RWMB_DIR', trailingslashit( ET_FUNCTIONS . '/metabox' ) );

require_once RWMB_DIR . 'meta-box.php';

include( ET_FUNCTIONS . '/posttypes.php' ); // Theme PostTypes
include( ET_FUNCTIONS . '/metaboxes.php' ); // Theme MetaBoxes
include( ET_FUNCTIONS . '/taxonomy-meta.php' ); // Theme Taxonomy Meta
include( ET_FUNCTIONS . '/theme-functions.php' ); // Theme Functions
include( ET_FUNCTIONS . '/woo.php' ); // WooCommerce Functions

#-----------------------------------------------------------------#
# Shortcodes
#-----------------------------------------------------------------#

//TinyMCE button + generator
require_once( ET_FUNCTIONS . '/tinymce/tinymce-class.php' ); 
//Shortcode Processing
require_once( ET_FUNCTIONS . '/tinymce/shortcode-processing.php' ); 

/*-----------------------------------------------------------------------------------*/
/* Widgets */
/*-----------------------------------------------------------------------------------*/
require_once( ET_FUNCTIONS . '/widgets/posts.php' ); // Posts Widget
require_once( ET_FUNCTIONS . '/widgets/social.php' ); // Social Icons Widget
require_once( ET_FUNCTIONS . '/widgets/portfolio.php' ); // Portfolio List Widget
require_once( ET_FUNCTIONS . '/widgets/brands.php' ); // Brands Widget

/*-----------------------------------------------------------------------------------*/
/*	REGISTER Widgets
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'sellegance_load_widgets' );
function sellegance_load_widgets()
{
   register_widget( 'WP_Widget_Custom_Posts' );
   register_widget( 'WP_Widget_Custom_Social' );
   register_widget( 'WP_Widget_Custom_Portfolio' );
}

/*-----------------------------------------------------------------------------------*/
/* GET PAGE URL
/*-----------------------------------------------------------------------------------*/

function get_permalink_by_name($title){
	$page = get_page_by_title($title);
	$pageID = $page->ID;
	$permalink = get_permalink($pageID);
	return $permalink;
}

/*-----------------------------------------------------------------------------------*/
/* Plugin recommendations
/*-----------------------------------------------------------------------------------*/


require_once ( 'includes/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme

		array(
			'name'     				=> 'Redux Framework',
			'slug'     				=> 'redux-framework',
			'source'   				=> 'https://downloads.wordpress.org/plugin/redux-framework.3.5.4.3.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/redux-framework/',
		),

		array(
			'name'     				=> 'Ninja Forms',
			'slug'     				=> 'ninja-forms',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/ninja-forms.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'http://wordpress.org/plugins/ninja-forms/',
		),
		
		array(
			'name'     				=> 'WooCommerce',
			'slug'     				=> 'woocommerce',
			'source'   				=> 'https://downloads.wordpress.org/plugin/woocommerce.2.3.8.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/woocommerce/',
		),

		array(
			'name'     				=> 'Revolution Slider',
			'slug'     				=> 'revslider',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/revslider.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
		
		array(
			'name'     				=> 'Regenerate Thumbnails',
			'slug'     				=> 'regenerate-thumbnails',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/regenerate-thumbnails.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/regenerate-thumbnails/',
		),
		
		array(
			'name'     				=> 'Unlimited Sidebars Woosidebars',
			'slug'     				=> 'woosidebars',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/woosidebars.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/woosidebars/',
		),

		array(
			'name'     				=> 'YITH WooCommerce Ajax Search',
			'slug'     				=> 'yith-woocommerce-ajax-search',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/yith-woocommerce-ajax-search.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-ajax-search/',
		),

		array(
			'name'     				=> 'YITH WooCommerce Compare',
			'slug'     				=> 'yith-woocommerce-compare',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/yith-woocommerce-compare.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-compare/',
		),

		array(
			'name'     				=> 'YITH WooCommerce Wishlist',
			'slug'     				=> 'yith-woocommerce-wishlist',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/yith-woocommerce-wishlist.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-wishlist/',
		),

		array(
			'name'     				=> 'YITH WooCommerce Zoom Magnifier',
			'slug'     				=> 'yith-woocommerce-zoom-magnifier',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/yith-woocommerce-zoom-magnifier.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-zoom-magnifier/',
		),
							
		
		array(
			'name'     				=> 'Envato Toolkit',
			'slug'     				=> 'envato-wordpress-toolkit-master',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/envato-wordpress-toolkit-master.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		
		array(
			'name'     				=> 'Breadcrumb NavXT',
			'slug'     				=> 'breadcrumb-navxt',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/breadcrumb-navxt.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/breadcrumb-navxt/',
		),
		
		array(
			'name'     				=> 'WP Retina 2x',
			'slug'     				=> 'wp-retina-2x',
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/wp-retina-2x.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/wp-retina-2x/',
		),		


	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'sellegance',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'sellegance' ),
			'menu_title'                       			=> __( 'Install Plugins', 'sellegance' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'sellegance' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'sellegance' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'sellegance' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'sellegance' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'sellegance' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}


/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails 
/*-----------------------------------------------------------------------------------*/

if( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size('admin_thumbs', 150, 90, true);
	add_image_size('recent_posts_shortcode', 190, 190, true);
	add_image_size('related-posts', 200, 150, true);
	add_image_size( 'small', 150, 90, true ); 
	add_image_size( 'medium', 400, 250, true );        
	add_image_size( 'large', 860, '', true );        
	add_image_size( 'post-thumb', 860, 450, true );        
	add_image_size( 'slider-image', 1170, 500, true );        
	add_image_size( 'full-width', 1170, '', true );
	add_image_size( 'brands', 200, 150, true );	
	create_sellegance_brands_table(); // create wp_wcm_sds_brands table if not exists
}


/*-----------------------------------------------------------------------------------*/
/*	Post Formats
/*-----------------------------------------------------------------------------------*/

$formats = array( 
			'gallery', 
			'video');

add_theme_support( 'post-formats', $formats );


/*--------------------------------------------------------
	Excerpts Setup
--------------------------------------------------------*/


function tdl_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= '';
	}
	return $output;
}

add_filter( 'get_the_excerpt', 'tdl_custom_excerpt_more' );


/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width (use in conjuction with ".entry-content img" css)
/*-----------------------------------------------------------------------------------*/

	if ( ! isset( $content_width ) ) $content_width = 1170;


/*-----------------------------------------------------------------------------------*/
/*	Better SEO page title
/*-----------------------------------------------------------------------------------*/
	
	add_filter( 'wp_title', 'filter_wp_title' );
	/**
	 * Filters the page title appropriately depending on the current page
	 *
	 * This function is attached to the 'wp_title' fiilter hook.
	 *
	 * @uses	get_bloginfo()
	 * @uses	is_home()
	 * @uses	is_front_page()
	 */
	function filter_wp_title( $title ) {
		global $page, $paged;
	
		if ( is_feed() )
			return $title;
	
		$site_description = get_bloginfo( 'description' );
	
		$filtered_title = $title . get_bloginfo( 'name' );
		$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
		$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'sellegance'), max( $paged, $page ) ) : '';
	
		return $filtered_title;
	}
	
	
/*-----------------------------------------------------------------------------------*/
/*	Remove Certain HEAD Tags
/*-----------------------------------------------------------------------------------*/
	
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tdl_browser_body_class' ) ) {
	function tdl_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		return $classes;
	}
	
	add_filter('body_class','tdl_browser_body_class');
}

add_action( 'body_class', 'ilwp_add_my_bodyclass'); function ilwp_add_my_bodyclass( $classes ) { global $post; $classes[] = $post->post_name; return $classes; }


/*--------------------------------------------------------
	Theme CSS Queueing
--------------------------------------------------------*/


function tdl_css_queueing() {
	if (!is_admin()) {

		global $sellegance_opt;
		
		wp_register_style('stylesheet', get_stylesheet_uri(), array(), '1.0', 'all');
		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_register_style('magnificpopup', get_template_directory_uri() . '/css/magnific-popup.css');
		wp_register_style('iosslider', get_template_directory_uri() . '/css/iosslider.css');	
		wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css');

		wp_enqueue_style('bootstrap');
		wp_enqueue_style('iosslider');
		wp_enqueue_style('fontawesome');
		wp_enqueue_style('magnificpopup');
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			//if woocommerce is active
			wp_enqueue_style('woocommerce_css', plugins_url() .'/woocommerce/assets/css/woocommerce.css'); 
		}

		wp_enqueue_style('stylesheet');

		if ($sellegance_opt['custom_stylesheet']==1) {
			wp_enqueue_style("custom",get_template_directory_uri().'/css/custom.css');
		}
				
		if ($sellegance_opt['responsive_layout'] == 'fixed') {
			wp_register_style('fixed', get_template_directory_uri() . '/css/style-fixed.css');
			wp_enqueue_style('fixed');
		} else {
			wp_register_style('responsive', get_template_directory_uri() . '/css/style-responsive.css');
			wp_enqueue_style('responsive'); 
		}		

	}
}
add_action('wp_enqueue_scripts', 'tdl_css_queueing');

/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

function tdl_register_js() {
	if (!is_admin()) {
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.full.min.js', 'jquery', NULL, FALSE);

		global $is_IE;

		if ( $is_IE ) {
			wp_register_script('html5', get_stylesheet_directory_uri() . '/js/html5.js', array(), '3.6', FALSE);
			wp_register_script('respond', get_stylesheet_directory_uri() . '/js/respond.min.js', array(), NULL, FALSE);
			
			wp_enqueue_script('html5');
			wp_enqueue_script('respond');
		}
		wp_register_script('hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', 'jquery', NULL, TRUE);
		wp_register_script('magnificpopup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', 'jquery', NULL, TRUE);
		wp_register_script('iosslider', get_template_directory_uri() . '/js/jquery.iosslider.min.js', 'jquery', NULL, FALSE);
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', NULL, TRUE);
		wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing-1.3.js', 'jquery', NULL, TRUE);
		wp_register_script('totalStorage', get_template_directory_uri() . '/js/jquery.total-storage.min.js', 'jquery');
		wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', NULL, TRUE);
		wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', NULL, TRUE);	
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery', NULL, TRUE);

		wp_enqueue_script('bootstrap');		
		wp_enqueue_script('modernizr');
		wp_enqueue_script('hoverIntent');
		wp_enqueue_script('magnificpopup');
		wp_enqueue_script('iosslider');
		wp_enqueue_script('isotope');
		wp_enqueue_script('easing');
		wp_enqueue_script('totalStorage');
		wp_enqueue_script('fitvids');
		wp_enqueue_script('custom');
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_page_template('template-contact.php') ) {        	
		wp_register_script('gMapapi', 'http://maps.google.com/maps/api/js?sensor=false', 'jquery');
		wp_register_script('gMap', get_template_directory_uri() . '/js/jquery.gmap.js', 'jquery');
		wp_enqueue_script('gMapapi');
		wp_enqueue_script('gMap');
	}

	global $is_IE;

	if ( $is_IE ) {
		wp_register_script('html5', get_stylesheet_directory_uri() . '/js/html5.js', array(), '3.6', TRUE);
		wp_register_script('respond', get_stylesheet_directory_uri() . '/js/respond.min.js', array(), NULL, TRUE);
		
		wp_enqueue_script('html5');
		wp_enqueue_script('respond');
	}
}

add_action('wp_enqueue_scripts', 'tdl_register_js');


/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tdl_admin_js' ) ) {
	function tdl_admin_js($hook) {
		if ($hook == 'post.php' || $hook == 'post-new.php') {
			wp_register_script('tdl-admin', get_template_directory_uri() . '/js/custom.admin.js', 'jquery', true);
			wp_enqueue_script('tdl-admin');
		}
	}
	
	add_action('admin_enqueue_scripts','tdl_admin_js',10,1);

}

/*-----------------------------------------------------------------------------------*/
/*	Add shortcodes to excerpts
/*-----------------------------------------------------------------------------------*/

add_filter('the_excerpt', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Add Magnific Popup rel to [gallery] with link=file
/*-----------------------------------------------------------------------------------*/

add_filter( 'wp_get_attachment_link', 'sant_mfpadd', 10, 6);
function sant_mfpadd ($content, $id, $size, $permalink, $icon, $text) {
	if ($permalink) {
	return $content;    
	}
	$content = preg_replace("/<a/","<a rel=\"magnificpopup[gallery]\"",$content,1);
	return $content;
}



/*-----------------------------------------------------------------------------------*/
/* Previous/Next Links Function
/*-----------------------------------------------------------------------------------*/

function the_previousnextlinks() {
	global $post;

	$next_post = get_adjacent_post(false, '', false);
	$prev_post = get_adjacent_post(false, '', true);

	if ($next_post) {
	 $next_post_id = $next_post->ID;
	 $next_post_link = get_permalink($next_post_id);
	} 

	if ($prev_post) {
	$prev_post_id = $prev_post->ID;
	$prev_post_link = get_permalink($prev_post_id);
	}


	if( $next_post || $prev_post ) { 
		echo '<div class="post_neighbors_container_wrapper"><div class="post_neighbors_container">';
		
		if ($prev_post) { 
			echo '<a href="'. $prev_post_link .'" class="neighbors_link previous_post"><i class="fa fa-angle-left"></i><h5>' . __('Previous Story', 'sellegance') . '</h5><h3>' . get_the_title($prev_post_id) . '</h3></a>'; 
		} else {
			echo '<span class="neighbors_link previous_post grey"><i class="fa fa-angle-left"></i><h5>' . __('Previous Story', 'sellegance') . '</h5><h3>'. __('There are no older stories.', 'sellegance') . '</h3></span>'; 
		} 
		
		if ($next_post) { 
			echo '<a href="'. $next_post_link .'" class="neighbors_link next_post"><h5>' . __('Next Story', 'sellegance') . '</h5><h3>' . get_the_title($next_post_id) . '</h3><i class="fa fa-angle-right"></i></a>'; 
		} else {
			echo '<span class="neighbors_link next_post grey"><h5>' . __('Next Story', 'sellegance') . '</h5><h3>'. __('This is the most recent story.', 'sellegance') . '</h3><i class="fa fa-angle-right"></i></span>'; 
		}  
		
		echo '<div class="clear"></div></div></div>';
	} 
}


/*-----------------------------------------------------------------------------------*/
/* Related Posts Function
/*-----------------------------------------------------------------------------------*/

function ag_get_related_post_args($id){

	global $relatedcatargs, $relatedargs;
	
	$rel_tagnames = '';
	$rel_catnames = '';

	$relatednumber = '2';

	// Get related post tag names
	$rel_tags = get_the_tags($id);
	
	if ($rel_tags) {
		// Get list of tag names and set arguments for loop
		foreach($rel_tags as $rel_tag) {
		  $rel_tagnames .= $rel_tag->name . ',';
		}
		$relatedargs = array(
		  'ignore_sticky_posts' => 1,
		  'tag' => $rel_tagnames,
		  'post__not_in' => array($id),
		  'showposts' => $relatednumber,
		  'orderby' => 'rand'
		);
	}

	// Get list of category names and set arguments for loop
	$post_cats = wp_get_post_categories($id);

	foreach($post_cats as $post_cat) {
	  $rel_catnames .= get_cat_name( $post_cat ) .',';
	}
	
	$relatedcatargs = array(
	  'ignore_sticky_posts' => 1,
	  'category__in' => $post_cats,
	  'post__not_in' => array($id),
	  'showposts' => $relatednumber,
	  'orderby' => 'rand'
	);

}

function getRelatedPosts( $count=4) {
	global $post;
	$orig_post = $post;
	$tags = wp_get_post_tags($post->ID);

	if ($tags) {
		$tag_ids = array();

		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> $count, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
		);

		$my_query = new WP_Query( $args );

		if( $my_query->have_posts() ) { ?>

			<div id="related-posts">
				

				<?php $sliderrandomid = rand();  ?>

				<script>
				(function($){
					$(window).load(function(){
					/* items_slider */
					$('.items_slider_id_<?php echo $sliderrandomid ?> .items_slider').iosSlider({
						snapToChildren: true,
						desktopClickDrag: true,
						navNextSelector: $('.items_slider_id_<?php echo $sliderrandomid ?> .items_sliders_nav .big_arrow_right'),
						navPrevSelector: $('.items_slider_id_<?php echo $sliderrandomid ?> .items_sliders_nav .big_arrow_left'),

					});
					
							
					})
				})(jQuery);
				</script>

				<div id="related_portslider" class="items_slider_id_<?php echo $sliderrandomid ?>">
					<div class="items_sliders_header">
						<div class="items_sliders_title">
							<div class="featured_section_title"><span><?php _e('Related Posts', 'sellegance'); ?></span></div>
							<div class="items_sliders_nav">
								<a class='big_arrow_right'></a>
								<a class='big_arrow_left'></a>
								<div class='clearfix'></div>
							</div>
						</div>
					</div>
				
					<div class="items_slider_wrapper">
						<div class="items_slider portfolioitems_slider">
							 <ul class="slider">

							<?php while( $my_query->have_posts() ) { $my_query->the_post(); ?>
								<li class="portfolio-item">
									<div class="related-image">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('related-posts'); ?></a>
										<?php } ?>
										<div class="related-text">
											<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
										</div><!--related-text-->
									</div><!--related-image-->
									<div class="related-small">
										<a href="<?php the_permalink() ?>" class="main-headline"><?php the_title(); ?></a>
									</div><!--related-small-->
								</li>
							<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php }
	}

	$post = $orig_post;

	wp_reset_query();

}

/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/

function sellegance_widgets_init() {

	global $sellegance_opt;

	if ( function_exists('register_sidebar') ) {

		register_sidebar(array(
			'name' => __( 'Sidebar', 'sellegance' ),
			'id' => 'sidebar',
			'description'   => 'General sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		
		register_sidebar(array(
			'name' => __( 'Shop Sidebar', 'sellegance' ),
			'id' => 'shop_sidebar',
			'description'   => 'Sidebar on products listing if WooCommerce is active',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => __( 'Product Sidebar', 'sellegance' ),
			'id' => 'product_sidebar',
			'description'   => 'Sidebar on single product page',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => __( 'Revolution Slider', 'sellegance' ),
			'id' => 'revslider',
			'description'   => 'For Revolution Slider on Homepage',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		
		if (isset($sellegance_opt['footer_top_columns'])) $columns=12/$sellegance_opt['footer_top_columns'];
		else $columns=3;

		register_sidebar(array(
			'name' => 'Footer Top',
			'id' => 'footer_top',
			'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-'.$columns.'">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		if (isset($sellegance_opt['footer_bottom_columns'])) $columns=12/$sellegance_opt['footer_bottom_columns'];
		else $columns=3;
		
		register_sidebar(array(
			'name' => 'Footer Bottom',
			'id' => 'footer_bottom',
			'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-'.$columns.'">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

	}
}
add_action( 'widgets_init', 'sellegance_widgets_init' );

add_filter('widget_text', 'do_shortcode');

register_nav_menus(array(
	'primary-menu' => __('Primary Menu', 'sellegance'),
	'mobile-menu' => __('Mobile Menu (Same as Primary Menu if empty)', 'sellegance'),
	'topbar' => __( 'Top Bar Menu', 'sellegance' ),
	'secondary' => __( 'Right Header Menu', 'sellegance' ),
));


class Description_Walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    parent::start_el($output, $item, $depth, $args);
    $output .= sprintf('<i>%s</i>', esc_html($item->description));
	}
}

add_filter( 'woocommerce_variation_option_name', 'display_price_in_variation_option_name' );

function display_price_in_variation_option_name( $term ) {
    global $wpdb, $product;

    $result = $wpdb->get_col( "SELECT slug FROM {$wpdb->prefix}terms WHERE name = '$term'" );

    $term_slug = ( !empty( $result ) ) ? $result[0] : $term;


    $query = "SELECT postmeta.post_id AS product_id
                FROM {$wpdb->prefix}postmeta AS postmeta
                    LEFT JOIN {$wpdb->prefix}posts AS products ON ( products.ID = postmeta.post_id )
                WHERE postmeta.meta_key LIKE 'attribute_%'
                    AND postmeta.meta_value = '$term_slug'
                    AND products.post_parent = $product->id";

    $variation_id = $wpdb->get_col( $query );

    $parent = wp_get_post_parent_id( $variation_id[0] );

    if ( $parent > 0 ) {
        $_product = new WC_Product_Variation( $variation_id[0] );
        return $term . ' (' . strip_tags(woocommerce_price( $_product->get_price() )) . ')';
    }
    return $term;

}

?>