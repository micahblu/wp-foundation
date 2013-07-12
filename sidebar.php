<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7
 */

$pagetype = is_blog() ? "blog" : "page";
?>
	<div id="secondary" class="widget-area" role="complementary">
	<?php if ( is_active_sidebar( $pagetype . '-sidebar' ) ) : ?>
		
		<?php dynamic_sidebar( $pagetype . '-sidebar' ); ?>
		
	<?php else :  ?>
		<p><em><?php echo __( 'This is your sidebar, add your widgets in appearance&ndash;&gt;widgets to see them', 'wp-foundation' ) ?> </em></p>
	<?php endif; ?>
	</div><!-- #secondary -->