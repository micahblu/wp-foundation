<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
  <?php
    if( ! is_home() ):
      wp_title( '|', true, 'right' );
    endif;
    bloginfo( 'name' );
  ?>
</title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
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
			  'menu_class' => 'right',
			  'container_id' => 'cssmenu', 
			  'walker' => new WPF_Menu_Walker()
			));
		?>
	  </section>
	</nav>
