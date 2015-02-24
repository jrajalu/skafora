<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '&bull;', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<?php wp_head(); ?>
</head>
<body>
<div class="wrapper">
<header class="section group">
<div class="col span_4_of_12">
<a href="<?php bloginfo( 'url' ); ?>">
<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
</a>
</div>
<div class="col span_8_of_12">
<?php 
wp_nav_menu(array(
  'menu'          => 'Main Navigation', 
  'container_id'  => 'cssmenu', 
  'walker'        => new CSS_Menu_Maker_Walker()
)); 
?>
</div>
</header>