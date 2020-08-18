<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Profix
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
$enable_image_logo = cs_get_option('enable_image_logo');
$image_logo = cs_get_option('image_logo');
$image_logo_max_height = cs_get_option('image_logo_max_height');
$enable_preloader = cs_get_option('enable_preloader');
wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- START PRELOADER -->
	<?php if ( $enable_preloader == true ) : ?>
		<div class="preloader">
	        <div class="spinner">
	          <div class="rect1"></div>
	          <div class="rect2"></div>
	          <div class="rect3"></div>
	          <div class="rect4"></div>
	          <div class="rect5"></div> 
	        </div>
	    </div>
	<?php endif; ?>
	<!-- / END PRELOADER -->
	
	<!-- START HEADER DESIGN AREA -->
	<header>
		<!-- START HEADER TOP DESIGN AREA -->
		<div class="header-top-area">
			<!-- START MENU DESIGN AREA -->
			<div class="container">
				<div class="navbar navbar-default mainmenu">
					<div class="navbar-header">
						<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
							<span class="sr-only"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo esc_url(home_url("/")); ?>" rel="home">

							<?php if( $enable_image_logo == true && !empty( $image_logo ) ) : ?>
								<img style="max-height: <?php echo esc_attr( $image_logo_max_height ); ?>px" src="<?php echo esc_url( $image_logo ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
							<?php else : ?>
								<h1><?php bloginfo( 'name' ); ?></h1>
							<?php endif; ?>
							
						</a>
					</div>
					<div class="navbar-collapse collapse">
						<nav>
							<?php profi_shovondesign_main_menu(); ?>
						</nav>
					</div> 
				</div>
			</div>
			<!-- / END MENU DESIGN AREA -->
		</div>
		<!-- / END HEADER TOP DESIGN AREA -->
	</header>
	<!-- / END HEADER DESIGN AREA -->