<?php
/**
 * @package skafora
 * @author Jamaludin Rajalu
 */

if($post->post_parent) {
  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
  $titlenamer = get_the_title($post->post_parent);
}

else {
  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
  $titlenamer = get_the_title($post->ID);
}
if ($children) { ?>

<ul class="widget_page_child">
<li><a href="<?php echo get_permalink( $post->post_parent ); ?>"><?php echo $titlenamer; ?></a></li>
<?php echo $children; ?>
</ul>

<?php }

if ( dynamic_sidebar( 'page_sidebar' ) ) : else : endif;

?>