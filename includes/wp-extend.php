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

	$posttype = 'post';
	$posttype =  get_post_type($post);
	
	if($posttype == '') $posttype = 'post'; // default to post if we get an empty result

	return ( ((is_archive()) || (is_search_page()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

/**
 * is_search_page
 *
 * Acts much as is_search() except this method will return true even if there are no search results
 *
 * @return bool
 * @since 1.0
 */
function is_search_page(){
	if(is_search() || isset($_GET['s'])){
		return true;
	}else{
		return false;
	}
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