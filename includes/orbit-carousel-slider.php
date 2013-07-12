<?php
/**
 * WP Foundation Orbit Carousel Slider
 * 
 * Sets up the "slides" custom post type to be used with the orbit carousel slider
 * 
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0
 */
 
function wp_foundation_carousel_slides_init() {

  $labels = array(
    'name' => 'Slides',
    'singular_name' => 'Slide',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Slide',
    'edit_item' => 'Edit Slide',
    'new_item' => 'New Slide',
    'all_items' => 'All Slides',
    'view_item' => 'View Slide',
    'search_items' => 'Search Slides',
    'not_found' =>  'No Slides found',
    'not_found_in_trash' => 'No Slides found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Slides'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'slide' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => 20,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes')
  ); 

  register_post_type( 'slide', $args );
  
  add_theme_support( 'post-thumbnails', array( 'post', 'slide' ) );
}

/**
* add order column to admin listing screen for header text
*/
function add_new_header_text_column($header_text_columns) {
  $header_text_columns['menu_order'] = "Order";
  return $header_text_columns;
}
add_filter('manage_edit-slide_columns', 'add_new_header_text_column');

/**
* show custom order column values
*/
function show_order_column($name){
  global $post;

  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_slide_posts_custom_column','show_order_column');

add_action( 'init', 'wp_foundation_carousel_slides_init' );

?>