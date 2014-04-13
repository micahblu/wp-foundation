<?php get_header(); ?>

  <div class="row">
    <div class="<?php echo $content_columns; ?> columns">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <h2>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <?php the_excerpt(); ?>
        <?php endwhile; wp_reset_query(); ?>
      <?php else: ?>
        <h2>No posts found</h2>
      <?php endif; ?>

      <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div class="prev">
          <?php next_posts_link( __( '&larr; Older posts' ) ); ?>
        </div>
        <div class="next">
          <?php previous_posts_link( __( 'Newer posts &rarr;' ) ); ?>
        </div>
      <?php endif; ?>
    </div><!-- .<?php echo $content_columns; ?> columns -->

    <div class="<?php echo $sidebar_columns; ?> columns">
      <?php get_sidebar(); ?>
    </div><!-- .<?php echo $sidebar_columns; ?> columns -->
  </div><!-- .row -->
<?php get_footer(); ?>