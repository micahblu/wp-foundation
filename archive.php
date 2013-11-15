<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7 
 */

get_header(); ?>

	<div id="main" class="large-8 columns" role="main">

	<?php if ( have_posts() ) : ?>
		<header class="archive-header">
			<h1 class="archive-title"><?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'wp-foundation' ), '<span>' . get_the_date() . '</span>' );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'wp-foundation' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wp-foundation' ) ) . '</span>' );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'wp-foundation' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wp-foundation' ) ) . '</span>' );
				else :
					_e( 'Archives', 'wp-foundation' );
				endif;
			?></h1>
		</header><!-- .archive-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();
			/* Include the post format-specific template for the content. If you want to
			 * this in a child theme then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );
		endwhile;
		?>

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
	
	<?php wp_foundation_paginate(); ?>
	</div><!-- .large-8 .columns -->
	
	<div id="sidebar" class="large-4 columns">
		<?php get_sidebar(); ?>
	</div><!-- .large-4 .columns -->

<?php get_footer();