<?php

//add_theme_support('menus'); 

/*
http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
*/
register_nav_menus( array(
	'main-menu' => 'Main Menu' // registers the menu in the WordPress admin menu editor
) );


/* 
http://codex.wordpress.org/Function_Reference/wp_nav_menu 
*/
function foundation_nav_bar() {
    wp_nav_menu(array( 
        'container' => false,             // remove menu container
        'container_class' => '',          // class of container
        'menu' => '',                     // menu name
        'menu_class' => 'nav-bar right button-group',        // adding custom nav class
        'theme_location' => 'main-menu',  // where it's located in the theme
        'before' => '',                   // before each link <a>
        'after' => '',                    // after each link </a>
        'link_before' => '',              // before each link text
        'link_after' => '',               // after each link text
        'depth' => 1,                     // limit the depth of the nav
    	'fallback_cb' => 'main_nav_fb',   // fallback function (see below)
        'walker' => new nav_walker()      // walker to customize menu (see foundation-nav-walker)
	));
}


/*
http://codex.wordpress.org/Template_Tags/wp_list_pages
*/
function main_nav_fb() {
	echo '<ul class="nav-bar right button-group">';
	wp_list_pages(array(
		'depth'        => 0,
		'child_of'     => 0,
		'exclude'      => '',
		'include'      => '',
		'title_li'     => '',
		'echo'         => 1,
		'authors'      => '',
		'sort_column'  => 'menu_order, post_title',
		'link_before'  => '',
		'link_after'   => '',
		'walker'       => new page_walker(),
		'post_type'    => 'page',
		'post_status'  => 'publish' 
	));
	echo '</ul>';
}

/* 
Customize the output of menus for Foundation nav classes and add descriptions

http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
http://code.hyperspatial.com/1514/twitter-bootstrap-walker-classes/ 
*/
class nav_walker extends Walker_Nav_Menu {
	
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
	
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
		  
		$classes[] = ($item->current) ? 'active' : '';
        $classes[] = ($args->has_children) ? 'has-flyout' : '';

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args ) );
        $class_names = strlen(trim($class_names)) > 0 ? ' class="'.esc_attr($class_names).'"' : '';

        $output .= $indent.'<li id="menu-item-'.$item->ID.'"'.$value.$class_names.'>';

        $attributes  = !empty($item->attr_title)  ? ' title="' .esc_attr($item->attr_title).'"' : '';
        $attributes .= !empty($item->target)      ? ' target="'.esc_attr($item->target    ).'"' : '';
        $attributes .= !empty($item->xfn)         ? ' rel="'   .esc_attr($item->xfn       ).'"' : '';
        $attributes .= !empty($item->url)         ? ' href="'  .esc_attr($item->url       ).'"' : '';
        $attributes .= !empty($item->description) ? ' class="' .esc_attr('has-description').'"' : '';

        $description = !empty($item->description) ? '<span class="menu-item-description">'.esc_attr($item->description).'</span>' : '';

        $item_output  = $args->before;
        $item_output .= '<a'.$attributes.' class="button">';
        $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $description.$args->link_after;
        $item_output .= ($args->has_children && depth == 0) ? '</a><a href="'.$item->url.'" class="flyout-toggle"><span> </span></a>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    function end_el(&$output, $item, $depth) {
        $output .= '</li>'."\n";
    }	
    function start_lvl(&$output, $depth) {
        $indent  = str_repeat("\t", $depth);
        $output .= "\n".$indent.'<ul class="sub-menu flyout">'."\n";
    }
    function end_lvl(&$output, $depth) {
        $indent  = str_repeat("\t", $depth);
        $output .= $indent.'</ul>'."\n";
    }		
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if(is_object($args[0])) {
            $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }  	
} /* end nav walker */



/*
Customize the output of page list for Foundation nav classes in main_nav_fb

http://forrst.com/posts/Using_Short_Page_Titles_for_wp_list_pages_Wordp-uV9
*/
class page_walker extends Walker_Page {
    function start_el(&$output, $page, $depth, $args, $current_page) {
		
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        extract($args, EXTR_SKIP);
        $classes = array('page_item', 'page-item-'.$page->ID);
        if (!empty($current_page)) {
            $_current_page = get_page( $current_page );
        if (isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
            $classes[] = 'current_page_ancestor';
        if ($page->ID == $current_page)
            $classes[] = 'current_page_item active';
        elseif ($_current_page && $page->ID == $_current_page->post_parent)
            $classes[] = 'current_page_parent';
        } elseif ($page->ID == get_option('page_for_posts') ) {
            $classes[] = 'current_page_parent';
        }
        if (get_children($page->ID))
            $classes[] = 'has-flyout';
		
        $classes = implode(' ', apply_filters('page_css_class', $classes, $page));
		
        $output .= $indent.'<li class="'.$classes.'">';
        $output .= '<a class="button" href="'.get_page_link($page->ID).'" title="'.esc_attr(wp_strip_all_tags($page->post_title)).'">';
        $output .= $args['link_before'].$page->post_title.$args['link_after'];
        $output .= '</a>';
    }
    function end_el(&$output, $item, $depth) {
        $output .= "</li>\n";
    }
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu flyout\">\n";
    }
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent</ul>\n";
    }
} /* end page walker */
?>