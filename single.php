<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>

<?php endwhile; else: ?>
  <h2 class="content-title"><?php _e( 'Not Found', 'skafora' ); ?></h2>
  <p><?php _e( 'Sorry, no page matched your criteria.', 'skafora' ); ?></p>
<?php endif; ?>


<?php get_footer(); ?>