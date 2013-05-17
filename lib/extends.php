<?php
/**
 * Extends
 *
 * A list of functions that essentially extent wordpress core functionality
 *
 * @package WordPress
 * @subpackage wp foundation
 * @since wp foundation 0.7
 */
 
/**
 * is_blog
 *
 * A simple method that lets us know if were on a blog page or not.. c'mon wp?
 *
 * @return bool
 * @since 0.7
 */
function is_blog () {
	//die("<h1>asdfasfasdfasdf</h1>");
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}
?>