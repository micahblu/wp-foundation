<?php
/**
 * WP Launchpad Custom shortcodes 
 * 
 * HTML/CSS shortcodes mostly based on Foundation 3 framework
 * 
 * @package wp_launchpad
 * @since wp_launchpad 1.0
 */


class WPLaunchpadShortcodes {

	function __construct() {
		add_action( 'init', array( $this, 'add_shortcodes' ) );
	}


	/*-------------------------------------------------------------------------------------
	*
    * add_shortcodes
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function add_shortcodes() {
	
		add_shortcode('button', array( $this, 'wplp_button' ));
		add_shortcode('alert', array( $this, 'wplp_alert' ));
		add_shortcode('code', array( $this, 'wplp_code' ));
		add_shortcode('span', array( $this, 'wplp_span' ));
		add_shortcode('row', array( $this, 'wplp_row' ));
		add_shortcode('label', array( $this, 'wplp_label' ));
		add_shortcode('badge', array( $this, 'wplp_badge' ));
		add_shortcode('icon', array( $this, 'wplp_icon' ));
		add_shortcode('icon_white', array( $this, 'wplp_icon_white' ));
		add_shortcode('table', array( $this, 'wplp_table' ));
		add_shortcode('collapsibles', array( $this, 'wplp_collapsibles' ));
		add_shortcode('collapse', array( $this, 'wplp_collapse' ));
		add_shortcode('panel', array( $this, 'wplp_panel' ));
		add_shortcode('tabs', array( $this, 'wplp_tabs' ));
		add_shortcode('tab', array( $this, 'wplp_tab' ));
	}

	


	/*--------------------------------------------------------------------------------------
	*
	* wplp_button
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_button($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"size" => '',
			"link" => '',
			"style" => 'radius'
		), $atts));
		return '<a href="' . $link . '" class="button ' . $size . ' ' . $type . ' ' . $style . '">' . do_shortcode( $content ) . '</a>';
	}
  

	/*--------------------------------------------------------------------------------------
	*
	* wplp_alert
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_alert($atts, $content = null) {
	 extract(shortcode_atts(array(
	    "type" => '',
	    "close" => true
	 ), $atts));
	 return '<div class="alert ' . $type . '">' . do_shortcode( $content ) . '<a href="" class="close">&times;</a></div>';
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_code
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_code($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"size" => '',
			"link" => ''
		), $atts));
		return '<pre><code>' . do_shortcode( $content ) . '</code></pre>';
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_span
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_span( $atts, $content = null ) {
		extract(shortcode_atts(array(
		  "size" => 'size'
		), $atts));
		
		return '<div class="span' . $size . '">' . do_shortcode( $content ) . '</div>';
	
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_row
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_row( $atts, $content = null ) {
	
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_label
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_label( $atts, $content = null ) {
		extract(shortcode_atts(array(
		  "type" => '',
		  "style" => ''
		), $atts));
		
		return '<span class="' . $type . ' ' . $style . ' label">' . do_shortcode( $content ) . '</span>';

	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_badge
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_badge($atts, $content = null){
		extract(shortcode_atts(array(
			"css" => ''
		), $atts));
		
		return '<div class="label round" style="' . $css . '">' . do_shortcode( $content ) . '</div>';
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_icon
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_icon( $atts, $content = null ) {
		extract(shortcode_atts(array(
		  "type" => 'type'
		), $atts));
		
		return '<i class="icon icon-' . $type . '"></i>';
	
	}
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_icon_white
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_icon_white( $atts, $content = null ) {
		extract(shortcode_atts(array(
		  "type" => 'type'
		), $atts));
		
		return '<i class="icon icon-' . $type . ' icon-white"></i>';
	
	}
	
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_table
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_table( $atts ) {
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
	* wplp_panel
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_panel( $atts, $content = null ) {
	  extract(shortcode_atts(array(
	    "type" => '',
	    "style" => ''
	  ), $atts));
	
	  return '<div class="panel ' . $type . ' ' . $style . '">' . do_shortcode( $content ) . '</div>';
	}
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	* wplp_tabs
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_tabs( $atts, $content = null ) {
	
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
	* wplp_tab
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_tab( $atts, $content = null ) {
		
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
	* wplp_collapsibles
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_collapsibles( $atts, $content = null ) {
		
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
	* wplp_collapse
	*
	* @package wp_launchpad
	* @since wp_launchpad 1.0
	*
	*-------------------------------------------------------------------------------------*/
	function wplp_collapse( $atts, $content = null ) {
	
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

new WPLaunchpadShortcodes();

?>