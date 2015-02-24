<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */
get_header(); ?>

<div class="flexslider">
  <ul class="slides">
    <li>
      <img src="<?php echo get_template_directory_uri(); ?>/img/slide-1.jpg" alt="Slide-1" width="960" height="380" />
    </li>
    <li>
      <img src="<?php echo get_template_directory_uri(); ?>/img/slide-2.jpg" alt="Slide-2" width="960" height="380" />
    </li>
  </ul>
</div>


<?php get_footer(); ?>