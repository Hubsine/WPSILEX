<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

	class Redux_Framework_sample_config {

		public $args        = array();
		public $sections    = array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if (!class_exists('ReduxFramework')) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if (  true == Redux_Helpers::isTheme(__FILE__) ) {
				$this->initSettings();
			} else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}

		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
			
			// Function to test the compiler hook and demo CSS output.
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
			
			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
			
			// Change the default value of a field after it's been set, but before it's been useds
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
			
			// Dynamically add a section. Can be also used to modify sections/fields
			//add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}

		/**

		  This is a test function that will let you see when the compiler hook occurs.
		  It only runs if a field	set with compiler=>true is changed.

		 * */
		function compiler_action($options, $css) {
			//echo '<h1>The compiler hook has run!</h1>';
			//print_r($options); //Option values
			//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

			/*
			  // Demo of how to use the dynamic CSS and write your own static CSS file
			  $filename = dirname(__FILE__) . '/style' . '.css';
			  global $wp_filesystem;
			  if( empty( $wp_filesystem ) ) {
				require_once( ABSPATH .'/wp-admin/includes/file.php' );
			  WP_Filesystem();
			  }

			  if( $wp_filesystem ) {
				$wp_filesystem->put_contents(
					$filename,
					$css,
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			  }
			 */
		}

		/**

		  Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		  Simply include this function in the child themes functions.php file.

		  NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		  so you must use get_template_directory_uri() if you want to use any of the built in icons

		 * */
		function dynamic_section($sections) {
			//$sections = array();
			$sections[] = array(
				'title' => __('Section via hook', 'sellegance'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'sellegance'),
				'icon' => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**

		  Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		 * */
		function change_arguments($args) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**

		  Filter hook for filtering the default value of any given field. Very useful in development mode.

		 * */
		function change_defaults($defaults) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if (class_exists('ReduxFrameworkPlugin')) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

		public function setSections() {

			/**
			  Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 * */
			// Background Patterns Reader
			$sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns        = array();

			if (is_dir($sample_patterns_path)) :

				if ($sample_patterns_dir = opendir($sample_patterns_path)) :
					$sample_patterns = array();

					while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

						if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
							$name = explode('.', $sample_patterns_file);
							$name = str_replace('.' . end($name), '', $sample_patterns_file);
							$sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
						}
					}
				endif;
			endif;

			ob_start();

			$ct             = wp_get_theme();
			$this->theme    = $ct;
			$item_name      = $this->theme->get('Name');
			$tags           = $this->theme->Tags;
			$screenshot     = $this->theme->get_screenshot();
			$class          = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'sellegance'), $this->theme->display('Name'));
			
			?>
			<div id="current-theme" class="<?php echo esc_attr($class); ?>">
			<?php if ($screenshot) : ?>
				<?php if (current_user_can('edit_theme_options')) : ?>
						<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
							<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
						</a>
				<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
				<?php endif; ?>

				<h4><?php echo $this->theme->display('Name'); ?></h4>

				<div>
					<ul class="theme-info">
						<li><?php printf(__('By %s', 'sellegance'), $this->theme->display('Author')); ?></li>
						<li><?php printf(__('Version %s', 'sellegance'), $this->theme->display('Version')); ?></li>
						<li><?php echo '<strong>' . __('Tags', 'sellegance') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
			<?php
			if ($this->theme->parent()) {
				printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'sellegance'), $this->theme->parent()->display('Name'));
			}
			?>

				</div>
			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			$sampleHTML = '';
			if (file_exists(dirname(__FILE__) . '/info-html.html')) {
				/** @global WP_Filesystem_Direct $wp_filesystem  */
				global $wp_filesystem;
				if (empty($wp_filesystem)) {
					require_once(ABSPATH . '/wp-admin/includes/file.php');
					WP_Filesystem();
				}
				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
			}

	// ACTUAL DECLARATION OF SECTIONS

	$url= get_template_directory_uri().'/images/patterns/';
	$url2= get_template_directory_uri().'/includes/assets/images/';

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('General Settings', 'sellegance'),
		'fields' => array(
			array(
				'id'=>'main_layout',
				'type' => 'select',
				'title' => __('Main Layout', 'sellegance'),
				'options' => array(
					'boxed' => 'Boxed',
					'framed' => 'Framed',
					'fullwidth' => 'Full Width',
					'transparent_header' => 'Transparent Header',
					),
				'default' => 'boxed'
				),
			array(
				'id'=>'responsive_layout',
				'type' => 'select',
				'title' => __('Responsive Layout', 'sellegance'), 
				'subtitle' => __('2 responsive modes and 1 fixed mode', 'sellegance'),
				'options' => array(
					'responsive' => 'Responsive - Max Width 1170px',
					'responsive940' => 'Responsive - Max Width 940px',
					'fixed' => 'Fixed - Min width 940px'),
				'default' => 'responsive'
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Background', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'overlay_pattern',
				'type' => 'image_select',
				'tiles' => true,
				'compiler'=>true,
				'title' => __('Overlay Pattern', 'sellegance'), 
				'subtitle' => __('Default option is pattern 5.<br>First option (0) is <em>transparent</em>.', 'sellegance'),
				'options' => array(
					'0' => array('alt' => '1', 'img' => $url .'0.png'),
					'1' => array('alt' => '1', 'img' => $url .'1.png'),
					'2' => array('alt' => '2', 'img' => $url .'2.png'),
					'3' => array('alt' => '3', 'img' => $url .'3.png'),
					'4' => array('alt' => '4', 'img' => $url .'4.png'),
					'5' => array('alt' => '5', 'img' => $url .'5.png'),
					'6' => array('alt' => '6', 'img' => $url .'6.png'),
					'7' => array('alt' => '7', 'img' => $url .'7.png'),
					'8' => array('alt' => '8', 'img' => $url .'8.png'),
					'9' => array('alt' => '9', 'img' => $url .'9.png'),
					'10' => array('alt' => '10', 'img' => $url .'10.png'),
					'11' => array('alt' => '11', 'img' => $url .'11.png'),
					'12' => array('alt' => '12', 'img' => $url .'12.png'),
					'13' => array('alt' => '13', 'img' => $url .'13.png'),
					'14' => array('alt' => '14', 'img' => $url .'14.png'),
					'15' => array('alt' => '15', 'img' => $url .'15.png'),
					'16' => array('alt' => '16', 'img' => $url .'16.png'),
					'17' => array('alt' => '17', 'img' => $url .'17.png'),
					'18' => array('alt' => '18', 'img' => $url .'18.png'),
					'19' => array('alt' => '19', 'img' => $url .'19.png'),
					'20' => array('alt' => '20', 'img' => $url .'20.png'),
					'21' => array('alt' => '21', 'img' => $url .'21.png'),
					'22' => array('alt' => '22', 'img' => $url .'22.png'),
					'23' => array('alt' => '23', 'img' => $url .'23.png'),
					'24' => array('alt' => '24', 'img' => $url .'24.png'),
					'25' => array('alt' => '25', 'img' => $url .'25.png'),
					'26' => array('alt' => '26', 'img' => $url .'26.png'),
					'27' => array('alt' => '27', 'img' => $url .'27.png'),
					'28' => array('alt' => '28', 'img' => $url .'28.png'),
					'29' => array('alt' => '29', 'img' => $url .'29.png'),
					'30' => array('alt' => '30', 'img' => $url .'30.png'),
					'31' => array('alt' => '31', 'img' => $url .'31.png'),
					'32' => array('alt' => '32', 'img' => $url .'32.png'),
					'33' => array('alt' => '33', 'img' => $url .'33.png'),
					'34' => array('alt' => '34', 'img' => $url .'34.png'),
					'35' => array('alt' => '35', 'img' => $url .'35.png'),
					'36' => array('alt' => '36', 'img' => $url .'36.png'),
					'37' => array('alt' => '37', 'img' => $url .'37.png'),
					'38' => array('alt' => '38', 'img' => $url .'38.png'),
					'39' => array('alt' => '39', 'img' => $url .'39.png'),
					'40' => array('alt' => '40', 'img' => $url .'40.png'),
					'41' => array('alt' => '41', 'img' => $url .'41.png'),
					'42' => array('alt' => '42', 'img' => $url .'42.png'),
				),
				'default' => $url .'5.png'
				),
			array(
				'id'=>'custom_overlay_pattern',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Custom Overlay Pattern', 'sellegance'),
				'compiler' => 'true',
				'subtitle'=> __('Upload your own <em>Pattern</em>.<br> Use <em>.png</em> images to preserve transparency.', 'sellegance'),
				'default' => array (
					'url' => '',
					)
				),
			array(
				'id'=>'body_bg_color',
				'type' => 'background',
				'output' => array('body'),
				'title' => __('Site Background', 'sellegance'), 
				'subtitle' => __('For Boxed and Framed layouts. <br><br> Default <code>#FFFFFF</code>.', 'sellegance'),
				'default'  => array(
					'background-color' => '#FFFFFF',
					)
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Colors', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'maincontent_text_color',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Central Content Text Color', 'sellegance'), 
				'subtitle' => __('Light or Dark text style.', 'sellegance'),
				'options' => array(
					'light' => $url2 . 'text-light.gif',
					'dark' => $url2 . 'text-dark.gif',
					),
				'default' => 'light',
				),
			array(
				'id'=>'maincontent_bg_color',
				'type' => 'color',
				'title' => __('Central Content Background', 'sellegance'), 
				'subtitle' => __('It\'s the section between the header and footer.<br> Default <code>#FFFFFF</code>', 'sellegance'),
				'default' => '#FFFFFF',
				'validate' => 'color',
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Favicon', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'favicon_image',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Favicon', 'sellegance'),
				'subtitle'=> __('Add your custom Favicon image. 16x16px .ico or .png file required.', 'sellegance'),
				'default' => array(
					'url' => '',
					)
				),
			array(
				'id'=>'favicon_retina',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Retina Favicon', 'sellegance'),
				'subtitle'=> __('The Retina version of your Favicon. 144x144px .png file required.', 'sellegance'),
				'default' => array(
					'url' => '',
					)
				),
			array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false,
            ),
			array(
				'id'=>'backtotop',
				'type' => 'switch', 
				'title' => __('Back to Top button', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'page_comments',
				'type' => 'switch', 
				'title' => __('Show comments on pages', 'sellegance'),
				"default"=> 0,
				)
			)
		
		);

	$url= get_template_directory_uri().'/includes/assets/images/';

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Header', 'sellegance'),
		'fields' => array(  

			array(
				'id'=>'header_layout',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Header Layout', 'sellegance'), 
				'subtitle' => __('Choose header layout:<br><br>
					1. Centered Logo<br>
					2. Left Logo<br>
					3. Minimal', 'sellegance'),
				'options' => array(
					'header1' => $url . 'header1.jpg',
					'header2' => $url . 'header2.jpg',
					'header3' => $url . 'header3.jpg',
					),
				'default' => 'header1',
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Logo', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'site_logo',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Logo', 'sellegance'),
				'compiler' => 'true',
				'subtitle'=> __('Upload your logo here.<br><br><em>*Use an image double size the logo container for better results on retina displays.</em>', 'sellegance'),
				'default' => array(
					'url' => get_template_directory_uri().'/images/logo.png',
					)
				),
			array(
				'id'=>'logo_size',
				'type' => 'dimensions',
				'units' => 'px',
				'title' => __('Logo container size (Width/Height)', 'sellegance'),
				'subtitle' => __('The default container size is 250 x 100 px.', 'sellegance'),
				'default' => array('width' => 250, 'height'=>100, )
				), 
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Navigation', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'fixed_navigation',
				'type' => 'switch', 
				'title' => __('Sticky Menu', 'sellegance'),
				'subtitle'=> __('Fixed navigation when scrolling', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'navigation_inside',
				'type' => 'switch', 
				'title' => __('Navigation inside central container', 'sellegance'),
				'subtitle'=> __('Boxed layout only', 'sellegance'),
				"default"=> 0,
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Custom Text', 'sellegance' ),
			    'indent'   => true,
			),
			
			array(
				'id'=>'header_text',
				'type' => 'editor',
				'title' => __('Header Text', 'sellegance'),
				'subtitle' => __('Custom content on header', 'sellegance'),
				'default' => 'Order before 1pm PST for Free Next Business Shipping on all Clothing',
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Header Colors', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'header_text_color',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Header Text Color', 'sellegance'), 
				'subtitle' => __('Light or Dark text style.', 'sellegance'),
				'options' => array(
					'header_light' => $url . 'text-light.gif',
					'header_dark' => $url . 'text-dark.gif',
					),
				'default' => 'light',
				),
			array(
				'id'=>'header_bg_color',
				'type' => 'color',
				'title' => __('Header Background', 'sellegance'), 
				'subtitle' => __('Default <code>transparent</code>', 'sellegance'),
				'default' => 'transparent',
				'validate' => 'color',
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Top Bar', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'top_bar',
				'type' => 'switch', 
				'title' => __('Top Bar', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'topbar_dropdown_title',
				'type' => 'text', 
				'title' => __('Topbar Dropdown Title', 'sellegance'),
				'subtitle'=> __('Configure dropdown items in <em>Appearance > Menus</em>', 'sellegance'),
				"default"=> 'My Account',
				),
			array(
				'id'=>'topbar_bg_color',
				'type' => 'color',
				'title' => __('Top Bar Background', 'sellegance'), 
				'subtitle' => __('Default <code>transparent</code> <br>The same color as the whole header.', 'sellegance'),
				'default' => 'transparent',
				'validate' => 'color',
				),
			array(
				'id'=>'topbar_text_color',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Top Bar Text Color', 'sellegance'), 
				'subtitle' => __('Light or Dark text style.', 'sellegance'),
				'options' => array(
					'topbar_light' => $url . 'text-light.gif',
					'topbar_dark' => $url . 'text-dark.gif',
					),
				'default' => 'light',
				),

			)
	);

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Footer', 'sellegance'),
		'fields' => array(  

			array(
				'id'            => 'footer_top_columns',
				'type'          => 'slider',
				'title'         => __('Footer Top widgets', 'sellegance'),
				'subtitle'      => __('Number of columns for Footer Top widgets', 'sellegance'),
				'default'       => 4,
				'min'           => 1,
				'step'          => 1,
				'max'           => 6,
				'display_value' => 'text'
			),
			array(
				'id'            => 'footer_bottom_columns',
				'type'          => 'slider',
				'title'         => __('Footer Bottom widgets', 'sellegance'),
				'subtitle'      => __('Number of columns for Footer Bottom widgets', 'sellegance'),
				'default'       => 4,
				'min'           => 1,
				'step'          => 1,
				'max'           => 6,
				'display_value' => 'text'
			),
			array(
				'id'=>'footer_text',
				'type' => 'editor',
				'title' => __('Footer Copyright Text', 'sellegance'),
				'subtitle' => __('Add custom content to the copyright section', 'sellegance'),
				'default' => 'Powered by Sellegance.',
				),
			array(
				'id'=>'payment_icons',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Payment Icons', 'sellegance'),
				'compiler' => 'true',
				'subtitle'=> __('Upload your own payment icon sprite', 'sellegance'),
				'default'=>array('url'=> get_template_directory_uri().'/images/payment_cards.png'),
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Footer Colors', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'footer_top_bg',
				'type' => 'color',
				'title' => __('Footer Top Background', 'sellegance'), 
				'subtitle' => __('Default <code>#F6F6F6</code>', 'sellegance'),
				'default' => '#f6f6f6',
				'validate' => 'color',
				),
			array(
				'id'=>'footer_top_text_color',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Footer Top text color', 'sellegance'), 
				'subtitle' => __('Light or Dark text style.', 'sellegance'),
				'options' => array(
					'light' => $url . 'text-light.gif',
					'dark' => $url . 'text-dark.gif',
					),
				'default' => 'light',
				),
			array(
				'id'=>'footer_bottom_bg',
				'type' => 'color',
				'title' => __('Footer Bottom Background*', 'sellegance'), 
				'subtitle' => __('Default:
					<br><br>-Boxed/Framed <code>transparent</code>
					<br>-Fullwidth/Transparent-header <code>#777777</code>', 'sellegance'),
				'default' => '#777777',
				'validate' => 'color',
				),
			array(
				'id'=>'footer_bottom_text_color',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Footer Bottom text color', 'sellegance'), 
				'subtitle' => __('Default:
					<br><br>-Boxed/Framed <code>Light</code>
					<br>-Fullwidth/Transparent-header <code>Dark</code>', 'sellegance'),
				'options' => array(
					'light' => $url . 'text-light.gif',
					'dark' => $url . 'text-dark.gif',
					),
				'default' => 'light',
				),
			array(
				'id'=>'footer_copyright_bg',
				'type' => 'color',
				'title' => __('Footer Copyright Background*', 'sellegance'), 
				'subtitle' => __('Default:
					<br><br>-Boxed/Framed <code>transparent</code>
					<br>-Fullwidth/Transparent-header <code>#5B5B5B</code>', 'sellegance'),
				'default' => 'transparent',
				'validate' => 'color',
				),
			array(
				'id'=>'footer_copyright_text_color',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Footer Copyright text color', 'sellegance'), 
				'subtitle' => __('Default:
					<br><br>-Boxed/Framed <code>Light</code>
					<br>-Fullwidth/Transparent-header <code>Dark</code>', 'sellegance'),
				'options' => array(
					'light' => $url . 'text-light.gif',
					'dark' => $url . 'text-dark.gif',
					),
				'default' => 'light',
				),
			array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false,
            ),
			)
	);

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Shop', 'sellegance'),
		'fields' => array(

			array(
				'id'=>'shop_sidebar',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Shop Sidebar Position', 'sellegance'), 
				'subtitle' => __('Select position for the shop sidebar.', 'sellegance'),
				'options' => array(
					'left' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
					'right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url.'assets/img/2cr.png'),
					'fullwidth' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
					),
				'default' => 'left'
				),
			array(
				'id'=>'catalog_mode',
				'type' => 'switch', 
				'title' => __('Catalog Only', 'sellegance'),
				'subtitle'=> __('Disable "Add To Cart" button and shopping cart. This option will turn off the shopping functionality of WooCommerce.', 'sellegance'),
				"default"=> 0,
				),
			array(
				'id'=>'global_search',
				'type' => 'switch', 
				'title' => __('Global search', 'sellegance'),
				'subtitle'=> __('Include pages, portfolios and posts in search results when WooCommerce is active. Otherwise, it will show only products.', 'sellegance'),
				"default"=> 0,
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Shop Banner', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'shop_banner',
				'type' => 'switch', 
				'title' => __('Shop Banner', 'sellegance'),
				'subtitle'=> __('Enable the banner on the shop main page', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'shop_banner_img',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Shop banner image', 'sellegance'),
				'compiler' => 'true',
				'subtitle'=> __('Upload your banner image', 'sellegance'),
				'default' => array (
					'url' => '',
					)
				),
			array(
				'id'=>'shop_banner_desc',
				'type' => 'editor',
				'title' => __('Banner Description', 'sellegance'),
				'subtitle' => __('Your description for the shop main page', 'sellegance'),
				'default' => ''
				),
			array(
				'id'=>'shop_banner_desc_align',
				'type' => 'select',
				'title' => __('Banner Description', 'sellegance'),
				'subtitle' => __('Your description for the shop main page', 'sellegance'),
				'options' => array(
					'right' => 'Right',
					'left' => 'Left'),
				'default' => 'left'
				),
			array(
				'id'=>'shop_banner_desc_color',
				'type' => 'select',
				'title' => __('Banner description background', 'sellegance'),
				'options' => array(
					'dark' => 'Dark',
					'light' => 'Light'),
				'default' => 'dark'
				),
			array(
				'id'=>'shop_banner_link',
				'type' => 'text', 
				'title' => __('Banner link', 'sellegance'),
				'subtitle'=> __('Enter the full URL (e.g. <code>http://site.com/link</code>)', 'sellegance'),
				'default' => ''
				),
			array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false,
            ),

			)
	);

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Products Listing', 'sellegance'),
		'fields' => array(  

			array(
				'id'=>'products_default_view',
				'type' => 'select',
				'title' => __('Products Default View', 'sellegance'), 
				'subtitle' => __('Select default presentation.', 'sellegance'),
				'options' => array(
					'grid' => 'Grid',
					'list' => 'List'),
				'default' => 'grid'
				),
			array(
				'id'=>'products_per_row',
				'type' => 'select',
				'title' => __('Products per row', 'sellegance'), 
				'options' => array(
					'three_side' => '3 columns (sidebar)',
					'four_side' => '4 columns (sidebar/full width)',
					'five_full' => '5 columns (full width)'),
				'default' => 'three_side'
				),
			array(
				'id'=>'product_animation',
				'type' => 'select',
				'title' => __('Animation on hover', 'sellegance'), 
				'subtitle' => __('The animation to switch 2 images on hover.', 'sellegance'),
				'options' => array(
					'noanim'=>'None',
					'productanim3' => 'Slide',
					'productanim5' => 'Fade',
					'productanim1' => 'Flip'),
				'default' => 'productanim3'
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Elements', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'show_quick_view',
				'type' => 'switch', 
				'title' => __('Show Quick View', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'category_listing',
				'type' => 'switch', 
				'title' => __('Category in product listing', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'rating_listing',
				'type' => 'switch', 
				'title' => __('Rating in product listing', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'new_badge',
				'type' => 'switch', 
				'title' => __('\'New\' Badge', 'sellegance'),
				'subtitle'=> __('Show \'New\' badge on recent products', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'new_badge_duration',
				'type' => 'text', 
				'title' => __('\'New\' Badge Duration', 'sellegance'),
				'subtitle'=> __('How many days \'New\' badge will display', 'sellegance'),
				"default"=> 5,
				),

			)
	);
	
	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Single Product', 'sellegance'),
		'fields' => array(  

			array(
				'id'=>'product_details_mode',
				'type' => 'select',
				'title' => __('Product Details Mode', 'sellegance'), 
				'subtitle' => __('Select Tabs or Accordion.', 'sellegance'),
				'options' => array(
					'tab_normal' => 'Tabs',
					'tab_accordion' => 'Accordion'),
				'default' => 'tab_normal'
				),
			array(
				'id'=>'product_prev_next',
				'type' => 'switch', 
				'title' => __('Show Previous/Next product links', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'share_buttons',
				'type' => 'switch', 
				'title' => __('Show share buttons', 'sellegance'),
				"default"=> 1,
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Custom Tab', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'custom_tab',
				'type' => 'switch', 
				'title' => __('Display custom tab', 'sellegance'),
				'subtitle'=> __('Check to Show custom tab on Single product Page', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'custom_tab_title',
				'type' => 'text', 
				'required' => array('custom_tab', '=' , '1'),
				'title' => __('Custom tab title', 'sellegance'),
				"default"=> 'Returns & Delivery',
				),
			array(
				'id'=>'custom_tab_content',
				'type' => 'editor',
				'required' => array('custom_tab', '=' , '1'),
				'title' => __('Custom tab content', 'sellegance'),
				'subtitle' => __('Enter custom content you would like to output to the product custom tab (for all products)', 'sellegance'),
				'default' => 'This is a static Custom Tab Content from admin panel.',
				),
			array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false,
            ),

			)
	);

	
	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Blog', 'sellegance'),
		'fields' => array(  

			array(
				'id'=>'blog_layout',
				'type' => 'select',
				'title' => __('Blog Layout', 'sellegance'), 
				'options' => array(
					'standard' => 'Standard',
					'grid' => 'Grid',
					'timeline' => 'Timeline'
					),
				'default' => 'standard'
				),
			array(
				'id'=>'blog_sidebar',
				'type' => 'image_select',
				'compiler'=>true,
				'title' => __('Blog Sidebar Position', 'sellegance'), 
				'options' => array(
					'none' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
					'left' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
					'right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url.'assets/img/2cr.png'),
					),
				'default' => 'right'
				),
			array(
				'id'        => 'blog_page',
				'type'      => 'select',
				'data'      => 'pages',
				'title'     => __('Blog page', 'sellegance'),
				'subtitle'  => __('Select blog items page', 'sellegance'),
			),
			array(
				'id'=>'post_prev_next',
				'type' => 'switch', 
				'title' => __('Show Previous/Next posts links', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'blog_related_posts',
				'type' => 'switch', 
				'title' => __('Show related posts', 'sellegance'),
				"default"=> 1,
				),

			)
	);

	
	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Portfolio', 'sellegance'),
		'fields' => array(

			array(
				'id'        => 'portfolio_page',
				'type'      => 'select',
				'data'      => 'pages',
				'title'     => __('Porftolio page', 'sellegance'),
				'subtitle'  => __('Select porfolio items page', 'sellegance'),
			),
			array(
				'id'=>'portfolio_related',
				'type' => 'switch', 
				'title' => __('Show Portfolio related posts', 'sellegance'),
				"default"=> 1,
				),
			array(
				'id'=>'portfolio_related_height',
				'type' => 'text', 
				'required' => array('portfolio_related', '=' , '1'),
				'title' => __('Related projects thumbnail height', 'sellegance'),
				"default"=> '400',
				),
			array(
				'id'=>'portfolio_comments',
				'type' => 'switch', 
				'title' => __('Show comments on portfolio', 'sellegance'),
				"default"=> 0,
				)

			)
	);


	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Social Icons', 'sellegance'),
		'desc' => __('Enter the full URL to each of your social accounts', 'sellegance'),
		'fields' => array(  

				array(
					"id" => "tdl_facebook_url",
					"type" => "text",
					"title" => __("Facebook URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_twitter_url",
					"type" => "text",
					"title" => __("Twitter URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_googleplus_url",
					"type" => "text",
					"title" => __("Google+ URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_pinterest_url",
					"type" => "text",
					"title" => __("Pinterest URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_vimeo_url",
					"type" => "text",
					"title" => __("Vimeo URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_youtube_url",
					"type" => "text",
					"title" => __("YouTube URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_flickr_url",
					"type" => "text",
					"title" => __("Flickr URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_skype_url",
					"type" => "text",
					"title" => __("Skype URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_behance_url",
					"type" => "text",
					"title" => __("Behance URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_dribbble_url",
					"type" => "text",
					"title" => __("Dribbble URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_tumblr_url",
					"type" => "text",
					"title" => __("Tumblr URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_linkedin_url",
					"type" => "text",
					"title" => __("LinkedIn URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_github_url",
					"type" => "text",
					"title" => __("Github URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_vine_url",
					"type" => "text",
					"title" => __("Vine URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_instagram_url",
					"type" => "text",
					"title" => __("Instagram URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_dropbox_url",
					"type" => "text",
					"title" => __("Dropbox URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_rss_url",
					"type" => "text",
					"title" => __("Feedburner RSS URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_stumbleupon_url",
					"type" => "text",
					"title" => __("Stumbleupon URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_paypal_url",
					"type" => "text",
					"title" => __("Paypal URL", 'sellegance'),
					"default" => "",
					),												
				array(
					"id" => "tdl_etsy_url",
					"type" => "text",
					"title" => __("Etsy URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_foursquare_url",
					"type" => "text",
					"title" => __("Foursquare URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_soundcloud_url",
					"type" => "text",
					"title" => __("SoundCloud URL", 'sellegance'),
					"default" => "",
					),
				array(
					"id" => "tdl_spotify_url",
					"type" => "text",
					"title" => __("Spotify URL", 'sellegance'),
					"default" => "",
					)
			)
	);
	

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Typography', 'sellegance'),
		'fields' => array(

			array(
				'id'=>'body_font',
				'type' => 'typography',
				'title' => __('Main Body Font', 'sellegance'),
				'subtitle' => __('The main font for all your site.
					<br><br>Default:
					<code>font-size:14px</code>, <code>font-weight:normal</code>, <code>font-family:Open Sans</code>', 'sellegance'),
				'google'=>true,
				'subsets'=>true,
				'line-height'=>false,
				'color'=>false,
				'text-align'=>false,
				'all_styles' => true,
				'default' => array(
					'color'=>'#333',
					'font-size'=>'14px',
					'font-weight'=>'400',
					'font-family'=>'Open Sans',
					'google' => true,
					),
				),

			array(
				'id'=>'title_font',
				'type' => 'typography', 
				'title' => __('Titles Font', 'sellegance'),
				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
				'subsets'=>true, // Only appears if google is true and subsets not set to false
				'line-height'=>false,
				'color'=>false,
				'text-align'=>false,
				'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
				'units'=>'px', // Defaults to px
				'subtitle'=> __('Font for the titles.
					<br><br>Default:
					<code>font-size:36px</code>, <code>font-weight:normal</code>, <code>font-family:Open Sans</code>', 'sellegance'),
				'default'=> array(
					'color'=>"#000",
					'font-size'=>'36px',
					'font-weight'=>'400',
					'font-family'=>'Open Sans', 
					'google' => true,
					),
				),
			
			array(
				'id'=>'other_font',
				'type' => 'typography',
				'title' => __('Other Font', 'sellegance'),
				'subtitle' => __('Fonts for the small texts. Use a font easy to read.
					<br><br>Default:
					<code>font-weight:normal</code>, <code>font-family:Open Sans</code>', 'sellegance'),
				'google'=>true,
				'subsets'=>true,
				'line-height'=>false,
				'color'=>false,
				'text-align'=>false,
				'font-size'=>false,
				'color'=>false,
				'text-align'=>false,
				'default' => array(
					'color'=>'#777',
					'font-size'=>'30px',
					'font-family'=>'Open Sans',
					'font-weight'=>'400',
					),
				)
		)
	);


	$this->sections[] = array(
		'icon' => 'el-icon-website',
		'title' => __('Styling Options', 'sellegance'),
		'fields' => array(

			array(
				'id'=>'primary_color',
				'type' => 'color',
				'title' => __('Primary Color', 'sellegance'), 
				'subtitle' => __('Default: <code>#444444</code>', 'sellegance'),
				'description' => __('Change primary color. Used for primary buttons, shopping cart icon, etc.', 'sellegance'),
				'default' => '#444',
				'validate' => 'color',
				),
			array(
				'id'=>'secondary_color',
				'type' => 'color',
				'title' => __('Secondary Color', 'sellegance'), 
				'subtitle' => __('Default: <code>#DD4B39</code>', 'sellegance'),
				'description' => __('Change secondary color. Used for Add to cart, checkout buttons, review stars and sale bubble.', 'sellegance'),
				'default' => '#DD4B39',
				'validate' => 'color',
				),
			array(
				'id'=>'links_color',
				'type' => 'link_color',
				'title' => __('Links Color', 'sellegance'), 
				'subtitle' => __('Default: <code>#428bca</code>', 'sellegance'),
				'default'  => array(
					'regular'  => '#428bca',
					'hover'    => '#2a6496',
					'active'   => '#2a6496',
					'visited'  => '#428bca'),
				'validate' => 'color',
				),
			array(
				'id'=>'price_color',
				'type' => 'color',
				'title' => __('Price color', 'sellegance'), 
				'subtitle' => __('Default <code>#85ad74</code>', 'sellegance'),
				'default' => '#85ad74',
				'validate' => 'color',
				),
			array(
				'id'=>'sale_tag_color',
				'type' => 'color',
				'title' => __('Sale tag color', 'sellegance'), 
				'subtitle' => __('Default: <code>#dc4343</code>', 'sellegance'),
				'default' => '#dc4343',
				'validate' => 'color',
				),

			array(
				'id'=>'rating_stars_color',
				'type' => 'color',
				'title' => __('Rating stars color', 'sellegance'), 
				'subtitle' => __('Default: <code>#dc4343</code>', 'sellegance'),
				'default' => '#dc4343',
				'validate' => 'color',
				),

		)
	);

	$this->sections[] = array(
		'icon' => 'el-icon-cogs',
		'title' => __('Custom Code', 'sellegance'),
		'desc' => __('Use these options to add your own code for advanced cusomization.', 'sellegance'),
		'fields' => array(   

			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'CSS Code', 'sellegance' ),
			    'indent'   => true,
			),       
			
			array(
				'id'=>'custom_css_code',
				'type' => 'ace_editor',
				'title' => __('CSS Code', 'sellegance'), 
				'subtitle' => __('Paste your custom CSS code here. The code will be added to the header of your site.<br>Example:<br><br>
					<code>h1{color:#000;}</code>', 'sellegance'),
				'mode' => 'css',
				'theme' => 'chrome',
				'default' => '',
				),
			array(
				'id'=>'custom_stylesheet',
				'type' => 'switch', 
				'title' => __('Enable custom.css', 'sellegance'),
				'subtitle'=> __('Enable this option to load the custom stylesheet where you can override the default styling of the theme.<br><br> Rename the file <em>/css/sample.custom.css</em> to <em>custom.css</em> located in theme directory.', 'sellegance'),
				"default"=> 0,
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'JS Code', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'custom_js_code',
				'type' => 'ace_editor',
				'title' => __('Custom JS Code', 'sellegance'), 
				'subtitle' => __('Paste your custom JS here. The code will be added to the footer of your site. <br>Example: <br><br>
					<code>jQuery(document).ready(function(){ });</code>', 'sellegance'),
				'mode' => 'javascript',
				'theme' => 'chrome',
				'default' => ""
				),
			array(
			    'id'       => 'section-start',
			    'type'     => 'section',
			    'title'    => __( 'Tracking', 'sellegance' ),
			    'indent'   => true,
			),
			array(
				'id'=>'tracking_code',
				'type' => 'ace_editor',
				'title' => __('Tracking Code', 'sellegance'), 
				'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added to the footer template of your theme.', 'sellegance'),
				'desc' => 'If you need more options and check analytics directly on your dashboard it\'s recommended to get a plugin.',
				'mode' => 'plain_text',
				'theme' => 'chrome',
				//'validate' => 'js',
				'default' => '',
				),
		)
	);
	/**
	 *  Note here I used a 'heading' in the sections array construct
	 *  This allows you to use a different title on your options page
	 * instead of reusing the 'title' value.  This can be done on any 
	 * section - kp
	 */
	
			
	$theme_info = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'sellegance') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'sellegance') . $this->theme->get('Author') . '</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'sellegance') . $this->theme->get('Version') . '</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
			$tabs = $this->theme->get('Tags');
			if (!empty($tabs)) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'sellegance') . implode(', ', $tabs) . '</p>';
	}
	$theme_info .= '</div>';

			if (file_exists(dirname(__FILE__) . '/../README.md')) {
	$this->sections['theme_docs'] = array(
					'icon'      => 'el-icon-list-alt',
				'title' => __('Documentation', 'sellegance'),
				'fields' => array(
					array(
						'id'=>'17',
						'type' => 'raw',
							'markdown'  => true,
							'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
						),              
				),
				);
			}

			$this->sections[] = array(
				'title'     => __('Import / Export', 'sellegance'),
				'desc'      => __('Import and Export your Sellegance settings from file, text or URL.', 'sellegance'),
				'icon'      => 'el-icon-refresh',
				'fields'    => array(
					array(
						'id'            => 'opt-import-export',
						'type'          => 'import_export',
						'title'         => 'Import Export',
						'subtitle'      => 'Save and restore your Redux options',
						'full_width'    => false,
						),
				),          
		);   

	$this->sections[] = array(
		'type' => 'divide',
	);


		if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
			$tabs['docs'] = array(
				'icon'      => 'el-icon-book',
				'title'     => __('Documentation', 'sellegance'),
				'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
			);
		}
	}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'        => 'redux-help-tab-1',
				'title'     => __('Theme Information 1', 'sellegance'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'sellegance')
			);

			$this->args['help_tabs'][] = array(
				'id'        => 'redux-help-tab-2',
				'title'     => __('Theme Information 2', 'sellegance'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'sellegance')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'sellegance');
		}

		/**

		  All the possible arguments for Redux.
		  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'          => 'sellegance_opt',            // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
				'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
				'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
				'menu_title'        => __('Sellegance Options', 'sellegance'),
				'page_title'        => __('Sellegance Options', 'sellegance'),
				
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII', // Must be defined to add google fonts to the typography module
				
				'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
				'admin_bar'         => true,                    // Show the panel pages on the admin bar
				'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
				'dev_mode'          => false,                    // Show the time the page took to load, etc
				'customizer'        => true,                    // Enable basic customizer support
				
				// OPTIONAL -> Give you extra features
				'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
				'menu_icon'         => '',                      // Specify a custom URL to an icon
				'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
				'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
				'page_slug'         => 'sellegance_options',              // Page slug used to denote the panel
				'save_defaults'     => '1',                    // On load save the defaults to DB before user clicks save or not
				'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
				'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
				
				// CAREFUL -> These options are for advanced use only
				'transient_time'    => 60 * MINUTE_IN_SECONDS,
				'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				'footer_credit'     => ' ',                   // Disable the footer credit of Redux. Please leave if you can help it.
				
				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'           => false, // REMOVE

				// HINTS
				'hints' => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'         => 'light',
						'shadow'        => true,
						'rounded'       => false,
						'style'         => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show'          => array(
							'effect'        => 'slide',
							'duration'      => '500',
							'event'         => 'mouseover',
						),
						'hide'      => array(
							'effect'    => 'slide',
							'duration'  => '500',
							'event'     => 'click mouseleave',
						),
					),
				)
			);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.

			$this->args['share_icons'][] = array(
				'url'   => 'https://www.facebook.com/everthemes',
				'title' => 'Like us on Facebook',
				'icon'  => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'http://twitter.com/everthemes',
				'title' => 'Follow us on Twitter',
				'icon'  => 'el-icon-twitter'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'http://themeforest.net/user/luisvelaz#contact',
				'title' => 'Contact us',
				'icon'  => 'el-icon-comment'
			);

			// Panel Intro text -> before the form
			/*if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace('-', '_', $this->args['opt_name']);
				}
				$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'sellegance'), $v);
			} else {
				$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'sellegance');
			}*/

			// Add content after the form.
			$this->args['footer_text'] = __('<p>Have a question about <em>Sellegance</em>? Send me a message using my <a href="http://themeforest.net/user/luisvelaz#contact" target="_blank">contact form</a>.</p>', 'sellegance');
		}

	}
	
	global $reduxConfig;
	$reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
	function redux_my_custom_field($field, $value) {
		print_r($field);
		echo '<br/>';
		print_r($value);
	}
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
	function redux_validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$value = 'just testing';

		/*
		  do your validation

		  if(something) {
			$value = $value;
		  } elseif(something else) {
			$error = true;
			$value = $existing_value;
			$field['msg'] = 'your custom error message';
		  }
		 */

		$return['value'] = $value;
		if ($error == true) {
			$return['error'] = $field;
		}
		return $return;
	}
endif;
