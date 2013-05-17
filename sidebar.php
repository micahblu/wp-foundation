<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage wp foundation
 * @since wp foundation 0.7
 */
 
 $pagetype = is_blog() ? "blog" : "page";

  //die("<h1>" . $pagetype . "</h1>");
?>
	
	<?php if ( is_active_sidebar( $pagetype . '-sidebar' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( $pagetype . '-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>