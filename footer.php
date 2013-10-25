	</div><!-- .row -->
  <!-- Footer -->  
  <footer class="row">
    <div class="large-12 columns">
      <hr />
      <div class="row">
        <div class="large-6 columns">
          <p><?php //here is where copyright message should be ?></p>
        </div>
        <div class="large-6 columns">
         
            <?php //footer menu
            	wp_nav_menu(array( 
				        'container' => false,             // remove menu container
				        'container_class' => '',          // class of container
				        'menu' => '',                     // menu name
				        'menu_class' => 'inline-list right', // adding custom nav class
				        'theme_location' => 'footer-menu',  // where it's located in the theme
				        'before' => '',                   // before each link <a>
				        'after' => '',                    // after each link </a>
				        'link_before' => '',              // before each link text
				        'link_after' => '',               // after each link text
				        'depth' => 1,                     // limit the depth of the nav	
							));
             ?>
         
        </div>
      </div>
    </div> 
  </footer>
  <?php wp_footer(); ?>
  <script>
    // hack to add a class to wordpress generated inputs where id=submit. i.e. commment submit button
		$("input[id=submit]").addClass("button"); 
		// init foundation scripts
   // $(document).foundation();
    
    $(document).foundation('orbit', {
		  animation: 'fade',
		  timer_speed: 10000,
		  pause_on_hover: true,
		  resume_on_mouseout: false,
		  animation_speed: 500,
		  stack_on_small: true,
		  navigation_arrows: true,
		  slide_number: true,
		  container_class: 'orbit-container',
		  stack_on_small_class: 'orbit-stack-on-small',
		  next_class: 'orbit-next',
		  prev_class: 'orbit-prev',
		  timer_container_class: 'orbit-timer',
		  timer_paused_class: 'paused',
		  timer_progress_class: 'orbit-progress',
		  slides_container_class: 'orbit-slides-container',
		  bullets_container_class: 'orbit-bullets',
		  bullets_active_class: 'active',
		  slide_number_class: 'orbit-slide-number',
		  caption_class: 'orbit-caption',
		  active_slide_class: 'active',
		  orbit_transition_class: 'orbit-transitioning',
		  bullets: true,
		  timer: false,
		  next_on_click: false,
		  variable_height: false,
		  before_slide_change: function(){},
		  after_slide_change: function(){
			  alert(this);
		  }
		});
  </script>

  <?php do_action("wp_foundation_did_footer"); ?>
  <!-- End Footer -->
</body>
</html>
