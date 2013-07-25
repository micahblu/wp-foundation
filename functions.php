<?php
/**
 * WP Foundation 
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7
 */
 
if ( ! isset( $content_width ) ) $content_width = 1000;

//before we go any further let's add our wordpress extension methods
require dirname( __FILE__ ) . '/includes/wp-extend.php';
require dirname( __FILE__ ) . '/includes/widgets.php';
require dirname( __FILE__ ) . '/includes/orbit-carousel-slider.php';	
require dirname( __FILE__ ) . '/includes/foundation-shortcodes.php';
require dirname( __FILE__ ) . '/includes/pro-shortcodes.php';
require dirname( __FILE__ ) . '/lib/prism/prism.php';

/** 
 * Globally Declare our Theme Options if they exist
 * ------------------------------------------------------------------------------- */
$optionsframework_settings = get_option('optionsframework');

$theme = wp_get_theme();

$template = $theme->template;

// Gets the unique option id
if( !empty($template) ) $option_name = $template;

elseif ( isset( $optionsframework_settings['id'] ) ) $option_name = $optionsframework_settings['id'];	

else $option_name = 'optionsframework';

//our global options variable
$wp_foundation_options = get_option($option_name);

/**
 * Sets up Theme Options
 *
 * @since 0.7
 * @access private
 *
 * @return null
 */
function wp_foundation_setup() {
	
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/lib/' );
		require_once dirname( __FILE__ ) . '/lib/options-framework.php';
	}
	
	// Add native Wordpress Theme support
	add_theme_support( 'menus' ); 
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_theme_support( 'automatic-feed-links' );
	
	// Add our custom Foundation Menu Walker
	include get_template_directory() . '/lib/FoundationMenuWalker.php';
	include get_template_directory() . '/lib/FoundationTopBarMenuWalker.php';
	
	
	// add theme support for woocommerce
	add_theme_support( 'woocommerce' );
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'wp_foundation_wc_content_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'wp_foundation_wc_content_wrapper_end', 10);	
	
}

function wp_foundation_wc_content_wrapper_start() {
  echo '<div class="large-8 columns">';
}

function wp_foundation_wc_content_wrapper_end() {
  echo '</div>';
}


add_action("after_setup_theme", "wp_foundation_setup");

/**
 * Queue our javascript and css.
 *
 * @since 0.7
 * @access private
 *
 *
 * @return null
 */
function wp_foundation_enqueue_scripts() {

	// styles	
	wp_enqueue_style('foundation-core', get_stylesheet_directory_uri() . '/css/foundation.css', false);
	
	wp_enqueue_style('core', get_stylesheet_directory_uri() . '/style.css', false); 
	
	//wp_register_style('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,800,600');
  //wp_enqueue_style('open-sans' );
	
	// scripts
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/js/vendor/custom.modernizr.js', null, null, true);
	
	// deregister wp's jquery as we want to use the version that has been tested with and comes with foundation
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_stylesheet_directory_uri() . '/js/vendor/jquery.js', null, null, true);
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('foundation-js', get_stylesheet_directory_uri() . '/js/foundation.min.js', null, null, true);
	
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

}

add_action( 'wp_enqueue_scripts', 'wp_foundation_enqueue_scripts' );

/**
 * Insert Theme Option Styles in the header that will override style.css
 *
 * @since  1.0
 * @access private
 *
 * @return null
 */
function wp_foundation_head(){

	global $wp_foundation_options;
	?>
	<style type="text/css">
	/* Custom Theme Styles */
	body{
	
		<?php if(!empty($wp_foundation_options["background"]["image"]) or !empty($wp_foundation_options["background"]["color"])) : ?>
			
		background: <?php echo (!empty($wp_foundation_options["background"]["image"]) ? "url(".$wp_foundation_options["background"]["image"].") " . $wp_foundation_options["background"]["position"] . " " . $wp_foundation_options["background"]["repeat"] : $wp_foundation_options["background"]["color"]); ?>;
		<?php endif; ?>
		
		<?php if(!empty($wp_foundation_options["background"]["attachment"])) : ?>
		background-attachment: <?php echo $wp_foundation_options["background"]["attachment"] == "fixed" ? "fixed" : "scroll" ?>;
		<?php endif; ?>
		
		<?php if(!empty($wp_foundation_options["typography"]["face"])) : ?>
		font-family: <?php echo $wp_foundation_options["typography"]["face"]; ?>;
		<?php endif; ?>
				
		<?php if(!empty($wp_foundation_options["typography"]["style"])) : ?>
		font-weight: <?php echo $wp_foundation_options["typography"]["style"]; ?>;
		<?php endif; ?>
		
		<?php if(!empty($wp_foundation_options["typography"]["color"])) : ?>
		color: <?php echo $wp_foundation_options["typography"]["color"]; ?>;
		<?php endif; ?>
	}
	
	p{
		<?php if(!empty($wp_foundation_options["typography"]["size"])
				  && !is_array($wp_foundation_options["typography"]["size"])) : ?>
		font-size: <?php echo $wp_foundation_options["typography"]["size"]; ?>;
		<?php endif; ?>
	}
	
	<?php if(!empty($wp_foundation_options["global_link_color"])) : ?>
	a, a:visited{
		color: <?php echo $wp_foundation_options["global_link_color"]; ?>;
	}
	<?php endif; ?>
	
	</style>
	<?php 
}

/**
 * Insert Footer Scripts
 *
 * The scripts here are added from theme options for code the 
 * user needs to add before the end of </body>. i.e. google analytics code
 *
 * @since  1.0
 * @access private
 *
 * @return null
 */
function wp_foundation_footer(){
	global $wp_foundation_options;
	
	if(!empty($wp_foundation_options["footer_scripts"])) echo $wp_foundation_options["footer_scripts"];
}

add_action("wp_head", "wp_foundation_head");
add_action("wp_footer", "wp_foundation_footer");

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * @since  1.0
 * @access private
 *
 * @return null
 */
function wp_foundation_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'wp-foundation' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'wp-foundation' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wp-foundation' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'wp-foundation' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'wp-foundation' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'wp-foundation' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}


remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
add_filter( 'the_content', 'youtube_url_to_embed'); 

/** 
	* Convert YouTu.be URLs into their full length counterparts 
	* 
	* @param string $url A URL, maybe with youtu.be in it 
	* @return string A URL, with any YouTube URL expanded 
	*/ 

function youtube_url_to_embed( $content ) { 
	
	preg_match_all("/http:\/\/youtu.be\/(.*)/i", $content, $matches);
	
	if(isset($matches[0][0])){
		$yturl = trim(strip_tags($matches[0][0]));
	}
	if(!empty($yturl)){
	
		$ytID = str_replace("http://youtu.be/", "", $yturl);
	
		return str_replace($yturl, '<div class="flex-video widescreen"><iframe width="420" height="315" src="http://www.youtube.com/embed/' . $ytID . '" frameborder="0" allowfullscreen></iframe></div>', $content);
	}else{
		return $content;
	}
} 

/** 
	* Apply do_shortcode to widget text
	* 
	* @param string $url A URL, maybe with youtu.be in it 
	* @return string A URL, with any YouTube URL expanded 
	*
	* @since 1.0
	* @param string
	*/ 

function apply_shortcode_to_widget_text($content){
	return do_shortcode(nl2br($content));
}

add_filter("widget_text", "apply_shortcode_to_widget_text");

?>