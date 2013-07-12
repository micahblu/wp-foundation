<?php
/**
 * The search form html
 *
 * this is called upon by get_search_form()
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 1.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="row collapse">
    	<label class="screen-reader-text" for="s">Search:</label>
    		<div class="small-9 columns">
        	<input type="text" value="" name="s" id="s" />
    		</div>
    		<div class="small-3 columns">
       		<input class="button prefix" type="submit" id="searchsubmit" value="Search" />
    		</div>
    </div><!-- .row -->
</form>