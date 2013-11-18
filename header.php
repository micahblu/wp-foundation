<?php
$favicon = of_get_option('wpf-favicon'); // this is  TODO item
$logo    = of_get_option('logo');
$social  = array(
	"facebook"   => of_get_option("facebook_url"),
	"twitter"    => of_get_option("twitter_url"),
	"instagram"  => of_get_option("instagram_url"),
	"pinterest"  => of_get_option("pinterest_url"),
	"youtube"    => of_get_option("youtube_url"),
);
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9"  <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
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
		echo ' | ' . sprintf( __( 'Page %s', 'wp-foundation' ), max( $paged, $page ) );

	?></title>

  <?php wp_head(); ?>
  
  <?php if(!empty($wp_foundation_options["wpf-favicon"])): ?>
  <link rel="shortcut icon" href="<?php echo $wp_foundation_options["wpf-favicon"] ?>" />
  <?php else : ?>
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  <?php endif; ?>
  
</head>
<body <?php body_class(); ?>>
	<?php if(true) : //if top_bar==true ?>
	<nav class="top-bar">
		<ul class="title-area">
	    <!-- Title Area -->
	    <li class="name">
	      <h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	    </li>
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>
		<?php foundation_top_bar_menu(); ?>
	</nav>
  <?php endif; ?>

  <div id="header" class="row">
    <div id="brand" class="large-9 columns">

    <?php if(!empty($logo)) : ?>
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img id="logo" src="<?php echo $logo ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</a>
		<?php else: ?>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="subheader site-description"><small><?php bloginfo( 'description' ); ?></small></h2>
		<?php endif; ?>

    </div><!-- #brand .large-9 .columns -->


    <div id="social-header-block">
			<?php if(!empty($social['facebook']))  : ?><a href="<?php echo $social['facebook'] ?>" target="_blank" class="facebook social-icon">Facebook</a><?php endif; ?>
			<?php if(!empty($social['twitter']))   : ?><a href="<?php echo $social['twitter'] ?>" target="_blank" class="twitter social-icon">Twitter</a><?php endif; ?>
			<?php if(!empty($social['instagram'])) : ?><a href="<?php echo $social['instagram'] ?>" target="_blank" class="instagram social-icon">Instagram</a><?php endif; ?>
			<?php if(!empty($social['pinterest'])) : ?><a href="<?php echo $social['pinterest'] ?>" target="_blank" class="pinterest social-icon">Pinterest</a><?php endif; ?>
			<?php if(!empty($social['youtube']))   : ?><a href="<?php echo $social['youtube'] ?>" target="_blank" class="youtube social-icon">Youtube</a><?php endif; ?>
		</div><!-- #social-header -->
  </div><!-- #header .row -->  
   
  <?php 
  /**
   * TODO - Basic Menu Support
   */
  if(false) : //if basic_menu == true ?> 
  <div class="row">
    <div class="large-12 columns">
    <?php foundation_nav_bar(); ?>
    </div><!-- .large-9 .columns -->
  </div><!-- .row -->
  <?php endif; ?>
  <!-- End Header and Nav -->
  <div id="container">