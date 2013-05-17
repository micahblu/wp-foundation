<?php
/*
 * Customize the output of page list for Foundation nav classes in main_nav_fb
 *
 * @package WordPress
 * @subpackage wp foundation
 * @since wp foundation 0.7
*/
class wp_foundation_walker_nav_menu extends Walker_Nav_Menu {
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active button' : 'button';
        $element->classes[] = ($element->has_children) ? 'dropdown button' : 'button';
		
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }	
	
    function start_el(&$output, $item, $depth, $args) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);	
		
        $classes = empty($item->classes) ? array() : (array) $item->classes;	
 
        if(in_array('has-flyout', $classes) && $depth == 0) {
            $item_html = str_replace('</a>', '</a><a class="flyout-toggle" href="#"><span> </span></a>', $item_html);
        }
		
        $output .= $item_html;
    }
 
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"sub-menu flyout\">\n";
    }
    
} // end nav bar walker

class page_walker extends Walker_Page {
    
    function start_el(&$output, $page, $depth, $args, $current_page) {
        $item_html = '';
    	parent::start_el($item_html, $page, $depth, $args, $current_page);
    	
    	$css_class = array('page_item', 'page-item-'.$page->ID);
    	
        if ( $args['has_children'] ) {
            $css_class[] = 'has-flyout';
        }
               
        $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
        
        $item_html = '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
 
        $output .= $item_html;
    }
 
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<a href=\"#\" class=\"flyout-toggle\"><span> </span></a><ul class=\"flyout $this->flyout_dir\">\n";
    }	
 
} // end page walker
?>