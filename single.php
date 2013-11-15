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
 * @subpackage WP Foundation
 * @since WP Foundation 0.7
 */

get_header(); ?>

	<div id="main" class="large-8 columns">

		<?php while ( have_posts() ) : the_post();  ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?>
						<span class="meta">
							<?php printf( __('Posted by <a href="%2$s" title="%3$s" rel="author">%4$s</a> %1$s', 'wp-foundation' ),
							esc_html( get_the_date(get_option('date_format')) ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'wp-foundation' ), get_the_author() ) ),
							get_the_author()
							);
							?>
						</span>
					</h1>
				</header>
			</article>
			<?php the_post_thumbnail(get_the_ID()); ?>
				<?php the_content(); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>

	</div><!-- .large-8 .columns -->

	<div id="sidebar" class="large-4 columns">
		<?php get_sidebar(); ?>
	</div><!-- .large-4 .columns -->
	
<?php get_footer();