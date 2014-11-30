<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wp-foundation
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer row" role="contentinfo">
		<div class="site-info large-12 columns">
			<a target="_blank" href="<?php echo esc_url( __( 'http://wordpress.org/', 'wp-foundation' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'wp-foundation' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<a target="_blank" href="https://github.com/micahblu/wp-foundation"><?php printf( __( 'Theme: %1$s.', 'wp-foundation' ), 'WP Fgitoundation'); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
