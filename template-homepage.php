<?php
/**
 * Template Name: Homepage
 *
 * This is template for the front page, being that the user elects to use it
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0
 */

get_header(); ?>
<div id="home-featured-row" class="row">
  <?php if(have_posts()) : the_post(); ?>
    <div class="large-6 columns">
     <?php the_post_thumbnail(); ?>
    </div><!-- .large-6 .columns -->

    <div class="large-6 columns">
     <?php the_content(); ?>
    </div><!-- .large-6 .columns -->
<?php endif; ?>

</div><!-- .row -->

<!-- Three-up Content Blocks -->
<div id="home-widgets" class="row">
	<div class="large-4 columns widget">
		<div class="panel">
		<?php if(!dynamic_sidebar('home-widget-left')) : ?>
		
      <img src="http://placehold.it/400x300&text=[img]" />
      <h4><?php echo __('This is a content section.', 'wp-foundation') ;?></h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
    <?php endif; ?>
		</div>
	</div>
  
  <div class="large-4 columns widget">
  	<div class="panel">
    <?php if(!dynamic_sidebar('home-widget-center')) : ?>
    <img src="http://placehold.it/400x300&text=[img]" />
      <h4><?php echo __('This is a content section.', 'wp-foundation') ;?></h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
  <?php endif; ?>
  	</div><!-- .panel -->
  </div><!-- .large-4 columns -->
  
  <div class="large-4 columns widget">
  	<div class="panel">
    <?php if(!dynamic_sidebar('home-widget-right')) : ?>
      <img src="http://placehold.it/400x300&text=[img]" />
      <h4><?php echo __('This is a content section.', 'wp-foundation') ;?></h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
  <?php endif; ?>
  	</div><!-- .panel -->
  </div><!-- .large-4 columns -->
<?php get_footer();