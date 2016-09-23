<?php
#-----------------------------------------------------------------
# Sellegance Shortcode Generator
#-----------------------------------------------------------------

//Access Wordpress
require_once( 'access-wp.php' );

//Shortcodes Definitions
require_once( 'shortcodes-definitions.php' );

//Option Element Function
require_once( 'option-element.php' );

//Shortcode html
$html_options = null;

$shortcode_html = '

<div id="shortcode-generator">
    					
	<div class="shortcode-content">		
		<div class="label"><strong>Shortcodes:</strong></div>
		<div class="content"><select id="tdl-shortcodes" data-placeholder="' . __("Choose a shortcode", 'sellegance') .'">
	    <option></option>';
		
		foreach( $tdl_shortcodes as $shortcode => $options ){
			
			if(strpos($shortcode,'header') !== false) {
				$shortcode_html .= '<optgroup label="'.$options['title'].'">';
			}
			else {
				$shortcode_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
				$html_options .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'" data-type="'.$options['type'].'">';
				
				if( !empty($options['attr']) ){
					 foreach( $options['attr'] as $name => $attr_option ){
						$html_options .= tdl_option_element( $name, $attr_option, $options['type'], $shortcode );
					 }
				}

				$html_options .= '</div>'; 
			}
			
		} 

$shortcode_html .= '</select></div> <div class="hr"></div>'; ?>

<!DOCTYPE html>
<html>
<head>
<title></title>

<!--style-->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/css/tinymce.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/css/chosen/chosen.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/css/simple_slider/simple-slider.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/css/simple_slider/simple-slider-volume.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" />

<!--scripts-->
<script src="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/js/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/js/simple_slider/simple-slider.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/js/popup.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/functions/tinymce/shortcode_generator/js/jscolor.js"></script>



</head>

<body>	
<?php echo $shortcode_html . $html_options;  ?>

	<div id="shortcode-content">
		
		<div class="label"><label id="option-label" for="shortcode-content"><?php echo __( 'Content: ', 'sellegance' ); ?> </label></div>
		<div class="content"><textarea id="content"></textarea></div>
	
	    <div class="hr"></div>
	    
	</div>

	<code class="shortcode_storage"><span id="shortcode-storage-o" style=""></span><span id="shortcode-storage-d"></span><span id="shortcode-storage-c" style=""></span></code>
	<a class="button button-primary button-large" id="add-shortcode"><?php echo __( 'Add Shortcode', 'sellegance' ); ?></a>
	
</div>

</div>
</body>
</html>