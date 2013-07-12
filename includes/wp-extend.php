<?php
/**
 * WP-Extend
 *
 * A list of functions that essentially extend wordpress core functionality
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7
 */
 
/**
 * is_blog
 *
 * A simple method that lets us know if were on a blog page or not
 *
 * @return bool
 * @since 0.7
 */
function is_blog () {
	global $post;

	$posttype = get_post_type($post);
	
	return ( ((is_archive()) || (is_search()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}


/**
 * get_page_by_slug
 *
 * A simple method that lets us know if were on a blog page or not.. c'mon wp?
 *
 * @return bool
 * @since 1.0
 */
function get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page' ) {
    global $wpdb;
    $page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s", $page_slug, $post_type ) );
    if ( $page )
            return get_page($page, $output);
    return null;
}

?>