<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */
?>
<div class="footer">
  <ul class="section group widget_footer">
    <li class="col span_1_of_6 footer_logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-footer.png" alt="Logo Footer" /></li>
    <?php if ( dynamic_sidebar( 'footer_left' ) ) : else : endif; ?>
    <?php if ( dynamic_sidebar( 'footer_right' ) ) : else : endif; ?>
  </ul>
</div>
</div><!--end .wrapper-->
<?php wp_footer(); ?>
</body>
</html>