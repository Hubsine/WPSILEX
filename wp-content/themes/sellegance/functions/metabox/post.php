<?php

$prefix = 'tdl_post_';

global $meta_boxes;

$pometa_boxes = array();

$pometa_boxes[] = array(
	'id' => 'sidebarsettings',
	'title' => __('Sidebar Settings', 'sellegance'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		

		array(
            'name' => __('Featured Image/Slider/Video on Single Post Page', 'sellegance'),
			'id' => $prefix . 'featured_image',
			'type' => 'checkbox',
			'desc' => __('Check this to show the featured image, slider or video at the beginning of the post on the single post page.', 'sellegance'),
			'std' => 1
		),
        
    )
);


$pometa_boxes[] = array(
	'id' => 'tdl-post-image',
	'title' => __('Image Settings', 'sellegance'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(	

			
        array(
			'name'  => __('Images', 'sellegance'),
			'desc' => __('Additional Images for your Gallery. Maximum 8 Images.', 'sellegance'),
			'id' => $prefix . 'gallery',
			'type' => 'plupload_image',
			'max_file_uploads' => 8,
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
  
    )
);

$pometa_boxes[] = array(
	'id' => 'tdl-post-video',
	'title' => 'Video Settings',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(	

			

        array(
			'name' => __('Video URL', 'sellegance'),
			'desc' => __('Enter the direct URL to a YouTube or Vimeo video page.', 'sellegance'),
			'id'   => $prefix . 'video',
			'type' => 'textarea',
			'std'  => '',
			'cols' => '40',
			'rows' => '2',
		)
        
    )
);


function tdl_post_register_meta_boxes() {

    global $pometa_boxes;
    
	if ( class_exists( 'RW_Meta_Box' ) ) {
	
        foreach ( $pometa_boxes as $pometa_box ) {
			new RW_Meta_Box( $pometa_box );
		}
    
	}

}

add_action( 'admin_init', 'tdl_post_register_meta_boxes' );

?>