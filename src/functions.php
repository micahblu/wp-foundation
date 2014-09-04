<?php
/**
 * wp-foundation functions and definitions
 *
 * @package wp-foundation
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wp_foundation_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_foundation_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wp-foundation, use a find and replace
	 * to change 'wp-foundation' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wp-foundation', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	include "inc/WPFMenuWalker.php";

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
	  'primary' => __( 'Primary Menu', 'wp-foundation' ),
	  'footer' => __( 'Footer Menu', 'wp-foundation' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wp_foundation_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * WooCommerce Support
	 */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'wp_foundation_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'wp_foundation_wrapper_end', 10);

	function wp_foundation_wrapper_start() {
	  echo '<section id="main" class="row">';
	  echo '	<div class="large-12 columns">';
	}

	function wp_foundation_wrapper_end() {
		echo '	</div>';
	  echo '</section>';
	}

	add_theme_support( 'woocommerce' );
}
endif; // wp_foundation_setup
add_action( 'after_setup_theme', 'wp_foundation_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wp_foundation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wp-foundation' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wp_foundation_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_foundation_scripts() {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'wp-foundation-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wp-foundation-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('foundation-js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery', 'modernizr'), '1.0.0', true);
	
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'foundation-js'), '1.0.0', true);


add_action('wp_enqueue_scripts', 'wpf_scripts');


	wp_enqueue_script( 'wp-foundation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_foundation_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
