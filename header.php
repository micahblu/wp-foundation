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
	      <h1><a href="#"><?php bloginfo('name'); ?></a></h1>
	    </li>
	    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	  </ul>

	  <section class="top-bar-section">
	  	<?php echo wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>

	    <!-- Right Nav Section 
	    <ul class="right">
	      <li class="active"><a href="#">Right Button Active</a></li>
	      <li class="has-dropdown">
	        <a href="#">Right Button Dropdown</a>
	        <ul class="dropdown">
	          <li><a href="#">First link in dropdown</a></li>
	        </ul>
	      </li>
	    </ul>
			-->
	    <!-- Left Nav Section 
	    <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul>
	    -->
	  </section>
	</nav>
<?php 
  // Uncomment to show menu
  // wp_nav_menu( array( 'menu' => 'Main' ) );
?>