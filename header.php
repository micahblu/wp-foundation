<?php
global $wp_foundation_options;	
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'wp_foundation' ), max( $paged, $page ) );

	?></title>

  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css">
  <!--<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/foundation.css">-->

  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/custom.modernizr.js"></script>

  <?php wp_head(); ?>
</head>
<body>

  <div class="row">
    <div class="large-9 columns">
		<?php if(!empty($wp_foundation_options["logo"])) : ?>
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo $wp_foundation_options["logo"]; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</a>
		<?php else: ?>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="subheader site-description"><small><?php bloginfo( 'description' ); ?></small></h2>
		<?php endif; ?>
    </div>
  </div><!-- .row -->  
   
  <div class="row">
    <div class="large-12 columns">
    <?php foundation_nav_bar(); ?>
    </div><!-- .large-9 .columns -->
    <!--
    <div class="large-9 columns">
    	<ul class="right button-group">
	    	<li><a href="#" class="button">Link 1</a></li>
	    	<li><a href="#" class="button">Link 2</a></li>
	    	<li><a href="#" class="button">Link 3</a></li>
	    	<li><a href="#" class="button">Link 4</a></li>
    	</ul>
	</div><.large-9 columns >
	-->
  </div>
  
<!-- End Header and Nav -->