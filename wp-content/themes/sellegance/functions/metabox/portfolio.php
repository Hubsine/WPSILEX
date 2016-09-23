<?php

$prefix = 'tdl_port_';

global $portmeta_boxes;

$portmeta_boxes = array();


$portmeta_boxes[] = array(
	'id' => 'portfoliodetails',
	'title' => __('Details', 'sellegance'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
            'name' => __('Sub Title', 'sellegance'),
			'id' => $prefix . 'caption',
			'desc' => __('Set the Portfolio item subtitle. It will appear only on the porfolio details page.)', 'sellegance'),
			'type'  => 'text',
			'std' => '',
            'size' => '100'
		),
			
        array(
			'name' => __('Item Type', 'sellegance'),
			'id'   => $prefix . 'type',
			'type' => 'select',
			'options' => array(
				'pic' => __('Picture', 'sellegance'),
				'gallery' => __('Gallery', 'sellegance'),
				'video' => __('Video', 'sellegance')
			),
			'std'  => array( 'pic' ),
			'desc' => __('Select the Portfolio Item Type.', 'sellegance'),
		),

        array(
			'name' => __('Project Date', 'sellegance'),
			'id' => $prefix . 'date',
			'desc' => __('When the project was done?', 'sellegance'),
			'type'  => 'text',
			'std' => '',
            'size' => '50'
		),
        array(
			'name' => __('Client', 'sellegance'),
			'id' => $prefix . 'client',
			'desc' => __('For whom was the project completed', 'sellegance'),
			'type'  => 'text',
			'std' => '',
            'size' => '50'
		),
        array(
			'name' => __('Project URL', 'sellegance'),
			'id' => $prefix . 'url',
			'desc' => __('The Project\'s Link Address. Include http://', 'sellegance'),
			'type'  => 'text',
			'std' => 'http://',
            'size' => '100'
		)
        
    )
);


$portmeta_boxes[] = array(
	'id' => 'tdl-port-image',
	'title' => __('Image Settings', 'sellegance'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(	

			
        array(
			'name'  => __('Images', 'sellegance'),
			'desc' => __('Additional Images for your Gallery. Maximum 8 Images.', 'sellegance'),
			'id' => $prefix . 'gallery',
			'type' => 'plupload_image',
			'max_file_uploads' => 12,
		),

		array(
            'name' => __('Show as thumbnails', 'sellegance'),
			'id' => $prefix . 'thumbnails',
			'type' => 'checkbox',
			'desc' => __('Show gallery as thumbnails instead of Slideshow (This disables the options below)', 'sellegance'),
			'std' => 1
		),

		array(
            'name' => __('Divider', 'sellegance'),
			'type' => 'divider'
		),
		
		array(
            'name' => __('Auto slide', 'sellegance'),
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

$portmeta_boxes[] = array(
	'id' => 'tdl-port-video',
	'title' => __('Video Settings', 'sellegance'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(	

			

        array(
			'name' => __('Video URL', 'sellegance'),
			'desc' => __('Enter the direct URL from YouTube or Vimeo.', 'sellegance'),
			'id'   => $prefix . 'video',
			'type' => 'textarea',
			'std'  => '',
			'cols' => '40',
			'rows' => '2',
		)
        
    )
);


function tdl_port_register_meta_boxes() {

    global $portmeta_boxes;
    
	if ( class_exists( 'RW_Meta_Box' ) ) {
	
        foreach ( $portmeta_boxes as $portmeta_box ) {
			new RW_Meta_Box( $portmeta_box );
		}
    
	}

}

add_action( 'admin_init', 'tdl_port_register_meta_boxes' );

?>