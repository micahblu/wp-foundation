<?php
/**
 * Functions.php
 *
 * This file acts as a bootstrap for our theme's functions, hooks and filters
 *
 */


if ( ! isset( $content_width ) ) $content_width = 960;

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
	
	// theme supports
	add_theme_support( 'menus' ); 
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_theme_support( 'automatic-feed-links' );
	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
	
	/* Add our custom Foundation Menu Walker */
	include get_template_directory() . '/lib/FoundationMenuWalker.php';
}

add_action("after_setup_theme", "wp_foundation_setup");

function wp_foundation_enqueue_scripts() {
	wp_enqueue_style( 'foundation-core', get_stylesheet_directory_uri() . '/css/foundation.css', false ); 
	wp_enqueue_style( 'core', get_stylesheet_directory_uri() . '/style.css', false ); 
	
	wp_enqueue_script( 'comment-reply' );
}

function wp_foundation_enqueue_script() {
	
}

add_action( 'wp_enqueue_scripts', 'wp_foundation_enqueue_scripts' );


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
		
		background-attachment: <?php echo $wp_foundation_options["background"]["attachment"] == "fixed" ? "fixed" : "scroll" ?>;
		
		font-family: <?php echo $wp_foundation_options["typography"]["face"]; ?>;
		font-weight: <?php echo $wp_foundation_options["typography"]["style"]; ?>;
		font-size: <?php echo $wp_foundation_options["typography"]["size"]	; ?>;
		color: <?php echo $wp_foundation_options["typography"]["color"]; ?>;
	}
	
	a, a:visited{
		color: <?php echo $wp_foundation_options["global_link_color"]; ?>;
	}
	</style>
<?php }

function wp_foundation_footer(){
	global $wp_foundation_options;
	
	if(!empty($wp_foundation_options["footer_scripts"])) echo $wp_foundation_options["footer_scripts"];
}

add_action("wp_head", "wp_foundation_head");
add_action("wp_footer", "wp_foundation_footer");


if ( ! function_exists( 'wp_foundation_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * @since wp-foundation 1.0
 */
function wp_foundation_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'wp_foundation' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'wp_foundation' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wp_foundation' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'wp_foundation' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'wp_foundation' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'wp_foundation' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

?>