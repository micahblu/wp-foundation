<?php
/**
 * Functions.php
 *
 * This file acts as a bootstrap for our theme's functions, hooks and filters
 *
 */

/**
 * Error reporting
 * Set true for development or false for live versions
 */
error_reporting(true);
ini_set("display_errors", true);

//before we go any further let's add our wordpress extension methods
require dirname( __FILE__ ) . '/lib/extends.php';

/** 
 * Globally Declare our Theme Options if they exist
 * ------------------------------------------------------------------------------- */
 
$optionsframework_settings = get_option('optionsframework');

$theme = wp_get_theme();
$template = $theme->template;

// Gets the unique option id
if( !empty($template) ){
	$option_name = $template;
}
elseif ( isset( $optionsframework_settings['id'] ) ) {
	$option_name = $optionsframework_settings['id'];
	
}
else {
	$option_name = 'optionsframework';
}

$wp_foundation_options = get_option($option_name);

/**
 * wp_foundation_setup
 *
 */
function wp_foundation_setup() {
	
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/lib/' );
		require_once dirname( __FILE__ ) . '/lib/options-framework.php';
	}
	
	add_theme_support('menus'); 
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
	        'menu_class' => 'button-group left',        // adding custom nav class
	        'theme_location' => 'main-menu',  // where it's located in the theme
	        'before' => '',                   // before each link <a>
	        'after' => '',                    // after each link </a>
	        'link_before' => '',              // before each link text
	        'link_after' => '',               // after each link text
	        'depth' => 2,                     // limit the depth of the nav
	    	'fallback_cb' => 'main_nav_fb',   // fallback function (see below)
	        'walker' => new wp_foundation_walker_nav_menu()      // walker to customize menu (see foundation-nav-walker)
		));
	}
	
	/*
	http://codex.wordpress.org/Template_Tags/wp_list_pages
	*/
	function main_nav_fb() {
		echo '<ul class="nav-bar">';
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
	
	include get_template_directory() . '/includes/foundation-menu-walker.php';
}

add_action("after_setup_theme", "wp_foundation_setup");

function wp_foundation_enqueue_style() {
	wp_enqueue_style( 'foundation-core', get_stylesheet_directory_uri() . '/css/foundation.css', false ); 
	wp_enqueue_style( 'core', get_stylesheet_directory_uri() . '/style.css', false ); 
}

function wp_foundation_enqueue_script() {
	
}

add_action( 'wp_enqueue_scripts', 'wp_foundation_enqueue_style' );
//add_action( 'wp_enqueue_scripts', 'wp_foundation_enqueue_script' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since wp_launchpad 1.0
 */
function wp_foundation_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'wp_foundation' ),
		'id' => 'page-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title"><small>',
		'after_title' => '</small></h1>',
	) );


	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'wp_foundation' ),
		'id' => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title"><small>',
		'after_title' => '</small></h1>',
	) );

}
add_action( 'widgets_init', 'wp_foundation_widgets_init' );

/**
 * wp_foundation_head
 */
function wp_foundation_head(){
	global $wp_foundation_options;
	?>
	<style type="text/css">
	/* Custom Theme Styles */
	body{
		background: <?php echo (!empty($wp_foundation_options["background"]["image"]) ? "url(".$wp_foundation_options["background"]["image"].") " . $wp_foundation_options["background"]["position"] . " " . $wp_foundation_options["background"]["repeat"] : $wp_foundation_options["background"]["color"]); ?>;
		
		background-attachment: <?= $wp_foundation_options["background"]["attachment"] == "fixed" ? "fixed" : "scroll" ?>;
		
		font-family: <?php echo $wp_foundation_options["typography"]["face"]; ?>;
		font-weight: <?php echo $wp_foundation_options["typography"]["style"]; ?>;
		font-size: <?php echo $wp_foundation_options["typography"]["size"]	; ?>;
		color: <?php echo $wp_foundation_options["typography"]["color"]; ?>;
	}
	
	a, a:visited{
		color: <?= $wp_foundation_options["global_link_color"]; ?>;
	}
	</style>
<?php }

function wp_foundation_footer(){
	global $wp_foundation_options;
	
	if(!empty($wp_foundation_options["footer_scripts"])) echo $wp_foundation_options["footer_scripts"];
}

add_action("wp_head", "wp_foundation_head");
add_action("wp_footer", "wp_foundation_footer");
?>