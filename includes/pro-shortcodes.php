<?php
/**
 * WP Foundation Custom shortcodes 
 * 
 * HTML/CSS shortcodes mostly based on Foundation 4 framework
 * 
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0
 */
 
class WPFoundationProShortcodes {

	function __construct() {
		add_action( 'init', array( $this, 'add_shortcodes' ) );
	}


	/*-------------------------------------------------------------------------------------
	*
    * add_shortcodes
	*
	* @package WP Foundation
	* @since 2.0
	*
	*-------------------------------------------------------------------------------------*/
	function add_shortcodes() {
	
		add_shortcode('embediframe', array( $this, 'wpf_embediframe' ));

	}


	/*--------------------------------------------------------------------------------------
	*
	* wpf_embed
	*
	* @package WP Foundation
	* @since 2.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_embediframe($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => 'widescreen' // regular | vimeo
		), $atts));
	
		$content = str_replace("&#8243;", "\"", $content);

		$content = str_replace("&#8221;", "\"", $content);
		
		$content = str_replace("//", "http://", $content);
		
		//die(html_entity_decode(htmlspecialchars_decode($content, ENT_QUOTES) ));
		return '<div class="flex-video ' . $type . '">' . do_shortcode( htmlspecialchars_decode( html_entity_decode($content) ) ) . '</div>';
	}	
	
}

new WPFoundationProShortcodes();
?>