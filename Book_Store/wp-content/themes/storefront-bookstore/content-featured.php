<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( has_post_thumbnail() ): ?>
        <div class="featured-thumbnail"> <?php the_post_thumbnail(); ?></div>
    <?php endif; ?>
    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
    <h5>By <?php the_author();?></h5>
    	<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
</article>