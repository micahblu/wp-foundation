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
			<a target="_blank" href="<?php echo esc_url( __( 'http://wordpress.org/', 'wp-foundation' ) ); ?>"><?php printf( __( 'Powered by %s', 'wp-foundation' ), 'WordPress' ); ?></a>
			<span class="sep"> and </span>
			<a target="_blank" href="https://github.com/micahblu/wp-foundation"><?php printf( __( '%1$s.', 'wp-foundation' ), 'WP Foundation'); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
