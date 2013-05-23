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
?>
	<div id="secondary" class="widget-area" role="complementary">
	<?php if ( is_active_sidebar( $pagetype . '-sidebar' ) ) : ?>
		
		<?php dynamic_sidebar( $pagetype . '-sidebar' ); ?>
		
	<?php else :  ?>
		<p><em>This is your sidebar, add your widgets in appearance->widgets to see them</em></p>
	<?php endif; ?>
	</div><!-- #secondary -->