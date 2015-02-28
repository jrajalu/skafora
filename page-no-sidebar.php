<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 *
 * Template Name: Page no sidebar
 */
get_header(); ?>

<div class="section group article">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="col span_6_of_6">

  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>

  <?php endwhile; else: ?>
    <h1><?php _e( 'Not Found', 'skafora' ); ?></h1>
    <p><?php _e( 'Sorry, no page matched your criteria.', 'skafora' ); ?></p>
  <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>