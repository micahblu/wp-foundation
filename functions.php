<?php
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
  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'wpf_scripts');

?>
