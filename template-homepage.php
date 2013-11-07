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

  <div class="large-12 columns">
    <ul data-orbit>
  	<?php
		$args = array(
			'posts_per_page'  => 5,
			'offset'          => 0,
			'category'        => '',
			'orderby'         => 'post_date',
			'order'           => 'DESC',
			'include'         => '',
			'exclude'         => '',
			'meta_key'        => '',
			'meta_value'      => '',
			'post_type'       => 'slide',
			'post_mime_type'  => '',
			'post_parent'     => '',
			'post_status'     => 'publish',
			'suppress_filters' => true 
		);
  	$slides = get_posts($args);
  
  	foreach($slides as $slide) : ?>
  		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($slide->ID) );	 ?>
			<li style="background: url('<?php echo $url; ?>') no-repeat center center">
				<!--<h1><?php echo $slide->post_title; ?></h1>-->
				<p><?php echo do_shortcode(wpautop($slide->post_content)); ?></p>
			</li>
				
  	<?php endforeach; ?>
  </ul>
  
  <hr />
  </div>
</div>

<!-- Three-up Content Blocks -->
<div id="home-widgets" class="row">
	<div class="large-4 columns">
		<div class="panel">
		<?php if(!dynamic_sidebar('home-widget-left')) : ?>
		
      <img src="http://placehold.it/400x300&text=[img]" />
      <h4><?php echo __('This is a content section.', 'wp-foundation') ;?></h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
    <?php endif; ?>
		</div>
	</div>
  
  <div class="large-4 columns">
  	<div class="panel">
    <?php if(!dynamic_sidebar('home-widget-center')) : ?>
    <img src="http://placehold.it/400x300&text=[img]" />
      <h4><?php echo __('This is a content section.', 'wp-foundation') ;?></h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
  <?php endif; ?>
  	</div><!-- .panel -->
  </div><!-- .large-4 columns -->
  
  <div class="large-4 columns">
  	<div class="panel">
    <?php if(!dynamic_sidebar('home-widget-right')) : ?>
      <img src="http://placehold.it/400x300&text=[img]" />
      <h4><?php echo __('This is a content section.', 'wp-foundation') ;?></h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
  <?php endif; ?>
  	</div><!-- .panel -->
  </div><!-- .large-4 columns -->
<?php get_footer();