<?php

class LayoutFactory{

	private $path;

	public function __constructor(){

	}

	private function header(){
		include "templates/header.php";
	}

	private function postHeader(){
		include "templates/post/header.php";
	}

	private function pageHeader($page_type){
		if(file_exists("templates/$page_type/header.php")){
			include "templates/$page_type/header.php";
		}
	}

	private function comments(){
		global $post;
		include "templates/comments.php";
	}

	private function body(){

		$page_type = $this->getPageType();

		if($page_type !== 'post'){
			$this->pageHeader($page_type);
		}
		if ( have_posts() ){
	  	
	  	while ( have_posts() ) : the_post();

	  		$this->postHeader($page_type);

		    if($page_type === 'single'){
		    	the_content();
		    	$this->comments();
		    }else{
		    	the_excerpt();
		    }
	  	endwhile; wp_reset_query();

	  	if($page_type !== 'single'){
	  		$this->pagination();
	  	}

		}else{
 			echo '<h2>No posts found</h2>';
		}

	}

	private function getPageType(){
		if(is_singular()){
			return 'single';
		}elseif(is_search()){
			return 'search';
		}elseif(is_archive()){
			return 'archive';
		}elseif(is_page()){
			return 'page';
		}else{
			return 'post';
		}
	}

	private function sidebar(){
		include "templates/sidebar.php";
	}

	private function footer(){
		include "templates/footer.php";
	}

	public function build(){

		$this->header(); ?>
		
		<div class="row body">
	    <div class="main medium-8 columns">
				<?php $this->body(); ?>
			</div>

	    <div class="sidebar medium-4 columns">
	      <?php $this->sidebar(); ?>
	    </div>
	  </div>
			
		<?php $this->footer();
	}

	private function pagination(){
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) : ?>
      <div class="prev">
        <?php next_posts_link( __( '&larr; Older posts' ) ); ?>
      </div>
      <div class="next">
        <?php previous_posts_link( __( 'Newer posts &rarr;' ) ); ?>
      </div>
    <?php 
    endif;
	}
}