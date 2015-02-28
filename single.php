<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="secton group">
  <div class="col span_6_of_6">
    <?php echo get_the_post_thumbnail(); ?>
  </div>
</div>
<div class="section group article">
  <div class="col span_4_of_6">
  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>

  <?php endwhile; else: ?>
    <h1><?php _e( 'Not Found', 'skafora' ); ?></h1>
    <p><?php _e( 'Sorry, no page matched your criteria.', 'skafora' ); ?></p>
  <?php endif; ?>

  </div>

  <div class="col span_2_of_6">
    <?php get_sidebar(); ?>
  </div>

</div>

<?php get_footer(); ?>