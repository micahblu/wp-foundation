<?php
/**
 * Template Name: Full Width
 *
 * Full width page template, no sidebar
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0
 */

get_header(); ?>

	<div id="main" class="large-12 columns">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part("content", "page"); ?>
			<?php //comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>

	</div><!-- .large-8 .columns -->
	
<?php get_footer();