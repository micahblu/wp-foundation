<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
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
			<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'wp-foundation' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

		<?php if ( tag_description() ) : // Show an optional tag description ?>
			<div class="archive-meta"><?php echo tag_description(); ?></div>
		<?php endif; ?>
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

	<?php else :  ?>
		<?php get_template_part( 'content', 'none' ); ?>
		<?php wp_foundation_paginate(); ?>
	<?php endif; ?>

	</div><!-- .large-8 .columns -->
	
	<div id="sidebar" class="large-4 columns">
		<?php get_sidebar(); ?>
	</div><!-- .large-4 .columns -->

<?php get_footer();