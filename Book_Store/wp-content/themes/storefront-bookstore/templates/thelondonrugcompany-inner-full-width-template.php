<?php
/**
* Template Name: TheLondonRugCompany Inner Fullwidth Page
*/
get_header();
?>
</div><!---col-full--->
<?php the_post_thumbnail();?>
<div class="inner-page-title"><?php the_title('<h1>','</h1>'); ?></div>
	<div id="primary" class="inner-content-area inner-full-template-content-area">
		<main id="main" class="inner-full-template-site-main" role="main">
			<?php
				while ( have_posts() ) :
					the_post();
					the_content();			

				endwhile; // End of the loop.
				?>
		</main><!-- #main -->
	</div><!-- #primary -->
<div class="col-full">
<?php
get_footer();