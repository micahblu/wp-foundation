<?php

/*
http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
*/
register_nav_menus(array(
    'top-bar-menu' => 'Top Bar'
));
 
 
/*
http://codex.wordpress.org/Function_Reference/wp_nav_menu
*/
 
// the right top bar
function foundation_top_bar_menu() {
	echo '<section class="top-bar-section">';
    wp_nav_menu(array( 
        'container' => false,                           // remove nav container
        'container_class' => '',           		// class of container
        'menu' => '',                      	        // menu name
        'menu_class' => 'right',         	// adding custom nav class
        'theme_location' => 'top-bar-menu',                // where it's located in the theme
        'before' => '',                                 // before each link <a> 
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
    	  'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
	));
	echo '</section>';
} // end right top bar


/*
Customize the output of menus for Foundation top bar classes
*/
 
class top_bar_walker extends Walker_Nav_Menu {
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
        $element->classes[] = ($element->has_children) ? 'has-dropdown' : '';
		
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
    function start_el(&$output, $item, $depth, $args) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);	
		
        $output .= ($depth == 0) ? '<li class="divider"></li>' : '';
		
        $classes = empty($item->classes) ? array() : (array) $item->classes;	
		
        if(in_array('label', $classes)) {
            $output .= '<li class="divider"></li>';
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
        }
		        
				if ( in_array('divider', $classes) ) {
					$item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
				}
		
        $output .= $item_html;
    }
	
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }
    
} // end top bar walker
?>