<?php
/**
 * Widgets
 *
 * All theme sidebars and widgets are registered here
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0	
 */
 
/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since  1.0
 * @access private
 *
 * @return null
 */
function wp_foundation_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'wp-foundation' ),
		'id' => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title"><small>',
		'after_title' => '</small></h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'wp-foundation' ),
		'id' => 'page-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title"><small>',
		'after_title' => '</small></h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Widget Left', 'wp-foundation' ),
		'id' => 'home-widget-left',
		'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="home-widget-title">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home Widget Center', 'wp-foundation' ),
		'id' => 'home-widget-center',
		'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="home-widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Widget Right', 'wp-foundation' ),
		'id' => 'home-widget-right',
		'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="home-widget-title">',
		'after_title' => '</h2>',
	) );

}
add_action( 'widgets_init', 'wp_foundation_widgets_init' );

// load any additional widgets
require dirname( __FILE__ ) . '/widgets/hw-image-widget/hw-image-widget.php';
?>