<?php
/**
 * The template for displaying a single page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage wp foundation
 * @since wp foundation 0.7
 */

get_header(); ?>

	<div class="row">
		<div class="large-8 columns">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- .large-8 .columns -->
	
		<div class="large-4 columns">
			<?php get_sidebar(); ?>
		</div><!-- .large-4 .columns -->
	</div><!-- .row -->
	
<?php get_footer(); ?>