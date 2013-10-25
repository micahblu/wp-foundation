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

class WPFoundationShortcodes {

	function __construct() {
		add_action( 'init', array( $this, 'add_shortcodes' ) );
	}


	/*-------------------------------------------------------------------------------------
	*
    * add_shortcodes
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function add_shortcodes() {

		add_shortcode('button', array( $this, 'wpf_button' ));
		add_shortcode('alert', array( $this, 'wpf_alert' ));
		add_shortcode('row', array( $this, 'wpf_row' ));
		add_shortcode('column', array( $this, 'wpf_column' ));
		add_shortcode('panel', array( $this, 'wpf_panel' ));
		add_shortcode('label', array( $this, 'wpf_label' ));
		add_shortcode('line', array( $this, 'wpf_line' ));
		
	}


	/*--------------------------------------------------------------------------------------
	*
	* wpf_button
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_button($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"size" => '',
			"link" => '',
			"style" => 'radius',
			"target" => '_self'
		), $atts));
		return '<a href="' . $link . '" target="' . $target . '" class="button ' . $size . ' ' . $type . ' ' . $style . '">' . do_shortcode( $content ) . '</a>';
	}
  
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_alert
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_alert($atts, $content = null) {
	 extract(shortcode_atts(array(
	    "type" => '',
	    "close" => true
	 ), $atts));
	 return '<div data-alert class="alert-box ' . $type . '">' . do_shortcode( $content ) . '<a href="" class="close">&times;</a></div>';
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_code
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_code($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"size" => '',
			"link" => ''
		), $atts));
		return '<pre><code>' . do_shortcode( $content ) . '</code></pre>';
	}
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_row
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_row( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"addclass" => '',
		  "addid" => ''
		), $atts));
		 
		$content = do_shortcode($content);
		
		return '<div' . (isset($addid) ? ' id="' . $addid . '"' : '') . 'class="row' . (isset($addclass) ? ' ' . $addclass : '') . '">' . $content . '</div>';
			
	}
	

	/*--------------------------------------------------------------------------------------
	*
	* wpf_column 
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_column( $atts, $content = null ) {
		extract(shortcode_atts(array(
		  "size" => 'large',
		  "offset" => '',
		  "span" => '12',
		  "addclass" => ''
		), $atts));
		
		return '<div class="' . $size . '-' . $span . (!empty($offset) ? ' offset-' . $offset : '') . ' columns ' . $addclass . '">' . do_shortcode( $content ) . '</div>';
	
	}
		
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_label
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_label( $atts, $content = null ) {
		extract(shortcode_atts(array(
		  "type" => '',
		  "style" => ''
		), $atts));
		
		return '<span class="' . $type . ' ' . $style . ' label">' . do_shortcode( $content ) . '</span>';

	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_code
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_line($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"size" => '',
			"link" => ''
		), $atts));
		return '<hr />';
	}
		
	/*--------------------------------------------------------------------------------------
	*
	* wpf_table
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_table( $atts ) {
	  extract( shortcode_atts( array(
	      'cols' => 'none',
	      'data' => 'none',
	      'type' => 'type'
	  ), $atts ) );
	  $cols = explode(',',$cols);
	  $data = explode(',',$data);
	  $total = count($cols);
	  $output = '';
	  $output .= '<table class="'. $type .'"><tr>';
	  foreach($cols as $col):
	      $output .= '<th>'.$col.'</th>';
	  endforeach;
	  $output .= '</tr><tr>';
	  $counter = 1;
	  foreach($data as $datum):
	      $output .= '<td>'.$datum.'</td>';
	      if($counter%$total==0):
	          $output .= '</tr>';
	      endif;
	      $counter++;
	  endforeach;
	      $output .= '</table>';
	  return $output;
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_panel
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_panel( $atts, $content = null ) {
	  extract(shortcode_atts(array(
	    "type" => '',
	    "style" => ''
	  ), $atts));
	
	  return '<div class="panel ' . $type . ' ' . $style . '">' . do_shortcode( $content ) . '</div>';
	}
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_tabs
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_tabs( $atts, $content = null ) {
	
		if( isset($GLOBALS['tabs_count']) )
			$GLOBALS['tabs_count']++;
		else
			$GLOBALS['tabs_count'] = 0;
		
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
			$output .= '<dl class="tabs" id="custom-tabs-'. rand(1, 100) .'">';
		
			$i = 0;
			foreach( $tab_titles as $tab ){
			if($i == 0)
			  $output .= '<dd class="active">';
			else
			  $output .= '<dd>';
			
			$output .= '<a href="#custom-tab-' . $GLOBALS['tabs_count'] . '-' . sanitize_title( $tab[0] ) . '" data-toggle="tab">' . $tab[0] . '</a></dd>';
			$i++;
		}
		
		$output .= '</dl>';
		$output .= '<ul class="tabs-content">';
		$output .= do_shortcode( $content );
		$output .= '</ul>';
		} else {
			$output .= do_shortcode( $content );
		}
	
	return $output;
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_tab
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_tab( $atts, $content = null ) {
		
		if( !isset($GLOBALS['current_tabs']) ) {
			$GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
			$state = 'active';
		} else {
			
			if( $GLOBALS['current_tabs'] == $GLOBALS['tabs_count'] ) {
				$state = '';
			} else {
				$GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
				$state = 'active';
			}
		}
		
		$defaults = array( 'title' => 'Tab');
		extract( shortcode_atts( $defaults, $atts ) );
			
		return '<li id="custom-tab-' . $GLOBALS['tabs_count'] . '-'. sanitize_title( $title ) .'" class="' . $state . '">'. do_shortcode( $content ) .'</li>';
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_collapsibles
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_collapsibles( $atts, $content = null ) {
		
		if( isset($GLOBALS['collapsibles_count']) )
			$GLOBALS['collapsibles_count']++;
		else
		  	$GLOBALS['collapsibles_count'] = 0;
		
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/collapse title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
			$output .= '<div class="accordion" id="accordion-' . $GLOBALS['collapsibles_count'] . '">';
			$output .= do_shortcode( $content );
			$output .= '</div>';
		} else {
		 	$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wpf_collapse
	*
	* @package WP Foundation
	* @since WP Foundation 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wpf_collapse( $atts, $content = null ) {
	
		if( !isset($GLOBALS['current_collapse']) )
		  $GLOBALS['current_collapse'] = 0;
		else
		  $GLOBALS['current_collapse']++;
		
		
		$defaults = array( 'title' => 'Tab', 'state' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		if (!empty($state))
		  $state = 'in';
		
		return '
		<div class="accordion-group">
		<div class="accordion-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['collapsibles_count'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'">
		' . $title . '
		</a>
		</div>
		<div id="collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'" class="accordion-body collapse ' . $state . '">
		<div class="accordion-inner">
		' . $content . '
		</div>
		</div>
		</div>
		';
	}

}

new WPFoundationShortcodes();

?>