<?php


/*--------------------------------------------------------
	Comments
--------------------------------------------------------*/

if ( ! function_exists( 'tdl_comment' ) ) :

function tdl_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<div class="clearfix"></div>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sellegance' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'sellegance' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<?php echo get_avatar( $comment, 40 ); ?>
			<div class="comment-text">
				<div class="comment-author vcard">
					
					<?php printf( sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<span class="comment-meta commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'sellegance' ), get_comment_date(), get_comment_time() ); ?>
						</time></a>
						<?php edit_comment_link( __( '(Edit)', 'sellegance' ), ' ' );
						?>
					</span><!-- .comment-meta .commentmetadata -->
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'sellegance' ); ?></em>
					<br />
				<?php endif; ?>



			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
			</div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for tdl_comment()

/*--------------------------------------------------------
	Validation Checks
--------------------------------------------------------*/

function checkurl($url) {
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}


/*-----------------------------------------------------------------------------------*/
/*	Add Favicon
/*-----------------------------------------------------------------------------------*/

function tdl_custom_favicon() {
	global $sellegance_opt;
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
	$favicon_url = $protocol. str_replace(array('http:', 'https:'), '', $sellegance_opt['favicon_image']['url']);
	
	if ( $favicon_url ) {
		echo '<link rel="shortcut icon" href="'.  $favicon_url  .'"/>'."\n";
	}
	else { ?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.png" />
	<?php }	
	
}

add_action( 'wp_head', 'tdl_custom_favicon' );

// Custom Retina Favicon

function tdl_custom_favicon_retina() {
	global $sellegance_opt;
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
	$favicon_retina = $protocol. str_replace(array('http:', 'https:'), '', $sellegance_opt['favicon_retina']['url']);
	
	if ( $favicon_retina ) {
		echo '<link rel="apple-touch-icon-precomposed" href="'.  $favicon_retina  .'"/>'."\n";
	}
	else { ?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ?>/images/apple-touch-icon-precomposed.png" />
	<?php }	
	
}

add_action( 'wp_head', 'tdl_custom_favicon_retina' );

/*-----------------------------------------------------------------------------------*/
/*	BREADCRUMBS
/*-----------------------------------------------------------------------------------*/

	function et_breadcrumbs() {
		$breadcrumb_output = "";
		
		if ( function_exists('bcn_display') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= bcn_display(true);
			$breadcrumb_output .= '</div>'. "\n";
		} else if ( function_exists('yoast_breadcrumb') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= yoast_breadcrumb("","",false);
			$breadcrumb_output .= '</div>'. "\n";
		}
		
		return $breadcrumb_output;
	}
	
/*-----------------------------------------------------------------------------------*/
/*	WPML dropdown
/*-----------------------------------------------------------------------------------*/

	function languages_list() {
		
		if (function_exists('icl_get_languages')) {
			
		$languages = icl_get_languages('skip_missing=0&orderby=code');
			if(!empty($languages)){
				foreach($languages as $l){
				if($l['active']) 
					echo '<span class="current">'.$l['native_name'].'</span>';
				else echo '';			
				}
		
				echo '<div class="header-dropdown"><ul>';
				foreach($languages as $l){			
		
					if($l['active']) echo '<li class="current-menu-item"><a href="'.$l['url'].'">';
					if(!$l['active']) echo '<li><a href="'.$l['url'].'">';
					echo '<span>'.$l['native_name'].'</span>';
					echo '</a></li>';				
		
				}
				echo '</ul></div>';
			}			
			
			
		} else {
			
			echo '<span class="current">English</span><div class="header-dropdown"><ul><li><a href="#"><span>Deutsch</span></a></li><li class="current-menu-item"><a href="#"><span>English</span></a></li><li><a href="#"><span>Fran&ccedil;ais</span></a></li></ul></div>'."\n";			
			
		}

	}
	

/*-----------------------------------------------------------------------------------*/
/*	Add Navigations
/*-----------------------------------------------------------------------------------*/


function navigation() {
	
	$mega = array(
		'theme_location' => 'primary-menu',
		'container' => '',
		'depth' => 3,
		'container_class' => 'clearfix',
		'fallback_cb' => 'nomenu',
		'menu_id' => 'menu',
		'walker' => new TDL_Menu_Frontend());

	wp_nav_menu($mega);
}

function nomenu() {
	echo "<ul id='menu' class='menu'><li><a>Define your primary navigation in <strong>Appearance -> Menus</strong>.</a></li></ul>";
}

class TDL_Menu_Right extends Walker_Nav_Menu {
function start_el(&$output, $object, $depth = 0, $args = array(), $id = 0) {  
		global $wp_query;  
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';  
  
		$class_names = $value = '';  
  
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;  
  
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );  
		$class_names = ' class="'. esc_attr( $class_names ) . '"';  
  
		$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';  
  
		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';  
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';  
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';  
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';  
		$description  = ! empty( $object->description ) ? '<span>'.esc_attr( $object->description ).'</span>' : '';  
  
		if($depth != 0) {  
			$description = $append = $prepend = "";  
		}  
  
		$item_output = $args->before;  
		$item_output .= '<a'. $attributes .'>';  
		$item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );  
		$item_output .= $description.$args->link_after;  
		$item_output .= '</a>';  
		$item_output .= $args->after;  
  
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );  
	} 
	function start_lvl(&$output, $depth = 0, $args = array()){
		$indent = str_repeat("\t", $depth);
	}
	function end_lvl(&$output, $depth = 0, $args = array()){
		$indent = str_repeat("\t", $depth);

	}
	function end_el(&$output, $object, $depth = 0, $args = array(), $id = 0) {
		$output .= "\n";
	}
}


/*--------------------------------------------------------
	Pagination Function
--------------------------------------------------------*/


function tdl_pagination ( $pages = '', $range = 4 ) {
	 
	 $showitems = ($range * 2) + 1;

 
	 global $paged;
	 
	 if( empty( $paged ) ) $paged = 1;
 
	 if( $pages == '' ) {
		 
		 global $wp_query;
		 
		 $pages = $wp_query->max_num_pages;
		 
		 if(!$pages) {
			 
			 $pages = 1;
			 
		 }
		 
	 }   
 
	 if(1 != $pages) {
		 
		 echo "<div><ul class=\"pagination \"><li class=\"disabled\"><a href=\"#\">" . __('Page ', 'sellegance') . $paged . __(' of ', 'sellegance') . $pages . "</a></li>";
		 
		 if( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) echo "<li><a href='" . get_pagenum_link( 1 ) . "'>&lArr; " . __('First', 'sellegance') . "</a></li>";
		 
		 if( $paged > 1 && $showitems < $pages ) echo "<li><a href='" . get_pagenum_link( $paged - 1 ) . "'>&larr; " . __('Previous', 'sellegance') . "</a></li>";
 
		 for ( $i = 1; $i <= $pages; $i++ ) {
			 
			 if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems )) {
				 
				 echo ( $paged == $i ) ? "<li class=\"active\"><a href=\"#\">" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . "</a></li>";
				 
			 }
			 
		 }
 
		 if ( $paged < $pages && $showitems < $pages ) echo "<li><a href=\"" . get_pagenum_link( $paged + 1 ) . "\">" . __('Next', 'sellegance') . " &rarr;</a></li>";
		 
		 if ( $paged < $pages-1 &&  $paged + $range - 1 < $pages && $showitems < $pages ) echo "<li><a href='" . get_pagenum_link( $pages ) . "'>" . __('Last', 'sellegance') . " &rArr;</a></li>";
		 
		 echo "</ul></div>\n";
		 
	 }
	 
}


/**
 * Title         : Aqua Resizer
 * Description   : Resizes WordPress images on the fly
 * Version       : 1.2.0
 * Author        : Syamil MJ
 * Author URI    : http://aquagraphite.com
 * License       : WTFPL - http://sam.zoy.org/wtfpl/
 * Documentation : https://github.com/sy4mil/Aqua-Resizer/
 *
 * @param string  $url      - (required) must be uploaded using wp media uploader
 * @param int     $width    - (required)
 * @param int     $height   - (optional)
 * @param bool    $crop     - (optional) default to soft crop
 * @param bool    $single   - (optional) returns an array if false
 * @param bool    $upscale  - (optional) resizes smaller images
 * @uses  wp_upload_dir()
 * @uses  image_resize_dimensions()
 * @uses  wp_get_image_editor()
 *
 * @return str|array
 */

if(!class_exists('Aq_Resize')) {
    class Aq_Resize
    {
        /**
         * The singleton instance
         */
        static private $instance = null;

        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        /**
         * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Run, forest.
         */
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
            // Validate inputs.
            if ( ! $url || ( ! $width && ! $height ) ) return false;

            // Caipt'n, ready to hook.
            if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

            // Define upload path & dir.
            $upload_info = wp_upload_dir();
            $upload_dir = $upload_info['basedir'];
            $upload_url = $upload_info['baseurl'];
            
            $http_prefix = "http://";
            $https_prefix = "https://";
            
            /* if the $url scheme differs from $upload_url scheme, make them match 
               if the schemes differe, images don't show up. */
            if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
                $upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
            }
            elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
                $upload_url = str_replace($https_prefix,$http_prefix,$upload_url);      
            }
            

            // Check if $img_url is local.
            if ( false === strpos( $url, $upload_url ) ) return false;

            // Define path of image.
            $rel_path = str_replace( $upload_url, '', $url );
            $img_path = $upload_dir . $rel_path;

            // Check if img path exists, and is an image indeed.
            if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

            // Get image info.
            $info = pathinfo( $img_path );
            $ext = $info['extension'];
            list( $orig_w, $orig_h ) = getimagesize( $img_path );

            // Get image size after cropping.
            $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
            $dst_w = $dims[4];
            $dst_h = $dims[5];

            // Return the original image only if it exactly fits the needed measures.
            if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                $img_url = $url;
                $dst_w = $orig_w;
                $dst_h = $orig_h;
            } else {
                // Use this to check if cropped image already exists, so we can return that instead.
                $suffix = "{$dst_w}x{$dst_h}";
                $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                    // Can't resize, so return false saying that the action to do could not be processed as planned.
                    return false;
                }
                // Else check if cache exists.
                elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                    $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                }
                // Else, we resize the image and return the new resized image url.
                else {

                    $editor = wp_get_image_editor( $img_path );

                    if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
                        return false;

                    $resized_file = $editor->save();

                    if ( ! is_wp_error( $resized_file ) ) {
                        $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                        $img_url = $upload_url . $resized_rel_path;
                    } else {
                        return false;
                    }

                }
            }

            // Okay, leave the ship.
            if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

            // Return the output.
            if ( $single ) {
                // str return.
                $image = $img_url;
            } else {
                // array return.
                $image = array (
                    0 => $img_url,
                    1 => $dst_w,
                    2 => $dst_h
                );
            }

            return $image;
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
        }
    }
}

if(!function_exists('et_resize')) {

    /**
     * This is just a tiny wrapper function for the class above so that there is no
     * need to change any code in your own WP themes. Usage is still the same :)
     */
    function et_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
        $aq_resize = Aq_Resize::getInstance();
        return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
    }
}

/*--------------------------------------------------------
	WooCommerce Custom Tab Function
--------------------------------------------------------*/

global $sellegance_opt;
if($sellegance_opt['custom_tab'] == '1' ) {

	add_filter( 'woocommerce_product_tabs', 'sellegance_product_tab' );
	function sellegance_product_tab( $tabs ) {
		global $sellegance_opt;	
		
		$tabs['test_tab'] = array(
			'title' 	=> __( $sellegance_opt['custom_tab_title'], 'woocommerce' ),
			'priority' 	=> 50,
			'callback' 	=> 'sellegance_product_tab_content'
		);
		return $tabs;
	}
	function sellegance_product_tab_content() {
		global $sellegance_opt;
	 
		echo $sellegance_opt['custom_tab_content'];	
	}
}

/**
 * Edit $wp_query before it is being run.
 */

function et_pre_get_posts_action( $query ) {
	global $sellegance_opt;

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    // Stop if searching from admin
    if($action == 'woocommerce_json_search_products') {
        return;
    }

    if($action == 'woocommerce_json_search_products_and_variations') {
        return;
    }
    // Include posts and pages in ajax search.
    if(defined('DOING_AJAX') && DOING_AJAX && !empty($query->query_vars['s']) && $sellegance_opt['global_search']==1) {
        $query->query_vars['post_type'] = array( $query->query_vars['post_type'], 'post', 'page','portfolio' );
        $query->query_vars['meta_query'] = new WP_Meta_Query( array( 'relation' => 'OR', $query->query_vars['meta_query'] ) );
    }
}

add_action('pre_get_posts', 'et_pre_get_posts_action');

?>
