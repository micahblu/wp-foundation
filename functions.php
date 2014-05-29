<?php

include "includes/WPFMenuWalker.php";
include "includes/LayoutFactory.php";

// global layout vars
$content_columns = 'medium-8';
$sidebar_columns = 'medium-4';

//register menus
register_nav_menus( array(
  'main_menu' => 'Main Menu',
  'footer_menu' => 'Footer Menu'
) );

if ( function_exists( 'add_theme_support' ) ):
  add_theme_support( 'menus' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
endif;

if ( function_exists('register_sidebars') ):
  register_sidebar(array(
    'name'=>'Sidebar',
    'before_title'=>'<h4>',
    'after_title'=>'</h4>'
  ));
endif;

add_editor_style( 'editor-style.css' );

function wpf_scripts() {
  wp_enqueue_style('foundation', get_template_directory_uri() . '/stylesheets/main.css' );
  wp_enqueue_script('modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('foundation-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array('jquery', 'modernizr'), '1.0.0', true);
  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'foundation-js'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'wpf_scripts');

?>
