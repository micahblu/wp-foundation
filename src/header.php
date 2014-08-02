<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wp-foundation
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="<?php echo site_url() ?>"><?php bloginfo('name'); ?></a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  </ul>

  <section class="top-bar-section">
  <?php
  	wp_nav_menu(array(
	  'menu' => 'main_menu', 
	  'menu_class' => '',
	  'container_id' => 'menu', 
	  'walker' => new WPF_Menu_Walker()
	));
	?>
  </section>
</nav>

<div id="page" class="hfeed site row">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wp-foundation' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<small class="site-description"><?php bloginfo( 'description' ); ?></small>
		</div>	
	</header><!-- #masthead -->

	<div id="content" class="site-content">
