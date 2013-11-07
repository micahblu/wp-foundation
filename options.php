<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'wp-foundation'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'wp-foundation'),
		'two' => __('Two', 'wp-foundation'),
		'three' => __('Three', 'wp-foundation'),
		'four' => __('Four', 'wp-foundation'),
		'five' => __('Five', 'wp-foundation')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'wp-foundation'),
		'two' => __('Pancake', 'wp-foundation'),
		'three' => __('Omelette', 'wp-foundation'),
		'four' => __('Crepe', 'wp-foundation'),
		'five' => __('Waffle', 'wp-foundation')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll',
		"size" => "auto" );

	// Typography Defaults / Header
	$typography_defaults_header = array(
		'size' => '24px',
		'face' => 'Open Sans',
		'style' => 'normal',
		'color' => '#2ba6cb' );

	// Typography Defaults / Sub Header
	$typography_defaults_sub_header = array(
		'size' => '20px',
		'face' => 'Open Sans',
		'style' => 'bold',
		'color' => '#333333' );

	// Typography Defaults / Body 
	$typography_defaults_body = array(
		'size' => '15px',
		'face' => 'Helvetica Neue',
		'style' => 'normal',
		'color' => '#666' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','15','16','20', 24, 30, 38, 44 ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue',
											'Helvetica' => 'Helvetica',
											'Arial' => 'Arial',
											'Open Sans' => 'Open Sans',
											'Verdana' => 'Verdana',
											'Georgia' => 'Georgia',
											'Times New Roman' => 'Times New Roman',
										),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => true
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'wp-foundation'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Branding', 'wp-foundation'),
		'desc' => __('Upload a logo image  file', 'wp-foundation'),
		'id' => 'logo',
		'type' => 'upload');

	$options[] = array(
		'name' =>  __('Background', 'wp-foundation'),
		'desc' => __('Change the background.', 'wp-foundation'),
		'id' => 'body_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Footer Scripts', 'wp-foundation'),
		'desc' => __('Place your analytics or other code here. No need to include &script> tags', 'wp-foundation'),
		'id' => 'footer_scripts',
		'std' => '',
		'type' => 'textarea');
	/*
	$options[] = array(
		'name' => __('Input Text Mini', 'wp-foundation'),
		'desc' => __('A mini text input field.', 'wp-foundation'),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Input Text', 'wp-foundation'),
		'desc' => __('A text input field.', 'wp-foundation'),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text');

	$options[] = array(
		'name' => __('Textarea', 'wp-foundation'),
		'desc' => __('Textarea description.', 'wp-foundation'),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input Select Small', 'wp-foundation'),
		'desc' => __('Small Select Box.', 'wp-foundation'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'wp-foundation'),
		'desc' => __('A wider select box.', 'wp-foundation'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array);

	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select a Category', 'wp-foundation'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'wp-foundation'),
		'id' => 'example_select_categories',
		'type' => 'select',
		'options' => $options_categories);
	}
	
	if ( $options_tags ) {
	$options[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'example_select_tags',
		'type' => 'select',
		'options' => $options_tags);
	}

	$options[] = array(
		'name' => __('Select a Page', 'wp-foundation'),
		'desc' => __('Passed an pages with ID and post_title', 'wp-foundation'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Input Radio (one)', 'wp-foundation'),
		'desc' => __('Radio select with default options "one".', 'wp-foundation'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array);
	
	$options[] = array(
		'name' => __('Example Info', 'wp-foundation'),
		'desc' => __('This is just some example information you can put in the panel.', 'wp-foundation'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'wp-foundation'),
		'desc' => __('Example checkbox, defaults to true.', 'wp-foundation'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox');
	*/
	$options[] = array(
		'name' => __('Typography Settings', 'wp-foundation'),
		'type' => 'heading');

	
	/*
	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'wp-foundation'),
		'desc' => __('Click here and see what happens.', 'wp-foundation'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Hidden Text Input', 'wp-foundation'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'wp-foundation'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'wp-foundation'),
		'desc' => __('This creates a full size uploader that previews the image.', 'wp-foundation'),
		'id' => 'example_uploader',
		'type' => 'upload');
	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);
	
	

	$options[] = array(
		'name' => __('Multicheck', 'wp-foundation'),
		'desc' => __('Multicheck description.', 'wp-foundation'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);
	*/

	$options[] = array(
		'name' => __('Global Link Color', 'wp-foundation'),
		'desc' => __('Set your site\'s global link color.', 'wp-foundation'),
		'id' => 'global_link_color',
		'std' => '',
		'type' => 'color' );
		
	$options[] = array( 
		'name' => __('Header Font', 'wp-foundation'),
		'desc' => __('Set the styles for your site\'s header font', 'wp-foundation'),
		'id' => "header_font",
		'std' => $typography_defaults_header,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array( 
		'name' => __('Sub Header Font', 'wp-foundation'),
		'desc' => __('Set the styles for your site\'s sub header font', 'wp-foundation'),
		'id' => "sub_header_font",
		'std' => $typography_defaults_sub_header,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array( 
		'name' => __('Main Body Font', 'wp-foundation'),
		'desc' => __('Set the styles for your site\'s header fonts', 'wp-foundation'),
		'id' => "paragraph",
		'std' => $typography_defaults_body,
		'type' => 'typography',
		'options' => $typography_options );
	
	$options[] = array(
		'name' => __('Social', 'wp-foundation'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('Facebook', 'wp-foundation'),
		'desc' => __('Facebook URL', 'wp-foundation'),
		'id' => 'facebook_url',
		'std' => '	',
		'type' => 'text' );

	$options[] = array(
		'name' => __('Twitter', 'wp-foundation'),
		'desc' => __('Twitter URL', 'wp-foundation'),
		'id' => 'twitter_url',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => __('Instagram', 'wp-foundation'),
		'desc' => __('Instagram URL', 'wp-foundation'),
		'id' => 'instagram_url',
		'std' => '',
		'type' => 'text' );
		
	$options[] = array(
		'name' => __('Pinterest', 'wp-foundation'),
		'desc' => __('Pinterest URL', 'wp-foundation'),
		'id' => 'pinterest_url',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => __('Youtube', 'wp-foundation'),
		'desc' => __('Youtube URL', 'wp-foundation'),
		'id' => 'youtube_url',
		'std' => '',
		'type' => 'text' );

	/**
	$options[] = array(
		'name' => __('Text Editor', 'wp-foundation'),
		'type' => 'heading' );


	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	/*
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('Default Text Editor', 'wp-foundation'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'wp-foundation' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
	*/

	$options = apply_filters("wp_foundation_custom_options", $options);

	return $options;
}