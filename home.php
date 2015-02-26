<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */
get_header();

$args = array(
  'post_type'       => 'sf_slide',
  'post_per_page'   => 10,
  'order'           => 'ASC'
);

$slide = new WP_Query( $args );

?>

<div class="flexslider">
  <ul class="slides">
  <?php if ( $slide->have_posts() ) : while ( $slide->have_posts() ) : $slide->the_post(); ?>
    <li><?php echo get_the_post_thumbnail(); ?></li>
  <?php endwhile; else: ?>
    <li><img src="<?php echo get_template_directory_uri(); ?>/img/sample-1.png" alt="Placeholder" width="960" height="380" /></li>
    <li><img src="<?php echo get_template_directory_uri(); ?>/img/sample-2.png" alt="Placeholder" width="960" height="380" /></li>
    <li><img src="<?php echo get_template_directory_uri(); ?>/img/sample-3.png" alt="Placeholder" width="960" height="380" /></li>
  <?php endif; ?>
  </ul>
</div>
<ul class="section group widget_first_row">
  <?php if ( dynamic_sidebar( 'first_row' ) ) : else : endif; ?>
</ul>
<ul class="section group widget_second_row">
  <?php if ( dynamic_sidebar( 'second_row' ) ) : else : endif; ?>
</ul>
<ul class="section group widget_third_row">
  <?php if ( dynamic_sidebar( 'third_row' ) ) : else : endif; ?>
</ul>
<?php get_footer(); ?>