<?php

add_filter( 'the_content', 'sh_pre_process_shortcode', 7 );

/**
 * Functionality to set up highlighter shortcode correctly.
 *
 * This function is attached to the 'the_content' filter hook.
 *
 * @since 1.0.0
 */
function sh_pre_process_shortcode( $content ) {
	global $shortcode_tags;

	$orig_shortcode_tags = $shortcode_tags;
	$shortcode_tags = array();

	// New shortcodes
	add_shortcode( 'code', 'sh_syntax_highlighter' );

	$content = do_shortcode( $content );
	
	$shortcode_tags = $orig_shortcode_tags;

	return $content;
}

/**
 * Code shortcode function
 *
 * This function is attached to the 'code' shortcode hook.
 *
 * @since 1.0.0
 */
function sh_syntax_highlighter( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'markup',
		'title' => '',
		'shortcodes' => false,
		'linenums' => '',
	), $atts ) );
	
	
	$title = ( $title ) ? ' rel="' . $title . '"' : '';
	$linenums = ( $linenums ) ? ' data-linenums="' . $linenums . '"' : '';
	
	if(!$shortcodes){
		$find_array = array( '&#91;', '&#93;' );
		$replace_array = array( '[', ']' );		
	}else{
		$find_array = array( '[', ']' );
		$replace_array = array( '&#91;', '&#93;' );
	}
	
	
	return '<div class="syntax-highlighter"' . $title . '><pre><code class="language-' . $type . '"' . $linenums . '>'	. preg_replace_callback( '|(.*)|isU', 'sh_pre_entities', trim( str_replace( $find_array, $replace_array, $content ) ) ) . '</code></pre>
</div>';
}


add_action( 'wp_enqueue_scripts', 'sh_add_js' );

/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @uses	is_admin()
 * @uses	is_singular()
 * @uses	wp_enqueue_script()
 * @uses	get_template_directory_uri(()
 *
 * @since 1.0.0
 */
function sh_add_js() {
	
	if ( ! is_admin() ) {
		if ( sh_has_shortcode( 'code' ) ) {
	    wp_enqueue_script( 'prism_js', get_template_directory_uri() . '/lib/prism/js/sh.js', '', '', true );
			wp_enqueue_style( 'prism_css',  get_template_directory_uri() . '/lib/prism/css/sh.css');
		}
	}
	
}

/**
 * Check posts to see if shortcode has been used
 *
 * @since 1.0.0
 */
 
function sh_has_shortcode( $shortcode = '' ) {

	global $wp_query;
	
	foreach( $wp_query->posts as $post ) {
		if ( !empty( $shortcode ) && stripos($post->post_content, '[' . $shortcode) !== false ) {
			return true;
		}
	}
	return true;
}
?>