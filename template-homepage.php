<?php
/**
 * Template Name: Homepage
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0
 */

get_header(); ?>

<!-- First Band (Slider) -->

  <div class="row">
    <div class="large-12 columns">
    <ul data-orbit>
      <li><img src="http://placehold.it/1000x400&text=[ img 1 ]" /></li>
      <li><img src="http://placehold.it/1000x400&text=[ img 2 ]" /></li>
      <li><img src="http://placehold.it/1000x400&text=[ img 3 ]" /></li>
      <li><img src="http://placehold.it/1000x400&text=[ img 4 ]" /></li>
    </ul>
    <!-- <div id="slider">
      
    </div> -->
    
    <hr />
    </div>
  </div>
  
<!-- Three-up Content Blocks -->

	<div class="row">
		<div class="large-4 columns">
	      <img src="http://placehold.it/400x300&text=[img]" />
	      <h4>This is a content section.</h4>
	      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
		</div>
    
	    <div class="large-4 columns">
	      <img src="http://placehold.it/400x300&text=[img]" />
	      <h4>This is a content section.</h4>
	      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
	    </div>
    
	    <div class="large-4 columns">
	      <img src="http://placehold.it/400x300&text=[img]" />
	      <h4>This is a content section.</h4>
	      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
	    </div>
    </div>
    
<!-- Call to Action Panel -->
<div class="row">
    <div class="large-12 columns">
    
      <div class="panel">
        <h4>Get in touch!</h4>
            
        <div class="row">
          <div class="large-9 columns">
            <p>We'd love to hear from you, you attractive person you.</p>
          </div>
          <div class="large-3 columns">
            <a href="#" class="radius button right">Contact Us</a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
<?php 
get_footer();
?>
