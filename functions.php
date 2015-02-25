<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */

add_action( 'after_setup_theme', 'skafora_setup' );

  function skafora_setup() {

  add_theme_support( 'html5', array( 'search-form' ) );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );

  register_nav_menus( array(

    'main'      => __( 'Main Navigation', 'skafora' )

  ));

  add_theme_support( 'custom-header', array(

    'width'         => 320,
    'height'        => 100,
    'default-image' => get_template_directory_uri() . '/img/logo.png',
    'uploads'       => true,
    'header-text'   => false,

  ));

  add_filter( 'show_admin_bar', '__return_false' );

  }

add_action( 'wp_enqueue_scripts', 'jquery' );
  function jquery() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', array(), '1.11.2', false );
  }

add_action( 'wp_enqueue_scripts', 'skafora_scripts' );
  function skafora_scripts() {
    // javascripts
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/lib/flexslider/jquery.flexslider-min.js', array(), '2.2.2', true );
    wp_enqueue_script( 'default', get_template_directory_uri() . '/js/script.min.js', array(), '6.5', true );
    // stylesheet
    wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/lib/flexslider/flexslider.css', false, '2.2.2' );
    wp_enqueue_style( 'style', get_stylesheet_uri(), false, '6.5' );
  }

/**
 * @link http://cssmenumaker.com/blog/wordpress-3-drop-down-menu-tutorial
 */

class CSS_Menu_Maker_Walker extends Walker {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
  
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }
  
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
  
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = ''; 
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    
    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }
    
    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }
    
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
    
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
    
    $output .= $indent . '<li' . $id . $value . $class_names .'>';
    
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'><span>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;
    
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}

/**
 * Custom Post Type
 *
 */

// Register Custom Post Type
function skafora_slides() {

  $labels = array(
    'name'                => _x( 'Slides', 'Post Type General Name', 'skafora' ),
    'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'skafora' ),
    'menu_name'           => __( 'Slides', 'skafora' ),
    'parent_item_colon'   => __( 'Parent Slide:', 'skafora' ),
    'all_items'           => __( 'Manage', 'skafora' ),
    'view_item'           => __( 'View Slide', 'skafora' ),
    'add_new_item'        => __( 'Add New Slide', 'skafora' ),
    'add_new'             => __( 'Add New', 'skafora' ),
    'edit_item'           => __( 'Edit Slide', 'skafora' ),
    'update_item'         => __( 'Update Slide', 'skafora' ),
    'search_items'        => __( 'Search Slide', 'skafora' ),
    'not_found'           => __( 'Not found', 'skafora' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'skafora' ),
  );
  $args = array(
    'label'               => __( 'sf_slide', 'skafora' ),
    'description'         => __( 'Frontpage slideshow', 'skafora' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'thumbnail', ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => false,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-images-alt2',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'sf_slide', $args );

}

// Hook into the 'init' action
add_action( 'init', 'skafora_slides', 0 );

// Hook into the 'init' action
add_action( 'init', 'skafora_slides', 0 );

// move to single column

add_action('do_meta_boxes', 'sf_slide_image_box');

function sf_slide_image_box() {

  remove_meta_box( 'postimagediv', 'sf_slide', 'side' );

  add_meta_box( 'postimagediv', __( 'Custom Image' ), 'post_thumbnail_meta_box', 'sf_slide', 'normal', 'high' );

}

/**
 * Sidebar
 */

function skafora_sidebar() {

  register_sidebar( array(
    'id'            => 'first_row',
    'name'          => __( 'First Row', 'skafora' ),
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
    'before_widget' => '<li class="col span_6_of_6">',
    'after_widget'  => '</li>',
  ));

  register_sidebar( array(
    'id'            => 'second_row',
    'name'          => __( 'Second Row', 'skafora' ),
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
    'before_widget' => '<li class="col span_2_of_6">',
    'after_widget'  => '</li>',
  ));

  register_sidebar( array(
    'id'            => 'third_row',
    'name'          => __( 'Thrid Row', 'skafora' ),
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
    'before_widget' => '<li class="col span_2_of_6">',
    'after_widget'  => '</li>',
  ));

  register_sidebar( array(
    'id'            => 'page_sidebar',
    'name'          => __( 'Page Sidebar', 'skafora' ),
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
  ));

  register_sidebar( array(
    'id'            => 'footer',
    'name'          => __( 'Footer', 'skafora' ),
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
  ));
  
}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'skafora_sidebar' );

/**
 * wp_title
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
 */

function skafora_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  $title .= get_bloginfo( 'name', 'display' );

  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'skafora' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'skafora_wp_title', 10, 2 );