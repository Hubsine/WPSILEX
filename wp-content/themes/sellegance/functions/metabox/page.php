<?php

$prefix = 'tdl_page_';

global $pmeta_boxes;

$pmeta_boxes = array();


$pmeta_boxes[] = array(
	'id' => 'pageoptions',
	'title' => __('Page Options', 'sellegance'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
        array(
            'name' => __('Sub Title', 'sellegance'),
			'id' => $prefix . 'caption',
			'desc' => __('Set your Page Sub Title to be displayed beside the Main Page Title (Excluding the homepage)', 'sellegance'),
			'type'  => 'text',
			'std' => '',
            'size' => '100'
		),
		
        array(
            'name' => __('Hide Title Area', 'sellegance'),
			'id' => $prefix . 'hidetitle',
			'type' => 'checkbox',
			'desc' => __('Check to Hide the Title Area from the Page', 'sellegance'),
			'std' => 0
		)		
      
    ),

);


$pmeta_boxes[] = array(
	'id' => 'sidebarsettings',
	'title' => __('Sidebar Settings', 'sellegance'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		

        array(
            'name' => __('Sidebar Position', 'sellegance'),
			'id' => $prefix . 'sidebar_position',
			'type' => 'select',
			'options' => array(
				'right' => __('Right Sidebar', 'sellegance'),
				'left' => __('Left Sidebar', 'sellegance'),
			),
			'std'  => array( 'right' ),
			'desc' => __('Select the position of the Sidebar on this page.', 'sellegance'),
		)
        
    ),
	'only_on'    => array(
		'template' => array( 'page-sidebar.php' )
	)
);



$pmeta_boxes[] = array(
	'id' => 'pageportfolio',
	'title' => __('Portfolio Settings', 'sellegance'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
        array(
			'name' => __('Portfolio Layout', 'sellegance'),
			'id'   => $prefix . 'portfolio',
			'type' => 'select',
			'options' => array(
				'2' => __('2 Column', 'sellegance'),
				'3' => __('3 Column', 'sellegance'),
				'4' => __('4 Column', 'sellegance'),
			),
			'std'  => array( '3' ),
			'desc' => __('Select the Portfolio Layout Type', 'sellegance'),
		),
        array(
			'name' => __('Height', 'sellegance'),
			'id' => $prefix . 'height',
			'desc' => __('The Portfolio Thumbnails Height (in px). Just enter a number. Default:400', 'sellegance'),
			'type'  => 'text',
			'std' => '400',
            'size' => '10'
		),			
        array(
			'name' => __('Portfolio Categories', 'sellegance'),
			'id'   => $prefix . 'port_cats',
			'type'    => 'taxonomy',
			'options' => array(
				'taxonomy' => 'port-group',
				'type' => 'checkbox_list'
			),
			'desc' => __('Choose the Categories you want to display on this Portfolio Page. Do not check anything if you want to show items from all categories', 'sellegance'),
		)
        
    ),
	'only_on'    => array(
		'template' => array( 'template-portfolio.php' )
	)
);


$pmeta_boxes[] = array(
	'id' => 'pageportfolio',
	'title' => __('Portfolio Settings', 'sellegance'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
        array(
			'name' => __('Portfolio Layout', 'sellegance'),
			'id'   => $prefix . 'portfolio',
			'type' => 'select',
			'options' => array(
				'2' => __('2 Column', 'sellegance'),
				'3' => __('3 Column', 'sellegance'),
				'4' => __('4 Column', 'sellegance'),
			),
			'std'  => array( '3' ),
			'desc' => __('Select the Portfolio Layout Type', 'sellegance'),
		),
        array(
			'name' => __('Height', 'sellegance'),
			'id' => $prefix . 'height',
			'desc' => __('The Portfolio Thumbnails Height (in px). Just enter a number. Default:400', 'sellegance'),
			'type'  => 'text',
			'std' => '400',
            'size' => '10'
		),		
        array(
            'name' => __('No. of Items', 'sellegance'),'No. of Items',
			'id' => $prefix . 'portfolio_itemcount',
			'desc' => __('Enter the No. of Items you want to show on this Portfolio Items Page. Enter a Number only. 0 - display all portfolio posts in page', 'sellegance'),
			'type'  => 'text',
			'std' => '0',
            'size' => '2'
		),
		
        array(
			'name' => __('Portfolio Categories', 'sellegance'),
			'id'   => $prefix . 'port_cats',
			'type'    => 'taxonomy',
			'options' => array(
				'taxonomy' => 'port-group',
				'type' => 'checkbox_list'
			),
			'desc' => __('Choose the Categories you want to display on this Portfolio Page. Do not check anything if you want to show items from all categories', 'sellegance'),
		)
        
    ),
	'only_on'    => array(
		'template' => array( 'template-portfolio-nofilter.php' )
	)
);



$pmeta_boxes[] = array(
	'id' => 'slidersettings',
	'title' => __('Slider Settings', 'sellegance'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

		array(
            'name' => __('Slider post type', 'sellegance'),
			'id' => $prefix . 'hdr_ioslider',
			'type' => 'heading',
			//'desc' => __('To use the Revolution Slider go to Appearance > Widgets and add a slider to Revolution Slider widget', 'sellegance'),
			//'std' => 0
		),
		

		array(
            'name' => __('Enable Slider post type', 'sellegance'),
			'id' => $prefix . 'enable_ioslider',
			'type' => 'checkbox',
			'desc' => __('Check to use the Slider Post type. <code>Leave unchecked to use Revolution Slider (enable on Appearance > Widgets)</code>.', 'sellegance'),
			'std' => 0
		),
		array(
            'name' => __('divider', 'sellegance'),
			'id' => $prefix . 'divider1',
			'type' => 'divider',
			//'desc' => __('Leave unchecked to use Revolution Slider.'),
			//'std' => 0
		),
        array(
			'name' => __( 'Slider Category', 'sellegance' ),
			'id'   => $prefix . 'lslider_category',
			'type'    => 'taxonomy',
			'options' => array(
				'taxonomy' => 'slider-group',
				'type' => 'select'
			),
			'desc' => __( 'Choose a Category for the Slider', 'sellegance' )
		),

        array(
            'name' => __( 'Slide Order', 'sellegance' ),
			'id' => $prefix . 'lslider_order',
            'type' => 'select',
			'options' => array(
				'ASC' => 'ASC',
				'DESC' => 'DESC'
			),
			'std'  => array( 'DESC' ),
			'desc' => __( 'Select the Slide Order. (Works on all Sliders except Layer Slider)', 'sellegance' )
		),
        array(
            'name' => __( 'Slide Order by', 'sellegance' ),
			'id' => $prefix . 'lslider_orderby',
            'type' => 'select',
			'options' => array(
				'ID' => 'ID',
				'title' => __( 'Title', 'sellegance' ),
				'date' => __( 'Date', 'sellegance' ),
				'rand' => __( 'Random', 'sellegance' ),
				'menu_order' => __( 'Menu Order', 'sellegance' )
			),
			'std'  => array( 'date' ),
			'desc' => __( 'Select the parameter by which you want the Slide Order. (Works on all Sliders except Layer Slider)', 'sellegance' )
		),		

		
		array(
            'name' => __('Slideshow', 'sellegance'),
			'id' => $prefix . 'slideshow',
			'type' => 'checkbox',
			'desc' => __('Animate slider automatically', 'sellegance'),
			'std' => 0
		),
		
        array(
            'name' => __('Slideshow Speed', 'sellegance'),
			'id' => $prefix . 'slideshowSpeed',
			'desc' => __('Set the speed of the slideshow cycling, in milliseconds', 'sellegance'),
			'type'  => 'text',
			'std' => '5000',
            'size' => '6'
		),	

       
    ),
	'only_on'    => array(
		'template' => array( 'template-home-fullslider.php' )
	)
);


$pmeta_boxes[] = array(
	'id' => 'contactsettings',
	'title' => __( 'Contact Page Settings', 'sellegance' ),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
        array(
            'name' => __( 'Show Map', 'sellegance' ),
			'id' => $prefix . 'contact_map',
			'type' => 'checkbox',
			'desc' => __( 'Check to show the Map on the Contact Page', 'sellegance' ),
			'std' => 1
		),
		
		
        array(
            'name' => __( 'Full-Width', 'sellegance' ),
			'id' => $prefix . 'fullwidth_map',
			'type' => 'checkbox',
			'desc' => __( 'Check to show the Map Full-width', 'sellegance' ),
			'std' => 0
		),
		
        array(
            'name' => __( 'Top padding', 'sellegance' ),
			'id' => $prefix . 'toppadding_map',
			'type' => 'checkbox',
			'desc' => __( 'Check to enable Top Padding for Map', 'sellegance' ),
			'std' => 0
		),
		
        array(
            'name' => __( 'Inner Shadows', 'sellegance' ),
			'id' => $prefix . 'shadows_map',
			'type' => 'checkbox',
			'desc' => __( 'Check to enable Inner Shadows for map', 'sellegance' ),
			'std' => 0
		),				
		
				
        array(
            'name' => __( 'Map Height', 'sellegance' ),
			'id' => $prefix . 'contact_mheight',
			'desc' => __( 'Enter the Height for the Map. Enter a Number', 'sellegance' ),
			'type'  => 'text',
			'std' => '400',
            'size' => '5'
		),
        array(
            'name' => __( 'Latitude', 'sellegance' ),
			'id' => $prefix . 'contact_latitude',
			'desc' => __( 'Enter the Latitude Value for the Map. Enter a Float Number', 'sellegance' ),
			'type'  => 'text',
			'std' => '',
            'size' => '20'
		),
        array(
            'name' => __( 'Longitude', 'sellegance' ),
			'id' => $prefix . 'contact_longitude',
			'desc' => __( 'Enter the Longitude Value for the Map. Enter a Float Number', 'sellegance' ),
			'type'  => 'text',
			'std' => '',
            'size' => '20'
		),
        array(
            'name' => __( 'Address', 'sellegance' ),
			'id' => $prefix . 'contact_address',
			'desc' => __( 'Enter the Address in 4-5 Words for the Map. Enter Text. If you use "Address" Option, then "Latitude" and "Longitude" Values will not be considered', 'sellegance' ),
			'type'  => 'text',
			'std' => '',
            'size' => '50'
		),
        array(
			'name' => __( 'Map Popup', 'sellegance' ),
			'desc' => __( 'Content to show in the Map Popup. HTML Supported', 'sellegance' ),
			'id'   => $prefix . 'contact_html',
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '3'
		),
        array(
            'name' => __( 'Zoom', 'sellegance' ),
			'id' => $prefix . 'contact_zoom',
            'type' => 'select',
			'options' => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
				10 => 10,
				11 => 11,
				12 => 12,
				13 => 13,
				14 => 14
			),
			'std'  => array( 12 ),
			'desc' => __( 'Select the amount of Zoom for the Map', 'sellegance' )
		),
        array(
            'name' => __( 'Map Type', 'sellegance' ),
			'id' => $prefix . 'contact_maptype',
            'type' => 'select',
			'options' => array(
				'HYBRID' => 'HYBRID',
				'ROADMAP' => 'ROADMAP',
				'SATELLITE' => 'SATELLITE',
				'TERRAIN' => 'TERRAIN'
			),
			'std'  => array( 'ROADMAP' ),
			'desc' => __( 'Select the Map Type', 'sellegance' )
		),
        array(
            'name' => __( 'Scrollwheel', 'sellegance' ),
			'id' => $prefix . 'contact_scrollwheel',
			'type' => 'checkbox',
			'desc' => __( 'Check to use Scrollwheel on the Map', 'sellegance' ),
			'std' => 0
		),
        array(
            'name' => __( 'Pan Control', 'sellegance' ),
			'id' => $prefix . 'contact_pancontrol',
			'type' => 'checkbox',
			'desc' => __( 'Check to use Pan Control on the Map', 'sellegance' ),
			'std' => 1
		),
        array(
            'name' => __( 'Zoom Control', 'sellegance' ),
			'id' => $prefix . 'contact_zoomcontrol',
			'type' => 'checkbox',
			'desc' => __( 'Check to use Zoom Control on the Map', 'sellegance' ),
			'std' => 1
		),
        array(
            'name' => __( 'MapType Control', 'sellegance' ),
			'id' => $prefix . 'contact_maptypecontrol',
			'type' => 'checkbox',
			'desc' => __( 'Check to use MapType Control on the Map', 'sellegance' ),
			'std' => 1
		),
        array(
            'name' => __( 'Scale Control', 'sellegance' ),
			'id' => $prefix . 'contact_scalecontrol',
			'type' => 'checkbox',
			'desc' => __( 'Check to use Scale Control on the Map', 'sellegance' ),
			'std' => 0
		),
        array(
            'name' => __( 'Street View Control', 'sellegance' ),
			'id' => $prefix . 'contact_streetviewcontrol',
			'type' => 'checkbox',
			'desc' => __( 'Check to use Street View Control on the Map', 'sellegance' ),
			'std' => 0
		),
        array(
            'name' => __( 'Overview Map Control', 'sellegance' ),
			'id' => $prefix . 'contact_overviewmapcontrol',
			'type' => 'checkbox',
			'desc' => __( 'Check to use Overview Map Control on the Map', 'sellegance' ),
			'std' => 0
		)
        
    ),
	'only_on'    => array(
		'template' => array( 'template-contact.php' )
	)
);



function tdl_page_register_meta_boxes() {

    global $pmeta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) ) {
		foreach ( $pmeta_boxes as $pmeta_box ) {
			if ( isset( $pmeta_box['only_on'] ) && ! rw_maybe_include( $pmeta_box['only_on'] ) ) {
				continue;
			}

			new RW_Meta_Box( $pmeta_box );
		}
	}

}

add_action( 'admin_init', 'tdl_page_register_meta_boxes' );


function rw_maybe_include( $conditions ) {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post = get_post( $post_id );

	foreach ( $conditions as $cond => $v ) {
		// Catch non-arrays too
		if ( ! is_array( $v ) ) {
			$v = array( $v );
		}

		switch ( $cond ) {
			case 'id':
				if ( in_array( $post_id, $v ) ) {
					return true;
				}
			break;
			case 'parent':
				$post_parent = $post->post_parent;
				if ( in_array( $post_parent, $v ) ) {
					return true;
				}
			break;
			case 'slug':
				$post_slug = $post->post_name;
				if ( in_array( $post_slug, $v ) ) {
					return true;
				}
			break;
			case 'template':
				$template = get_post_meta( $post_id, '_wp_page_template', true );
				if ( in_array( $template, $v ) ) {
					return true;
				}
			break;
		}
	}

	// If no condition matched
	return false;
}


?>