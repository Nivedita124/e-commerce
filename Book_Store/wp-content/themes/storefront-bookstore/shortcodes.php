<?php

	function blog_code(){
		// $cat_args=array(
        //     'include' => '7,8,9',
        //     'orderby' => 'name',
        //     'order' => 'ASC'
        //         );
        // $categories=get_categories($cat_args);
        // foreach($categories as $category):
            // $args=array(
            //     'type'=>'posts',
            //     'posts_per_page'=>3,
            //     'category__in' => array($category->term_id),
            //     );
            $lastblog=new WP_Query('showposts=3');
            if( $lastblog->have_posts() ):?>
                <ul class="row"><?php
                while( $lastblog->have_posts() ): $lastblog->the_post(); ?>
                    <li class="col-md-4">
                        <?php get_template_part('content','featured'); ?>
                    </li>
                <?php endwhile;?>
            </ul>
            <?php
            endif;
            wp_reset_postdata();
    }?>
	<?php add_shortcode('blogpost', 'blog_code'); 

 ?>