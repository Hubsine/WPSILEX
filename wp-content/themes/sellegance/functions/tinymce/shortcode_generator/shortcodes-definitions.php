<?php

#-----------------------------------------------------------------
# Columns
#-----------------------------------------------------------------


$tdl_shortcodes['header_1'] = array( 
	'type'=>'heading', 
	'title'=>__('Columns', 'sellegance')
);

//Container
$tdl_shortcodes['container'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Container', 'sellegance' ), 
	'attr'=>array()
);

//Full-width
$tdl_shortcodes['full_width'] = array( 
	'type'=>'simple', 
	'title'=>__('Full-width (1)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'checkbox', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'checkbox', 'title'=>__('Centered Text','sellegance')),
		'bg_color'=>array(
			'type'=>'text', 
			'title'=>'Background Color',
			'desc' => __('Sets the background color. Default: #ffffff', 'sellegance'),
		),		
		
		'image'=>array(
			'type'=>'custom',
			'title'  => __('Background Image','sellegance'),
			'desc' => __('Sets the an image background for your banner (URL). Set it to none for a transparent background.', 'sellegance'),
		),

		
		'h_padding'=>array(
			'type'=>'text', 
			'title'=>'Horizontal Padding',
			'std' => '0px',
			'desc' => __('Sets the horizontal padding (size in px or percentage). Default: 0px', 'sellegance'),
		),
		
		'v_padding'=>array(
			'type'=>'text', 
			'title'=>'Vertical Padding',
			'std' => '0px',
			'desc' => __('Sets the vertical padding (size in px or percentage). Default: 0px', 'sellegance'),
		)		
		
	)
);

//Half
$tdl_shortcodes['one_half'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Half (1/2)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);


//Thirds
$tdl_shortcodes['one_third'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Third Column (1/3)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);

$tdl_shortcodes['two_thirds'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Two Thirds Column (2/3)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);


//Fourths
$tdl_shortcodes['one_fourth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Fourth Column (1/4)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);

$tdl_shortcodes['three_fourths'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Three Fourths Column (3/4)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);

//Fifth
$tdl_shortcodes['one_fifth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Fifth Column (1/5)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);

$tdl_shortcodes['two_fifth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Two Fifth Column (2/5)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);

$tdl_shortcodes['three_fifth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Three Fifth Column (3/5)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);

$tdl_shortcodes['four_fifth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Four Fifth Column (4/5)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);


//Sixths
$tdl_shortcodes['one_sixth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('One Sixth Column (1/6)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);


$tdl_shortcodes['five_sixth'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Five Sixth Column (5/6)', 'sellegance' ), 
	'attr'=>array( 
		'boxed'=>array('type'=>'custom', 'title'=>__('Boxed Column','sellegance')),
		'centered_text'=>array('type'=>'custom', 'title'=>__('Centered Text','sellegance')),
		'last'=>array( 'type'=>'custom', 'title'=>__('Last Column','sellegance'), 'desc' => __('Check this for the last column in a row. i.e. when the columns add up to 1.', 'sellegance'))
	)
);




#-----------------------------------------------------------------
# Elements 
#-----------------------------------------------------------------

$tdl_shortcodes['header_6'] = array( 
	'type'=>'heading', 
	'title'=>__('Elements', 'sellegance' )
);


//Code
$tdl_shortcodes['code'] = array( 
	'type'=>'simple', 
	'title'=>__('Code', 'sellegance' ), 
	'attr'=>array()
);

//Banner
$tdl_shortcodes['banner'] = array( 
	'type'=>'regular', 
	'title'=>__('Banner', 'sellegance'), 
	'attr'=>array(
	
		'style'=>array(
				'type'=>'select', 
				'title'=> __('Content Color Style', 'sellegance'), 
				'desc' => __('Select Color of Content. Default: Dark', 'sellegance'),
				'values'=>array(
					'dark'=>'dark',
					'light'=>'light',
				),
			),
		
		'align'=>array(
				'type'=>'select', 
				'title'=> __('Title Align', 'sellegance'), 
				'desc' => __('Select align for titles.', 'sellegance'),
				'values'=>array(
					'center'=>'center',
					'left'=>'left',				
					'right'=>'right',
				),
			),
				
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
			
		),
		'subtitle'=>array(
			'type'=>'text', 
			'title'=>__('Sub Title', 'sellegance')
		),		
		'url'=>array(
			'type'=>'text', 
			'title'=>'Link URL'
		),
		
		'borders'=>array(
			'type'=>'checkbox',
			'std' => 'true',
			'title'=>__('Show borders?', 'sellegance')
		),
		
		'divider'=>array(
			'type'=>'checkbox',
			'std' => 'true',
			'title'=>__('Show divider?', 'sellegance')
		),		
		
		'bg_color'=>array(
			'type'=>'text', 
			'title'=>'Background Color',
			'desc' => __('Sets the background color. Default: #ffffff', 'sellegance'),
		),		
		
		'image'=>array(
			'type'=>'custom',
			'title'  => __('Background Image','sellegance'),
			'desc' => __('Sets the an image background for your banner (URL). Set it to none for a transparent background.', 'sellegance'),
		),

		
		'h_padding'=>array(
			'type'=>'text', 
			'title'=>'Horizontal Padding',
			'std' => '20px',
			'desc' => __('Sets the horizontal padding (size in px or percentage). Default: 20px', 'sellegance'),
		),
		
		'v_padding'=>array(
			'type'=>'text', 
			'title'=>'Vertical Padding',
			'std' => '20px',
			'desc' => __('Sets the vertical padding (size in px or percentage). Default: 20px', 'sellegance'),
		),	
		
	) 
);

//Heading
$tdl_shortcodes['heading'] = array( 
	'type'=>'simple', 
	'title'=>__('Heading', 'sellegance' ), 
	'attr'=>array( 
		'heading_size'=>array(
				'type'=>'select', 
				'title'=> __('Heading Size', 'sellegance'), 
				'values'=>array(
					'H1'=>'H1',
					'H2'=>'H2',				
					'H3'=>'H3',
					'H4'=>'H4',
				),
			),
			
		'heading_align'=>array(
				'type'=>'select', 
				'title'=> __('Heading Align', 'sellegance'), 
				'values'=>array(
					'left'=>'left',
					'center'=>'center',				
					'right'=>'right',
				),
			),
			
		'heading_style'=>array(
				'type'=>'select', 
				'title'=> __('Heading Style', 'sellegance'), 
				'values'=>array(
					'none'=>'none',
					'border_bottom'=>'border_bottom',
					'bold_title'=>'bold_title',				
				),
			),						
	
		'heading_weight'=>array(
		'type'=>'checkbox',
		'title'=>__('Bold Heading Weight?', 'sellegance')
		), 
		
		'v_padding'=>array(
			'type'=>'text', 
			'title'=>'Vertical Padding',
			'std' => '15px',
			'desc' => __('Sets the vertical padding (size in px or percentage). Default: 15px', 'sellegance'),
		),
	)
);

//Blockquote
$tdl_shortcodes['blockquote'] = array( 
	'type'=>'simple', 
	'title'=>__('Blockquote', 'sellegance' ), 
	'attr'=>array( 
			
		'align' => array(
			'type' => 'select',
			'title' => __('Align', 'sellegance'),
			'desc' => __('Select the Blockquote Alignment', 'sellegance'),
			'values' => array(
				'' => 'none',
				'left' => 'left',
				'right' => 'right'
			)
		),			
			
		'style'=>array(
				'type'=>'select', 
				'title'=> __('Blockquote Style', 'sellegance'), 
				'desc' => __('Select the Blockquote Style', 'sellegance'),
				'values'=>array(
					''=>'normal',
					'quote'=>'quote',			
				),
			),						

		'author'=>array(
			'type'=>'text', 
			'title' => __('Author', 'sellegance'),
			'desc' => __('The Author of the Blockquote. Optional', 'sellegance'),
		),
	)
);

//Divider
$tdl_shortcodes['divider'] = array( 
	'type'=>'regular', 
	'title'=>__('Divider', 'sellegance' ), 
	'attr'=>array( 
		'line'=>array(
		'type'=>'checkbox',
		'title'=>__('Show line?', 'sellegance')
		),
		
		'top_space'=>array(
			'type'=>'text', 
			'title'=>'Top Space',
			'std' => '15px',
			'desc' => __('Sets the top margin (size in px).', 'sellegance'),
		),
		'bottom_space'=>array(
			'type'=>'text', 
			'title'=>'Bottom Space',
			'std' => '15px',
			'desc' => __('Sets the bottom margin (size in px).', 'sellegance'),
		),

	)
);

//Button
$tdl_shortcodes['button'] = array( 
	'type'=>'radios', 
	'title'=>__('Button', 'sellegance'), 
	'attr'=>array(
		'size'=>array(
			'type'=>'radio', 
			'title'=>__('Size', 'sellegance'), 
			'opt'=>array(
				'btn-sm'=>'Small',
				'btn-me'=>'Medium',
				'btn-lg'=>'Large'
			)
		),
		'url'=>array(
			'type'=>'text', 
			'title'=>'Link URL'
		),
		'text'=>array(
			'type'=>'text', 
			'title'=>__('Text', 'sellegance')
		)
	) 
);


//Icon
$tdl_shortcodes['icon'] = array( 
	'type'=>'regular', 
	'title'=>__('Icon', 'sellegance'), 
	'attr'=>array(
		'size'=>array(
			'type'=>'radio', 
			'title'=>__('Icon Size', 'sellegance'), 
			'desc' => __('Tiny is recommended to be used inline with regular text. <br/> Small is recommended to be used inline right before heading text. <br> Large is recommended to be used at the top of columns.', 'sellegance'),
			'opt'=>array(
				'fa-1x'=>'1x',
				'fa-2x'=>'2x',
				'fa-3x'=>'3x',
				'fa-4x'=>'4x',
				'fa-5x'=>'5x',
			)
		),
		
		'style'=>array(
				'type'=>'select', 
				'title'=> __('Icon Style', 'sellegance'), 
				'values'=>array(
					'style1'=>'style1',
					'style2'=>'style2',
					'style3'=>'style3',
					'style4'=>'style4',				
				),
			),
			
		'url'=>array(
			'type'=>'text', 
			'title'=>'Link URL'
		),			
					
		'icons' => array(
			'type'=>'icons', 
			'title'=>'Icon', 
			'values'=> array(
				 'fa-glass'                => 'fa-glass',
				 'fa-music'                => 'fa-music',
				 'fa-search'               => 'fa-search',
				 'fa-envelope-o'           => 'fa-envelope-o',
				 'fa-heart'                => 'fa-heart',
				 'fa-star'                 => 'fa-star',
				 'fa-star-o'               => 'fa-star-o',
				 'fa-user'                 => 'fa-user',
				 'fa-film'                 => 'fa-film',
				 'fa-th-large'             => 'fa-th-large',
				 'fa-th'                   => 'fa-th',
				 'fa-th-list'              => 'fa-th-list',
				 'fa-check'                => 'fa-check',
				 'fa-times'                => 'fa-times',
				 'fa-search-plus'          => 'fa-search-plus',
				 'fa-search-minus'         => 'fa-search-minus',
				 'fa-power-off'            => 'fa-power-off',
				 'fa-signal'               => 'fa-signal',
				 'fa-gear'                 => 'fa-gear',
				 'fa-cog'                  => 'fa-cog',
				 'fa-trash-o'              => 'fa-trash-o',
				 'fa-home'                 => 'fa-home',
				 'fa-file-o'               => 'fa-file-o',
				 'fa-clock-o'              => 'fa-clock-o',
				 'fa-road'                 => 'fa-road',
				 'fa-download'             => 'fa-download',
				 'fa-arrow-circle-o-down'  => 'fa-arrow-circle-o-down',
				 'fa-arrow-circle-o-up'    => 'fa-arrow-circle-o-up',
				 'fa-inbox'                => 'fa-inbox',
				 'fa-play-circle-o'        => 'fa-play-circle-o',
				 'fa-rotate-right'         => 'fa-rotate-right',
				 'fa-repeat'               => 'fa-repeat',
				 'fa-refresh'              => 'fa-refresh',
				 'fa-list-alt'             => 'fa-list-alt',
				 'fa-lock'                 => 'fa-lock',
				 'fa-flag'                 => 'fa-flag',
				 'fa-headphones'           => 'fa-headphones',
				 'fa-volume-off'           => 'fa-volume-off',
				 'fa-volume-down'          => 'fa-volume-down',
				 'fa-volume-up'            => 'fa-volume-up',
				 'fa-qrcode'               => 'fa-qrcode',
				 'fa-barcode'              => 'fa-barcode',
				 'fa-tag'                  => 'fa-tag',
				 'fa-tags'                 => 'fa-tags',
				 'fa-book'                 => 'fa-book',
				 'fa-bookmark'             => 'fa-bookmark',
				 'fa-print'                => 'fa-print',
				 'fa-camera'               => 'fa-camera',
				 'fa-font'                 => 'fa-font',
				 'fa-bold'                 => 'fa-bold',
				 'fa-italic'               => 'fa-italic',
				 'fa-text-height'          => 'fa-text-height',
				 'fa-text-width'           => 'fa-text-width',
				 'fa-align-left'           => 'fa-align-left',
				 'fa-align-center'         => 'fa-align-center',
				 'fa-align-right'          => 'fa-align-right',
				 'fa-align-justify'        => 'fa-align-justify',
				 'fa-list'                 => 'fa-list',
				 'fa-dedent'               => 'fa-dedent',
				 'fa-outdent'              => 'fa-outdent',
				 'fa-indent'               => 'fa-indent',
				 'fa-video-camera'         => 'fa-video-camera',
				 'fa-photo'                => 'fa-photo',
				 'fa-image'                => 'fa-image',
				 'fa-picture-o'            => 'fa-picture-o',
				 'fa-pencil'               => 'fa-pencil',
				 'fa-map-marker'           => 'fa-map-marker',
				 'fa-adjust'               => 'fa-adjust',
				 'fa-tint'                 => 'fa-tint',
				 'fa-edit'                 => 'fa-edit',
				 'fa-pencil-square-o'      => 'fa-pencil-square-o',
				 'fa-share-square-o'       => 'fa-share-square-o',
				 'fa-check-square-o'       => 'fa-check-square-o',
				 'fa-arrows'               => 'fa-arrows',
				 'fa-step-backward'        => 'fa-step-backward',
				 'fa-fast-backward'        => 'fa-fast-backward',
				 'fa-backward'             => 'fa-backward',
				 'fa-play'                 => 'fa-play',
				 'fa-pause'                => 'fa-pause',
				 'fa-stop'                 => 'fa-stop',
				 'fa-forward'              => 'fa-forward',
				 'fa-fast-forward'         => 'fa-fast-forward',
				 'fa-step-forward'         => 'fa-step-forward',
				 'fa-eject'                => 'fa-eject',
				 'fa-chevron-left'         => 'fa-chevron-left',
				 'fa-chevron-right'        => 'fa-chevron-right',
				 'fa-plus-circle'          => 'fa-plus-circle',
				 'fa-minus-circle'         => 'fa-minus-circle',
				 'fa-times-circle'         => 'fa-times-circle',
				 'fa-check-circle'         => 'fa-check-circle',
				 'fa-question-circle'      => 'fa-question-circle',
				 'fa-info-circle'          => 'fa-info-circle',
				 'fa-crosshairs'           => 'fa-crosshairs',
				 'fa-times-circle-o'       => 'fa-times-circle-o',
				 'fa-check-circle-o'       => 'fa-check-circle-o',
				 'fa-ban'                  => 'fa-ban',
				 'fa-arrow-left'           => 'fa-arrow-left',
				 'fa-arrow-right'          => 'fa-arrow-right',
				 'fa-arrow-up'             => 'fa-arrow-up',
				 'fa-arrow-down'           => 'fa-arrow-down',
				 'fa-mail-forward'         => 'fa-mail-forward',
				 'fa-share'                => 'fa-share',
				 'fa-expand'               => 'fa-expand',
				 'fa-compress'             => 'fa-compress',
				 'fa-plus'                 => 'fa-plus',
				 'fa-minus'                => 'fa-minus',
				 'fa-asterisk'             => 'fa-asterisk',
				 'fa-exclamation-circle'   => 'fa-exclamation-circle',
				 'fa-gift'                 => 'fa-gift',
				 'fa-leaf'                 => 'fa-leaf',
				 'fa-fire'                 => 'fa-fire',
				 'fa-eye'                  => 'fa-eye',
				 'fa-eye-slash'            => 'fa-eye-slash',
				 'fa-warning'              => 'fa-warning',
				 'fa-exclamation-triangle' => 'fa-exclamation-triangle',
				 'fa-plane'                => 'fa-plane',
				 'fa-calendar'             => 'fa-calendar',
				 'fa-random'               => 'fa-random',
				 'fa-comment'              => 'fa-comment',
				 'fa-magnet'               => 'fa-magnet',
				 'fa-chevron-up'           => 'fa-chevron-up',
				 'fa-chevron-down'         => 'fa-chevron-down',
				 'fa-retweet'              => 'fa-retweet',
				 'fa-shopping-cart'        => 'fa-shopping-cart',
				 'fa-folder'               => 'fa-folder',
				 'fa-folder-open'          => 'fa-folder-open',
				 'fa-arrows-v'             => 'fa-arrows-v',
				 'fa-arrows-h'             => 'fa-arrows-h',
				 'fa-bar-chart-o'          => 'fa-bar-chart-o',
				 'fa-twitter-square'       => 'fa-twitter-square',
				 'fa-facebook-square'      => 'fa-facebook-square',
				 'fa-camera-retro'         => 'fa-camera-retro',
				 'fa-key'                  => 'fa-key',
				 'fa-gears'                => 'fa-gears',
				 'fa-cogs'                 => 'fa-cogs',
				 'fa-comments'             => 'fa-comments',
				 'fa-thumbs-o-up'          => 'fa-thumbs-o-up',
				 'fa-thumbs-o-down'        => 'fa-thumbs-o-down',
				 'fa-star-half'            => 'fa-star-half',
				 'fa-heart-o'              => 'fa-heart-o',
				 'fa-sign-out'             => 'fa-sign-out',
				 'fa-linkedin-square'      => 'fa-linkedin-square',
				 'fa-thumb-tack'           => 'fa-thumb-tack',
				 'fa-external-link'        => 'fa-external-link',
				 'fa-sign-in'              => 'fa-sign-in',
				 'fa-trophy'               => 'fa-trophy',
				 'fa-github-square'        => 'fa-github-square',
				 'fa-upload'               => 'fa-upload',
				 'fa-lemon-o'              => 'fa-lemon-o',
				 'fa-phone'                => 'fa-phone',
				 'fa-square-o'             => 'fa-square-o',
				 'fa-bookmark-o'           => 'fa-bookmark-o',
				 'fa-phone-square'         => 'fa-phone-square',
				 'fa-twitter'              => 'fa-twitter',
				 'fa-facebook'             => 'fa-facebook',
				 'fa-github'               => 'fa-github',
				 'fa-unlock'               => 'fa-unlock',
				 'fa-credit-card'          => 'fa-credit-card',
				 'fa-rss'                  => 'fa-rss',
				 'fa-hdd-o'                => 'fa-hdd-o',
				 'fa-bullhorn'             => 'fa-bullhorn',
				 'fa-bell'                 => 'fa-bell',
				 'fa-certificate'          => 'fa-certificate',
				 'fa-hand-o-right'         => 'fa-hand-o-right',
				 'fa-hand-o-left'          => 'fa-hand-o-left',
				 'fa-hand-o-up'            => 'fa-hand-o-up',
				 'fa-hand-o-down'          => 'fa-hand-o-down',
				 'fa-arrow-circle-left'    => 'fa-arrow-circle-left',
				 'fa-arrow-circle-right'   => 'fa-arrow-circle-right',
				 'fa-arrow-circle-up'      => 'fa-arrow-circle-up',
				 'fa-arrow-circle-down'    => 'fa-arrow-circle-down',
				 'fa-globe'                => 'fa-globe',
				 'fa-wrench'               => 'fa-wrench',
				 'fa-tasks'                => 'fa-tasks',
				 'fa-filter'               => 'fa-filter',
				 'fa-briefcase'            => 'fa-briefcase',
				 'fa-arrows-alt'           => 'fa-arrows-alt',
				 'fa-group'                => 'fa-group',
				 'fa-users'                => 'fa-users',
				 'fa-chain'                => 'fa-chain',
				 'fa-link'                 => 'fa-link',
				 'fa-cloud'                => 'fa-cloud',
				 'fa-flask'                => 'fa-flask',
				 'fa-cut'                  => 'fa-cut',
				 'fa-scissors'             => 'fa-scissors',
				 'fa-copy'                 => 'fa-copy',
				 'fa-files-o'              => 'fa-files-o',
				 'fa-paperclip'            => 'fa-paperclip',
				 'fa-save'                 => 'fa-save',
				 'fa-floppy-o'             => 'fa-floppy-o',
				 'fa-square'               => 'fa-square',
				 'fa-navicon'              => 'fa-navicon',
				 'fa-reorder'              => 'fa-reorder',
				 'fa-bars'                 => 'fa-bars',
				 'fa-list-ul'              => 'fa-list-ul',
				 'fa-list-ol'              => 'fa-list-ol',
				 'fa-strikethrough'        => 'fa-strikethrough',
				 'fa-underline'            => 'fa-underline',
				 'fa-table'                => 'fa-table',
				 'fa-magic'                => 'fa-magic',
				 'fa-truck'                => 'fa-truck',
				 'fa-pinterest'            => 'fa-pinterest',
				 'fa-pinterest-square'     => 'fa-pinterest-square',
				 'fa-google-plus-square'   => 'fa-google-plus-square',
				 'fa-google-plus'          => 'fa-google-plus',
				 'fa-money'                => 'fa-money',
				 'fa-caret-down'           => 'fa-caret-down',
				 'fa-caret-up'             => 'fa-caret-up',
				 'fa-caret-left'           => 'fa-caret-left',
				 'fa-caret-right'          => 'fa-caret-right',
				 'fa-columns'              => 'fa-columns',
				 'fa-unsorted'             => 'fa-unsorted',
				 'fa-sort'                 => 'fa-sort',
				 'fa-sort-down'            => 'fa-sort-down',
				 'fa-sort-desc'            => 'fa-sort-desc',
				 'fa-sort-up'              => 'fa-sort-up',
				 'fa-sort-asc'             => 'fa-sort-asc',
				 'fa-envelope'             => 'fa-envelope',
				 'fa-linkedin'             => 'fa-linkedin',
				 'fa-rotate-left'          => 'fa-rotate-left',
				 'fa-undo'                 => 'fa-undo',
				 'fa-legal'                => 'fa-legal',
				 'fa-gavel'                => 'fa-gavel',
				 'fa-dashboard'            => 'fa-dashboard',
				 'fa-tachometer'           => 'fa-tachometer',
				 'fa-comment-o'            => 'fa-comment-o',
				 'fa-comments-o'           => 'fa-comments-o',
				 'fa-flash'                => 'fa-flash',
				 'fa-bolt'                 => 'fa-bolt',
				 'fa-sitemap'              => 'fa-sitemap',
				 'fa-umbrella'             => 'fa-umbrella',
				 'fa-paste'                => 'fa-paste',
				 'fa-clipboard'            => 'fa-clipboard',
				 'fa-lightbulb-o'          => 'fa-lightbulb-o',
				 'fa-exchange'             => 'fa-exchange',
				 'fa-cloud-download'       => 'fa-cloud-download',
				 'fa-cloud-upload'         => 'fa-cloud-upload',
				 'fa-user-md'              => 'fa-user-md',
				 'fa-stethoscope'          => 'fa-stethoscope',
				 'fa-suitcase'             => 'fa-suitcase',
				 'fa-bell-o'               => 'fa-bell-o',
				 'fa-coffee'               => 'fa-coffee',
				 'fa-cutlery'              => 'fa-cutlery',
				 'fa-file-text-o'          => 'fa-file-text-o',
				 'fa-building-o'           => 'fa-building-o',
				 'fa-hospital-o'           => 'fa-hospital-o',
				 'fa-ambulance'            => 'fa-ambulance',
				 'fa-medkit'               => 'fa-medkit',
				 'fa-fighter-jet'          => 'fa-fighter-jet',
				 'fa-beer'                 => 'fa-beer',
				 'fa-h-square'             => 'fa-h-square',
				 'fa-plus-square'          => 'fa-plus-square',
				 'fa-angle-double-left'    => 'fa-angle-double-left',
				 'fa-angle-double-right'   => 'fa-angle-double-right',
				 'fa-angle-double-up'      => 'fa-angle-double-up',
				 'fa-angle-double-down'    => 'fa-angle-double-down',
				 'fa-angle-left'           => 'fa-angle-left',
				 'fa-angle-right'          => 'fa-angle-right',
				 'fa-angle-up'             => 'fa-angle-up',
				 'fa-angle-down'           => 'fa-angle-down',
				 'fa-desktop'              => 'fa-desktop',
				 'fa-laptop'               => 'fa-laptop',
				 'fa-tablet'               => 'fa-tablet',
				 'fa-mobile-phone'         => 'fa-mobile-phone',
				 'fa-mobile'               => 'fa-mobile',
				 'fa-circle-o'             => 'fa-circle-o',
				 'fa-quote-left'           => 'fa-quote-left',
				 'fa-quote-right'          => 'fa-quote-right',
				 'fa-spinner'              => 'fa-spinner',
				 'fa-circle'               => 'fa-circle',
				 'fa-mail-reply'           => 'fa-mail-reply',
				 'fa-reply'                => 'fa-reply',
				 'fa-github-alt'           => 'fa-github-alt',
				 'fa-folder-o'             => 'fa-folder-o',
				 'fa-folder-open-o'        => 'fa-folder-open-o',
				 'fa-smile-o'              => 'fa-smile-o',
				 'fa-frown-o'              => 'fa-frown-o',
				 'fa-meh-o'                => 'fa-meh-o',
				 'fa-gamepad'              => 'fa-gamepad',
				 'fa-keyboard-o'           => 'fa-keyboard-o',
				 'fa-flag-o'               => 'fa-flag-o',
				 'fa-flag-checkered'       => 'fa-flag-checkered',
				 'fa-terminal'             => 'fa-terminal',
				 'fa-code'                 => 'fa-code',
				 'fa-mail-reply-all'       => 'fa-mail-reply-all',
				 'fa-reply-all'            => 'fa-reply-all',
				 'fa-star-half-empty'      => 'fa-star-half-empty',
				 'fa-star-half-full'       => 'fa-star-half-full',
				 'fa-star-half-o'          => 'fa-star-half-o',
				 'fa-location-arrow'       => 'fa-location-arrow',
				 'fa-crop'                 => 'fa-crop',
				 'fa-code-fork'            => 'fa-code-fork',
				 'fa-unlink'               => 'fa-unlink',
				 'fa-chain-broken'         => 'fa-chain-broken',
				 'fa-question'             => 'fa-question',
				 'fa-info'                 => 'fa-info',
				 'fa-exclamation'          => 'fa-exclamation',
				 'fa-superscript'          => 'fa-superscript',
				 'fa-subscript'            => 'fa-subscript',
				 'fa-eraser'               => 'fa-eraser',
				 'fa-puzzle-piece'         => 'fa-puzzle-piece',
				 'fa-microphone'           => 'fa-microphone',
				 'fa-microphone-slash'     => 'fa-microphone-slash',
				 'fa-shield'               => 'fa-shield',
				 'fa-calendar-o'           => 'fa-calendar-o',
				 'fa-fire-extinguisher'    => 'fa-fire-extinguisher',
				 'fa-rocket'               => 'fa-rocket',
				 'fa-maxcdn'               => 'fa-maxcdn',
				 'fa-chevron-circle-left'  => 'fa-chevron-circle-left',
				 'fa-chevron-circle-right' => 'fa-chevron-circle-right',
				 'fa-chevron-circle-up'    => 'fa-chevron-circle-up',
				 'fa-chevron-circle-down'  => 'fa-chevron-circle-down',
				 'fa-html5'                => 'fa-html5',
				 'fa-css3'                 => 'fa-css3',
				 'fa-anchor'               => 'fa-anchor',
				 'fa-unlock-alt'           => 'fa-unlock-alt',
				 'fa-bullseye'             => 'fa-bullseye',
				 'fa-ellipsis-h'           => 'fa-ellipsis-h',
				 'fa-ellipsis-v'           => 'fa-ellipsis-v',
				 'fa-rss-square'           => 'fa-rss-square',
				 'fa-play-circle'          => 'fa-play-circle',
				 'fa-ticket'               => 'fa-ticket',
				 'fa-minus-square'         => 'fa-minus-square',
				 'fa-minus-square-o'       => 'fa-minus-square-o',
				 'fa-level-up'             => 'fa-level-up',
				 'fa-level-down'           => 'fa-level-down',
				 'fa-check-square'         => 'fa-check-square',
				 'fa-pencil-square'        => 'fa-pencil-square',
				 'fa-external-link-square' => 'fa-external-link-square',
				 'fa-share-square'         => 'fa-share-square',
				 'fa-compass'              => 'fa-compass',
				 'fa-toggle-down'          => 'fa-toggle-down',
				 'fa-caret-square-o-down'  => 'fa-caret-square-o-down',
				 'fa-toggle-up'            => 'fa-toggle-up',
				 'fa-caret-square-o-up'    => 'fa-caret-square-o-up',
				 'fa-toggle-right'         => 'fa-toggle-right',
				 'fa-caret-square-o-right' => 'fa-caret-square-o-right',
				 'fa-euro'                 => 'fa-euro',
				 'fa-eur'                  => 'fa-eur',
				 'fa-gbp'                  => 'fa-gbp',
				 'fa-dollar'               => 'fa-dollar',
				 'fa-usd'                  => 'fa-usd',
				 'fa-rupee'                => 'fa-rupee',
				 'fa-inr'                  => 'fa-inr',
				 'fa-cny'                  => 'fa-cny',
				 'fa-rmb'                  => 'fa-rmb',
				 'fa-yen'                  => 'fa-yen',
				 'fa-jpy'                  => 'fa-jpy',
				 'fa-ruble'                => 'fa-ruble',
				 'fa-rouble'               => 'fa-rouble',
				 'fa-rub'                  => 'fa-rub',
				 'fa-won'                  => 'fa-won',
				 'fa-krw'                  => 'fa-krw',
				 'fa-bitcoin'              => 'fa-bitcoin',
				 'fa-btc'                  => 'fa-btc',
				 'fa-file'                 => 'fa-file',
				 'fa-file-text'            => 'fa-file-text',
				 'fa-sort-alpha-asc'       => 'fa-sort-alpha-asc',
				 'fa-sort-alpha-desc'      => 'fa-sort-alpha-desc',
				 'fa-sort-amount-asc'      => 'fa-sort-amount-asc',
				 'fa-sort-amount-desc'     => 'fa-sort-amount-desc',
				 'fa-sort-numeric-asc'     => 'fa-sort-numeric-asc',
				 'fa-sort-numeric-desc'    => 'fa-sort-numeric-desc',
				 'fa-thumbs-up'            => 'fa-thumbs-up',
				 'fa-thumbs-down'          => 'fa-thumbs-down',
				 'fa-youtube-square'       => 'fa-youtube-square',
				 'fa-youtube'              => 'fa-youtube',
				 'fa-xing'                 => 'fa-xing',
				 'fa-xing-square'          => 'fa-xing-square',
				 'fa-youtube-play'         => 'fa-youtube-play',
				 'fa-dropbox'              => 'fa-dropbox',
				 'fa-stack-overflow'       => 'fa-stack-overflow',
				 'fa-instagram'            => 'fa-instagram',
				 'fa-flickr'               => 'fa-flickr',
				 'fa-adn'                  => 'fa-adn',
				 'fa-bitbucket'            => 'fa-bitbucket',
				 'fa-bitbucket-square'     => 'fa-bitbucket-square',
				 'fa-tumblr'               => 'fa-tumblr',
				 'fa-tumblr-square'        => 'fa-tumblr-square',
				 'fa-long-arrow-down'      => 'fa-long-arrow-down',
				 'fa-long-arrow-up'        => 'fa-long-arrow-up',
				 'fa-long-arrow-left'      => 'fa-long-arrow-left',
				 'fa-long-arrow-right'     => 'fa-long-arrow-right',
				 'fa-apple'                => 'fa-apple',
				 'fa-windows'              => 'fa-windows',
				 'fa-android'              => 'fa-android',
				 'fa-linux'                => 'fa-linux',
				 'fa-dribbble'             => 'fa-dribbble',
				 'fa-skype'                => 'fa-skype',
				 'fa-foursquare'           => 'fa-foursquare',
				 'fa-trello'               => 'fa-trello',
				 'fa-female'               => 'fa-female',
				 'fa-male'                 => 'fa-male',
				 'fa-gittip'               => 'fa-gittip',
				 'fa-sun-o'                => 'fa-sun-o',
				 'fa-moon-o'               => 'fa-moon-o',
				 'fa-archive'              => 'fa-archive',
				 'fa-bug'                  => 'fa-bug',
				 'fa-vk'                   => 'fa-vk',
				 'fa-weibo'                => 'fa-weibo',
				 'fa-renren'               => 'fa-renren',
				 'fa-pagelines'            => 'fa-pagelines',
				 'fa-stack-exchange'       => 'fa-stack-exchange',
				 'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right',
				 'fa-arrow-circle-o-left'  => 'fa-arrow-circle-o-left',
				 'fa-toggle-left'          => 'fa-toggle-left',
				 'fa-caret-square-o-left'  => 'fa-caret-square-o-left',
				 'fa-dot-circle-o'         => 'fa-dot-circle-o',
				 'fa-wheelchair'           => 'fa-wheelchair',
				 'fa-vimeo-square'         => 'fa-vimeo-square',
				 'fa-turkish-lira'         => 'fa-turkish-lira',
				 'fa-try'                  => 'fa-try',
				 'fa-plus-square-o'        => 'fa-plus-square-o',
				 'fa-space-shuttle'        => 'fa-space-shuttle',
				 'fa-slack'                => 'fa-slack',
				 'fa-envelope-square'      => 'fa-envelope-square',
				 'fa-wordpress'            => 'fa-wordpress',
				 'fa-openid'               => 'fa-openid',
				 'fa-institution'          => 'fa-institution',
				 'fa-bank'                 => 'fa-bank',
				 'fa-university'           => 'fa-university',
				 'fa-mortar-board'         => 'fa-mortar-board',
				 'fa-graduation-cap'       => 'fa-graduation-cap',
				 'fa-yahoo'                => 'fa-yahoo',
				 'fa-google'               => 'fa-google',
				 'fa-reddit'               => 'fa-reddit',
				 'fa-reddit-square'        => 'fa-reddit-square',
				 'fa-stumbleupon-circle'   => 'fa-stumbleupon-circle',
				 'fa-stumbleupon'          => 'fa-stumbleupon',
				 'fa-delicious'            => 'fa-delicious',
				 'fa-digg'                 => 'fa-digg',
				 'fa-pied-piper-square'    => 'fa-pied-piper-square',
				 'fa-pied-piper'           => 'fa-pied-piper',
				 'fa-pied-piper-alt'       => 'fa-pied-piper-alt',
				 'fa-drupal'               => 'fa-drupal',
				 'fa-joomla'               => 'fa-joomla',
				 'fa-language'             => 'fa-language',
				 'fa-fax'                  => 'fa-fax',
				 'fa-building'             => 'fa-building',
				 'fa-child'                => 'fa-child',
				 'fa-paw'                  => 'fa-paw',
				 'fa-spoon'                => 'fa-spoon',
				 'fa-cube'                 => 'fa-cube',
				 'fa-cubes'                => 'fa-cubes',
				 'fa-behance'              => 'fa-behance',
				 'fa-behance-square'       => 'fa-behance-square',
				 'fa-steam'                => 'fa-steam',
				 'fa-steam-square'         => 'fa-steam-square',
				 'fa-recycle'              => 'fa-recycle',
				 'fa-automobile'           => 'fa-automobile',
				 'fa-car'                  => 'fa-car',
				 'fa-cab'                  => 'fa-cab',
				 'fa-taxi'                 => 'fa-taxi',
				 'fa-tree'                 => 'fa-tree',
				 'fa-spotify'              => 'fa-spotify',
				 'fa-deviantart'           => 'fa-deviantart',
				 'fa-soundcloud'           => 'fa-soundcloud',
				 'fa-database'             => 'fa-database',
				 'fa-file-pdf-o'           => 'fa-file-pdf-o',
				 'fa-file-word-o'          => 'fa-file-word-o',
				 'fa-file-excel-o'         => 'fa-file-excel-o',
				 'fa-file-powerpoint-o'    => 'fa-file-powerpoint-o',
				 'fa-file-photo-o'         => 'fa-file-photo-o',
				 'fa-file-picture-o'       => 'fa-file-picture-o',
				 'fa-file-image-o'         => 'fa-file-image-o',
				 'fa-file-zip-o'           => 'fa-file-zip-o',
				 'fa-file-archive-o'       => 'fa-file-archive-o',
				 'fa-file-sound-o'         => 'fa-file-sound-o',
				 'fa-file-audio-o'         => 'fa-file-audio-o',
				 'fa-file-movie-o'         => 'fa-file-movie-o',
				 'fa-file-video-o'         => 'fa-file-video-o',
				 'fa-file-code-o'          => 'fa-file-code-o',
				 'fa-vine'                 => 'fa-vine',
				 'fa-codepen'              => 'fa-codepen',
				 'fa-jsfiddle'             => 'fa-jsfiddle',
				 'fa-life-bouy'            => 'fa-life-bouy',
				 'fa-life-saver'           => 'fa-life-saver',
				 'fa-support'              => 'fa-support',
				 'fa-life-ring'            => 'fa-life-ring',
				 'fa-circle-o-notch'       => 'fa-circle-o-notch',
				 'fa-ra'                   => 'fa-ra',
				 'fa-rebel'                => 'fa-rebel',
				 'fa-ge'                   => 'fa-ge',
				 'fa-empire'               => 'fa-empire',
				 'fa-git-square'           => 'fa-git-square',
				 'fa-git'                  => 'fa-git',
				 'fa-hacker-news'          => 'fa-hacker-news',
				 'fa-tencent-weibo'        => 'fa-tencent-weibo',
				 'fa-qq'                   => 'fa-qq',
				 'fa-wechat'               => 'fa-wechat',
				 'fa-weixin'               => 'fa-weixin',
				 'fa-send'                 => 'fa-send',
				 'fa-paper-plane'          => 'fa-paper-plane',
				 'fa-send-o'               => 'fa-send-o',
				 'fa-paper-plane-o'        => 'fa-paper-plane-o',
				 'fa-history'              => 'fa-history',
				 'fa-circle-thin'          => 'fa-circle-thin',
				 'fa-header'               => 'fa-header',
				 'fa-paragraph'            => 'fa-paragraph',
				 'fa-sliders'              => 'fa-sliders',
				 'fa-share-alt'            => 'fa-share-alt',
				 'fa-share-alt-square'     => 'fa-share-alt-square',
				 'fa-bomb'                 => 'fa-bomb',
			)
		)
	) 
);

//Toggle
$tdl_shortcodes['toggle'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Toggle Panel', 'sellegance' ), 
	'attr'=>array( 
		'title'=>array('type'=>'text', 'title'=>__('Title', 'sellegance')) 
	)
);

//Tabbed Sections
$tdl_shortcodes['tabbed_section'] = array( 
	'type'=>'dynamic', 
	'title'=>__('Tabbed Section', 'sellegance' ), 
	'attr'=>array(
		'tabs'=>array('type'=>'custom'),
		'style'=>array(
				'type'=>'select', 
				'title'=> __('Tabs Style', 'sellegance'), 
				'values'=>array(
					'top'=>'top',
					'side'=>'side',
				),
			),
	)
);




#-----------------------------------------------------------------
# Shop Shortcodes 
#-----------------------------------------------------------------

$tdl_shortcodes['header_7'] = array( 
	'type'=>'heading', 
	'title'=>__('Shop Shortcodes', 'sellegance' )
);

//Custom Big Featured Products
$tdl_shortcodes['custom_big_featured_products'] = array( 
	'type'=>'regular', 
	'title'=>__('Custom Big Featured Products', 'sellegance' ), 
	'attr'=>array()
);

//Custom Featured Products
$tdl_shortcodes['custom_featured_products'] = array( 
	'type'=>'regular', 
	'title'=>__('Custom Featured Products', 'sellegance' ), 
	'attr'=>array(
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
			
		),
		'category'=>array(
			'type'=>'text', 
			'title'=>__('Categories', 'sellegance'),
			'desc' => __('Use category slugs separated by commas. Leave empty to show all.', 'sellegance'),
		),
	)
);


//Custom Latest Products
$tdl_shortcodes['custom_latest_products'] = array( 
	'type'=>'regular', 
	'title'=>__('Custom Latest Products', 'sellegance' ), 
	'attr'=>array(
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
		),
		'category'=>array(
			'type'=>'text', 
			'title'=>__('Categories', 'sellegance'),
			'desc' => __('Use category slugs separated by commas. Leave empty to show all.', 'sellegance'),
		),
	
	)
);

//Custom Best Sellers
$tdl_shortcodes['custom_best_sellers'] = array( 
	'type'=>'regular', 
	'title'=>__('Custom Best Sellers', 'sellegance' ), 
	'attr'=>array(
	
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
			
		),	

	)
);

//Custom On Sale Products
$tdl_shortcodes['custom_on_sale_products'] = array( 
	'type'=>'regular', 
	'title'=>__('Custom On Sale Products', 'sellegance' ), 
	'attr'=>array(
	
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
			
		),	
	
	)
);



#-----------------------------------------------------------------
# Recent Posts/Projects/Brands 
#-----------------------------------------------------------------

$tdl_shortcodes['header_8'] = array( 
	'type'=>'heading', 
	'title'=>__('Recent Posts/Work', 'sellegance' )
);

//Recent Posts
$tdl_shortcodes['recent_posts'] = array( 
	'type'=>'direct_to_editor', 
	'title'=>__('Recent Posts', 'sellegance' ), 
	'attr'=>array( 
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
		),
		'category'=>array(
			'type'=>'text', 
			'title'=>__('Categories', 'sellegance'),
			'desc' => __('Use category slugs separated by commas. Leave empty to show all.', 'sellegance'),
		),
		'posts'=>array(
			'type'=>'text', 
			'title'=>__('No. of Posts', 'sellegance'),
			'std'=> '3',
		),
		'style'=>array(
				'type'=>'select', 
				'title'=> __('Style', 'sellegance'), 
				'desc' => __('Select style. Default: Slider', 'sellegance'),
				'values'=>array(
					'slider'=>'slider',
					'static'=>'static',
				),
			),
	)
);

//Recent Work
$tdl_shortcodes['recent_projects'] = array( 
	'type'=>'direct_to_editor', 
	'title'=>__('Recent Projects', 'sellegance' ), 
	'attr'=>array( 
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
			
		),
	)
);

//Brands
$tdl_shortcodes['brands'] = array( 
	'type'=>'direct_to_editor', 
	'title'=>__('Brands', 'sellegance' ), 
	'attr'=>array( 
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'sellegance'),
			
		),
	)
);

?>