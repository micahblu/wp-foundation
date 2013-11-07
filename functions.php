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
require dirname( __FILE__ ) . '/lib/prism/prism.php';


/**
 * Pagination
 *
 * @since 1.0
 * @access private
 * @return null
 */
function wp_foundation_paginate(){
	global $wp_query;
	die(__LINE__ . " page " . $_SERVER['PHP_SELF']);
	$big = 999999999; // need an unlikely integer
	
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	) );
}

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
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
		require_once dirname( __FILE__ ) . '/inc/options-framework.php';
	}

	// Add native Wordpress Theme support
	add_theme_support( 'menus' ); 
	/* add_theme_support( 'post-thumbnails', array( 'post', 'page' ) ); ! was conflicting w/woocommerce set featured image */
	add_theme_support( 'post-thumbnails' );
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
	wp_enqueue_style('foundation-core', get_template_directory_uri() . '/css/foundation.css', false);
	wp_enqueue_style('core', get_stylesheet_directory_uri() . '/style.css', false); 
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/custom.modernizr.js', null, null, true);
	wp_enqueue_script('jquery');
	wp_enqueue_script('foundation-js', get_template_directory_uri() . '/js/foundation.min.js', null, null, true);
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
	
	$background = of_get_option('body_background');
	$header     = of_get_option('header_font');
	$subheader  = of_get_option('sub_header_font');
	$paragraph  = of_get_option('paragraph');
	$linkcolor  = of_get_option('global_link_color');

	echo "<style type=\"text/css\">\n";
	echo "/* Custom Theme Styles */\n";
	echo "body{\n";
		if(!empty($background["image"]) or !empty($background["color"])) :
			echo "background:" . (!empty($background["image"]) ? "url(".$background["image"].") " . $background["position"] . " " . $background["repeat"] : $background["color"]) . ";";
		endif;
			
		if(!empty($background["attachment"])) :
			echo "background-attachment:" . ($background["attachment"] == "fixed" ? "fixed" : "scroll") . ";";
		endif;

		if(!empty($background["size"])) :
			echo "background-size:" . $background["size"]  . ";";
		endif;
	echo "}\n";
	
	echo "h1, .site-title{\n";
		echo (!empty($header["size"]) ? "font-size: " . $header['size'] : '') . ";";
		echo (!empty($header["face"]) ? "font-family: " . $header['face'] : '') . ";";
		echo (!empty($header["style"]) ? "font-weight: " . $header['style'] : '') . ";";
		echo (!empty($header["color"]) ? "color: " . $header['color'] : '') . ";";
	echo "}\n";

	echo ".subheader{\n";
		echo (!empty($subheader["size"]) ? "font-size: " . $subheader['size'] : '') . ";";
		echo (!empty($subheader["face"]) ? "font-family: " . $subheader['face'] : '') . ";";
		echo (!empty($subheader["style"]) ? "font-weight: " . $subheader['style'] : '') . ";";
		echo (!empty($subheader["color"]) ? "color: " . $subheader['color'] : '') . ";";
	echo "}\n";

	echo "p{\n";
			echo (!empty($paragraph["size"]) ? "font-size: " . $paragraph['size'] : '') . ";";
			echo (!empty($paragraph["face"]) ? "font-family: " . $paragraph['face'] : '') . ";";
			echo (!empty($paragraph["style"]) ? "font-weight: " . $paragraph['style'] : '') . ";";
			echo (!empty($paragraph["color"]) ? "color: " . $paragraph['color'] : '') . ";";
	echo "}\n";
	
	if(!empty($linkcolor)) :
		echo "a, a:visited{\n";
		echo "color:" . $linkcolor . ";";
		echo "}\n";
	endif;

	echo "</style>\n";
	
	do_action("wp_foundation_head");
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
		
	$footer_scripts = of_get_option('footer_scripts');
	?>
	<script>
	 <?php if(!empty($footer_scripts)) echo  $footer_scripts ?>

	 (function($){ 	
			// buffer class to wordpress generated inputs where id=submit. i.e. commment submit button
			$("input[id=submit]").addClass("button"); 

	    $(document).foundation('topbar', {stickyClass: 'sticky-topbar'});
  	})(jQuery);
	</script>
<?php }

add_action("wp_head", "wp_foundation_head");
add_action("wp_footer", "wp_foundation_footer", 999); //put a late priority to ensure dependencies have been added

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