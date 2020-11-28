<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' );?>
       	<?php the_category(); ?>
        <?php if( has_post_thumbnail() ):
        	the_post_thumbnail('medium');
         endif;?>
</article>
