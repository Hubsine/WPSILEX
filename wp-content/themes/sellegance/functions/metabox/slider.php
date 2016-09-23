<?php

$prefix = 'tdl_slider_';

global $smeta_boxes;

$smeta_boxes = array();

$smeta_boxes[] = array(
	'id' => 'metabox',
	'title' => __( 'Slide Data', 'sellegance' ),
	'pages' => array( 'slider' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
        array(
			'name' => __( 'Caption', 'sellegance' ),
			'desc' => __( 'Text to be shown as a Caption. HTML not supported.', 'sellegance' ),
			'id'   => $prefix . 'caption',
			'type' => 'textarea',
			'std'  => '',
			'cols' => '40',
			'rows' => '4',
		),
        array(
            'name' => __('Title & Caption Position', 'sellegance'),
			'id' => $prefix . 'caption_position',
			'type' => 'select',
			'options' => array(
				'left' => __('Left', 'sellegance'),
				'right' => __('Right', 'sellegance'),
				'center' => __('Center', 'sellegance'),
			),
			'std'	=> __( 'left', 'sellegance' ),
			'desc' => __('Select Title & Caption Position.', 'sellegance'),
		),		
		
        array(
			'name' => __( 'Title URL', 'sellegance' ),
			'id' => $prefix . 'button_url',
			'desc' => __( 'The Slide\'s Link Address. Include http://', 'sellegance' ),
			'type'  => 'text',
			'std' => 'http://',
            'size' => '60'
		),
        array(
            'name' => __('Header Content Color', 'sellegance'),
			'id' => $prefix . 'slide_style',
			'type' => 'select',
			'options' => array(
				'dark' => __('Dark', 'sellegance'),
				'light' => __('Light', 'sellegance'),
			),
			'std'	=> __( 'Dark', 'sellegance' ),
			'desc' => __('Select header content color. If your image is dark please select Light style.', 'sellegance'),
		),
        
    )
);

function tdl_slider_register_meta_boxes() {

    global $smeta_boxes;
    
	if ( class_exists( 'RW_Meta_Box' ) ) {
	
        foreach ( $smeta_boxes as $smeta_box ) {
			new RW_Meta_Box( $smeta_box );
		}
    
	}

}

add_action( 'admin_init', 'tdl_slider_register_meta_boxes' );

?>