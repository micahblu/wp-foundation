<?php get_header(); ?>
  <div class="row">
    <div class="medium-9 columns">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			  <h1><?php the_title(); ?></h1>
			  <?php the_content(); ?>
			<?php endwhile; wp_reset_query(); ?>

			<?php comments_template( '', true ); ?>
		</div><!-- .medium-9 columns -->

    <div class="medium-3 columns">
      <?php get_sidebar(); ?>
    </div><!-- .medium-3 columns -->
  </div><!-- .row -->
<?php get_footer(); ?>