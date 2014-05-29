<?php get_header(); ?>
  <div class="row">
    <div class="<?php echo $content_columns; ?> columns">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			  <h1><?php the_title(); ?></h1>
			  <?php the_content(); ?>
			<?php endwhile; wp_reset_query(); ?>

			<?php comments_template( '', true ); ?>
		</div><!-- .<?php echo $content_columns; ?> columns -->

    <div class="<?php echo $sidebar_columns; ?> columns">
      <?php get_sidebar(); ?>
    </div><!-- .<?php echo $sidebar_columns; ?> columns -->
  </div><!-- .row -->
<?php get_footer(); ?>