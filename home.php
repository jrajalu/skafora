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
    <li><img src="<?php echo get_template_directory_uri(); ?>/img/slide-1.jpg" alt="Slide-1" width="960" height="380" /></li>
    <li><img src="<?php echo get_template_directory_uri(); ?>/img/slide-2.jpg" alt="Slide-2" width="960" height="380" /></li>
  <?php endif; ?>
  </ul>
</div>
<?php get_footer(); ?>